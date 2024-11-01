<!-- resources/views/dashboard.blade.php -->
@extends('layouts.dashboard')

@section('title', 'Dashboard')

@section('content')
    <div class="text-center">
        <h1 class="text-3xl font-bold mb-6">Welcome to Your Dashboard!</h1>
        <p class="text-lg text-gray-600 mb-4">Manage the library with ease.</p>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Example Cards -->
            <div class="bg-white shadow-md rounded-lg p-6">
                <h2 class="text-xl font-semibold mb-2">Total Books</h2>
                <p class="text-3xl font-bold text-blue-600">{{ $totalBooks }}</p>
            </div>
            <div class="bg-white shadow-md rounded-lg p-6">
                <h2 class="text-xl font-semibold mb-2">Active Borrowings</h2>
                <p class="text-3xl font-bold text-green-600">{{ $totalBorrowedBooks }}</p>
            </div>
            <div class="bg-white shadow-md rounded-lg p-6">
                <h2 class="text-xl font-semibold mb-2">Users</h2>
                <p class="text-3xl font-bold text-purple-600">{{ $totalUsers }}</p>
            </div>
        </div>
    </div>
@endsection
