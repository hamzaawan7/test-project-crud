<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

/**
 * Interface UserRepositoryInterface
 * @package App\Repositories
 */
interface UserRepositoryInterface
{
    /**
     * @param array $data
     */
    public function save(array $data);

    /**
     * @return Collection
     */
    public function all(): Collection;

    /**
     * @param int $id
     * @return User
     */
    public function get(int $id): User;

    /**
     * @param int $id
     * @return void
     */
    public function delete(int $id): void;
}
