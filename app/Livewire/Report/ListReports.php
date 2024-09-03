<?php

namespace App\Livewire\Report;

use Livewire\Component;
use App\Models\Report;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class ListReports extends Component
{
    use WithPagination;

    public function delete($reportId)
    {
        $report = Report::find($reportId);

        if (Auth::user()->id === $report->user_id){
            $report->delete();
            session()->flash('message', 'Report deleted successfully.');
        }
    }

    public function render()
    {
        $reports = Report::paginate(10); // Use pagination here
        return view('livewire.report.list-reports', ['reports' => $reports]);
    }
}
