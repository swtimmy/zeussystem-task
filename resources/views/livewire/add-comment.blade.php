<div>
    @can('add-comment')
    <h3 class="text-xl">Comment:</h3>
    <form wire:submit.prevent="addComment">
        <div class="py-4">
            <textarea id="body" wire:model="comment" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 " placeholder="Write your thoughts here..."></textarea>
            @error('comment') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>
        <button type="submit" class="px-4 py-2 text-sm bg-green-500 hover:bg-green-700 text-white rounded">Add Comment</button>
    </form>
    @endcan
</div>
