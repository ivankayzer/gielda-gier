<?php

namespace App\ValueObjects;


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

    public static function getLabelById($id)
    {
        return data_get(collect(self::availableLanguages())
            ->filter(function ($lang) use ($id) {
                return $lang['value'] === $id;
            })->first(), 'name');
    }
}