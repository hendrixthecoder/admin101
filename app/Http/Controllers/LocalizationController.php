<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class LocalizationController extends Controller
{
    public function setLang($locale, Request $request) {
        App::setLocale($locale);
        $user = $request->user();
        $user->locale = $locale;
        $user->save();

        return back()->with('successTrans', trans('auth.langChangSuc'));
    }
}
