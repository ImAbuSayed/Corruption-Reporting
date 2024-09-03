<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
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
                <th class="px-4 py-2">Files</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reports as $report)
                <tr class="hover:bg-gray-200">
                    <td class="border px-4 py-2">{{ $report->id }}</td>
                    <td class="border px-4 py-2">{{ $report->title }}</td>
                    <td class="border px-4 py-2">{{ Str::limit($report->description, 100) }}</td>
                    <td class="border px-4 py-2">{{ $report->status }}</td>
                    <td class="border px-4 py-2">
                        @if($report->file)
                            <a href="{{ asset('storage/' . $report->file) }}" target="_blank" class="text-blue-500 underline">View File</a>
                        @else
                            No File
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4">
        {{ $reports->links() }}
    </div>
</div>
