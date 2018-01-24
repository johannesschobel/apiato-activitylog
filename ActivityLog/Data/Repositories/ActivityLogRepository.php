<?php

namespace App\Containers\ActivityLog\Data\Repositories;

use App\Ship\Parents\Repositories\Repository;

/**
 * Class ActivityLogRepository
 *
 * @author  Johannes Schobel <johannes.schobel@googlemail.com>
 */
class ActivityLogRepository extends Repository
{

    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id' => '=',
        'log_name' => '=',
        // ...
    ];

}
