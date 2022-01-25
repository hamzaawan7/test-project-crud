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
            $interest = Interest::where('user_id', $userId)->where('name', $interestName)->first();

            if (!$interest) {
                $interest = new Interest();
            }

            $interest->user_id = $userId;
            $interest->name = $interestName;

            $interest->save();
        }

        Interest::where('user_id', $userId)->whereNotIn('name', $data)->delete();
    }
}
