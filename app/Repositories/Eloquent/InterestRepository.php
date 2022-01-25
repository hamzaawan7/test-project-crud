<?php

namespace App\Repositories\Eloquent;

use App\Models\Interest;
use App\Repositories\InterestRepositoryInterface;

/**
 * Class InterestRepository
 * @package App\Repositories\Eloquent
 */
class InterestRepository implements InterestRepositoryInterface
{
    /**
     * @param array $data
     * @param int $userId
     * @return void
     */
    public function save(array $data, int $userId): void
    {
        foreach ($data as $interestName) {
            Interest::updateOrCreate(
                ['user_id' => $userId, 'name' => $interestName],
                ['user_id' => $userId, 'name' => $interestName],
            );
        }

        Interest::where('user_id', $userId)->whereNotIn('name', $data)->delete();
    }
}
