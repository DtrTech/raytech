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
                        <form enctype="multipart/form-data" @if (isset($customer)) method="post" action="{{ route('customer.update',$customer) }}" @else method="post" action="{{ route('customer.store') }}" @endif>
                        @csrf
                        <div class="col-lg-12 col-12 ">
                            <div class="form-group">
                                <label for="t-text">Customer Name</label>
                                <input id="t-text" type="text" name="name" placeholder="name..." class="form-control" value="{{$customer->name??''}}" required >
                            </div>
                        </div>   
                        <div class="col-lg-12 col-12 ">
                            <div class="form-group">
                                <label for="t-text">Customer Code</label>
                                <input id="t-text" type="text" name="customer_code" placeholder="customer code..." class="form-control" value="{{$customer->customer_code??''}}" required>
                            </div>
                        </div> 
                        <div class="col-lg-12 col-12 ">
                            <div class="form-group">
                                <label for="t-text">Contact No</label>
                                <input id="t-text" type="text" name="contact_no" placeholder="contact no..." class="form-control" value="{{$customer->contact_no??''}}" required>
                            </div>
                        </div>  
                        <div class="col-lg-12 col-12 ">
                            <div class="form-group">
                                <label for="t-text">Credit Limit</label>
                                <input id="t-text" type="text" name="credit_limit" placeholder="credit limit..." class="form-control" value="{{$customer->credit_limit??''}}" >
                            </div>
                        </div>  
                        <!-- <div class="col-lg-12 col-12 ">
                            <div class="form-group">
                                <label for="t-text">Credit Amount</label>
                                <input id="t-text" type="text" name="credit_amount" placeholder="credit amount..." class="form-control" value="{{$customer->credit_amount??''}}" >
                            </div>
                        </div>-->
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
                                <select class="form-select" aria-label="Default select example" name="group_id">
                                    <option value="" >-- Select --</option>
                                    @foreach($group as $g)
                                    <option value="{{$g->id}}" <?php echo isset($customer)&&$customer->group_id == $g->id?'selected':'' ?>>{{$g->group_name??""}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div> 
                        <div class="col-lg-12 col-12 ">
                            <div class="form-group">
                                <label for="t-text">Upline</label>
                                <select class="form-select" aria-label="Default select example" name="upline">
                                    <option value="" >-- Select --</option>
                                    @foreach($upline as $up)
                                    <option value="{{$up->id}}" <?php echo isset($customer)&&$customer->upline == $up->id?'selected':'' ?>>{{$up->username??""}} ({{$up->name??""}})</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>   
                        <div class="col-lg-12 col-12 ">
                            <div class="form-group">
                                <label for="t-text">Username</label>
                                <input id="t-text" type="text" name="username" placeholder="username..." class="form-control" value="{{$customer->username??''}}">
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
                                <select class="form-select" aria-label="Default select example" name="is_active">
                                    <option value="1" <?php echo isset($customer)&&$customer->is_active == 1?'selected':'' ?>>Active</option>
                                    <option value="0" <?php echo isset($customer)&&$customer->is_active == 0?'selected':'' ?>>Inactive</option>
                                </select>
                            </div>
                        </div>                                      
                    </div>
                </div>  
                    <button type="submit" class="mt-2  btn btn-primary float-right" style="margin-right:10px">Save</button>
                    <a href="{{route('customer.index')}}" class="mt-2  btn btn-warning float-right" style="margin-right:10px">Back</a>
                </form> 
            </div>
        </div> 
    </div>


</div>
@endsection
@section('scripts')
@endsection
