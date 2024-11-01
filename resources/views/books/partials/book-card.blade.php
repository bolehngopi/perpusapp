<div
    class="group bg-white shadow-lg rounded-lg overflow-hidden hover:shadow-xl transition-shadow duration-300 flex flex-col h-full">
    <a href="{{ route('books.show', $book->id) }}" class="block">
        @if ($book->cover)
            <img src="{{ asset('storage/' . $book->cover) }}" alt="{{ $book->title }}"
                class="w-full h-64 object-cover group-hover:scale-105 transition-transform duration-300">
        @else
            <div class="w-full h-64 bg-gray-200 flex items-center justify-center">
                <span class="text-gray-500">No Cover Available</span>
            </div>
        @endif
    </a>

    <div class="p-4 flex flex-col flex-grow">
        <h2 class="text-lg font-semibold mb-1 group-hover:text-blue-500 transition-colors">
            {{ $book->title }}
        </h2>

        <div class="mt-auto">
            <p class="text-sm text-gray-500 mb-1"><strong>Author:</strong> {{ $book->author }}</p>
            <p class="text-sm text-gray-500"><strong>ISBN:</strong> {{ $book->isbn }}</p>
            <p class="text-sm text-gray-600"><strong>Year:</strong> {{ $book->publication_year }}</p>
            <p class="text-sm text-gray-600"><strong>Copies Available:</strong> {{ $book->available_copies }}</p>
        </div>
    </div>

    <div class="p-4 flex justify-between items-center">
        <a href="{{ route('books.show', $book->id) }}"
            class="w-full block text-center bg-blue-500 hover:bg-blue-600 text-white py-2 rounded-lg transition-colors">
            View Details
        </a>
    </div>
</div>
