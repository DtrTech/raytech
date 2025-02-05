<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Spatie\Browsershot\Browsershot;
use Illuminate\Http\Request;
use App\Models\RemoveTintSetting;
use Bouncer;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class TintRemoveController extends Controller
{
    public function index(Request $request)
    {
        $tintremove = RemoveTintSetting::find(1);
        
        return view('tintremove.index')->with('tintremove',$tintremove);
    }

    public function store(Request $request)
    {   
        $tintremove = RemoveTintSetting::find(1);
        $tintremove->update($request->all());
        
        return view('tintremove.index')->with('tintremove',$tintremove);
    }
}
