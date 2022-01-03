<?php

namespace App\Policies;

use App\Models\Check;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CheckPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return true;
    }

    public function view(User $user, Check $check)
    {
        return true;
    }

    public function create(User $user)
    {
        return false;
    }

    public function update(User $user, Check $check)
    {
        return false;
    }

    public function delete(User $user, Check $check)
    {
        return true;
    }
}
