<?php

namespace App\Containers\ActivityLog\UI\API\Transformers;

use App\Containers\ActivityLog\Models\ActivityLog;
use App\Ship\Parents\Transformers\Transformer;

/**
 * Class ActivityLogTransformer
 *
 * @author  Johannes Schobel <johannes.schobel@googlemail.com>
 */
class ActivityLogTransformer extends Transformer
{
    /**
     * @var  array
     */
    protected $defaultIncludes = [

    ];

    /**
     * @var  array
     */
    protected $availableIncludes = [

    ];

    /**
     * @param ActivityLog $entity
     *
     * @return array
     */
    public function transform(ActivityLog $entity)
    {
        $response = [
            'object' => 'ActivityLog',
            'id' => $entity->getHashedKey(),

            'log_name' => $entity->log_name,
            'message' => $this->outputMessage($entity->description),
            'properties' => $entity->properties,

            'created_at' => $entity->created_at,
            'updated_at' => $entity->updated_at,
        ];

        $response = $this->ifAdmin([
            'real_id'    => $entity->id,
        ], $response);

        return $response;
    }

    /**
     * @param string $message
     *
     * @return string
     */
    private function outputMessage(string $message) : string
    {
        // check if the message should be translated
        if (config('activitylog-container.translate_messages_on_output'. false))
        {
            $message = trans($message);
        }

        return $message;
    }
}
