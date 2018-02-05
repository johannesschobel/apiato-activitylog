<?php

return [

    /*
    |--------------------------------------------------------------------------
    | ActivityLog Container
    |--------------------------------------------------------------------------
    |
    |
    |
    */

    /**
     * Indicates, if the $message parameter for the CreateActivityLogEntryTask is a localized resource string.
     *
     * true, thereby, means that the value will be translated using trans() function. The strings, however, therefore,
     * must be of the form: 'container::messages.your.custom.path'
     *
     * false, however, means, that the $message parameter already contains your message (e.g., "You have changed your
     * Profile!").
     */
    'translate_messages_on_output' => true,

    /**
     * Merge entries, if you consecutively trigger the same entry below a given time threshold (in minutes).
     * For example, if a user calls several times the same route (where an activity log is generated), the entry is
     * UPDATED instead of CREATING a new one!
     */
    'merge_entries' => [
        'enable' => true,
        'time_threshold' => 10,
    ],
];
