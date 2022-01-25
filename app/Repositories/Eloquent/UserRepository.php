<?php

namespace App\Repositories\Eloquent;

use App\Models\User;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class UserRepository
 * @package App\Repositories\Eloquent
 */
class UserRepository implements UserRepositoryInterface
{
    /**
     * @param array $data
     * @return mixed
     */
    public function save(array $data)
    {
        return User::updateOrCreate(['email' => $data['email']], $data);
    }

    /**
     * @return Collection
     */
    public function all(): Collection
    {
        return User::all();
    }

    /**
     * @param int $id
     * @return User
     */
    public function get(int $id): User
    {
        return User::find($id);
    }

    /**
     * @param int $id
     * @return void
     */
    public function delete(int $id): void
    {
        User::find($id)->delete();
    }
}
