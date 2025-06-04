<?php

namespace FF\Localization;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Lang;

class LocalizationController extends Controller
{
    public function __invoke(Request $request)
    {
        $files = $request->input('files');
        $localeFiles = collect();
        App::setLocale('en_US');

        foreach ($files as $file) {
            $lang = Lang::get($file);
            if(is_array($lang)) {
                $localeFiles[$file] = $lang;
            }
        }
        $dotLocaleFiles = $localeFiles->dot();
        return $dotLocaleFiles->toJson();
    }
}