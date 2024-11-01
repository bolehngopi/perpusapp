@extends('layouts.dashboard')

@section('title', 'Dashboard Users')

@section('content')
    <div class="max-w-7xl mx-auto">
        <h1 class="text-4xl font-bold text-center mb-12">All Users</h1>

        @if ($users->isEmpty())
            <p class="text-center text-gray-500">No users available at the moment. Please check back later!</p>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                @foreach ($users as $user)
                    <div
                        class="group bg-white shadow-lg rounded-lg overflow-hidden hover:shadow-xl transition-shadow duration-300 flex flex-col h-full">
                        <div class="p-4 flex flex-col flex-grow">
                            <h2 class="text-lg font-semibold mb-1 group-hover:text-blue-500 transition-colors">
                                {{ $user->name }}
                            </h2>
                            <p class="text-sm text-gray-500"><strong>Email:</strong> {{ $user->email }}</p>
                            <p class="text-sm text-gray-500"><strong>Role:</strong> {{ $user->role->name }}</p>
                            <p class="text-sm text-gray-500"><strong>Joined:</strong>
                                {{ $user->created_at->format('M d, Y') }}</p>
                        </div>

                        <div class="p-4 flex justify-between items-center">
                            {{-- <a href="{{ route('users.show', $user->id) }}"
                                class="w-full text-center bg-blue-500 hover:bg-blue-600 text-white py-2 rounded-lg transition-colors">
                                View
                            </a> --}}
                            {{-- <a href="{{ route('users.edit', $user->id) }}"
                                class="ml-2 w-full text-center bg-yellow-500 hover:bg-yellow-600 text-white py-2 rounded-lg transition-colors">
                                Edit
                            </a> --}}

                            {{-- <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="ml-2 w-full">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="w-full bg-red-500 hover:bg-red-600 text-white py-2 rounded-lg transition-colors"
                                    onclick="return confirm('Are you sure you want to delete this user?')">
                                    Delete
                                </button>
                            </form> --}}
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-12">
                {{ $users->links() }} <!-- Pagination -->
            </div>
        @endif
    </div>
@endsection
