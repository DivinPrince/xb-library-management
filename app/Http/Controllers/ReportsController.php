<?php

namespace App\Http\Controllers;

use App\Models\BookBorrows;
use App\Models\Books;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportsController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        // Only admins can access reports
        if ($user->role !== 'admin') {
            return redirect('/');
        }
        
        // Get basic statistics
        $totalBooks = Books::count();
        $totalBorrowed = BookBorrows::count();
        $totalUsers = User::where('role', '!=', 'admin')->count();
        
        // Books currently borrowed
        $currentBorrows = BookBorrows::with(['book', 'user'])
            ->orderBy('borrowdate', 'desc')
            ->get();
            
        return view('reports.index', compact('user', 'totalBooks', 'totalBorrowed', 'totalUsers', 'currentBorrows'));
    }
    
    public function borrowHistory()
    {
        $user = auth()->user();
        
        // Only admins can access reports
        if ($user->role !== 'admin') {
            return redirect('/');
        }
        
        $borrowHistory = BookBorrows::with(['book', 'user'])
            ->orderBy('borrowdate', 'desc')
            ->get();
            
        return view('reports.borrow-history', compact('user', 'borrowHistory'));
    }
    
    public function userActivity(Request $request)
    {
        $user = auth()->user();
        
        // Only admins can access reports
        if ($user->role !== 'admin') {
            return redirect('/');
        }
        
        $userId = $request->input('user_id');
        
        $users = User::where('role', '!=', 'admin')->get();
        
        $userBorrows = null;
        if ($userId) {
            $userBorrows = BookBorrows::with('book')
                ->where('userid', $userId)
                ->orderBy('borrowdate', 'desc')
                ->get();
        }
        
        return view('reports.user-activity', compact('user', 'users', 'userBorrows', 'userId'));
    }
    
    public function popularBooks()
    {
        $user = auth()->user();
        
        // Only admins can access reports
        if ($user->role !== 'admin') {
            return redirect('/');
        }
        
        $popularBooks = DB::table('book_borrows')
            ->join('books', 'book_borrows.bookid', '=', 'books.bookid')
            ->select('books.bookid', 'books.bookname', DB::raw('count(*) as borrow_count'))
            ->groupBy('books.bookid', 'books.bookname')
            ->orderBy('borrow_count', 'desc')
            ->get();
            
        return view('reports.popular-books', compact('user', 'popularBooks'));
    }
} 