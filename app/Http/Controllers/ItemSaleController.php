<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Spatie\Browsershot\Browsershot;
use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\ItemCommission;
use App\Models\ItemSale;
use App\Models\ItemSaleDt;
use App\Models\User;
use Bouncer;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ItemSaleController extends Controller
{
    public function index(Request $request)
    {
        if(isset($request->select_date)){
            $from = Carbon::parse($request->select_date)->format('Y-m-d');
        }else{
            $from = Carbon::now()->format('Y-m-d');
        }

        if(isset($request->select_date_to)){
            $to = Carbon::parse($request->select_date_to)->format('Y-m-d');
        }else{
            $to = Carbon::now()->format('Y-m-d');
        }
        
        $item_sale = ItemSale::whereBetween('sales_date',[$from,$to])->orderBy('id','DESC')->get();
        
        return view('item_sale.index')->with('item_sale',$item_sale)->with('from',$from)->with('to',$to);
    }

    public function create()
    {
        $today = Carbon::now()->format('Y-m-d');
        $items = Item::where('is_active',1)->get();
        $worker = User::where('role_id',2)->where('is_active',1)->get();
        $s_commission_give = ItemCommission::where('type','sale')->first();
        $w_commission_give = ItemCommission::where('type','work')->first();
        return view('item_sale.create')->with('today',$today)->with('items',$items)->with('worker',$worker)->with('s_commission_give',$s_commission_give)->with('w_commission_give',$w_commission_give);
    }

    public function store(Request $request)
    {   
        // dd(($request->all()));
        $item_sale = ItemSale::create($request->all());
        
        if(isset($request->sale_person_ids)){
            $s_commission_give = ItemCommission::where('type','sale')->first();
            $number_of_sales = count($request->sale_person_ids);
            $commission = round($request->sales_commission / $number_of_sales,2);

            foreach($request->sale_person_ids as $sales){
                ItemSaleDt::create([
                    'item_sale_id'=>$item_sale->id,
                    'type'=> 'sale',
                    'sales_date'=>$request->sales_date,
                    'worker_id'=>$sales,
                    'rate'=>$s_commission_give->rate,
                    'worker_commission'=>$commission
                ]);
            }
        }
        if(isset($request->worker_ids)){
            $w_commission_give = ItemCommission::where('type','work')->first();
            $number_of_workers = count($request->worker_ids);
            $w_commission = round($request->work_commission / $number_of_workers,2);
            
            foreach($request->worker_ids as $work){
                ItemSaleDt::create([
                    'item_sale_id'=>$item_sale->id,
                    'type'=> 'work',
                    'sales_date'=>$request->sales_date,
                    'worker_id'=>$work,
                    'rate'=>$w_commission_give->rate,
                    'worker_commission'=>$w_commission
                ]);
            }
        }
        
        return redirect()->route('item_sale.index')->withSuccess('Data updated');
    }

    public function edit(ItemSale $item_sale)
    {
        $today = Carbon::now()->format('Y-m-d');
        $items = Item::where('is_active',1)->get();
        $worker = User::where('role_id',2)->where('is_active',1)->get();
        $s_commission_give = ItemCommission::where('type','sale')->first();
        $w_commission_give = ItemCommission::where('type','work')->first();

        return view('item_sale.create')->with('today',$today)->with('items',$items)->with('worker',$worker)->with('s_commission_give',$s_commission_give)->with('w_commission_give',$w_commission_give)->with('item_sale',$item_sale);
    }

    public function update(Request $request, ItemSale $item_sale)
    {
        $item_sale->update($request->all());
        if($item_sale->workers->count()>0){
            foreach($item_sale->workers as $worker){
                $worker->delete();
            }
        }
        if($item_sale->salePersons->count()>0){
            foreach($item_sale->salePersons as $sales){
                $sales->delete();
            }
        }
        if(isset($request->sale_person_ids)){
            $s_commission_give = ItemCommission::where('type','sale')->first();
            $number_of_sales = count($request->sale_person_ids);
            $commission = round($request->sales_commission / $number_of_sales,2);

            foreach($request->sale_person_ids as $sales){
                ItemSaleDt::create([
                    'item_sale_id'=>$item_sale->id,
                    'type'=> 'sale',
                    'sales_date'=>$request->sales_date,
                    'worker_id'=>$sales,
                    'rate'=>$s_commission_give->rate,
                    'worker_commission'=>$commission
                ]);
            }
        }
        if(isset($request->worker_ids)){
            $w_commission_give = ItemCommission::where('type','work')->first();
            $number_of_workers = count($request->worker_ids);
            $w_commission = round($request->work_commission / $number_of_workers,2);
            
            foreach($request->worker_ids as $work){
                ItemSaleDt::create([
                    'item_sale_id'=>$item_sale->id,
                    'type'=> 'work',
                    'sales_date'=>$request->sales_date,
                    'worker_id'=>$work,
                    'rate'=>$w_commission_give->rate,
                    'worker_commission'=>$w_commission
                ]);
            }
        }

        return redirect()->route('item_sale.index')->withSuccess('Data updated');
    }

    public function destroy(ItemSale $item_sale)
    {
        if($item_sale->workers->count()>0){
            foreach($item_sale->workers as $worker){
                $worker->delete();
            }
        }
        if($item_sale->salePersons->count()>0){
            foreach($item_sale->salePersons as $sales){
                $sales->delete();
            }
        }
        $item_sale->delete();

        return redirect()->route('item_sale.index')->withSuccess('Data updated');
    }
   
}
