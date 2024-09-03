<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function show($slug)
    {
        $report = Report::where('slug', $slug)
            ->where('approval_status', 'approved')
            ->firstOrFail();

        return view('reports.show', compact('report'));
    }
}