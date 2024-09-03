<div class="min-h-screen flex items-center justify-center">
    
    <form wire:submit.prevent="register" class="w-full max-w-md bg-white p-6 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300">
        <h1 class='font-bold text-3xl text-center mb-6'>Register</h1>
        <div class="mb-4">
            <label for="name" class="block text-sm font-bold text-gray-700 mb-1">Name</label>
            <div class="border-black rounded border">
            <input id="name" wire:model="name" type="text" class="w-full border-gray-200 rounded" required>
            </div>
            @error('name') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="email" class="block text-sm font-bold text-gray-700 mb-1">Email</label>
            <div class="border-black rounded border">
            <input id="email" wire:model="email" type="email" class="w-full border-gray-200 rounded" required>
            </div>
            @error('email') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="password" class="block text-sm font-bold text-gray-700 mb-1">Password</label>
            <div class="border-black rounded border">
            <input id="password" wire:model="password" type="password" class="w-full border-gray-200 rounded" required>
            </div>
            @error('password') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="password_confirmation" class="block text-sm font-bold text-gray-700 mb-1">Confirm Password</label>
            <div class="border-black rounded border">
            <input id="password_confirmation" wire:model="password_confirmation" type="password" class="w-full border-gray-200 rounded" required>
            </div>
        </div>

        <button type="submit" class="w-full bg-blue-500 text-white p-2 rounded hover:bg-blue-600 transition-bg duration-300">Register</button>
    </form>
</div>
