<?php

/*
 * based on https://github.com/flarum/nicknames/blob/main/src/AddNicknameValidation.php
 */

namespace Other8026\UserFlair;

use Flarum\Settings\SettingsRepositoryInterface;
use Illuminate\Validation\Validator;

class FlairValidator
{
    /**
     * @var SettingsRepositoryInterface
     */
    protected $settings;

    public function __construct(SettingsRepositoryInterface $settings)
    {
        $this->settings = $settings;
    }

    public function __invoke($flarumValidator, Validator $validator)
    {
        $rules = $validator->getRules();

        $rules['user_flair'] = [
            function ($attribute, $value, $fail) {
                $regex = $this->settings->get('user_flair.validator.regex');
                if ($regex && ! preg_match_all("/$regex/", $value)) {
                    $fail("username is not valid");
                }
            },
            'min:'.$this->settings->get('user_flair.validator.min-length'),
            'max:'.$this->settings->get('user_flair.validator.max-length'),
            'nullable'
        ];

        $validator->setRules($rules);
    }
}
