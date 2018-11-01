<?php

namespace App\Components;


class Language
{
    public static function availableLanguages()
    {
        return [
            [
                'value' => 'en',
                'name' => __('common.english'),
                'icon' => asset('images/flags/gb.svg')
            ],
            [
                'value' => 'pl',
                'name' => __('common.polish'),
                'icon' => asset('images/flags/pl.svg')
            ]
        ];
    }
}