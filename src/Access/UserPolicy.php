<?php

/*
 * based on https://github.com/flarum/nicknames/blob/main/src/Access/UserPolicy.php
 */

namespace Other8026\UserFlair\Access;

use Flarum\User\Access\AbstractPolicy;
use Flarum\User\User;

class UserPolicy extends AbstractPolicy
{

    /**
     * @param User $actor
     * @param User $user
     * @return bool|null
     */
    public function editFlair(User $actor, User $user)
    {
        if (!$actor->isAdmin() && $user->isAdmin()) {
            return $this->deny();
        } else if ($actor->can('edit', $user)) {
            return $this->allow();
        } else {
            return $this->deny();
        }
    }
}
