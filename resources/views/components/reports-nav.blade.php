<nav class="flex justify-between items-center p-4 reports-nav">
    <h1 class="text-2xl font-bold">Reports</h1>
    <div class="flex gap-4">
        <a href="{{ route('reports.index') }}" class="w-fit no-print"><button class="w-fit">Dashboard</button></a>
        <a href="{{ route('reports.borrow-history') }}" class="w-fit no-print"><button class="w-fit">Borrow History</button></a>
        <a href="{{ route('reports.user-activity') }}" class="w-fit no-print"><button class="w-fit">User Activity</button></a>
        <a href="{{ route('reports.popular-books') }}" class="w-fit no-print"><button class="w-fit">Popular Books</button></a>
        <a href="{{ route('books.index') }}" class="w-fit no-print"><button class="w-fit">Back to Books</button></a>
        <button onclick="window.print()" class="w-fit bg-green-500 text-white p-2 rounded no-print">Print Report</button>
    </div>
</nav>

<div class="print-only">
    <h1 class="text-2xl font-bold text-center">Library Management System Report</h1>
    <p class="text-center">Generated on: {{ date('Y-m-d H:i:s') }}</p>
    <hr class="my-4">
</div>