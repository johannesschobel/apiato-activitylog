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

];
