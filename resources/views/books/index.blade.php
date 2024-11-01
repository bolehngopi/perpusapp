@extends('layouts.app')

@section('title', 'Library Books')

@section('content')
    <div class="max-w-7xl mx-auto">
        <h1 class="text-4xl font-bold text-center mb-12">Library Collection</h1>

        <!-- New Arrivals Section -->
        <section class="mb-12">
            <h2 class="text-3xl font-bold text-gray-800 mb-6">New Arrivals</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                @foreach ($newBooks as $book)
                    @include('books.partials.book-card', ['book' => $book])
                @endforeach
            </div>
        </section>

        <!-- Most Borrowed Section -->
        <section class="mb-12">
            <h2 class="text-3xl font-bold text-gray-800 mb-6">Most Borrowed Books</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                @foreach ($mostBorrowedBooks as $book)
                    @include('books.partials.book-card', ['book' => $book])
                @endforeach
            </div>
        </section>
    </div>
@endsection
