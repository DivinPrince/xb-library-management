<x-layout>
    <x-container>
        <h2>Edit Book</h2>
        <form class="form" action="{{ route("books.update",$book->bookid) }}" method="post">
            @csrf
            @method("put")
            <label for="bookname">Book Name</label>
            <input type="text" id="bookname" name="bookname" value="{{ $book->bookname }}" placeholder="Book Name" required>
            
            <label for="quantity">Quantity (Number of Copies)</label>
            <input type="number" id="quantity" name="quantity" value="{{ $book->quantity }}" placeholder="Quantity" min="1" required>
            
            <button>Update Book</button>
        </form>
    </x-container>
</x-layout>