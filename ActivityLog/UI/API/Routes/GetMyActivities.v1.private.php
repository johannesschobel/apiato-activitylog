<?php

/**
 * @apiGroup           ActivityLog
 * @apiName            getMyActivities
 *
 * @api                {GET} /v1/my/activities Get My Activities
 * @apiDescription     Get the users latest activities (e.g., what the user has executed in the application)
 *
 * @apiVersion         1.0.0
 * @apiPermission      none
 *
 * @apiParam           {String}  parameters here..
 *
 * @apiSuccessExample  {json}  Success-Response:
 * HTTP/1.1 200 OK
{
  // Insert the response of the request here...
}
 */

/** @var Route $router */
$router->get('my/activities', [
    'as' => 'api_activitylog_get_my_activities',
    'uses'  => 'Controller@getMyActivities',
    'middleware' => [
      'auth:api',
    ],
]);
