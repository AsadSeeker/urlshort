<?php

namespace App\Http\Controllers;

use App\Models\Urls;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UrlController extends Controller
{
    public function store(Request $request)
    {

        $length = 5;
        $str = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcefghijklmnopqrstuvwxyz';
        $string = substr(str_shuffle($str), 0, $length);

        $urls = new Urls;

        $urls->url = $request->url;
        $urls->uuid = $string;
        $urls->url = $request->url;

        $urls->save();

        return back()->with('url', $string);
    }

    public function redirect(Request $request, $uuid)
    {
        $find = Urls::where('uuid', $uuid)->first();
        $find->increment('count');
        Urls::where('uuid',$uuid)->update(['last_used'=> Carbon::now()]);
        return redirect($find->url);
    }
}
