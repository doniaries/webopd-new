<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\VisiMisi;
use Illuminate\Auth\Access\HandlesAuthorization;

class VisiMisiPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:VisiMisi');
    }

    public function view(AuthUser $authUser, VisiMisi $visiMisi): bool
    {
        return $authUser->can('View:VisiMisi');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:VisiMisi');
    }

    public function update(AuthUser $authUser, VisiMisi $visiMisi): bool
    {
        return $authUser->can('Update:VisiMisi');
    }

    public function delete(AuthUser $authUser, VisiMisi $visiMisi): bool
    {
        return $authUser->can('Delete:VisiMisi');
    }

    public function restore(AuthUser $authUser, VisiMisi $visiMisi): bool
    {
        return $authUser->can('Restore:VisiMisi');
    }

    public function forceDelete(AuthUser $authUser, VisiMisi $visiMisi): bool
    {
        return $authUser->can('ForceDelete:VisiMisi');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:VisiMisi');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:VisiMisi');
    }

    public function replicate(AuthUser $authUser, VisiMisi $visiMisi): bool
    {
        return $authUser->can('Replicate:VisiMisi');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:VisiMisi');
    }

}