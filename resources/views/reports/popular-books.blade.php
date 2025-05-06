<x-layout>
    <x-reports-nav />
    
    <div class="mt-8">
        <h2 class="text-xl font-semibold mb-4">Popular Books Report</h2>
        
        @if(count($popularBooks) > 0)
            <table class="w-full border-collapse">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="border p-2 text-left">Rank</th>
                        <th class="border p-2 text-left">Book Name</th>
                        <th class="border p-2 text-left">Borrow Count</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($popularBooks as $index => $book)
                        <tr>
                            <td class="border p-2">{{ $index + 1 }}</td>
                            <td class="border p-2">{{ $book->bookname }}</td>
                            <td class="border p-2">{{ $book->borrow_count }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>No borrow data available to determine popular books.</p>
        @endif
    </div>
</x-layout> 