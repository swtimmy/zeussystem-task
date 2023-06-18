<div class="w-full">
    @if(!$ticket)
        <h4 class="text-md">Something go wrong!</h4>
    @else
        <div class="flex flex-col gap-4">
            <h4 class="text-md">ID: {{$ticket->id}}</h4>
            <h4 class="text-md">Problem Description: {{$ticket->problem_description}}</h4>
            <h4 class="text-md">Affected User: {{$users->firstWhere('id',$ticket->affected_user)->name}}</h4>
            <h4 class="text-md">Received Date: {{$ticket->received_date}}</h4>
            @can(['update-ticket'])
                <form wire:submit.prevent="changeTicketData" class="mb-4">
                    <div class="mb-4">
                        <label for="additionalNotes" class="block text-gray-700">Additional Notes:</label>
                        <textarea id="additionalNotes" wire:model="ticket.additional_notes" class="form-textarea mt-1 block w-full"></textarea>
                        @error('ticket.additional_notes') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>
                    <div class="flex justify-end gap-4">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Update Additional Notes</button>
                    </div>
                </form>
            @else
                <h4 class="text-md">Additional Notes: {{$ticket->additional_notes}}</h4>
            @endcan

            <table class="table-auto w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3">Comment ID</th>
                        <th scope="col" class="px-6 py-3">Content</th>
                    </tr>
                </thead>
                <tbody>
                    @if($ticket->comments->count()>0)
                        @foreach ($ticket->comments as $comment)
                            <tr class="bg-white border-b hover:bg-gray-50">
                                <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">{{ $comment->id }}</td>
                                <td class="px-6 py-4">{{ $comment->content }}</td>
                            </tr>
                        @endforeach
                    @else
                        <tr class="bg-white border-b hover:bg-gray-50">
                            <td colspan=2 class="text-center">No Comment Yet.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
            <div>
                <livewire:add-comment :wire:key="$ticket->id" :ticketId="$ticket->id" />
            </div>
        </div>
    @endif
</div>
