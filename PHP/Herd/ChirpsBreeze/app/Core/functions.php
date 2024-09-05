<?php

function isRTL()
{
    $locale = app()->getLocale();

    return in_array($locale, ["ar", "dv", "fa", "ha", "he", "iw", "ji", "ps", "ur", "yi"]);
}