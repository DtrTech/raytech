<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Spatie\Browsershot\Browsershot;
use Illuminate\Http\Request;
use App\Models\ItemCommission;
use Bouncer;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ItemCommissionController extends Controller
{
    public function index(Request $request)
    {
        $item_commission = ItemCommission::all();
        
        return view('item_commission.index')->with('item_commission',$item_commission);
    }

    public function edit(ItemCommission $item_commission)
    {
        return view('item_commission.create')->with('item_commission',$item_commission);
    }

    public function update(Request $request, ItemCommission $item_commission)
    {
        $item_commission->update($request->all());
        return redirect()->route('item_commission.index')->withSuccess('Data updated');
    }
   
}
