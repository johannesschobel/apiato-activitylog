<?php

namespace App\Containers\ActivityLog\UI\API\Tests\Functional;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\ActivityLog\Tasks\CreateActivityLogEntryTask;
use App\Containers\ActivityLog\Tests\ApiTestCase;

/**
 * Class GetMyActivitiesTest.
 *
 * @group activitylog
 * @group api
 */
class GetMyActivitiesTest extends ApiTestCase
{

    // the endpoint to be called within this test (e.g., get@v1/users)
    protected $endpoint = 'get@v1/my/activities';

    // fake some access rights
    protected $access = [
        'permissions' => '',
        'roles'       => '',
    ];

    /**
     * @test
     */
    public function test_with_user_that_has_no_entries()
    {
        $data = [
        ];

        // send the HTTP request
        $response = $this->makeCall($data);

        // assert the response status
        $response->assertSuccessful();

        // test for empty content
        $response->assertJson(['data' => []]);
    }

    /**
     * @test
     */
    public function test_with_user_that_has_some_entries()
    {
        $user = $this->getTestingUser();

        // create 2 activities
        $activity1 = Apiato::call(CreateActivityLogEntryTask::class, [$user, $user, 'test 1', [], 'test']);
        $activity2 = Apiato::call(CreateActivityLogEntryTask::class, [$user, $user, 'test 2', [], 'test']);

        $data = [
        ];

        $response = $this->makeCall($data);

        // assert the response status
        $response->assertSuccessful();
        $response->assertJsonCount(2, 'data');
    }

}
