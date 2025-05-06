<x-layout>
    <form accept="{{ route("registerUser") }}" method="post">
        @csrf
        <input type="text" name="name" placeholder="Name">
        <select name="role" id="">
            <option>select role</option>
            <option value="student">Student</option>
            <option value="teacher">Teacher</option>
        </select>
        <input type="email" name="email" placeholder="email">
        <input type="passeord" name="password" placeholder="password">
        <button>Register</button>
    </form>
</x-layout>