<!-- resources/views/layouts/dashboard.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Library Dashboard</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100">

    {{-- Global Success Toast --}}
    @if (session('success'))
        <div id="successToast"
            class="fixed top-4 right-4 bg-green-500 text-white px-4 py-3 rounded shadow-lg flex items-center space-x-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd"
                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm-1.293-4.707a1 1 0 011.414 0l3-3a1 1 0 10-1.414-1.414L9 11.586l-1.293-1.293a1 1 0 00-1.414 1.414l2 2z"
                    clip-rule="evenodd" />
            </svg>
            <span>{{ session('success') }}</span>
            <button onclick="hideToast('success')" class="text-white focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M6 6l8 8m0-8L6 14" clip-rule="evenodd" />
                </svg>
            </button>
        </div>
    @endif

    {{-- Global Error Toast --}}
    @if (session('error'))
        <div id="errorToast"
            class="fixed top-16 right-4 bg-red-500 text-white px-4 py-3 rounded shadow-lg flex items-center space-x-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd"
                    d="M18 10A8 8 0 11.74 5.88l1.63 1.63a6 6 0 104.24 4.24l1.63 1.63A8 8 0 0118 10zM9 9V7h2v2H9zm0 4v-2h2v2H9z"
                    clip-rule="evenodd" />
            </svg>
            <span>{{ session('error') }}</span>
            <button onclick="hideToast('error')" class="text-white focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M6 6l8 8m0-8L6 14" clip-rule="evenodd" />
                </svg>
            </button>
        </div>
    @endif

    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <aside class="w-64 bg-blue-800 text-white flex-shrink-0">
            <div class="p-6">
                <h2 class="text-2xl font-bold mb-4">Library Management</h2>
                <nav>
                    <ul>
                        <li class="mb-2">
                            <a href="{{ route('dashboard.index') }}"
                                class="block py-2 px-4 rounded hover:bg-blue-700 transition">
                                Dashboard
                            </a>
                        </li>

                        <!-- Show these links only for admin and staff -->
                        <li class="mb-2">
                            <a href="{{ route('dashboard.books') }}"
                                class="block py-2 px-4 rounded hover:bg-blue-700 transition">
                                Books Management
                            </a>
                        </li>

                        <li class="mb-2">
                            <a href="{{ route('dashboard.create') }}"
                                class="block py-2 px-4 rounded hover:bg-blue-700 transition">
                                Add New Book
                            </a>
                        </li>

                        <li class="mb-2">
                            <a href="{{ route('dashboard.users') }}"
                                class="block py-2 px-4 rounded hover:bg-blue-700 transition">
                                Users Management
                            </a>
                        </li>

                        <li class="mb-2">
                            <a href="{{ route('books.index') }}"
                                class="block py-2 px-4 rounded hover:bg-blue-700 transition">
                                Return
                            </a>
                        </li>

                        <li class="mt-8">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="w-full text-left block py-2 px-4 rounded hover:bg-red-600 transition">
                                    Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-8">
            @yield('content')
        </main>
    </div>
</body>

</html>
