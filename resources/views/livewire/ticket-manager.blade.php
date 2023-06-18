@php
    use Illuminate\Support\Facades\Gate;
@endphp

<div class="max-w-screen-xl mx-auto px-4 flex flex-col md:flex-row gap-4 w-full">
    <div class="flex gap-4 flex-col w-full @if($selectTicket) md:w-[50%] lg:w-full @endif">
        @if(Auth::user()->isRole("regular"))
            @if($createTicket)
            <!-- Ticket creation form -->
            <form wire:submit.prevent="createTicket" class="mb-4">
                <div class="mb-4">
                    <label for="problemDescription" class="block text-gray-700">Problem Description:</label>
                    <input type="text" id="problemDescription" wire:model="problemDescription" class="form-input mt-1 block w-full">
                    @error('problemDescription') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>
                
                <div class="mb-4">
                    <label for="receivedDate" class="block text-gray-700">Received Date:</label>
                    <input type="date" id="receivedDate" wire:model="receivedDate" class="form-input mt-1 block w-full">
                    @error('receivedDate') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>
                
                <div class="mb-4">
                    <label for="affectedUser" class="block text-gray-700">Affected User:</label>
                    <select id="affectedUser" wire:model="affectedUser" class="form-select mt-1 block w-full">
                        <option value="">Select User</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                    @error('affectedUser') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>
                
                <div class="mb-4">
                    <label for="additionalNotes" class="block text-gray-700">Additional Notes:</label>
                    <textarea id="additionalNotes" wire:model="additionalNotes" class="form-textarea mt-1 block w-full"></textarea>
                    @error('additionalNotes') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>
                <div class="flex justify-end gap-4">
                    <div wire:click="openTicketForm" class="cursor-pointer bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Cancel</div>
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Create Ticket</button>
                </div>
            </form>
            @else
                <div class="flex justify-start">
                    <button wire:click="openTicketForm" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Add Ticket</button>
                </div>
            @endif
        @endif

        <div class="overflow-auto flex-auto @if($selectTicket)max-h-[180px]@endif md:max-h-none">
            <table class="table-auto w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3">Ticket Number</th>
                        <th scope="col" class="px-6 py-3">Affected User</th>
                        <th scope="col" class="px-6 py-3">Comment Count</th>
                        <th scope="col" class="px-6 py-3">Status</th>
                        <th scope="col" class="px-6 py-3">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tickets as $ticket)
                        @if(Auth::user()->isRole("regular")&&$ticket->is_deleted)
                        @else
                        <tr class="bg-white border-b hover:bg-gray-50 @if($ticket->is_deleted) opacity-50 @endif">
                            <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">{{ $ticket->id }}</td>
                            <td class="px-6 py-4">{{ $users->firstWhere('id',$ticket->affected_user)->name }}</td>
                            <td class="px-6 py-4">{{ $ticket->comments->count() }}</td>
                            <td class="px-6 py-4">{{ $ticket->is_deleted ? 'Deleted' : 'Active' }}</td>
                            
                            <td class="px-6 py-4 flex flex-row gap-4">
                                @canany(['delete-ticket', 'restore-ticket'])
                                    @if($ticket->is_deleted)
                                        @can(['restore-ticket'])
                                            <button wire:click="restoreTicket({{ $ticket->id }})" class="px-4 py-2 text-sm bg-green-500 text-white rounded">Restore</button>
                                        @endcan
                                    @else
                                        @can(['delete-ticket'])
                                            <button wire:click="deleteTicket({{ $ticket->id }})" class="px-4 py-2 text-sm bg-red-500 text-white rounded">Delete</button>
                                            <!-- <a href="/ticket-detail/{{$ticket->id}}">Detail</a> -->
                                            <button class="px-4 py-2 text-sm bg-blue-500 text-white rounded" wire:click="selectTicket({{$ticket->id}})">Detail</button>
                                        @endcan
                                    @endif
                                    <div wire:ignore class="hidden">
                                        <livewire:add-comment :ticketId="$ticket->id" />
                                    </div>
                                @else
                                    <button class="px-4 py-2 text-sm bg-blue-500 text-white rounded" wire:click="selectTicket({{$ticket->id}})">Detail</button>
                                @endcanany
                            </td>
                        </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- Display ticket list with their status, number, user, and comment count -->
    @if($selectTicket)
        <div class="flex flex-col w-full md:w-[50%] lg:w-full overflow-auto">
            <h3 class="text-xl py-4">Ticket Information:</h3>
            <div class="h-full flex overflow-auto w-full">
                <livewire:ticket-detail-management />
            </div>
        </div>
    @endif
</div>

@push('scripts')
<script>
    document.addEventListener('livewire:load', function () {
        Livewire.on('ticketCreated', function (data) {
            alert(data.message);
        });
    });
</script>
@endpush