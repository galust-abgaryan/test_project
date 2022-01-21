<?php

namespace App\Services;

use App\Events\UserCreated;
use App\Models\User;

class UserService extends BaseService
{

    /**
     * @param User $user
     * @param $with
     */
    public function createRelations($user, $with)
    {
        foreach ($with['interests'] as $interest) {
            $user->userInterests()->create(['interest' => $interest]);
        }
        parent::createRelations($user, $with);
    }

    /**
     * @param User $user
     * @param $with
     */
    public function updateRelations($user, $with)
    {
        $oldUserInterests = $user->userInterests()->pluck('interest')->toArray();
        $deleted = array_diff($oldUserInterests, $with['interests']);
        if ($deleted) {
            $user->userInterests()->whereIn('interest', $deleted)->delete();
        }
        foreach ($with['interests'] as $interest) {
            if (in_array($interest, $oldUserInterests)) {
                continue;
            }
            $user->userInterests()->create(['interest' => $interest]);
        }

        parent::updateRelations($user, $with);
    }

    /**
     * @param User $user
     */
    public function itemCreated($user)
    {
        UserCreated::dispatch($user);
        parent::itemCreated($user);
    }

    /**
     * @param $value
     * @param array|string[] $columns
     * @param string $column
     * @param array $with
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|\Illuminate\Database\Query\Builder|mixed|object|null
     */
    public function find($value, $columns = ['*'], $column = 'id', $with = [])
    {
        return parent::find($value, $columns, $column, ['userInterests:interest,user_id']);
    }
}
