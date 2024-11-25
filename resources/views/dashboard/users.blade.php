@extends('layouts.dashboard')

@section('title', 'Dashboard Users')

@section('content')
    <div class="max-w-7xl mx-auto">
        <h1 class="text-4xl font-bold text-center mb-12 dark:text-white">All Users</h1>

        @if ($users->isEmpty())
            <p class="text-center text-gray-500 dark:text-gray-300">No users available at the moment. Please check back
                later!</p>
        @else
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white dark:bg-gray-800 shadow-lg rounded-lg">
                    <thead>
                        <tr>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Name
                            </th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Email
                            </th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Role
                            </th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Joined
                            </th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach ($users as $user)
                            <tr class="hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-200">
                                <td
                                    class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">
                                    <a href="{{ route('dashboard.users.show', $user->id) }}"> {{ $user->name }} </a>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                    {{ $user->email }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                    {{ $user->role->name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                    {{ $user->created_at->format('M d, Y') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
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
                                            class="bg-gray-500 text-white px-4 py-2 rounded-lg cursor-not-allowed dark:bg-gray-600">
                                            Already staff
                                        </button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-12">
                {{ $users->links() }} <!-- Pagination -->
            </div>
        @endif
    </div>
@endsection
