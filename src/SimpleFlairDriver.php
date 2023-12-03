<?php

/*
 * based on https://github.com/flarum/nicknames/blob/main/src/NicknameDriver.php
 *
 * this is meant to be a temporary thing while a better thing is made
 */

namespace Other8026\UserFlair;

use Flarum\User\DisplayName\DriverInterface;
use Flarum\User\User;

class SimpleFlairDriver implements DriverInterface
{
    public function displayName(User $user): string
    {
        if ($user->user_flair) {
            return "$user->username ($user->user_flair)";
        } else {
            return $user->username;
        }
    }
}
