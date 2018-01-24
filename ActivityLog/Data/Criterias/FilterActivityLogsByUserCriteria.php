<?php

namespace App\Containers\ActivityLog\Data\Criterias;

use App\Containers\User\Models\User;
use App\Ship\Parents\Criterias\Criteria;
use Prettus\Repository\Contracts\RepositoryInterface as PrettusRepositoryInterface;

/**
 * Class FilterActivityLogsByUserCriteria
 *
 * @author  Johannes Schobel <johannes.schobel@googlemail.com>
 */
class FilterActivityLogsByUserCriteria extends Criteria
{
    /**
     * @var User
     */
    private $user;

    /**
     * FilterActivityLogsByUserCriteria constructor.
     *
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * @param                            $model
     * @param PrettusRepositoryInterface $repository
     *
     * @return mixed
     */
    public function apply($model, PrettusRepositoryInterface $repository)
    {
        return $model->where('causer_id', '=', $this->user->id)->where('causer_type', '=', User::class);
    }
}
