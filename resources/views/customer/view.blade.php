@extends('layouts.app')

@section('content')
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
                                <li class="breadcrumb-item">Customer</li>
                                <li class="breadcrumb-item">Details</li>
                            </ol>
                        </nav>
        
                    </div>
                </div>
            </header>
        </div>
    </div>

    
    <div class="row layout-top-spacing">
        <div id="basic" class="col-lg-12 layout-spacing">
        </div>
        <div id="basic" class="col-lg-6 layout-spacing">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h4>Customer Details</h4>
                        </div>                 
                    </div>
                </div>
                <div class="widget-content widget-content-area" style="padding: 16px 15px">

                    <div class="row" >
                        <div class="col-lg-12 col-12 ">
                            <div class="form-group">
                                <label for="t-text">Customer Name</label>
                                <input id="t-text" type="text" name="name" placeholder="name..." class="form-control" value="{{$customer->name??''}}" readonly >
                            </div>
                        </div>   
                        <div class="col-lg-12 col-12 ">
                            <div class="form-group">
                                <label for="t-text">Customer Code</label>
                                <input id="t-text" type="text" name="customer_code" placeholder="customer code..." class="form-control" value="{{$customer->customer_code??''}}" readonly>
                            </div>
                        </div> 
                        <div class="col-lg-12 col-12 ">
                            <div class="form-group">
                                <label for="t-text">Contact No</label>
                                <input id="t-text" type="text" name="contact_no" placeholder="contact no..." class="form-control" value="{{$customer->contact_no??''}}" readonly>
                            </div>
                        </div>  
                        <div class="col-lg-12 col-12 ">
                            <div class="form-group">
                                <label for="t-text">Credit Limit</label>
                                <input id="t-text" type="text" name="credit_limit" placeholder="credit limit..." class="form-control" value="{{$customer->credit_limit??''}}" readonly>
                            </div>
                        </div>  
                        <div class="col-lg-12 col-12 ">
                            <div class="form-group">
                                <label for="t-text">Credit Amount</label>
                                <input id="t-text" type="text" name="credit_amount" placeholder="credit amount..." class="form-control" value="{{$customer->credit_amount??''}}" readonly>
                            </div>
                        </div>                                         
                    </div>

                </div>
            </div>
        </div>
        <div id="basic" class="col-lg-6 layout-spacing">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h4>Other Details 
                            </h4>
                        </div>                 
                    </div>
                </div>
                <div class="widget-content widget-content-area" style="padding: 16px 15px">

                    <div class="row" >
                        <div class="col-lg-12 col-12 ">
                            <div class="form-group">
                                <label for="t-text">Group</label>
                                <input id="t-text" type="text" name="credit_amount" placeholder="credit amount..." class="form-control" value="{{$customer->groupdetail->group_name??''}}" readonly>
                            </div>
                        </div> 
                        <div class="col-lg-12 col-12 ">
                            <div class="form-group">
                                <label for="t-text">Upline</label>
                                <input id="t-text" type="text" name="credit_amount" placeholder="credit amount..." class="form-control"  value="{{$customer->upline_id->name??''}} ({{$customer->upline_id->name??''}})" readonly>
                                </select>
                            </div>
                        </div>   
                        <div class="col-lg-12 col-12 ">
                            <div class="form-group">
                                <label for="t-text">Username</label>
                                <input id="t-text" type="text" name="username" placeholder="username..." class="form-control" value="{{$customer->username??''}}" readonly>
                            </div>
                        </div>   
                        <!-- <div class="col-lg-12 col-12 ">
                            <div class="form-group">
                                <label for="t-text">Password (<span class="small_note">key in if wish to reset</span>)</label>
                                <input id="t-text" type="text" name="password" placeholder="password..." class="form-control" value="" @if(!isset($customer)) required @endif>
                            </div>
                        </div>    -->
                        <div class="col-lg-12 col-12 ">
                            <div class="form-group">
                                <label for="t-text">Status</label>
                                <input id="t-text" type="text" name="username" placeholder="username..." class="form-control" value="{{$customer->is_active??''}}" readonly>
                            </div>
                        </div>                                      
                    </div>
                </div>
                    <a href="{{route('purchase_order.index')}}" class="mt-2  btn btn-warning float-right" style="margin-right:10px">Back</a>
            </div>
        </div> 
    </div>


</div>
@endsection
@section('scripts')
@endsection
