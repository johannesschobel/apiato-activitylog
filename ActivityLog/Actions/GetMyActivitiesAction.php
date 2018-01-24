<?php

namespace App\Containers\ActivityLog\Actions;

use App\Containers\ActivityLog\Tasks\GetMyActivitiesTask;
use App\Ship\Parents\Actions\Action;
use Apiato\Core\Foundation\Facades\Apiato;

/**
 * Class GetMyActivitiesAction
 *
 * @author  Johannes Schobel <johannes.schobel@googlemail.com>
 */
class GetMyActivitiesAction extends Action
{
    /**
     * @return mixed
     */
    public function run()
    {
        $activities = Apiato::call(GetMyActivitiesTask::class);

        return $activities;
    }
}
