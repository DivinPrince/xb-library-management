<x-layout>
    <x-auth>
        <h2>Login</h2>
        <form class="form" accept="{{ route("loginUser") }}" method="post">
            @csrf
            <input type="email" name="email" placeholder="email">
            <input type="passeord" name="password" placeholder="password">
            <button>Login</button>
            <p>New? <a href="{{ route("register") }}" class="text-blue-400 hover:underline">Register</a></p>
        </form>
    </x-auth>
</x-layout>