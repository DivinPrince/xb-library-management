<x-layout>
    <x-container>
        <h2>Register</h2>
        <form class="form" accept="{{ route("registerUser") }}" method="post">
            @csrf
            <input type="text" name="name" placeholder="Name">
            <select name="role" id="" class="border h-12 rounded-md border-gray-200 p-2">
                <option>select role</option>
                <option value="student">Student</option>
                <option value="teacher">Teacher</option>
            </select>
            <input type="email" name="email" placeholder="email">
            <input type="passeord" name="password" placeholder="password">
            <button>Register</button>

            <p>Already Have an account? <a href="{{ route("login") }}" class="text-blue-400 hover:underline">Login</a></p>

        </form>
    </x-container>
</x-layout>