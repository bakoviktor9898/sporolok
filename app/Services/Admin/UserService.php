<?php

namespace App\Services\Admin;

use App\Models\User;
use App\Services\Service;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Auth\User as AuthUser;

class UserService extends Service
{
    public function __construct(User $model)
    {
        $this->model = $model;
    }

    /**
     * Return all categories
     * 
     * @return Collection
     */
    public function get(): Collection
    {
        return $this->model->all();
    }

    /**
     * Retrieve a model by it's ID
     * 
     * @return null|User
     */
    public function find($id): ?User
    {
        return $this->model->find($id);
    }

    

    public function delete(User $user)
    {
        $user->delete();
        
    }


}