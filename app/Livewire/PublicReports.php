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
        $reports = Report::paginate(5); // Use pagination here
        return view('livewire.public-reports', ['reports' => $reports]);
    }
}
