<x-layout>
    <x-container>
        <h2>Create Book</h2>
        <form class="form" action="{{ route("books.store") }}" method="post">
            @csrf
            <input type="text" name="bookname" placeholder="Book Name">
            <button>Create Book</button>
        </form>
    </x-container>
</x-layout>