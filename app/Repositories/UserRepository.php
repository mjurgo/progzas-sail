<?php

namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class UserRepository implements UserRepositoryInterface
{
    public function __construct(private readonly User $model) {}


    public function getStudents(): Collection
    {
        $studentRole = Role::where('name', 'student')->first()->id;

        return $this->model->with('role')->where(['role_id' => $studentRole])->get();
    }

    public function getStudentById(int $id): User|Collection
    {
        return $this->model->with(['role', 'grades'])
            ->find($id);
    }
}
