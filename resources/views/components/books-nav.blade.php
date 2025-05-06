<nav class="flex justify-between items-center p-4">
    <h1 class="text-2xl font-bold">Books</h1>
    <div class="flex gap-4 items-center">
        @if (auth()->user()->role === "admin")
            <a href="{{ route("books.create") }}" class="w-fit"><button class="w-fit">Create a new Books +</button></a>
            <a href="{{ route("reports.index") }}" class="w-fit"><button class="w-fit">Reports</button></a>
        @endif
        
        <div class="user-dropdown ml-4" id="userDropdownContainer">
            <button onclick="toggleDropdown()">
                <span>{{ auth()->user()->name }}</span>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>
            <div id="userDropdown">
                <div>
                    <div>{{ auth()->user()->name }}</div>
                    <div>{{ auth()->user()->email }}</div>
                    <div>{{ ucfirst(auth()->user()->role) }}</div>
                </div>
                <a href="{{ url('/logout') }}">Logout</a>
            </div>
        </div>
    </div>
</nav>

<script>
    function toggleDropdown() {
        const dropdown = document.getElementById('userDropdown');
        const container = document.getElementById('userDropdownContainer');
        
        dropdown.classList.toggle('hidden');
        container.classList.toggle('active');
    }
    
    // Close the dropdown if clicked outside
    window.addEventListener('click', function(event) {
        const container = document.getElementById('userDropdownContainer');
        if (!container.contains(event.target)) {
            document.getElementById('userDropdown').classList.add('hidden');
            container.classList.remove('active');
        }
    });
</script>