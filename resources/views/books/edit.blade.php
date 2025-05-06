<x-layout>
    <x-container>
        <h2>Edit Book</h2>
        <form class="form" action="{{ route("books.update",$book->bookid) }}" method="post">
            @csrf
            @method("put")
            <input type="text" name="bookname" value="{{ $book->bookname }}" placeholder="Book Name">
            <button>Update Book</button>
        </form>
    </x-container>
</x-layout>