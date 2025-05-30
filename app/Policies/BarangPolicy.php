<?php

namespace App\Policies;

use App\Models\Barang;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BarangPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return true; // Or your custom logic
    }

    public function view(User $user, Barang $barang)
    {
        return $user->id === $barang->user_id;
    }

    public function create(User $user)
    {
        return true; // Or your custom logic
    }

    public function update(User $user, Barang $barang)
    {
        return $user->id === $barang->user_id;
    }

    public function delete(User $user, Barang $barang)
    {
        return $user->id === $barang->user_id;
    }
}