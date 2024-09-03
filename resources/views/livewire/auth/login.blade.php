<div class="min-h-screen flex items-center justify-center">
    <form
        wire:submit.prevent="login"
        class="w-full max-w-md p-6 bg-white rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300 relative"
    >
        <h2 class="text-3xl font-bold text-black text-center mb-6">Login</h2>

        <div class="mb-4">
            <label for="email" class="block text-sm font-bold text-gray-700 mb-1">Email</label>
            <input
                id="email"
                wire:model="email"
                type="email"
                class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                required
            >
            @error('email')
                <span class="text-red-600 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-4">
            <label for="password" class="block text-sm font-bold text-gray-700 mb-1">Password</label>
            <input
                id="password"
                wire:model="password"
                type="password"
                class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                required
            >
            @error('password')
                <span class="text-red-600 text-sm">{{ $message }}</span>
            @enderror
        </div>

        @if (session()->has('error'))
            <div class="text-red-600 mb-4">{{ session('error') }}</div>
        @endif

        <button
            type="submit"
            class="w-full bg-blue-500 text-white py-2 rounded hover:bg-blue-600 transition-bg duration-300 flex justify-center items-center"
            wire:loading.attr="disabled"
        >
            <svg wire:loading class="animate-spin h-5 w-5 mr-3 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
            </svg>
            <span wire:loading.remove>Login</span>
            <span wire:loading>Loading...</span>
        </button>
    </form>
</div>
