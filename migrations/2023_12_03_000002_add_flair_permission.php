<?php

/*
 * based on https://github.com/flarum/suspend/blob/main/migrations/2017_07_22_000000_add_default_permissions.php
 */

use Flarum\Database\Migration;
use Flarum\Group\Group;

return Migration::addPermissions([
    'user-flair.modify-flair' => Group::ADMINISTRATOR_ID
]);
