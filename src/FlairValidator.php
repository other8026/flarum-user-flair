<?php

/*
 * based on https://github.com/flarum/nicknames/blob/main/src/AddNicknameValidation.php
 */

namespace Other8026\UserFlair;

use Flarum\Settings\SettingsRepositoryInterface;
use Illuminate\Validation\Validator;
use Symfony\Contracts\Translation\TranslatorInterface;

class FlairValidator
{
    /**
     * @var SettingsRepositoryInterface
     */
    protected $settings;

    /**
     * @var TranslatorInterface
     */
    protected $translator;

    public function __construct(SettingsRepositoryInterface $settings, TranslatorInterface $translator)
    {
        $this->settings = $settings;
        $this->translator = $translator;
    }

    public function __invoke($flarumValidator, Validator $validator)
    {
        $rules = $validator->getRules();

        $rules['user_flair'] = [
            function ($attribute, $value, $fail) {
                $regex = $this->settings->get('user_flair.validator.regex');
                if ($regex && ! preg_match_all("/$regex/", $value)) {
                    $fail($this->translator->trans('other8026-user-flair.api.invalid'));
                }
            },
            'min:'.$this->settings->get('user_flair.validator.min-length'),
            'max:'.$this->settings->get('user_flair.validator.max-length'),
            'nullable'
        ];

        $validator->setRules($rules);
    }
}
