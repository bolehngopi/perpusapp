<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrowing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    public function index()
    {
        // Retrieve books in different categories
        $newBooks = Book::orderBy('created_at', 'desc')->take(4)->get(); // Newest books
        $mostBorrowedBooks = Book::withCount('borrowings')
            ->orderBy('borrowings_count', 'desc')
            ->take(4)
            ->get(); // Most borrowed books

        return view('books.index', compact('newBooks', 'mostBorrowedBooks'));
    }



    public function show($id)
    {
        $book = Book::findOrFail($id);
        $borrowing = Borrowing::where('book_id', $id)
            ->where('user_id', auth()->id())
            ->whereNull('returned_at')
            ->first(); // Get the borrowing record if it exists

        $borrowedDetails = Borrowing::where('book_id', $book->id)
            ->whereNull('returned_at')
            ->with('user')
            ->get();


        return view('books.show', compact('book', 'borrowing', 'borrowedDetails'));
    }



    public function create()
    {
        return view('books.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'isbn' => 'required|unique:books',
            'publisher' => 'nullable|string|max:255',
            'publication_year' => 'required|digits:4',
            'genre' => 'nullable|string|max:100',
            'description' => 'nullable|string',
            'total_copies' => 'required|integer|min:1',
            'location' => 'nullable|string|max:255',
            'language' => 'nullable|string|max:100',
            'is_reference_only' => 'boolean',
            'cover' => 'nullable|image|max:2048'
        ]);

        // Handle cover upload
        $coverPath = $request->file('cover') ? $request->file('cover')->store('covers', 'public') : null;

        // Create the book record
        Book::create(array_merge($request->all(), ['available_copies' => $request->total_copies, 'cover' => $coverPath]));

        return redirect()->route('dashboard.index')->with('success', 'Book added successfully!');
    }

    public function edit(Book $book)
    {
        return view('books.edit', compact('book'));
    }

    public function update(Request $request, Book $book)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'isbn' => "required|unique:books,isbn,{$book->id}",
            'publication_year' => 'required|digits:4',
            'total_copies' => 'required|integer|min:1',
            'cover' => 'nullable|image|max:2048'
        ]);

        // Handle cover replacement if a new one is uploaded
        if ($request->hasFile('cover')) {
            if ($book->cover) {
                Storage::disk('public')->delete($book->cover);
            }
            $coverPath = $request->file('cover')->store('covers', 'public');
            $book->cover = $coverPath;
        }

        $book->update(array_merge($request->except('cover'), ['available_copies' => $request->total_copies]));

        return redirect()->route('dashboard.index')->with('success', 'Book updated successfully!');
    }

    public function destroy(Book $book)
    {
        if ($book->cover) {
            Storage::disk('public')->delete($book->cover);
        }
        $book->delete();

        return redirect()->route('dashboard.index')->with('success', 'Book deleted successfully!');
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        $books = Book::where('title', 'like', "%{$query}%")
            ->orWhere('author', 'like', "%{$query}%")
            ->orWhere('isbn', 'like', "%{$query}%")
            ->paginate(10); // Pagination with 10 books per page

        return view('books.search', compact('books'));
    }

}
