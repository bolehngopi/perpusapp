@extends('layouts.app')

@section('title', 'Edit Profile')

@section('content')
    <div class="max-w-lg mx-auto bg-white p-8 rounded shadow">
        <h1 class="text-2xl font-bold mb-6">Edit Profile</h1>

        @if ($errors->any())
            <div class="mb-4 p-2 text-red-700 bg-red-200 rounded">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('account.update') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <label for="name" class="block font-medium text-gray-700">Name</label>
                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}"
                    class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <div class="mb-4">
                <label for="email" class="block font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}"
                    class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <div class="mb-4">
                <label for="profile_picture" class="block font-medium text-gray-700">Profile Picture</label>
                <input type="file" name="profile_picture" id="profile_picture"
                    class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="mt-6 flex justify-between gap-4">
                <button type="submit"
                    class="w-full bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded transition duration-200">
                    Save Changes
                </button>
                <a href="{{ route('books.index') }}"
                    class="w-full text-center bg-gray-500 hover:bg-gray-600 text-white py-2 px-4 rounded transition duration-200">
                    Cancel
                </a>
            </div>
        </form>
    </div>
@endsection
