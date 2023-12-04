<?php

/*
 * based on https://github.com/flarum/suspend/blob/main/src/AddUserSuspendAttributes.php
 */

namespace Other8026\UserFlair;

use Flarum\Api\Serializer\UserSerializer;
use Flarum\User\User;

class AddUserFlairAttributes
{
    public function __invoke(UserSerializer $serializer, User $user): array
    {
        $attributes = [];

        if ($user->user_flair && strlen($user->user_flair) > 0) {
            $flair = $user->user_flair;
        } else {
            $flair = "temporary thing";
        }

        $attributes['userFlair'] = $flair;

        return $attributes;
    }
}
