<x-layout>
    <x-reports-nav />
    
    <div class="mt-8">
        <h2 class="text-xl font-semibold mb-4">Borrow History</h2>
        
        @if(count($borrowHistory) > 0)
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
                    @foreach($borrowHistory as $borrow)
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
            <p>No borrow history found.</p>
        @endif
    </div>
</x-layout> 