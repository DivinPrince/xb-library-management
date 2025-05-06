<x-layout>
    <x-container>
        <a href="{{ route("books.index") }}">Back to Books</a>
        <h2>Borrow {{ $book->bookname }}</h2>
        <form class="form" action="{{ route("books.borrowBook", $book->bookid) }}" method="post">
            @csrf
            <label for="">Borrow Date</label>
            <input type="date" name="borrowdate" placeholder="Borrow Date">
            <label for="">Return Date for ({{ $book->bookname }})</label>
            <input type="date" name="returndate" placeholder="Return Date">
            <button>
                Borrow
            </button>
        </form>
    </x-container>
</x-layout>