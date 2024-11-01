<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBooks = Book::count();
        $totalBorrowedBooks = Book::whereHas('borrowings', function ($query) {
            $query->whereNull('returned_at');
        })->count();
        $totalUsers = User::count();
        return view(
            'dashboard',
            compact('totalBooks', 'totalBorrowedBooks', 'totalUsers')
        );
    }

    public function books()
    {
        $books = Book::paginate(10);

        return view('dashboard.books', compact('books'));
    }

    public function users()
    {
        $users = User::paginate(10);

        return view('dashboard.users', compact('users'));
    }

}
