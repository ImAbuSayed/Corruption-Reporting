<?php

namespace App\Livewire\Report;

use App\Models\Report;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditReport extends Component
{
    use WithFileUploads;

    public $existingThumbnail;

    public $reportId;

    public $title;

    public $description;

    public $files = [];

    public $status;

    public $other_status;

    public $thumbnail;

    public $existingFiles = [];

    public $filesToDelete = [];

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
            $this->existingThumbnail = $report->thumbnail;
            $this->existingFiles = $report->files->toArray();
        } else {
            abort(403);
        }
    }

    public function deleteFile($fileId)
    {
        $this->filesToDelete[] = $fileId;
        $this->existingFiles = array_filter($this->existingFiles, function ($file) use ($fileId) {
            return $file['id'] != $fileId;
        });
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

        // Handle file deletions
        foreach ($this->filesToDelete as $fileId) {
            $file = $report->files()->find($fileId);
            if ($file) {
                Storage::disk('public')->delete($file->path);
                $file->delete();
            }
        }

        // Handle new file uploads
        if ($this->files) {
            foreach ($this->files as $file) {
                $filePath = $file->store('files', 'public');
                $report->files()->create(['path' => $filePath]);
            }
        }

        if ($this->thumbnail) {
            // Delete the old thumbnail if it exists
            if ($report->thumbnail) {
                Storage::disk('public')->delete($report->thumbnail);
            }
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
