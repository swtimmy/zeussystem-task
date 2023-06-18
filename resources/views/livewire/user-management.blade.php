<div class="w-full">
    <h1 class="p-4">User Management</h1>
    <div class="max-w-screen-xl mx-auto px-4 flex flex-col md:flex-row gap-4 w-full h-full">
        <div class="flex gap-4 flex-col w-full md:h-full overflow-auto">
            <table class="w-full border border-gray-200 text-left">
                <thead>
                    <tr>
                        <th class="px-4 py-2">Name</th>
                        <th class="px-4 py-2">Email</th>
                        <th class="px-4 py-2">Role</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td class="px-4 py-2">{{ $user->name }}</td>
                            <td class="px-4 py-2">{{ $user->email }}</td>
                            <td class="px-4 py-2">{{ $user->role->name }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="flex gap-4 flex-col w-full overflow-auto">
        @if (session()->has('message'))
            <div class="text-green-700">{{ session('message') }}</div>
        @endif
        <form wire:submit.prevent="createUser" class="w-full">
            <div class="mb-4">
                <label for="name" class="block mb-2">Name:</label>
                <input type="text" id="name" wire:model="name" class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('name') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>
            <div class="mb-4">
                <label for="email" class="block mb-2">Email:</label>
                <input type="email" id="email" wire:model="email" class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('email') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>
            <div class="mb-4">
                <label for="password" class="block mb-2">Password:</label>
                <input type="password" id="password" wire:model="password" class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('password') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>
            <div class="mb-4">
                <label for="role" class="block text-gray-700">Affected User:</label>
                <select id="role" wire:model="role" class="form-select mt-1 block w-full">
                    <option value="">Select Role</option>
                    @foreach ($roles as $role)
                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                    @endforeach
                </select>
                @error('role') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>
            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Create User</button>
        </form>
        </div>
    </div>

    
</div>
