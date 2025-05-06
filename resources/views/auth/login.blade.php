<x-layout>
    <form accept="{{ route("loginUser") }}" method="post">
        @csrf
        <input type="email" name="email" placeholder="email">
        <input type="passeord" name="password" placeholder="password">
        <button>Login</button>
    </form>
</x-layout>