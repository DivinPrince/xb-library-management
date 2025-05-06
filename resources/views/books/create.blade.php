<x-layout>
    <x-container>
        <h2>Create Book</h2>
        <form class="form" action="{{ route("books.store") }}" method="post">
            @csrf
            <label for="bookname">Book Name</label>
            <input type="text" id="bookname" name="bookname" placeholder="Book Name" required>
            
            <label for="quantity">Quantity (Number of Copies)</label>
            <input type="number" id="quantity" name="quantity" placeholder="Quantity" min="1" value="1" required>
            
            <button>Create Book</button>
        </form>
    </x-container>
</x-layout>