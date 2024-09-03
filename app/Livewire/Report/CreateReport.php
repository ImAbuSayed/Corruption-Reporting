<?php

namespace App\Livewire\Report;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Report;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CreateReport extends Component
{
    use WithFileUploads;

    public $category;
    public $customCategory;
    public $title;
    public $description;
    public $files = [];
    public $thumbnail;
    public $location;

    protected $rules = [
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'files.*' => 'nullable|file|max:102400', // 100MB max size
        'thumbnail' => 'nullable|image|max:10240', // 10MB max size for thumbnail
        'category' => 'required|string',
        'customCategory' => 'required_if:category,Other|string|max:255',
        'location' => 'nullable|string|max:255',
    ];

    public function store()
    {
        $this->validate();

        $finalCategory = $this->category === 'Other' ? $this->customCategory : $this->category;

        $report = Report::create([
            'title' => $this->title,
            'description' => $this->description,
            'approval_status' => 'pending',
            'user_id' => Auth::id(),
            'category' => $finalCategory,
            'location' => $this->location,
            'slug' => Str::slug($this->title) . '-' . Str::random(8),
            'encrypted_code' => Str::random(16),
        ]);

        if ($this->files) {
            foreach ($this->files as $file) {
                $filePath = $file->store('files', 'public');
                $report->files()->create(['path' => $filePath]);
            }
        }

        if ($this->thumbnail) {
            $thumbnailPath = $this->thumbnail->store('thumbnails', 'public');
            $report->update(['thumbnail' => $thumbnailPath]);
        }

        session()->flash('message', 'Report Created Successfully.');

        return redirect()->route('reports.index');
    }

    public function cancel()
    {
        return redirect()->route('reports.index');
    }

    public function render()
    {
        $categories = ['Healthcare', 'Education', 'Government', 'Private Sector', 'Agriculture', 'Business', 'Environment', 'Social', 'Defence', 'Asset', 'Other'];
        sort($categories);
        return view('livewire.report.create-report', compact('categories'));
    }
}