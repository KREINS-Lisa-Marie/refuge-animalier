<?php

namespace App\Policies;

use App\Models\User;

class DashboardPolicy
{

    public function viewAny(User $user): bool
    {
        return true;
    }

    public function viewAnyLimited(User $user): bool
    {
        return  $user->is_admin;
    }
}
