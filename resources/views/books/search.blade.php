@extends('layouts.app')

@section('title', 'Search Books')

@section('content')
    <div class="max-w-4xl mx-auto">
        <h1 class="text-3xl font-bold mb-4">Search Books</h1>

        <form action="{{ route('books.search') }}" method="GET" class="mb-8">
            <input type="text" name="query" placeholder="Search by title, author, or ISBN"
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                value="{{ request('query') }}" required>
            <button type="submit" class="mt-4 bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md">
                Search
            </button>
        </form>

        @if (isset($books) && $books->count() > 0)
            <div class="grid gap-6">
                @foreach ($books as $book)
                    <div class="p-6 bg-white shadow-md rounded-lg">
                        <h2 class="text-xl font-semibold">{{ $book->title }}</h2>
                        <p class="text-gray-600">Author: {{ $book->author }}</p>
                        <p class="text-gray-600">ISBN: {{ $book->isbn }}</p>
                        <a href="{{ route('books.show', $book->id) }}"
                            class="mt-4 inline-block text-blue-500 hover:underline">
                            View Details
                        </a>
                    </div>
                @endforeach
            </div>

            {{-- Pagination Links --}}
            <div class="mt-8">
                {{ $books->appends(['query' => request('query')])->links('pagination::tailwind') }}
            </div>
        @else
            <p class="text-gray-500">No books found. Try a different search.</p>
        @endif
    </div>
@endsection
