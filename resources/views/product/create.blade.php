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
                                <li class="breadcrumb-item">Settings</li>
                                <li class="breadcrumb-item"><a href="{{route('product.index')}}">Product</a></li>
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
                            <h4>Product</h4>
                        </div>                 
                    </div>
                </div>
                <div class="widget-content widget-content-area" style="padding: 16px 15px">
                    <form enctype="multipart/form-data" @if (isset($product)) method="post" action="{{ route('product.update',$product) }}" @else method="post" action="{{ route('product.store') }}" @endif>
                    @csrf
                    <div class="row">
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="t-group">Product Name</label>
                                <input id="t-text" type="text" name="product_name" placeholder="product name..." class="form-control" value="{{$product->product_name??''}}" required >
                            </div>
                        </div>   
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="t-group">FWS Commission</label>
                                <input id="t-text" type="number" min="0" step="0.01" name="fws" placeholder="fws commission..." class="form-control" value="{{$product->fws??''}}" required >
                            </div>
                        </div>  
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="t-group">RWS Commission</label>
                                <input id="t-text" type="number" min="0" step="0.01" name="rws" placeholder="rws commission..." class="form-control" value="{{$product->rws??''}}" required >
                            </div>
                        </div>  
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="t-group">SRF Commission</label>
                                <input id="t-text" type="number" min="0" step="0.01" name="srf" placeholder="srf commission..." class="form-control" value="{{$product->srf??''}}" required >
                            </div>
                        </div> 
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="t-group">L1 Commission</label>
                                <input id="t-text" type="number" min="0" step="0.01" name="l1" placeholder="l1 commission..." class="form-control" value="{{$product->l1??''}}" required >
                            </div>
                        </div> 
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="t-group">L2 Commission</label>
                                <input id="t-text" type="number" min="0" step="0.01" name="l2" placeholder="l2 commission..." class="form-control" value="{{$product->l2??''}}" required >
                            </div>
                        </div> 
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="t-group">L3 Commission</label>
                                <input id="t-text" type="number" min="0" step="0.01" name="l3" placeholder="l3 commission..." class="form-control" value="{{$product->l3??''}}" required >
                            </div>
                        </div> 
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="t-group">R1 Commission</label>
                                <input id="t-text" type="number" min="0" step="0.01" name="r1" placeholder="r1 commission..." class="form-control" value="{{$product->r1??''}}" required >
                            </div>
                        </div> 
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="t-group">R2 Commission</label>
                                <input id="t-text" type="number" min="0" step="0.01" name="r2" placeholder="r2 commission..." class="form-control" value="{{$product->r2??''}}" required >
                            </div>
                        </div> 
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="t-group">R3 Commission</label>
                                <input id="t-text" type="number" min="0" step="0.01" name="r3" placeholder="r3 commission..." class="form-control" value="{{$product->r3??''}}" required >
                            </div>
                        </div> 
                        @if(isset($product))
                        <div class="col-lg-12 col-12 ">
                            <div class="form-group">
                                <label for="t-text">Is Active?</label>
                                <select class="form-select" aria-label="Default select example" name="is_active">
                                    <option value="1" <?php echo isset($product)&&$product->is_active == 1?'selected':'' ?>>Active</option>
                                    <option value="0" <?php echo isset($product)&&$product->is_active == 0?'selected':'' ?>>Inactive</option>
                                </select>
                            </div>
                        </div>  
                        @endif
                        <div class="col-lg-12 col-12 ">
                            <button type="submit" class="mt-4 btn btn-primary float-right">Submit</button>
                            <a href="{{route('product.index')}}" class="mt-4  btn btn-warning float-right" style="margin-right:10px">Back</a>
                            
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
@endsection
