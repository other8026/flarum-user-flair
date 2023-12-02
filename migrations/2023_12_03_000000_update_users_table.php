<?php

use Flarum\Database\Migration;

return Migration::addColumns('users', [
    'flair' => ['string', 'nullable' => true],
]);
