<x-layout>
    <x-books-nav />
    
    @if (session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4">
            {{ session('success') }}
        </div>
    @endif
    
    @foreach ($books as $book)
        <div class="book-card">
            {{ $book->bookname }}
            <div class="flex gap-4 items-center">
                @if ($user->role === "admin")
                    <a href="{{ route("books.edit",$book->bookid) }}">Edit</a>
                    <form action="{{ route("books.destroy", $book->bookid) }}" method="post">
                        @csrf
                        @method("delete")
                        <button>Delete</button>
                    </form>
                    @if ($book->isborrowed)
                        <form action="{{ route("books.return", $book->borrowId ?? 0) }}" method="post">
                            @csrf
                            <button class="bg-yellow-400">Return Book</button>
                        </form>
                    @endif
                @else
                    <div>
                        @if ($book->isborrowed)
                            @if (isset($book->borrowedByMe) && $book->borrowedByMe)
                                <form action="{{ route("books.return", $book->borrowId) }}" method="post">
                                    @csrf
                                    <button class="bg-yellow-400">Return Book</button>
                                </form>
                            @else
                                <p>Book is Borrowed</p>
                            @endif
                        @else 
                            <a href="{{ route("books.borrow", $book->bookid) }}"><button>borrow</button></a>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    @endforeach
</x-layout>