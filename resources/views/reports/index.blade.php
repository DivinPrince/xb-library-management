<x-layout>
    <x-reports-nav />
    
    <div class="mt-8">
        <h2 class="text-xl font-semibold mb-4">Library Dashboard</h2>
        
        <div class="grid grid-cols-3 gap-6 mb-8">
            <div class="p-4 bg-blue-100 rounded shadow">
                <h3 class="text-lg font-semibold">Total Books</h3>
                <p class="text-3xl font-bold">{{ $totalBooks }}</p>
            </div>
            
            <div class="p-4 bg-green-100 rounded shadow">
                <h3 class="text-lg font-semibold">Total Borrowed</h3>
                <p class="text-3xl font-bold">{{ $totalBorrowed }}</p>
            </div>
            
            <div class="p-4 bg-purple-100 rounded shadow">
                <h3 class="text-lg font-semibold">Total Users</h3>
                <p class="text-3xl font-bold">{{ $totalUsers }}</p>
            </div>
        </div>
        
        <div class="mt-8">
            <h3 class="text-lg font-semibold mb-4">Currently Borrowed Books</h3>
            
            @if(count($currentBorrows) > 0)
                <table class="w-full border-collapse">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border p-2 text-left">Book Name</th>
                            <th class="border p-2 text-left">Borrowed By</th>
                            <th class="border p-2 text-left">Borrow Date</th>
                            <th class="border p-2 text-left">Return Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($currentBorrows as $borrow)
                            <tr>
                                <td class="border p-2">{{ $borrow->book->bookname }}</td>
                                <td class="border p-2">{{ $borrow->user->name }}</td>
                                <td class="border p-2">{{ $borrow->borrowdate->format('Y-m-d') }}</td>
                                <td class="border p-2">{{ $borrow->returndate->format('Y-m-d') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p>No books currently borrowed.</p>
            @endif
        </div>
    </div>
</x-layout> 