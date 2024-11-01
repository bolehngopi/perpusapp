@extends('layouts.app')

@section('title', 'Borrow Management')

@section('content')
    <div class="max-w-4xl mx-auto bg-white shadow-lg rounded-lg p-6 md:p-8">
        <h1 class="text-2xl md:text-3xl font-bold mb-6 text-center">Borrowed Books</h1>

        <div class="mb-4">
            <input type="text" id="search" placeholder="Search by title or borrower..."
                class="w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 transition duration-200">
        </div>

        <div class="overflow-x-auto">
            <table class="w-full table-auto border-collapse border border-gray-300">
                <thead class="bg-blue-500 text-white sticky top-0">
                    <tr>
                        <th class="border px-4 py-2 text-left">Book Title</th>
                        <th class="border px-4 py-2 text-left">Borrowed At</th>
                        <th class="border px-4 py-2 text-left">Due At</th>
                        <th class="border px-4 py-2 text-left">Returned At</th>
                        <th class="border px-4 py-2 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($borrows as $borrow)
                        <tr class="hover:bg-gray-100 transition-colors">
                            <td class="border px-4 py-2">{{ $borrow->book->title }}</td>
                            <td class="border px-4 py-2">{{ \Carbon\Carbon::parse($borrow->borrowed_at)->format('d M Y') }}
                            </td>
                            <td class="border px-4 py-2">{{ \Carbon\Carbon::parse($borrow->due_at)->format('d M Y') }}</td>
                            <td class="border px-4 py-2">
                                @if ($borrow->returned_at)
                                    <span class="text-green-600 font-semibold">Returned
                                        ({{ \Carbon\Carbon::parse($borrow->returned_at)->format('d M Y') }})
                                    </span>
                                @else
                                    <span class="text-red-600 font-semibold">Not Returned</span>
                                @endif
                            </td>
                            <td class="border px-4 py-2 text-center">
                                @if (!$borrow->returned_at)
                                    <form action="{{ route('borrows.return', $borrow->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit"
                                            class="bg-blue-500 hover:bg-blue-600 text-white py-1 px-3 rounded-lg transition duration-200">
                                            Return
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script>
        document.getElementById('search').addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            const rows = document.querySelectorAll('tbody tr');

            rows.forEach(row => {
                const title = row.children[0].textContent.toLowerCase();

                row.style.display = (title.includes(searchTerm) || borrower.includes(searchTerm)) ? '' :
                    'none';
            });
        });
    </script>
@endsection
