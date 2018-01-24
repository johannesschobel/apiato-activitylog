<?php

namespace App\Containers\ActivityLog\Models;

use Apiato\Core\Traits\HashIdTrait;
use Apiato\Core\Traits\HasResourceKeyTrait;
use Spatie\Activitylog\Models\Activity;

/**
 * Class ActivityLog
 *
 * @author  Johannes Schobel <johannes.schobel@googlemail.com>
 */
class ActivityLog extends Activity
{
    /*
    * Add the traits here because we are not directly extending Ship/Parents/Model here
    */
    use HashIdTrait;
    use HasResourceKeyTrait;

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    /**
     * A resource key to be used by the the JSON API Serializer responses.
     */
    protected $resourceKey = 'activitylogs';
}
