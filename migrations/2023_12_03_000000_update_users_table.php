<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\Builder;

/*
 * based on https://github.com/flarum/nicknames/blob/main/migrations/2020_11_23_000000_add_nickname_column.php
 */

return [
    'up' => function (Builder $schema) {
        if (! $schema->hasColumn('users', 'user_flair')) {
            $schema->table('users', function (Blueprint $table) {
                $table->string('user_flair', 100)->index()->nullable();
            });
        }
    },
    'down' => function (Builder $schema) {
        $schema->table('users', function (Blueprint $table) {
            $table->dropColumn('user_flair');
        });
    }
];
