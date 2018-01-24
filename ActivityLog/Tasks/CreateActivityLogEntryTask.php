<?php

namespace App\Containers\ActivityLog\Tasks;

use App\Containers\User\Models\User;
use App\Ship\Parents\Tasks\Task;

/**
 * Class CreateActivityLogEntryTask
 *
 * @author  Johannes Schobel <johannes.schobel@googlemail.com>
 */
class CreateActivityLogEntryTask extends Task
{
    /**
     * Create Activity Entry
     *
     * Creates an Activity Log Entry with the given properties
     *
     * @param User        $causer  the user that causes this entry
     * @param mixed       $model   the model this entry is for
     * @param string      $message the message to be logged
     * @param array       $options additional key/value information
     * @param string|null $log     the log file to add this entry
     *
     * @return void
     */
    public function run(User $causer, $model, $message = '', $options = [], $log = null)
    {
        // get the default log name
        if ($log === null) {
            $log = config('activitylog.default_log_name', 'default');
        }

        // create the log entry
        activity($log)
            ->causedBy($causer)
            ->performedOn($model)
            ->withProperties($options)
            ->log($message);
    }
}
