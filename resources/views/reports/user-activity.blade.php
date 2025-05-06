<x-layout>
    <x-reports-nav />
    
    <div class="mt-8">
        <h2 class="text-xl font-semibold mb-4">User Activity Report</h2>
        
        <form method="GET" action="{{ route('reports.user-activity') }}" class="mb-6">
            <div class="flex gap-4 items-center">
                <label for="user_id">Select User:</label>
                <select name="user_id" id="user_id" class="p-2 border rounded">
                    <option value="">-- Select User --</option>
                    @foreach($users as $userOption)
                        <option value="{{ $userOption->id }}" {{ $userId == $userOption->id ? 'selected' : '' }}>
                            {{ $userOption->name }} ({{ $userOption->email }})
                        </option>
                    @endforeach
                </select>
                <button type="submit" class="p-2 bg-blue-500 text-white rounded">View Activity</button>
            </div>
        </form>
        
        @if($userBorrows)
            <h3 class="text-lg font-semibold mt-6 mb-4">
                Borrowing History for {{ $users->firstWhere('id', $userId)->name }}
            </h3>
            
            @if(count($userBorrows) > 0)
                <table class="w-full border-collapse">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border p-2 text-left">Book Name</th>
                            <th class="border p-2 text-left">Borrow Date</th>
                            <th class="border p-2 text-left">Return Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($userBorrows as $borrow)
                            <tr>
                                <td class="border p-2">{{ $borrow->book->bookname }}</td>
                                <td class="border p-2">{{ $borrow->borrowdate->format('Y-m-d') }}</td>
                                <td class="border p-2">{{ $borrow->returndate->format('Y-m-d') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p>No borrow history found for this user.</p>
            @endif
        @else
            <p>Please select a user to view their activity.</p>
        @endif
    </div>
</x-layout> 