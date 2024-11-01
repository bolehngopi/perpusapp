@extends('layouts.app')

@section('title', 'User Account')

@section('content')
    <div class="max-w-lg mx-auto bg-white p-8 rounded shadow">
        <h1 class="text-2xl font-bold mb-4">My Account</h1>

        @if (session('success'))
            <div class="mb-4 p-2 text-green-700 bg-green-200 rounded">
                {{ session('success') }}
            </div>
        @endif

        <div class="mb-4 flex items-center">
            <div class="w-16 h-16 bg-gray-200 rounded-full overflow-hidden flex items-center justify-center">
                @if ($user->profile_picture)
                    <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="Profile Picture"
                        class="w-full h-full object-cover">
                @else
                    <span class="text-gray-500">No Image</span>
                @endif
            </div>
            <div class="ml-4">
                <label class="block font-medium text-gray-700">Name</label>
                <p class="text-gray-600">{{ $user->name }}</p>
                <label class="block font-medium text-gray-700">Email</label>
                <p class="text-gray-600">{{ $user->email }}</p>
            </div>
        </div>

        <!-- Penalty Details Section -->
        <div class="mt-6">
            <h2 class="text-xl font-semibold mb-4">Penalties</h2>

            @if ($user->borrowings->whereNotNull('penalty')->isEmpty())
                <p class="text-gray-600">No penalties found.</p>
            @else
                <div class="space-y-4">
                    @foreach ($user->borrowings as $borrowing)
                        @if ($borrowing->penalty)
                            <div class="p-4 bg-red-100 rounded">
                                <h3 class="font-semibold text-gray-800">{{ $borrowing->book->title }}</h3>
                                <p class="text-gray-700">Overdue Days: {{ $borrowing->penalty->overdue_days }}</p>
                                <p class="text-gray-700">Penalty Amount: Rp
                                    {{ number_format($borrowing->penalty->amount, 0, ',', '.') }}</p>
                                <p class="text-gray-600 text-sm">Due Date: {{ $borrowing->due_at->format('d M Y') }}</p>
                                <p class="text-gray-600 text-sm">Returned At:
                                    {{ $borrowing->returned_at ? $borrowing->returned_at->format('d M Y') : 'Not Returned' }}
                                </p>
                            </div>
                        @endif
                    @endforeach
                </div>
            @endif
        </div>

        <div class="flex gap-4 mt-6">
            <a href="{{ route('account.edit') }}"
                class="w-full text-center bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded transition duration-200">
                Edit Profile
            </a>
            <form action="{{ route('logout') }}" method="POST" class="w-full">
                @csrf
                <button type="submit"
                    class="w-full bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded transition duration-200">
                    Logout
                </button>
            </form>
        </div>
    </div>
@endsection
