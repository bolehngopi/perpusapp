@extends('layouts.dashboard')

@section('title', 'Dashboard Books')

@section('content')
    <div class="max-w-7xl mx-auto">
        <h1 class="text-4xl font-bold text-center mb-12">All books</h1>

        @if ($books->isEmpty())
            <p class="text-center text-gray-500 dark:text-gray-400">No books available at the moment. Please check back
                later!</p>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                @foreach ($books as $book)
                    <div
                        class="group bg-white dark:bg-gray-800 shadow-lg rounded-lg overflow-hidden hover:shadow-xl transition-shadow duration-300 flex flex-col h-full">
                        <a href="{{ route('books.show', $book->id) }}" class="block">
                            @if ($book->cover)
                                <img src="{{ asset('storage/' . $book->cover) }}" alt="{{ $book->title }}"
                                    class="w-full h-64 object-cover group-hover:scale-105 transition-transform duration-300">
                            @else
                                <div class="w-full h-64 bg-gray-200 dark:bg-gray-900 flex items-center justify-center">
                                    <span class="text-gray-500 dark:text-gray-300">No Cover Available</span>
                                </div>
                            @endif
                        </a>

                        <div class="p-4 flex flex-col flex-grow">
                            <h2
                                class="text-lg font-semibold mb-1 group-hover:text-blue-500 transition-colors dark:text-white">
                                {{ $book->title }}
                            </h2>

                            <div class="mt-auto">
                                <p class="text-sm text-gray-500 dark:text-gray-300 mb-1"><strong>Author:</strong>
                                    {{ $book->author }}</p>
                                <p class="text-sm text-gray-500 dark:text-gray-300"><strong>ISBN:</strong>
                                    {{ $book->isbn }}</p>
                                <p class="text-sm text-gray-600 dark:text-gray-400"><strong>Year:</strong>
                                    {{ $book->publication_year }}</p>
                                <p class="text-sm text-gray-600 dark:text-gray-400">
                                    <strong>Copies Available:</strong> {{ $book->available_copies }}
                                </p>
                            </div>
                        </div>

                        <div class="p-4 flex justify-between items-center">
                            <a href="{{ route('books.show', $book->id) }}"
                                class="w-full text-center bg-blue-500 hover:bg-blue-600 text-white py-2 rounded-lg transition-colors dark:bg-blue-700 dark:hover:bg-blue-600">
                                View
                            </a>
                            <a href="{{ route('books.edit', $book->id) }}"
                                class="ml-2 w-full text-center bg-yellow-500 hover:bg-yellow-600 text-white py-2 rounded-lg transition-colors dark:bg-yellow-600 dark:hover:bg-yellow-500">
                                Edit
                            </a>

                            <form action="{{ route('books.destroy', $book->id) }}" method="POST" class="ml-2 w-full">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="w-full bg-red-500 hover:bg-red-600 text-white py-2 rounded-lg transition-colors dark:bg-red-600 dark:hover:bg-red-500"
                                    onclick="return confirm('Are you sure you want to delete this book?')">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-12">
                {{ $books->links() }} <!-- Pagination -->
            </div>
        @endif
    </div>
@endsection
