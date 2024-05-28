<?php

namespace App\Interfaces;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

interface UserRepositoryInterface
{
    public function getStudentById(int $id): User|Collection;
    public function getStudents(): Collection;
}
