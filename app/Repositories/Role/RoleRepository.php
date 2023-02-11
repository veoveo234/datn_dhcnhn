<?php

namespace App\Repositories\Role;

use App\Models\Role;
use App\Repositories\BaseRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 *
 */
class RoleRepository extends BaseRepository
{
    public function model(): string
    {
        return Role::class;

    }

    public function getWithPaginate($quantity = 5)
    {
        return $this->model->latest('id')->paginate($quantity);
    }

    public function getById($id)
    {
        return $this->model->find($id);
    }

    public function create($attributes)
    {
        $role = $this->model->create([
            'name' => $attributes->name,
            'description' => $attributes->description,
        ]);
        $role->permissions()->attach($attributes->permissions);
        return $role;
    }

    public function update($id, $attributes): bool
    {
        //update data to role table
        $role = $this->model->find($id);
        if ($role) {
            $role->update([
                'name' => $attributes->name,
                'description' => $attributes->description
            ]);
            //update data to role_permission table
            $role->permissions()->detach();
            $role->permissions()->attach($attributes->permissions);
            return true;
        }
        return false;
    }

    public function delete($id): bool
    {
        $role = $this->model->find($id);
        if (!is_null($role)) {
            $role->delete($id);
            //delete role of role
            $role->permissions()->detach();
            return true;
        }
        return false;

    }
}
