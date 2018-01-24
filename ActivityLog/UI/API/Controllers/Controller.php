<?php

namespace App\Containers\ActivityLog\UI\API\Controllers;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\ActivityLog\Actions\GetMyActivitiesAction;
use App\Containers\ActivityLog\UI\API\Requests\GetMyActivitiesRequest;
use App\Containers\ActivityLog\UI\API\Transformers\ActivityLogTransformer;
use App\Ship\Parents\Controllers\ApiController;

/**
 * Class Controller
 *
 * @author  Johannes Schobel <johannes.schobel@googlemail.com>
 */
class Controller extends ApiController
{

    /**
     * @param GetMyActivitiesRequest $request
     *
     * @return array
     */
    public function getMyActivities(GetMyActivitiesRequest $request)
    {
        $activities = Apiato::call(GetMyActivitiesAction::class);

        return $this->transform($activities, ActivityLogTransformer::class);
    }

}
