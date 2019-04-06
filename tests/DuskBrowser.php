<?php

namespace Tests;

use Laravel\Dusk\Browser;

class DuskBrowser extends Browser
{
    public function select2($uniqueClass, $searchableTextValue)
    {
        $this->click(".select2.{$uniqueClass} ~ .select2")
            ->pause(500)
            ->type('.select2-container .select2-search__field', $searchableTextValue)
            ->pause(500)
            ->keys('.select2-container .select2-search__field', ['{enter}']);

        return $this;
    }
}