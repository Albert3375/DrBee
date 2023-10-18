<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class webPageController extends Controller
{
    public function setLanguage($lang)
    {
        $_SESSION["language"] = $lang;
        App::setLocale($lang);
        return back();
    }
}
