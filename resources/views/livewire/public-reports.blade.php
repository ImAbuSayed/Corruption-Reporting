<div>
    <h2 class="text-2xl font-bold mb-4">Public Reports</h2>

    <div class="mb-4">
        <h3 class="text-xl font-semibold mb-2">Categories</h3>
        <div class="flex flex-wrap gap-2">
            @foreach($categories as $category)
                <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded">{{ $category }}</span>
            @endforeach
        </div>
    </div>

    @foreach($reports as $report)
        <div class="mb-4 p-4 border rounded">
            <h3 class="text-xl font-bold">
                <a href="{{ route('reports.show', $report->slug) }}" class="text-blue-600 hover:underline">
                    {{ $report->title }}
                </a>
            </h3>
            <p class="text-gray-600">{{ Str::limit($report->description, 150) }}</p>
            @if($report->report_status)
                <p class="mt-2"><strong>Status:</strong> {{ $report->report_status ?? 'N/A' }}</p>
            @endif
            <p class="mt-2"><strong>Category:</strong> {{ $report->category ?? 'N/A' }}</p>
        </div>
    @endforeach

    {{ $reports->links() }}
</div>