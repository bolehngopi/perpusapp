@extends('layouts.dashboard')

@section('title', 'User Details')

@section('content')
    <div class="max-w-4xl mx-auto bg-white dark:bg-gray-800 p-8 rounded shadow dark:text-white">
        <h1 class="text-2xl font-bold mb-4">User Details</h1>

        <div class="mb-4 flex items-center gap-10">
            <div
                class="w-20 h-20 bg-gray-200 dark:bg-gray-600 rounded-full overflow-hidden flex items-center justify-center">
                @if ($user->profile_picture)
                    <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="Profile Picture"
                        class="w-full h-full object-cover">
                @else
                    <span class="text-gray-500 dark:text-gray-300">No Image</span>
                @endif
            </div>
            <div class="ml-6">
                <label class="block font-medium text-gray-700 dark:text-gray-300">Name</label>
                <p class="text-gray-600 dark:text-gray-200">{{ $user->name }}</p>
                <label class="block font-medium text-gray-700 dark:text-gray-300">Email</label>
                <p class="text-gray-600 dark:text-gray-200">{{ $user->email }}</p>
                <label class="block font-medium text-gray-700 dark:text-gray-300">Role</label>
                <p class="text-gray-600 dark:text-gray-200">{{ $user->role->name }}</p>
            </div>
        </div>

        <!-- Additional Information -->
        <div class="mt-6">
            <h2 class="text-xl font-semibold mb-4">Additional Details</h2>
            <p class="text-gray-700 dark:text-gray-300"><strong>Joined:</strong> {{ $user->created_at->format('d M Y') }}
            </p>
            <p class="text-gray-700 dark:text-gray-300"><strong>Last Login:</strong> {{ $user->last_login_at ?? 'N/A' }}</p>
        </div>

        <a href="{{ route('dashboard.users') }}"
            class="mt-6 inline-block bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-lg transition duration-200 dark:bg-blue-700 dark:hover:bg-blue-600">
            Back to Users List
        </a>

        @if (!in_array($user->role->name, ['staff', 'admin']))
            <form action="{{ route('dashboard.users.upgrade', $user->id) }}" method="POST">
                @csrf
                @method('PATCH')
                <button type="submit"
                    class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition-colors dark:bg-blue-700 dark:hover:bg-blue-600">
                    Upgrade to Staff
                </button>
            </form>
        @else
            <button type="submit" disabled
                class="bg-gray-500 text-white px-4 py-2 rounded-lg cursor-not-allowed dark:bg-gray-600 dark:text-gray-400">
                Already staff
            </button>
        @endif
    </div>
@endsection
