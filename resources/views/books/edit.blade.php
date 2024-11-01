@extends('layouts.dashboard')

@section('title', 'Edit Book')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Edit Book</h1>

    <form action="{{ route('books.update', $book->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="title" class="block font-medium">Title</label>
            <input type="text" name="title" id="title" value="{{ $book->title }}" required
                class="w-full border rounded p-2">
        </div>

        <div class="mb-4">
            <label for="author" class="block font-medium">Author</label>
            <input type="text" name="author" id="author" value="{{ $book->author }}" required
                class="w-full border rounded p-2">
        </div>

        <div class="mb-4">
            <label for="isbn" class="block font-medium">ISBN</label>
            <input type="text" name="isbn" id="isbn" value="{{ $book->isbn }}" required
                class="w-full border rounded p-2">
        </div>

        <div class="mb-4">
            <label for="publication_year" class="block font-medium">Publication Year</label>
            <input type="number" name="publication_year" id="publication_year" value="{{ $book->publication_year }}"
                required class="w-full border rounded p-2">
        </div>

        <div class="mb-4">
            <label for="total_copies" class="block font-medium">Total Copies</label>
            <input type="number" name="total_copies" id="total_copies" value="{{ $book->total_copies }}" required
                class="w-full border rounded p-2">
        </div>

        <div class="mb-4">
            <label for="cover" class="block font-medium">Cover Image</label>
            <input type="file" name="cover" id="cover" class="w-full border rounded p-2">
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update Book</button>
    </form>
@endsection
