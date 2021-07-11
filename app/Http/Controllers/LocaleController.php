<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\App;

class LocaleController extends Controller
{

    public function index($locale)
    {
        App::setlocale($locale);

        session()->put('locale', $locale);

        return redirect()->back();
    }
}
