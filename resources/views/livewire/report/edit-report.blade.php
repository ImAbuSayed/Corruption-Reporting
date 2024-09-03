<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    @if (session()->has('message'))
        <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-2" role="alert">
            <div class="flex">
                <div>
                    <p class="text-sm">{{ session('message') }}</p>
                </div>
            </div>
        </div>
    @endif

    <form wire:submit.prevent="save" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 transition-shadow duration-300 hover:shadow-lg">
        @csrf

        <div class="mb-4">
            <label for="title" class="block text-sm font-bold text-gray-700 mb-1">Title</label>
            <input id="title" wire:model="title" type="text" class="w-full border-gray-200 rounded" required>
            @error('title') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="description" class="block text-sm font-bold text-gray-700 mb-1">Description</label>
            <textarea id="description" wire:model="description" class="w-full border-gray-200 rounded h-24" required></textarea>
            @error('description') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="files" class="block text-sm font-bold text-gray-700 mb-1">File(s)</label>
            <input id="files" type="file" wire:model="files" multiple class="w-full border-gray-200 rounded">
            <p class="text-sm text-gray-600">Please upload files in zip format, max size will be 100MB for each file. Supported formats: images, videos, and zip files.</p>
            @error('files') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        
            <div wire:loading wire:target="files" class="mt-2">
                <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-blue-500 inline-block" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                Uploading...
            </div>
        
            @if ($files)
                <div class="mt-2">
                    @foreach($files as $file)
                        <div class="text-sm text-gray-600">{{ $file->getClientOriginalName() }} - {{ number_format($file->getSize() / 1048576, 2) }} MB</div>
                    @endforeach
                </div>
            @endif
        </div>

        <div class="mb-4">
            <label for="thumbnail" class="block text-sm font-bold text-gray-700 mb-1">Thumbnail</label>
            @if ($existingThumbnail)
                <div class="mb-2">
                    <img src="{{ asset('storage/' . $existingThumbnail) }}" alt="Existing Thumbnail" class="w-32 h-32 object-cover">
                    <p class="text-sm text-gray-600">Current thumbnail</p>
                </div>
            @endif
            <input id="thumbnail" type="file" wire:model="thumbnail" class="w-full border-gray-200 rounded">
            @if ($thumbnail)
                <div class="mt-2">
                    <img src="{{ $thumbnail->temporaryUrl() }}" alt="New Thumbnail" class="w-32 h-32 object-cover">
                    <p class="text-sm text-gray-600">New thumbnail preview</p>
                </div>
            @endif
            @error('thumbnail') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="status" class="block text-sm font-bold text-gray-700 mb-1">Status</label>
            <input id="status" wire:model="status" type="text" class="w-full border-gray-200 rounded" readonly>
        </div>

        <div class="flex items-center justify-between mt-4">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" wire:loading.attr="disabled">
                <span wire:loading.remove>Save Changes</span>
                <span wire:loading>
                    <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white inline-block" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    Saving...
                </span>
            </button>
            <button type="button" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" wire:click="cancel">
                Cancel
            </button>
        </div>
    </form>
</div>
