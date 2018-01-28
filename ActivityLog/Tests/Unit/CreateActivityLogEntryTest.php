<?php

namespace App\Containers\ActivityLog\Tests\Unit;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\ActivityLog\Tasks\CreateActivityLogEntryTask;
use App\Containers\ActivityLog\Tests\TestCase;
use App\Containers\User\Models\User;
use Illuminate\Support\Facades\Config;
use Spatie\Activitylog\Models\Activity;

/**
 * Class CreateActivityLogEntryTest.
 *
 * @group activitylog
 * @group unit
 */
class CreateActivityLogEntryTest extends TestCase
{

    /**
     * @test
     */
    public function test_if_activity_is_created_and_logged_to_database()
    {
        // get one user
        $causer = $this->getTestingUser();
        $subject = $causer;

        $description = 'Test Entry Created';
        $options = [
            'operation' => 'create',
            'variables' => [
                'test' => true,
            ],
        ];
        $logname = 'test';

        /** @var Activity $activity */
        $activity = Apiato::call(CreateActivityLogEntryTask::class, [
            $causer,
            $subject,
            $description,
            $options,
            $logname,
        ]);

        // check if values are correctly set
        $this->assertInstanceOf(Activity::class, $activity);

        // check if this entry is in the database
        $this->assertDatabaseHas('activity_log',
            [
                'id' => $activity->id,

                'causer_id' => $causer->id,
                'causer_type' => get_class($causer),

                'description' => $description,
                'log_name' => $logname
            ]);
    }
}
