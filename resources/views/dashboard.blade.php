@extends('layouts.dashboard')

@section('title', 'Dashboard')

@section('content')
    <div class="text-center">
        <h1 class="text-3xl font-bold mb-6 text-gray-900 dark:text-gray-100">Welcome to Your Dashboard!</h1>
        <p class="text-lg text-gray-600 dark:text-gray-400 mb-4">Manage the library with ease.</p>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Example Cards with Dark Mode Styling -->
            <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
                <h2 class="text-xl font-semibold mb-2 text-gray-800 dark:text-gray-200">Total Books</h2>
                <p class="text-3xl font-bold text-blue-600 dark:text-blue-400">{{ $totalBooks }}</p>
            </div>
            <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
                <h2 class="text-xl font-semibold mb-2 text-gray-800 dark:text-gray-200">Active Borrowings</h2>
                <p class="text-3xl font-bold text-green-600 dark:text-green-400">{{ $totalBorrowedBooks }}</p>
            </div>
            <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
                <h2 class="text-xl font-semibold mb-2 text-gray-800 dark:text-gray-200">Users</h2>
                <p class="text-3xl font-bold text-purple-600 dark:text-purple-400">{{ $totalUsers }}</p>
            </div>
        </div>
    </div>
@endsection
