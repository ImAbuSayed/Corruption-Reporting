<?php

namespace App\Livewire\Report;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Report;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class EditReport extends Component
{
    use WithFileUploads;

    public $reportId, $title, $description, $files = [], $status, $other_status, $thumbnail;

    protected $rules = [
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'files.*' => 'nullable|file|max:102400', // 100MB max size
        'thumbnail' => 'nullable|image|max:10240', // 10MB max size for thumbnail
        'other_status' => 'nullable|string',
    ];

    public function mount($reportId)
    {
        $report = Report::find($reportId);
        if ($report && Auth::user()->id === $report->user_id) {
            $this->reportId = $reportId;
            $this->title = $report->title;
            $this->description = $report->description;
            $this->status = $report->status;
            $this->other_status = $report->other_status;
        } else {
            abort(403);
        }
    }

    public function save()
    {
        $this->validate();

        $report = Report::find($this->reportId);
        $report->update([
            'title' => $this->title,
            'description' => $this->description,
            'other_status' => $this->other_status,
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

        session()->flash('message', 'Report updated successfully.');
        return redirect()->route('reports.index');
    }

    public function cancel()
    {
        return redirect()->route('reports.index');
    }

    public function render()
    {
        return view('livewire.report.edit-report');
    }
}
