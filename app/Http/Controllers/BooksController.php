<?php

namespace App\Http\Controllers;

use App\Models\BookBorrows;
use App\Models\Books;
use Illuminate\Http\Request;

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
            // Get borrow information
            $borrow = BookBorrows::where("bookid", $book->bookid)->first();

            if ($borrow) {
                $book->isborrowed = true;
                $book->borrowId = $borrow->id;
                
                // Check if the current user borrowed this book
                if ($borrow->userid == $user->id) {
                    $book->borrowedByMe = true;
                }
            } else {
                $book->isborrowed = false;
            }
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
        ]);
        
        $user = auth()->user();
        
        if ($user->role === "admin") {
            $book->update($values);
            return redirect(route("books.index", compact("user")));
        }
    }
    public function borrow($id)
    {
        $user = auth()->user();
        $book = Books::find($id);
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
            $borrow = BookBorrows::firstWhere("bookid", $book->bookid);

            if($borrow){
                return back()->withErrors([
                    "errors"=>"Book Already Borrowed"
                ]);
            }
            BookBorrows::create([
                "bookid"=>$book->bookid,
                "userid"=>$user->id,
                ...$values
            ]);
            return redirect(route("books.index", compact("user")));
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
            $book->delete();
            return redirect(route("books.index", compact("user")));
        }
    }
}
