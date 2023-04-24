<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;

class LocalizationController extends Controller
{
    public function setLang($locale, Request $request) {
        if(array_key_exists($locale, Config::get('languages'))){
            App::setLocale($locale);
            $user = $request->user();
            $user->locale = $locale;
            $user->save();
            
        }else{
            return back()->with('error', 'Language not found');
        }

        return back()->with('successTrans', trans('auth.langChangSuc'));
    }
}
