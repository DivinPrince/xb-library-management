<?php

namespace App\Http\Controllers;

use App\Models\BookBorrows;
use App\Models\Books;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();

        $books = Books::all();

        foreach ($books as $book) {
            // Count active borrows for this book
            $activeBookBorrows = BookBorrows::where("bookid", $book->bookid)->count();
            
            // Calculate available copies
            $book->availableCopies = max(0, $book->quantity - $activeBookBorrows);
            
            // Get borrow information
            $userBorrow = BookBorrows::where("bookid", $book->bookid)
                ->where('userid', $user->id)
                ->first();

            if ($userBorrow) {
                $book->borrowedByMe = true;
                $book->borrowId = $userBorrow->id;
            }
            
            // Mark as borrowed if all copies are taken
            $book->isborrowed = ($book->availableCopies <= 0);
        };
        return view("books.index", compact("user", "books"));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = auth()->user();
        return view("books.create", compact("user"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $values = $request->validate([
            "bookname" => "required|string",
            "quantity" => "required|integer|min:1",
        ]);

        $user = auth()->user();

        if ($user->role === "admin") {
            $res = Books::create($values);
            if ($res) {
                return redirect(route("books.index", compact("user")));
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Books $books)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Books $book)
    {
        $user = auth()->user();
        return view("books.edit", compact("user", "book"));
        //
    }
    
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Books $book)
    {
        $values = $request->validate([
            "bookname" => "required|string",
            "quantity" => "required|integer|min:1",
        ]);
        
        $user = auth()->user();
        
        if ($user->role === "admin") {
            // Get current number of borrows for this book
            $currentBorrows = BookBorrows::where('bookid', $book->bookid)->count();
            
            // Ensure new quantity is not less than current borrows
            if ($values['quantity'] < $currentBorrows) {
                return back()->withErrors([
                    "errors" => "Cannot reduce quantity below the number of currently borrowed copies ($currentBorrows)"
                ]);
            }
            
            $book->update($values);
            return redirect(route("books.index", compact("user")));
        }
    }
    
    public function borrow($id)
    {
        $user = auth()->user();
        $book = Books::find($id);
        
        // Check if user already has a borrowed copy of this book
        $existingBorrow = BookBorrows::where('bookid', $book->bookid)
            ->where('userid', $user->id)
            ->exists();
            
        if ($existingBorrow) {
            return back()->withErrors([
                "errors" => "You already have a copy of this book borrowed"
            ]);
        }
        
        // Count active borrows for this book
        $activeBookBorrows = BookBorrows::where("bookid", $book->bookid)->count();
        
        // Check if there are available copies
        if ($activeBookBorrows >= $book->quantity) {
            return back()->withErrors([
                "errors" => "No copies available for borrowing"
            ]);
        }
        
        return view("books.borrow", compact("user", "book"));
    }

    public function borrowBook(Request $request,$id)
    {
        $values = $request->validate([
            "borrowdate" => "required",
            "returndate" => "required",
        ]);

        $book = Books::find($id);
        $user = auth()->user();

        if ($user->role !== "admin") {
            // Check if user already has a borrowed copy of this book
            $existingBorrow = BookBorrows::where('bookid', $book->bookid)
                ->where('userid', $user->id)
                ->exists();
                
            if ($existingBorrow) {
                return back()->withErrors([
                    "errors" => "You already have a copy of this book borrowed"
                ]);
            }
            
            // Count active borrows for this book
            $activeBookBorrows = BookBorrows::where("bookid", $book->bookid)->count();
            
            // Check if there are available copies
            if ($activeBookBorrows >= $book->quantity) {
                return back()->withErrors([
                    "errors" => "No copies available for borrowing"
                ]);
            }
            
            BookBorrows::create([
                "bookid" => $book->bookid,
                "userid" => $user->id,
                ...$values
            ]);
            return redirect(route("books.index", compact("user")))->with('success', 'Book borrowed successfully');
        }
    }
    
    /**
     * Return a borrowed book
     */
    public function returnBook($id)
    {
        $user = auth()->user();
        $bookBorrow = BookBorrows::findOrFail($id);
        
        // Check if the current user borrowed this book or is an admin
        if ($bookBorrow->userid === $user->id || $user->role === "admin") {
            $bookBorrow->delete();
            return redirect(route("books.index", compact("user")))->with('success', 'Book returned successfully');
        }
        
        return back()->withErrors([
            "errors" => "You cannot return a book you did not borrow"
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Books $book)
    {
        $user = auth()->user();

        if ($user->role === "admin") {
            // Check if any copies are currently borrowed
            $borrowedCount = BookBorrows::where('bookid', $book->bookid)->count();
            
            if ($borrowedCount > 0) {
                return back()->withErrors([
                    "errors" => "Cannot delete book while copies are still borrowed"
                ]);
            }
            
            $book->delete();
            return redirect(route("books.index", compact("user")));
        }
    }
}
