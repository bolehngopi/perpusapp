<?php

namespace App\Http\Controllers;

use App\Models\Borrowing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BorrowingController extends Controller
{
    public function index()
    {
        $borrows = Borrowing::with(['user', 'book'])->get(); // Eager load relationships
        return view('borrows.index', compact('borrows'));
    }

    public function borrow(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'book_id' => 'required|exists:books,id',
            'borrowed_at' => 'required|date',
            'due_at' => 'required|date|after:borrowed_at',
        ]);

        // Check if the user has already borrowed this book
        $existingBorrowing = Borrowing::where('user_id', $validated['user_id'])
            ->where('book_id', $validated['book_id'])
            ->whereNull('returned_at') // Check if the book has not been returned yet
            ->first();

        if ($existingBorrowing) {
            return redirect()->back()->with('error', 'This book has already been borrowed by you');
        }

        try {
            Borrowing::borrowBook(
                $validated['book_id'],
                $validated['user_id'],
                $validated['borrowed_at'],
                $validated['due_at']
            );

            return redirect()->back()->with('success', 'Book borrowed successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function returnBook($id)
    {
        $borrowing = Borrowing::findOrFail($id);
        $borrowing->returnBook();

        return redirect()->back()->with('success', 'Book returned successfully.');
    }

    // get all books borrowed by a user
    public function userBorrows()
    {
        $userId = Auth::id();
        $borrows = Borrowing::where('user_id', $userId)->with('book')->paginate(10);
        return view('borrows.index', compact('borrows'));
    }
}
