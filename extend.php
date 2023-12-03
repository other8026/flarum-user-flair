<?php

/*
 * This file is part of other8026/user-flair.
 *
 * Copyright (c) 2023 other8026.
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Other8026\UserFlair;

use Flarum\Extend;
use Flarum\User\User;
use Other8026\UserFlair\Access\UserPolicy;

return [
    (new Extend\Frontend('forum'))
        ->js(__DIR__.'/js/dist/forum.js')
        ->css(__DIR__.'/less/forum.less'),

    (new Extend\Frontend('admin'))
        ->js(__DIR__.'/js/dist/admin.js')
        ->css(__DIR__.'/less/admin.less'),

    new Extend\Locales(__DIR__.'/locale'),

    (new Extend\Model(User::class))
        ->cast('user_flair', 'string'),

    (new Extend\User())
        ->displayNameDriver('simple-flair', SimpleFlairDriver::class),

    (new Extend\Settings())
        ->default('user_flair.default_flair', 'Member')
        ->default('user_flair.validator.regex', '^[a-zA-Z0-9\s]*$')
        ->default('user_flair.validator.min-length', 1)
        ->default('user_flair.validator.max-length', 100),

    (new Extend\Policy())
        ->modelPolicy(User::class, UserPolicy::class),
];
