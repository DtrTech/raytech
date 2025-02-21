@extends('layouts.app')

@section('content')
<style>
    .form-control{
        padding:0.3rem 0.8rem !important;
        color:orange;
    } 
    .ts-wrapper.multi .ts-control .item{
        padding: 2px 4px !important;
        margin: 0px 3px 0 0 !important;
    }
    .ts-wrapper.multi.has-items .ts-control {
        padding: calc(.075rem - 1px) .55rem calc(.075rem - 1px) !important;
    }

    .form-group label, label{
        margin-bottom:0.1rem !important;
    }

    .ts-wrapper:not(.form-control):not(.form-select).single .ts-control{
        color:orange;
    }

    .form-control:disabled:not(.flatpickr-input), .form-control[readonly]:not(.flatpickr-input) {
        background-color: #d2e8ff !important;
        color: orange !important;
    }
</style>
<div class="middle-content container-xxl p-0">

    <!--  BEGIN BREADCRUMBS  -->
    <div class="secondary-nav">
        <div class="breadcrumbs-container" data-page-heading="Analytics">
            <header class="header navbar navbar-expand-sm">
                <a href="javascript:void(0);" class="btn-toggle sidebarCollapse" data-placement="bottom">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg>
                </a>
                <div class="d-flex breadcrumb-content">
                    <div class="page-header">
                        <div class="page-title">
                        </div>
                        <nav class="breadcrumb-style-one" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">Settings</li>
                                <li class="breadcrumb-item"><a href="{{route('sale.index')}}">Item Sales</a></li>
                                <li class="breadcrumb-item">Create</li>
                            </ol>
                        </nav>
        
                    </div>
                </div>
            </header>
        </div>
    </div>

    
    <div class="row layout-top-spacing">
        <div id="basic" class="col-lg-12 layout-spacing">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h4><b>Item Sales</b></h4>
                        </div>                 
                    </div>
                </div>
                <div class="widget-content widget-content-area" style="padding: 4px 18px">
                    <form enctype="multipart/form-data" @if (isset($item_sale)) method="post" action="{{ route('item_sale.update',$item_sale) }}" @else method="post" action="{{ route('item_sale.store') }}" @endif>
                    @csrf
                    <div class="row">  
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="t-group">Date</label>
                                <input type="date" name="sales_date" class="form-control" value="{{$item_sale->sales_date??$today}}" required >
                            </div>
                        </div>  
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="t-group">Car Plate</label>
                                <input type="text" name="car_plate" placeholder="car plate..." class="form-control" value="{{$item_sale->car_plate??''}}" >
                            </div>
                        </div>  
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="t-group">Item</label>
                                <select id="select-item" name="item_id" placeholder="Select a item..." autocomplete="off" required>
                                <option value=""></option>
                                @foreach($items as $item)
                                <option value="{{$item->id??''}}" attr-itemcost="{{$item->item_cost??0}}" <?php echo isset($item_sale)&&$item->id == $item_sale->item_id?'selected':'' ?>>{{$item->item_name??''}}</option>
                                @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="t-group">Per Item Cost</label>
                                <input type="number" min="0" step="0.01" name="per_cost_price" id="per_cost_price" onkeyup="updateAmount()" placeholder="per item cost..." class="form-control" value="{{$item_sale->per_cost_price??''}}" >
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="t-group">Quantity</label>
                                <input type="number" min="0" name="quantity" id="quantity" onkeyup="updateAmount()" placeholder="quantity..." class="form-control" value="{{$item_sale->quantity??''}}" >
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="t-group">Total Item Cost</label>
                                <input type="number" min="0" step="0.01" name="total_cost_price" onkeyup="updateAmount()" id="total_cost_price" placeholder="total item cost..." class="form-control" value="{{$item_sale->total_cost_price??''}}" >
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="t-group">Total Item Sale</label>
                                <input type="number" min="0" step="0.01" name="total_sale_price" onkeyup="updateAmount()" id="total_sale_price" placeholder="total item sales..." class="form-control" value="{{$item_sale->total_sale_price??''}}" >
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="t-group">Profit</label>
                                <input type="number" min="0" step="0.01" name="profit" id="profit" placeholder="total item sales..." class="form-control" value="{{$item_sale->profit??''}}" readonly>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="t-group">SA Commission</label>
                                <input type="number" min="0" step="0.01" name="sa_commission" id="sa_commission" onkeyup="updateAmount()" placeholder="total item sales..." class="form-control" value="{{$item_sale->sa_commission??''}}" >
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="t-group">Issue PV Date</label>
                                <input type="date" name="issue_pv_date" class="form-control" value="{{$item_sale->issue_pv_date??$today}}"  >
                            </div>
                        </div>  
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="t-group">Sales Person</label>
                                <select id="select-sales" name="sale_person_ids[]" multiple onchange="updateAmount()" placeholder="who sales..." autocomplete="off" >
                                <option value=""></option>
                                @foreach($worker as $work)
                                <option value="{{$work->id??''}}" <?php echo isset($item_sale)&&in_array($work->id,$item_sale->sale_person_ids)?'selected':'' ?>>{{$work->name??''}}</option>
                                @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="t-group">Sales Commission</label>
                                <input type="number" min="0" step="0.01" name="sales_commission" onkeyup="updateAmount()" id="sales_commission" placeholder="sales commission..." class="form-control" value="{{$item_sale->sales_commission??''}}" >
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="t-group">Work Person</label>
                                <select id="select-worker" name="worker_ids[]" multiple onchange="updateAmount()" placeholder="who work..." autocomplete="off" >
                                <option value=""></option>
                                @foreach($worker as $work)
                                <option value="{{$work->id??''}}" <?php echo isset($item_sale)&&in_array($work->id,$item_sale->worker_ids)?'selected':'' ?>>{{$work->name??''}}</option>
                                @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="t-group">Work Commission</label>
                                <input type="number" min="0" step="0.01" name="work_commission" onkeyup="updateAmount()" id="work_commission" placeholder="work commission..." class="form-control" value="{{$item_sale->work_commission??''}}" >
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="t-group">Net Profit</label>
                                <input type="number" min="0" step="0.01" name="net_profit" id="net_profit" placeholder="work commission..." class="form-control" value="{{$item_sale->net_profit??''}}" readonly>
                            </div>
                        </div>
                        
                        <div class="col-lg-12 col-12" style="padding-bottom:10px">
                            <button type="submit" class="mt-4 btn btn-primary float-right">Submit</button>
                            <a href="{{route('item_sale.index')}}" class="mt-4  btn btn-warning float-right" style="margin-right:10px">Back</a>
                            
                        </div>                                     
                    </div>
                    </form>   
                </div>
            </div>
        </div>
    </div>


</div>
@endsection
@section('scripts')
<script>
    new TomSelect("#select-item");
    new TomSelect("#select-sales");
    new TomSelect("#select-worker");

    document.addEventListener("DOMContentLoaded", function () {
        document.getElementById("select-item").addEventListener("change", function () {
            let selectedOption = this.options[this.selectedIndex];
            let itemCost = selectedOption.getAttribute("attr-itemcost") || 0; 
            console.log(itemCost);
            document.getElementById("per_cost_price").value = itemCost;
        });
    });
    
    
    function updateAmount(){
        var per_cost_price = parseFloat(document.getElementById("per_cost_price").value) || 0;
        var quantity = parseFloat(document.getElementById("quantity").value) || 0;
        var total_sale_price = parseFloat(document.getElementById("total_sale_price").value) || 0;
        
        var total_cost_price_input = document.getElementById("total_cost_price");
        var profit_input = document.getElementById("profit");

        var total_cost = per_cost_price * quantity;
        
        if (per_cost_price >= 0 && quantity > 0) {
            total_cost_price_input.value = total_cost.toFixed(2); 
        } else {
            total_cost_price_input.value = ""; 
        }

        if (total_sale_price > 0 && total_cost >= 0) {
            var profitEarn = total_sale_price - total_cost;
            profit_input.value = profitEarn.toFixed(2);
        } else {
            profit_input.value = ""; 
        }
        if(profitEarn>0){
            var sa_commission = parseFloat(document.getElementById("sa_commission").value) || 0;
            var sale_person_ids = document.getElementById("select-sales").value;
            var worker_ids = document.getElementById("select-worker").value;
            var sales_commission = document.getElementById("sales_commission");
            var work_commission = document.getElementById("work_commission");
            var net_profit = document.getElementById("net_profit");
            var s_commission = 0;
            var w_commission = 0;

            if(sale_person_ids !=""){
                var s_commission_rate = "{{$s_commission_give->rate??0}}";
                s_commission = profitEarn*s_commission_rate/100;
                sales_commission.value = s_commission.toFixed(2);
            }else{
                sales_commission.value = null;
            }
            if(worker_ids !=""){
                var w_commission_rate = "{{$w_commission_give->rate??0}}";
                w_commission = profitEarn*w_commission_rate/100;
                work_commission.value = w_commission.toFixed(2);
            }else{
                work_commission.value = null;
            }

            var final_profit = profitEarn-sa_commission-s_commission-w_commission;
            net_profit.value = final_profit.toFixed(2);
        }
    }
</script>
@endsection
