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

    <div class="mb-4 flex justify-end">
        <a href="{{ route('create.report') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Create New Report</a>
    </div>

    <table class="table-auto w-full">
        <thead>
            <tr class="bg-gray-800 text-white">
                <th class="px-4 py-2">ID</th>
                <th class="px-4 py-2">Title</th>
                <th class="px-4 py-2">Description</th>
                <th class="px-4 py-2">Status</th>
                <th class="px-4 py-2">User</th>
                <th class="px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reports as $report)
                <tr class="hover:bg-gray-200">
                    <td class="border px-4 py-2">{{ $report->id }}</td>
                    <td class="border px-4 py-2">{{ $report->title }}</td>
                    <td class="border px-4 py-2">{{ Str::limit($report->description, 100) }}</td>
                    <td class="border px-4 py-2">{{ $report->status }}</td>
                    @auth
                        <td class="border px-4 py-2">{{ $report->user->name }}</td>
                        <td class="border px-4 py-2">
                            <a href="{{ route('edit.report', $report->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition bg duration-300">Edit</a>
                            <button wire:click="delete({{ $report->id }})" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded transition bg duration-300">Delete</button>
                        </td>
                    @else
                        <td class="border px-4 py-2">Anonymous</td>
                        <td class="border px-4 py-2">-</td>
                    @endauth
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4">
        {{ $reports->links() }}
    </div>
</div>
