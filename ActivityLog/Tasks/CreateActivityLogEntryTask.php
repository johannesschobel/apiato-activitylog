<?php

namespace App\Containers\ActivityLog\Tasks;

use App\Containers\ActivityLog\Models\ActivityLog;
use App\Containers\User\Models\User;
use App\Ship\Parents\Tasks\Task;
use Carbon\Carbon;
use Spatie\Activitylog\Models\Activity;

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
     * @return Activity
     */
    public function run(User $causer, $model, $message = '', $options = [], $log = null) : Activity
    {
        // get the default log name
        if ($log === null) {
            $log = config('activitylog.default_log_name', 'default');
        }

        if (config('activitylog-container.merge_entries.enable', false)) {
            /** @var ActivityLog $latestActions */
            $latestActions = $causer
                ->actions()
                ->where('subject_type', '=', get_class($model))
                ->where('subject_id', '=', $model->id)
                ->where('description', '=', $message)
                ->where('log_name', '=', $log)
                ->orderBy('updated_at', 'desc')
                ->first();

            // there already exist an entry for this model
            if ($latestActions) {
                // now check, if it is in the defined timeframe!
                if ($latestActions->updated_at >= Carbon::now()->subMinutes(config('activitylog-container.merge_entries.time_threshold'))) {
                    // we need to simply update the entry
                    $latestActions->touch();

                    return $latestActions;
                }
            }
        }

        // create the log entry
        $action = activity($log)
            ->causedBy($causer)
            ->performedOn($model)
            ->withProperties($options)
            ->log($message);

        return $action;
    }
}
