### ActivityLog Apiato Container

This container provides a basic _log activities of a user_ feature. Furthermore, it provides a route `/my/activities` 
to get all activities of the current user (sorted descending; the newest entry is the first to be retrieved).

In order to log activities, call the respective `Task`.

```php
Apiato::call(CreateActivityLogEntryTask::class, [
    $user, // the user who caused this event
    $model, // the model on which the event was caused
    $message, // the message to be logged
    [
        // completely custom options for this entry 
    ],
    $logfile, // the "log file" where this entry should be stored; if null, the default log will be used.
]);
```

#### Installation and Configuration

1) Just copy / paste the respective `ActivityLog` folder to `App/Containers`.
2) Run `composer update` in order to install the new dependencies
3) Run `php artisan migrate` to migrate the database accordingly

#### Example

Consider the following example:

A `User` creates a new `Post`. Then you could log this "event" in the `CreatePostAction` like this:

```php
// $user = the currently logged in user;
 
$post = Apiato::call(CreatePostTask::class, [...]);
 
Apiato::call(CreateActivityLogEntryTask::class, [
    $user,
    $post,
    'You have created a new Post.'
    [
        'name' => $post->name,
        'category' => $post->category,
    ]
]);
 
// do other stuff here
```

#### Translating Messages
 
But wait.. Now the message "You have created a new Post" is stored in the database. What about, if the user wants to 
get the message in `DE` instead of `EN`? You can pass in `Laravel Translation Resource`, like this:

```php
Apiato::call(CreateActivityLogEntryTask::class, [
    $user,
    $post,
    'activitylog::messages.post.create'
    [
        'name' => $post->name,
        'category' => $post->category,
    ]
]);
```

You need to enable this `Translation Feature` by setting respective configuration flag in `ActivityLog/Configs/activitylog-container.php` 
configuration file. When outputting the activities via `/my/activities`, the translation strings are automatically resolved.

This would for example output "Du hast einen neuen Beitrag erstellt." (which roughly translates to "You have created a new Post." in German).

Note that you may need to add respective localized resource files in the container!