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
        // do in this order:
        // non-admins can't edit admins' flair
        // admins can always make changes
        // permit changes if the actor has privileges to edit users (a different permission)
        // deny if none of the preceding conditions are met
        if (!$actor->isAdmin() && $user->isAdmin()) {
            return $this->deny();
        } else if ($actor->isAdmin()) {
            return $this->allow();
        } else if ($actor->can('edit', $user)) {
            return $this->allow();
        } else {
            return $this->deny();
        }
    }
}
