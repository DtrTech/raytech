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
                                <li class="breadcrumb-item"><a href="{{route('sale.index')}}">Sales</a></li>
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
                            <h4><b>Sales</b></h4>
                        </div>                 
                    </div>
                </div>
                <div class="widget-content widget-content-area" style="padding: 4px 18px">
                    <form enctype="multipart/form-data" @if (isset($sale)) method="post" action="{{ route('sale.update',$sale) }}" @else method="post" action="{{ route('sale.store') }}" @endif>
                    @csrf
                    <div class="row">
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="t-group">Car Model</label>
                                <input id="t-text" type="text" name="car_model" placeholder="car model..." class="form-control" value="{{$sale->car_model??''}}" required >
                            </div>
                        </div>   
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="t-group">Car Plate</label>
                                <input id="t-text" type="text" name="carplate" placeholder="car plate..." class="form-control" value="{{$sale->carplate??''}}" required >
                            </div>
                        </div>  
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="t-group">Date</label>
                                <input id="t-text" type="date" name="sales_date" class="form-control" value="{{$sale->sales_date??$today}}" required >
                            </div>
                        </div>  
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="t-group">Product</label>
                                <select id="select-product" name="product_ids[]" multiple placeholder="Select a product..." autocomplete="off" required>
                                <option value=""></option>
                                @foreach($product as $prod)
                                <option value="{{$prod->id??''}}" <?php echo isset($sale)&&in_array($prod->id,$sale->product_ids)?'selected':'' ?>>{{$prod->product_name??''}}</option>
                                @endforeach
                                </select>
                            </div>
                        </div>
                        @if(isset($sale))  
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="t-group">FWS Worker</label>
                                <select id="fws_worker_id" name="fws_worker_id" placeholder="Select a worker..." autocomplete="off">
                                <option value="">Select a worker...</option>
                                @foreach($worker as $work)
                                <option value="{{$work->id??''}}" <?php echo isset($sale)&&$work->id == $sale->fws_worker_id?'selected':'' ?>>{{$work->name??''}}</option>
                                @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="t-group">FWS RT (Optional)</label>
                                <select id="fws_remove_worker_id" name="fws_remove_worker_id" placeholder="Select a worker..." autocomplete="off">
                                <option value="">Select a worker...</option>
                                @foreach($worker as $work)
                                <option value="{{$work->id??''}}" <?php echo isset($sale)&&$work->id == $sale->fws_remove_worker_id?'selected':'' ?>>{{$work->name??''}}</option>
                                @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="t-group">FWS Product</label>
                                <select id="fws_product_id" name="fws_product_id" placeholder="Select a product..." autocomplete="off">
                                <option value="">Select a product...</option>
                                @foreach($selected_product as $index=>$sel_prod)
                                <option value="{{ $sel_prod->id ?? '' }}" 
                                    @if((isset($sale) && $sel_prod->id == $sale->fws_product_id) || (!isset($sale->fws_product_id) && $index == 0)) 
                                        selected 
                                    @endif>
                                    {{ $sel_prod->product_name ?? '' }}
                                </option>
                                @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="t-group">FWS Coating (Optional)</label>
                                <select id="coating_worker_id" name="coating_worker_id" placeholder="Select a worker..." autocomplete="off">
                                <option value="">Select a worker...</option>
                                @foreach($worker as $work)
                                <option value="{{$work->id??''}}" <?php echo isset($sale)&&$work->id == $sale->coating_worker_id?'selected':'' ?>>{{$work->name??''}}</option>
                                @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="t-group">RWS Worker</label>
                                <select id="rws_worker_id" name="rws_worker_id" placeholder="Select a worker..." autocomplete="off">
                                <option value="">Select a worker...</option>
                                @foreach($worker as $work)
                                <option value="{{$work->id??''}}" <?php echo isset($sale)&&$work->id == $sale->rws_worker_id?'selected':'' ?>>{{$work->name??''}}</option>
                                @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="t-group">RWS RT (Optional)</label>
                                <select id="rws_remove_worker_id" name="rws_remove_worker_id" placeholder="Select a worker..." autocomplete="off">
                                <option value="">Select a worker...</option>
                                @foreach($worker as $work)
                                <option value="{{$work->id??''}}" <?php echo isset($sale)&&$work->id == $sale->rws_remove_worker_id?'selected':'' ?>>{{$work->name??''}}</option>
                                @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="t-group">RWS Product</label>
                                <select id="rws_product_id" name="rws_product_id" placeholder="Select a product..." autocomplete="off">
                                <option value="">Select a product...</option>
                                @foreach($selected_product as $index=>$sel_prod)
                                <option value="{{ $sel_prod->id ?? '' }}" 
                                    @if((isset($sale) && $sel_prod->id == $sale->rws_product_id) || (!isset($sale->rws_product_id) && $index == 0)) 
                                        selected 
                                    @endif>
                                    {{ $sel_prod->product_name ?? '' }}
                                </option>
                                @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="t-group">R1 Worker</label>
                                <select id="r1_worker_id" name="r1_worker_id" placeholder="Select a worker..." autocomplete="off">
                                <option value="">Select a worker...</option>
                                @foreach($worker as $work)
                                <option value="{{$work->id??''}}" <?php echo isset($sale)&&$work->id == $sale->r1_worker_id?'selected':'' ?>>{{$work->name??''}}</option>
                                @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="t-group">R1 RT (Optional)</label>
                                <select id="r1_remove_worker_id" name="r1_remove_worker_id" placeholder="Select a worker..." autocomplete="off">
                                <option value="">Select a worker...</option>
                                @foreach($worker as $work)
                                <option value="{{$work->id??''}}" <?php echo isset($sale)&&$work->id == $sale->r1_remove_worker_id?'selected':'' ?>>{{$work->name??''}}</option>
                                @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="t-group">R1 Product</label>
                                <select id="r1_product_id" name="r1_product_id" placeholder="Select a product..." autocomplete="off">
                                <option value="">Select a product...</option>
                                @foreach($selected_product as $index=>$sel_prod)
                                <option value="{{ $sel_prod->id ?? '' }}" 
                                    @if((isset($sale) && $sel_prod->id == $sale->r1_product_id) || (!isset($sale->r1_product_id) && $index == 0)) 
                                        selected 
                                    @endif>
                                    {{ $sel_prod->product_name ?? '' }}
                                </option>
                                @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="t-group">R2 Worker</label>
                                <select id="r2_worker_id" name="r2_worker_id" placeholder="Select a worker..." autocomplete="off">
                                <option value="">Select a worker...</option>
                                @foreach($worker as $work)
                                <option value="{{$work->id??''}}" <?php echo isset($sale)&&$work->id == $sale->r2_worker_id?'selected':'' ?>>{{$work->name??''}}</option>
                                @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="t-group">R2 RT (Optional)</label>
                                <select id="r2_remove_worker_id" name="r2_remove_worker_id" placeholder="Select a worker..." autocomplete="off">
                                <option value="">Select a worker...</option>
                                @foreach($worker as $work)
                                <option value="{{$work->id??''}}" <?php echo isset($sale)&&$work->id == $sale->r2_remove_worker_id?'selected':'' ?>>{{$work->name??''}}</option>
                                @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="t-group">R2 Product</label>
                                <select id="r2_product_id" name="r2_product_id" placeholder="Select a product..." autocomplete="off">
                                <option value="">Select a product...</option>
                                @foreach($selected_product as $index=>$sel_prod)
                                <option value="{{ $sel_prod->id ?? '' }}" 
                                    @if((isset($sale) && $sel_prod->id == $sale->r2_product_id) || (!isset($sale->r2_product_id) && $index == 0)) 
                                        selected 
                                    @endif>
                                    {{ $sel_prod->product_name ?? '' }}
                                </option>
                                @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="t-group">L1 Worker</label>
                                <select id="l1_worker_id" name="l1_worker_id" placeholder="Select a worker..." autocomplete="off">
                                <option value="">Select a worker...</option>
                                @foreach($worker as $work)
                                <option value="{{$work->id??''}}" <?php echo isset($sale)&&$work->id == $sale->l1_worker_id?'selected':'' ?>>{{$work->name??''}}</option>
                                @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="t-group">L1 RT (Optional)</label>
                                <select id="l1_remove_worker_id" name="l1_remove_worker_id" placeholder="Select a worker..." autocomplete="off">
                                <option value="">Select a worker...</option>
                                @foreach($worker as $work)
                                <option value="{{$work->id??''}}" <?php echo isset($sale)&&$work->id == $sale->l1_remove_worker_id?'selected':'' ?>>{{$work->name??''}}</option>
                                @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="t-group">L1 Product</label>
                                <select id="l1_product_id" name="l1_product_id" placeholder="Select a product..." autocomplete="off">
                                <option value="">Select a product...</option>
                                @foreach($selected_product as $index=>$sel_prod)
                                <option value="{{ $sel_prod->id ?? '' }}" 
                                    @if((isset($sale) && $sel_prod->id == $sale->l1_product_id) || (!isset($sale->l1_product_id) && $index == 0)) 
                                        selected 
                                    @endif>
                                    {{ $sel_prod->product_name ?? '' }}
                                </option>
                                @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="t-group">L2 Worker</label>
                                <select id="l2_worker_id" name="l2_worker_id" placeholder="Select a worker..." autocomplete="off">
                                <option value="">Select a worker...</option>
                                @foreach($worker as $work)
                                <option value="{{$work->id??''}}" <?php echo isset($sale)&&$work->id == $sale->l2_worker_id?'selected':'' ?>>{{$work->name??''}}</option>
                                @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="t-group">L2 RT (Optional)</label>
                                <select id="l2_remove_worker_id" name="l2_remove_worker_id" placeholder="Select a worker..." autocomplete="off">
                                <option value="">Select a worker...</option>
                                @foreach($worker as $work)
                                <option value="{{$work->id??''}}" <?php echo isset($sale)&&$work->id == $sale->l2_remove_worker_id?'selected':'' ?>>{{$work->name??''}}</option>
                                @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="t-group">L2 Product</label>
                                <select id="l2_product_id" name="l2_product_id" placeholder="Select a product..." autocomplete="off">
                                <option value="">Select a product...</option>
                                @foreach($selected_product as $index=>$sel_prod)
                                <option value="{{ $sel_prod->id ?? '' }}" 
                                    @if((isset($sale) && $sel_prod->id == $sale->l2_product_id) || (!isset($sale->l2_product_id) && $index == 0)) 
                                        selected 
                                    @endif>
                                    {{ $sel_prod->product_name ?? '' }}
                                </option>
                                @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="t-group">R3 Worker</label>
                                <select id="r3_worker_id" name="r3_worker_id" placeholder="Select a worker..." autocomplete="off">
                                <option value="">Select a worker...</option>
                                @foreach($worker as $work)
                                <option value="{{$work->id??''}}" <?php echo isset($sale)&&$work->id == $sale->r3_worker_id?'selected':'' ?>>{{$work->name??''}}</option>
                                @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="t-group">R3 RT (Optional)</label>
                                <select id="r3_remove_worker_id" name="r3_remove_worker_id" placeholder="Select a worker..." autocomplete="off">
                                <option value="">Select a worker...</option>
                                @foreach($worker as $work)
                                <option value="{{$work->id??''}}" <?php echo isset($sale)&&$work->id == $sale->r3_remove_worker_id?'selected':'' ?>>{{$work->name??''}}</option>
                                @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="t-group">R3 Product</label>
                                <select id="r3_product_id" name="r3_product_id" placeholder="Select a product..." autocomplete="off">
                                <option value="">Select a product...</option>
                                @foreach($selected_product as $index=>$sel_prod)
                                <option value="{{ $sel_prod->id ?? '' }}" 
                                    @if((isset($sale) && $sel_prod->id == $sale->r3_product_id) || (!isset($sale->r3_product_id) && $index == 0)) 
                                        selected 
                                    @endif>
                                    {{ $sel_prod->product_name ?? '' }}
                                </option>
                                @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="t-group">L3 Worker</label>
                                <select id="l3_worker_id" name="l3_worker_id" placeholder="Select a worker..." autocomplete="off">
                                <option value="">Select a worker...</option>
                                @foreach($worker as $work)
                                <option value="{{$work->id??''}}" <?php echo isset($sale)&&$work->id == $sale->l3_worker_id?'selected':'' ?>>{{$work->name??''}}</option>
                                @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="t-group">L3 RT (Optional)</label>
                                <select id="l3_remove_worker_id" name="l3_remove_worker_id" placeholder="Select a worker..." autocomplete="off">
                                <option value="">Select a worker...</option>
                                @foreach($worker as $work)
                                <option value="{{$work->id??''}}" <?php echo isset($sale)&&$work->id == $sale->l3_remove_worker_id?'selected':'' ?>>{{$work->name??''}}</option>
                                @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="t-group">L3 Product</label>
                                <select id="l3_product_id" name="l3_product_id" placeholder="Select a product..." autocomplete="off">
                                <option value="">Select a product...</option>
                                @foreach($selected_product as $index=>$sel_prod)
                                <option value="{{ $sel_prod->id ?? '' }}" 
                                    @if((isset($sale) && $sel_prod->id == $sale->l3_product_id) || (!isset($sale->l3_product_id) && $index == 0)) 
                                        selected 
                                    @endif>
                                    {{ $sel_prod->product_name ?? '' }}
                                </option>
                                @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="t-group">SRF Worker</label>
                                <select id="srf_worker_id" name="srf_worker_id" placeholder="Select a worker..." autocomplete="off">
                                <option value="">Select a worker...</option>
                                @foreach($worker as $work)
                                <option value="{{$work->id??''}}" <?php echo isset($sale)&&$work->id == $sale->srf_worker_id?'selected':'' ?>>{{$work->name??''}}</option>
                                @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="t-group">SRF RT (Optional)</label>
                                <select id="srf_remove_worker_id" name="srf_remove_worker_id" placeholder="Select a worker..." autocomplete="off">
                                <option value="">Select a worker...</option>
                                @foreach($worker as $work)
                                <option value="{{$work->id??''}}" <?php echo isset($sale)&&$work->id == $sale->srf_remove_worker_id?'selected':'' ?>>{{$work->name??''}}</option>
                                @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="t-group">SRF Product</label>
                                <select id="srf_product_id" name="srf_product_id" placeholder="Select a product..." autocomplete="off">
                                <option value="">Select a product...</option>
                                @foreach($selected_product as $index=>$sel_prod)
                                <option value="{{ $sel_prod->id ?? '' }}" 
                                    @if((isset($sale) && $sel_prod->id == $sale->srf_product_id) || (!isset($sale->srf_product_id) && $index == 0)) 
                                        selected 
                                    @endif>
                                    {{ $sel_prod->product_name ?? '' }}
                                </option>
                                @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="t-group">SRF 2 Worker</label>
                                <select id="srf2_worker_id" name="srf2_worker_id" placeholder="Select a worker..." autocomplete="off">
                                <option value="">Select a worker...</option>
                                @foreach($worker as $work)
                                <option value="{{$work->id??''}}" <?php echo isset($sale)&&$work->id == $sale->srf2_worker_id?'selected':'' ?>>{{$work->name??''}}</option>
                                @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="t-group">SRF 2 RT (Optional)</label>
                                <select id="srf2_remove_worker_id" name="srf2_remove_worker_id" placeholder="Select a worker..." autocomplete="off">
                                <option value="">Select a worker...</option>
                                @foreach($worker as $work)
                                <option value="{{$work->id??''}}" <?php echo isset($sale)&&$work->id == $sale->srf2_remove_worker_id?'selected':'' ?>>{{$work->name??''}}</option>
                                @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="t-group">SRF 2 Product</label>
                                <select id="srf2_product_id" name="srf2_product_id" placeholder="Select a product..." autocomplete="off">
                                <option value="">Select a product...</option>
                                @foreach($selected_product as $index=>$sel_prod)
                                <option value="{{ $sel_prod->id ?? '' }}" 
                                    @if((isset($sale) && $sel_prod->id == $sale->srf2_product_id) || (!isset($sale->srf2_product_id) && $index == 0)) 
                                        selected 
                                    @endif>
                                    {{ $sel_prod->product_name ?? '' }}
                                </option>
                                @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="t-group">SRF Big Worker</label>
                                <select id="srfbig_worker_id" name="srfbig_worker_id" placeholder="Select a worker..." autocomplete="off">
                                <option value="">Select a worker...</option>
                                @foreach($worker as $work)
                                <option value="{{$work->id??''}}" <?php echo isset($sale)&&$work->id == $sale->srfbig_worker_id?'selected':'' ?>>{{$work->name??''}}</option>
                                @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="t-group">SRF Big RT (Optional)</label>
                                <select id="srfbig_remove_worker_id" name="srfbig_remove_worker_id" placeholder="Select a worker..." autocomplete="off">
                                <option value="">Select a worker...</option>
                                @foreach($worker as $work)
                                <option value="{{$work->id??''}}" <?php echo isset($sale)&&$work->id == $sale->srfbig_remove_worker_id?'selected':'' ?>>{{$work->name??''}}</option>
                                @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="t-group">SRF Big Product</label>
                                <select id="srfbig_product_id" name="srfbig_product_id" placeholder="Select a product..." autocomplete="off">
                                <option value="">Select a product...</option>
                                @foreach($selected_product as $index=>$sel_prod)
                                <option value="{{ $sel_prod->id ?? '' }}" 
                                    @if((isset($sale) && $sel_prod->id == $sale->srfbig_product_id) || (!isset($sale->srfbig_product_id) && $index == 0)) 
                                        selected 
                                    @endif>
                                    {{ $sel_prod->product_name ?? '' }}
                                </option>
                                @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label style="color:red">** RT = Remove Tinted</label>
                            </div>
                        </div>
                        @endif
                        <div class="col-lg-12 col-12" style="padding-bottom:10px">
                            <button type="submit" class="mt-4 btn btn-primary float-right">Submit</button>
                            <a href="{{route('sale.index')}}" class="mt-4  btn btn-warning float-right" style="margin-right:10px">Back</a>
                            
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
    new TomSelect("#select-product",{
        maxItems: 10
    });
    new TomSelect("#fws_worker_id");
    new TomSelect("#fws_product_id");
    new TomSelect("#fws_remove_worker_id");
    new TomSelect("#rws_worker_id");
    new TomSelect("#rws_product_id");
    new TomSelect("#rws_remove_worker_id");
    new TomSelect("#l1_worker_id");
    new TomSelect("#l1_product_id");
    new TomSelect("#l1_remove_worker_id");
    new TomSelect("#l2_worker_id");
    new TomSelect("#l2_product_id");
    new TomSelect("#l2_remove_worker_id");
    new TomSelect("#r1_worker_id");
    new TomSelect("#r1_product_id");
    new TomSelect("#r1_remove_worker_id");
    new TomSelect("#r2_worker_id");
    new TomSelect("#r2_product_id");
    new TomSelect("#r2_remove_worker_id");
    new TomSelect("#l3_worker_id");
    new TomSelect("#l3_product_id");
    new TomSelect("#l3_remove_worker_id");
    new TomSelect("#r3_worker_id");
    new TomSelect("#r3_product_id");
    new TomSelect("#r3_remove_worker_id");
    new TomSelect("#srf_worker_id");
    new TomSelect("#srf_product_id");
    new TomSelect("#srf_remove_worker_id");
    new TomSelect("#srf2_worker_id");
    new TomSelect("#srf2_product_id");
    new TomSelect("#srf2_remove_worker_id");
    new TomSelect("#srfbig_worker_id");
    new TomSelect("#srfbig_product_id");
    new TomSelect("#srfbig_remove_worker_id");
    new TomSelect("#coating_worker_id");
</script>
@endsection
