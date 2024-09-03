<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <form wire:submit.prevent="store" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 transition-shadow duration-300 hover:shadow-lg">
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
        </div>

        <div class="mb-4">
            <label for="thumbnail" class="block text-sm font-bold text-gray-700 mb-1">Thumbnail</label>
            <input id="thumbnail" type="file" wire:model="thumbnail" class="w-full border-gray-200 rounded">
            @if ($thumbnail)
                <img src="{{ $thumbnail->temporaryUrl() }}" class="mt-2 w-32 h-32 object-cover">
            @endif
            @error('thumbnail') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="w-full bg-blue-500 text-white p-2 rounded hover:bg-blue-600 transition-bg duration-300">Create Report</button>
        <button type="button" class="w-full bg-gray-500 text-white p-2 rounded hover:bg-gray-600 transition-bg duration-300 mt-2" wire:click="cancel">Cancel</button>
    </form>
</div>
