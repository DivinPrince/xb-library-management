<x-layout>
    <x-books-nav />
    
    @if (session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4">
            {{ session('success') }}
        </div>
    @endif
    
    @foreach ($books as $book)
        <div class="book-card">
            <div class="book-info">
                <h3 class="book-title">{{ $book->bookname }}</h3>
                <div class="book-availability">
                    <span class="text-sm {{ $book->availableCopies > 0 ? 'text-green-600' : 'text-red-600' }}">
                        {{ $book->availableCopies }} of {{ $book->quantity }} copies available
                    </span>
                </div>
            </div>
            <div class="flex gap-4 items-center">
                @if ($user->role === "admin")
                    <a href="{{ route("books.edit",$book->bookid) }}">Edit</a>
                    <form action="{{ route("books.destroy", $book->bookid) }}" method="post">
                        @csrf
                        @method("delete")
                        <button>Delete</button>
                    </form>
                    @if (isset($book->borrowedByMe) && $book->borrowedByMe)
                        <form action="{{ route("books.return", $book->borrowId) }}" method="post">
                            @csrf
                            <button class="bg-yellow-400">Return Book</button>
                        </form>
                    @endif
                @else
                    <div>
                        @if (isset($book->borrowedByMe) && $book->borrowedByMe)
                            <form action="{{ route("books.return", $book->borrowId) }}" method="post">
                                @csrf
                                <button class="bg-yellow-400">Return Book</button>
                            </form>
                        @elseif ($book->availableCopies <= 0)
                            <p class="text-red-600">No copies available</p>
                        @else 
                            <a href="{{ route("books.borrow", $book->bookid) }}"><button>Borrow</button></a>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    @endforeach
</x-layout>