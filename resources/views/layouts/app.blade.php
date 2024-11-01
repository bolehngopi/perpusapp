<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Library App')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script>
        // JavaScript for controlling toast visibility
        function hideToast(type) {
            const toast = document.getElementById(`${type}Toast`);
            if (toast) {
                toast.classList.add('hidden');
            }
        }

        window.onload = function() {
            ['errorToast', 'successToast'].forEach((id) => {
                const toast = document.getElementById(id);
                if (toast) {
                    setTimeout(() => {
                        toast.classList.add('hidden');
                    }, 5000); // Auto-hide after 5 seconds
                }
            });
        };
    </script>
</head>

<body class="bg-gray-50 min-h-screen flex flex-col">

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

    <main class="flex-grow container mx-auto px-6 py-8">
        @yield('content')
    </main>

    <!-- Bottom Navbar -->
    <nav class="fixed bottom-0 left-0 w-full bg-white shadow-md">
        <div class="flex justify-around items-center py-3">
            <a href="{{ route('books.index') }}" class="flex flex-col items-center text-gray-700 hover:text-blue-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24">
                    <path d="M12 2.1L1 12h3v9h6v-7h4v7h6v-9h3L12 2.1z"></path>
                </svg>
                <span class="text-sm">Home</span>
            </a>

            <a href="{{ route('borrows.index') }}" class="flex flex-col items-center text-gray-700 hover:text-blue-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24">
                    <path
                        d="M6 2c-1.1 0-2 .9-2 2v15a2 2 0 002 2h13a1 1 0 000-2H7a1 1 0 010-2h13a1 1 0 000-2H7a1 1 0 010-2h13V4c0-.6-.4-1-1-1h-3v10l-3-2-3 2V2H6z">
                    </path>
                </svg>
                <span class="text-sm">Borrow</span>
            </a>

            <a href="{{ route('books.search') }}" class="flex flex-col items-center text-gray-700 hover:text-blue-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M8 16l-4 4m0 0l4-4m-4 4H3a2 2 0 01-2-2V5a2 2 0 012-2h18a2 2 0 012 2v18a2 2 0 01-2 2h-6">
                    </path>
                </svg>
                <span class="text-sm">Search</span>
            </a>

            @auth
                <a href="{{ route('account.show') }}" class="flex flex-col items-center text-gray-700 hover:text-blue-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M5.121 17.804A7.962 7.962 0 0112 16a7.962 7.962 0 016.879 1.804M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <span class="text-sm">User</span>
                </a>
            @else
                <a href="{{ route('login') }}" class="flex flex-col items-center text-gray-700 hover:text-blue-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12H9m6-4v8m-2 4v-2a4 4 0 00-8 0v2" />
                    </svg>
                    <span class="text-sm">Login</span>
                </a>
            @endauth
        </div>
    </nav>

    <footer class="bg-gray-800 text-white py-4">
        <div class="container mx-auto text-center">
            <p>&copy; 2024 Library App. All rights reserved.</p>
        </div>
    </footer>

</body>

</html>
