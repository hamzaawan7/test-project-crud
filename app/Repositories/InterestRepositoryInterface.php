<?php

namespace App\Repositories;

use App\Models\Interest;
use Illuminate\Database\Eloquent\Collection;

/**
 * Interface InterestRepositoryInterface
 * @package App\Repositories
 */
interface InterestRepositoryInterface
{
    /**
     * @param array $data
     * @param int $userId
     * @return void
     */
    public function save(array $data, int $userId): void;
}
