@extends('layouts.app')

@section('title', $book->title)

@section('content')
    <div class="max-w-4xl mx-auto bg-white shadow-lg rounded-lg p-8">
        {{-- Book Cover --}}
        @if ($book->cover)
            <img src="{{ asset('storage/' . $book->cover) }}" alt="{{ $book->title }}"
                class="w-full h-96 object-cover rounded-md mb-6">
        @else
            <div class="w-full h-96 bg-gray-200 rounded-md mb-6 flex items-center justify-center">
                <span class="text-gray-400">No Cover Available</span>
            </div>
        @endif

        <h1 class="text-4xl font-bold mb-4">{{ $book->title }}</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <p><strong>Author:</strong> {{ $book->author }}</p>
            <p><strong>ISBN:</strong> {{ $book->isbn }}</p>
            <p><strong>Publisher:</strong> {{ $book->publisher ?? 'N/A' }}</p>
            <p><strong>Publication Year:</strong> {{ $book->publication_year }}</p>
            <p><strong>Genre:</strong> {{ $book->genre ?? 'N/A' }}</p>
            <p><strong>Language:</strong> {{ $book->language ?? 'N/A' }}</p>
            <p><strong>Total Copies:</strong> {{ $book->total_copies }}</p>
            <p><strong>Available Copies:</strong> {{ $book->available_copies }}</p>
        </div>

        <p class="mt-6"><strong>Description:</strong><br>{{ $book->description ?? 'No description available.' }}</p>

        {{-- Active Borrowed Details --}}
        @if ($borrowedDetails->count() > 0)
            <div class="mt-6 bg-yellow-50 border-l-4 border-yellow-400 p-4">
                <h2 class="text-lg font-semibold text-yellow-700">Currently Borrowed By:</h2>
                <ul class="list-disc pl-6">
                    @foreach ($borrowedDetails as $borrow)
                        <li class="text-gray-700">
                            <strong>{{ $borrow->user->name }}</strong>
                            (Due: {{ \Carbon\Carbon::parse($borrow->due_at)->format('d M Y') }})
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="mt-8 flex flex-wrap gap-4">
            {{-- Back to Library --}}
            <a href="{{ route('books.index') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                Back to Library
            </a>

            {{-- Borrow Book --}}
            @if ($book->available_copies > 0 && !$borrowing && !$book->is_reference_only)
                <form action="{{ route('borrows.borrow') }}" method="POST">
                    @csrf
                    <input type="hidden" name="book_id" value="{{ $book->id }}">
                    <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                    <input type="hidden" name="borrowed_at" value="{{ now() }}">
                    <input type="hidden" name="due_at" value="{{ now()->addDays(14) }}">

                    <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">
                        Borrow
                    </button>
                </form>
            @else
                <button class="bg-gray-500 text-white px-4 py-2 rounded cursor-not-allowed" disabled>
                    @if ($book->is_reference_only)
                        Reference Only
                    @elseif ($borrowing)
                        Already Borrowed
                    @else
                        Not Available
                    @endif
                </button>
            @endif

            {{-- Return Book --}}
            @if ($borrowing)
                <form action="{{ route('borrows.return', $borrowing->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">
                        Return Book
                    </button>
                </form>
            @endif
        </div>
    </div>
@endsection
