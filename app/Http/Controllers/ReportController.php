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
use App\Exports\TintSalesExport;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    public function tint_sale_details(Request $request)
    {
        if(isset($request->date_from)){
            $date_from = Carbon::parse($request->date_from)->format('Y-m-d');
        }else{
            $date_from = Carbon::now()->format('Y-m-d');
        }
        if(isset($request->date_to)){
            $date_to = Carbon::parse($request->date_to)->format('Y-m-d');
        }else{
            $date_to = Carbon::now()->format('Y-m-d');
        }
        $sale = Sale::whereBetween('sales_date',[$date_from,$date_to])->orderBy('id','DESC')->get();
        foreach($sale as $s){
            $data = $this->calculateCommission($s);
            // dump($data);
            $s->total = $data['all_total'];
            $s->total_remove_commission = $data['all_total_remove_commission'];
        }
        // dd($sale);
        if(isset($request->excel)){
            return Excel::download(new TintSalesExport($sale), 'tint_sales.xlsx');
        }
        return view('report.tint_sale_details')->with('sale',$sale)->with('date_from',$date_from)->with('date_to',$date_to);
    }

    public function by_user(Request $request)
    {
        if(isset($request->date_from)){
            $date_from = Carbon::parse($request->date_from)->format('Y-m-d');
        }else{
            $date_from = Carbon::now()->format('Y-m-d');
        }
        if(isset($request->date_to)){
            $date_to = Carbon::parse($request->date_to)->format('Y-m-d');
        }else{
            $date_to = Carbon::now()->format('Y-m-d');
        }
        $sale = Sale::whereBetween('sales_date',[$date_from,$date_to])->orderBy('id','DESC')->get();
        $worker = User::where('is_active',1)->where('role_id',2)->orderBy('id','ASC')->get();
        foreach($sale as $s){
            $data = $this->calculateCommission($s);
            $s->total = $data['all_total'];
            $s->total_remove_commission = $data['all_total_remove_commission'];
            foreach($worker as $w){
                $id = $w->id;
                $s->$id = $data['worker'][$id]['full_total']??0;
            }
        }

        if(isset($request->excel)){
            return Excel::download(new TintSalesExport($sale), 'tint_sales.xlsx');
        }
        return view('report.by_user')->with('sale',$sale)->with('date_from',$date_from)->with('date_to',$date_to)->with('worker',$worker);
    }
}
