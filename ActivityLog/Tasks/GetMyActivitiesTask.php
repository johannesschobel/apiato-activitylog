<?php

namespace App\Containers\ActivityLog\Tasks;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\ActivityLog\Data\Criterias\FilterActivityLogsByUserCriteria;
use App\Containers\ActivityLog\Data\Repositories\ActivityLogRepository;
use App\Containers\Authentication\Tasks\GetAuthenticatedUserTask;
use App\Ship\Criterias\Eloquent\OrderByCreationDateDescendingCriteria;
use App\Ship\Parents\Tasks\Task;

/**
 * Class GetMyActivitiesTask
 *
 * @author  Johannes Schobel <johannes.schobel@googlemail.com>
 */
class GetMyActivitiesTask extends Task
{

    /**
     * @var ActivityLogRepository
     */
    private $repository;

    /**
     * GetMyActivitiesTask constructor.
     *
     * @param ActivityLogRepository $repository
     */
    public function __construct(ActivityLogRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return mixed
     */
    public function run()
    {
        $user = Apiato::call(GetAuthenticatedUserTask::class);

        $this->repository->pushCriteria(new FilterActivityLogsByUserCriteria($user));

        $this->repository->pushCriteria(new OrderByCreationDateDescendingCriteria());

        return $this->repository->paginate();
    }
}
