<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Spatie\Browsershot\Browsershot;
use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\Product;
use App\Models\User;
use Bouncer;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class SaleController extends Controller
{
    public function index(Request $request)
    {
        if(isset($request->select_date)){
            $today = Carbon::parse($request->select_date)->format('Y-m-d');
        }else{
            $today = Carbon::now()->format('Y-m-d');
        }
        $sale = Sale::where('sales_date',$today)->orderBy('id','DESC')->get();
        
        return view('sale.index')->with('sale',$sale)->with('today',$today);
    }

    public function create()
    {
        $today = Carbon::now()->format('Y-m-d');
        $product = Product::where('is_active',1)->get();
        return view('sale.create')->with('today',$today)->with('product',$product);
    }

    public function store(Request $request)
    {   
        $sale = Sale::create($request->all());
        
        return redirect()->route('sale.edit',$sale)->withSuccess('Data updated');
    }

    public function edit(Sale $sale)
    {
        $product = Product::where('is_active',1)->get();
        $worker = User::where('role_id',2)->where('is_active',1)->get();
        $selected_product = Product::whereIn('id',$sale->product_ids)->get();
        return view('sale.create')->with('sale',$sale)->with('product',$product)->with('worker',$worker)->with('selected_product',$selected_product);
    }

    public function update(Request $request, Sale $sale)
    {
        $sale->update($request->all());
        return redirect()->route('sale.edit',$sale)->withSuccess('Data updated');
    }

    public function destroy(Sale $sale)
    {
        $sale->delete();

        return redirect()->route('sale.index')->withSuccess('Data deleted');
    }
   
}
