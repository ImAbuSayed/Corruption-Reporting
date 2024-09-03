<?php

namespace App\Policies;

use App\Models\Report;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization;

class ReportPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return true; // Adjust authorization logic as needed
    }

    public function view(User $user, Report $report)
    {
        return $user->id === $report->user_id;
    }

    public function create(User $user)
    {
        return true;
    }

    public function update(User $user, Report $report)
    {
        return $user->id === $report->user_id;
    }

    public function delete(User $user, Report $report)
    {
        return $user->id === $report->user_id;
    }
}
