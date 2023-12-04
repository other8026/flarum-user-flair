<?php

/*
 * based on https://github.com/flarum/suspend/blob/main/src/AddUserSuspendAttributes.php
 */

namespace Other8026\UserFlair;

use Flarum\Api\Serializer\UserSerializer;
use Flarum\Settings\SettingsRepositoryInterface;
use Flarum\User\User;

class AddUserFlairAttributes
{
    /**
     * @var SettingsRepositoryInterface
     */
    protected $settings;

    public function __construct(SettingsRepositoryInterface $settings)
    {
        $this->settings = $settings;
    }
    public function __invoke(UserSerializer $serializer, User $user): array
    {
        $attributes = [];

        // add user's flair if set
        // add null if no user flair set and no default
        // add default flair if it's set and no user flair is set
        if ($user->user_flair && strlen($user->user_flair) > 0) {
            $flair = $user->user_flair;
        } else if ($this->settings->get('user_flair.default_flair') && strlen($this->settings->get('user_flair.default_flair')) > 0) {
            $flair = $this->settings->get('user_flair.default_flair');
        } else {
            $flair = null;
        }

        $canSetUserFlair = $serializer->getActor()->can('edit', $user);

        $attributes['userFlair'] = $flair;
        $attributes['canSetUserFlair'] = $canSetUserFlair;

        return $attributes;
    }
}
