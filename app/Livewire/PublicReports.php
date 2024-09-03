<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Report;
use Livewire\WithPagination;

class PublicReports extends Component
{
    use WithPagination;

    public function render()
    {
        $reports = Report::where('approval_status', 'approved')
            ->latest()
            ->paginate(10);

        $categories = Report::distinct('category')->pluck('category');

        return view('livewire.public-reports', compact('reports', 'categories'));
    }
}
