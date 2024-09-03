<?php

namespace App\Livewire\Report;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Report;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CreateReport extends Component
{
    use WithFileUploads;

    public $title;
    public $description;
    public $files = [];
    public $other_status;
    public $thumbnail;

    protected $rules = [
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'files.*' => 'nullable|file|max:102400', // 100MB max size
        'thumbnail' => 'nullable|image|max:10240', // 10MB max size for thumbnail
        'other_status' => 'nullable|string',
    ];

    public function store()
    {
        $this->validate();

        $report = Report::create([
            'title' => $this->title,
            'description' => $this->description,
            'status' => 'Pending',
            'other_status' => $this->other_status,
            'user_id' => Auth::id(),
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
        return view('livewire.report.create-report');
    }
}
