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
                                <li class="breadcrumb-item">Tinted Remove Settings</li>
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
                            <h4>Tinted Remove Settings</h4>
                        </div>                 
                    </div>
                </div>
                <div class="widget-content widget-content-area" style="padding: 16px 15px">
                    <form enctype="multipart/form-data" method="post" action="{{ route('removetint.store') }}">
                    @csrf
                    <div class="row">
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="t-group">FWS Remove Commission</label>
                                <input id="t-text" type="number" min="0" step="0.01" name="fws" placeholder="fws commission..." class="form-control" value="{{$tintremove->fws??''}}" required >
                            </div>
                        </div>  
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="t-group">RWS Remove Commission</label>
                                <input id="t-text" type="number" min="0" step="0.01" name="rws" placeholder="rws commission..." class="form-control" value="{{$tintremove->rws??''}}" required >
                            </div>
                        </div>  
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="t-group">SRF Remove Commission</label>
                                <input id="t-text" type="number" min="0" step="0.01" name="srf" placeholder="srf commission..." class="form-control" value="{{$tintremove->srf??''}}" required >
                            </div>
                        </div> 
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="t-group">L1 Remove Commission</label>
                                <input id="t-text" type="number" min="0" step="0.01" name="l1" placeholder="l1 commission..." class="form-control" value="{{$tintremove->l1??''}}" required >
                            </div>
                        </div> 
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="t-group">L2 Remove Commission</label>
                                <input id="t-text" type="number" min="0" step="0.01" name="l2" placeholder="l2 commission..." class="form-control" value="{{$tintremove->l2??''}}" required >
                            </div>
                        </div> 
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="t-group">L3 Remove Commission</label>
                                <input id="t-text" type="number" min="0" step="0.01" name="l3" placeholder="l3 commission..." class="form-control" value="{{$tintremove->l3??''}}" required >
                            </div>
                        </div> 
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="t-group">R1 Remove Commission</label>
                                <input id="t-text" type="number" min="0" step="0.01" name="r1" placeholder="r1 commission..." class="form-control" value="{{$tintremove->r1??''}}" required >
                            </div>
                        </div> 
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="t-group">R2 Remove Commission</label>
                                <input id="t-text" type="number" min="0" step="0.01" name="r2" placeholder="r2 commission..." class="form-control" value="{{$tintremove->r2??''}}" required >
                            </div>
                        </div> 
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="t-group">R3 Remove Commission</label>
                                <input id="t-text" type="number" min="0" step="0.01" name="r3" placeholder="r3 commission..." class="form-control" value="{{$tintremove->r3??''}}" required >
                            </div>
                        </div> 
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="t-group">SRF2 Remove Commission</label>
                                <input id="t-text" type="number" min="0" step="0.01" name="srf2" placeholder="srf2 commission..." class="form-control" value="{{$tintremove->srf2??''}}" required >
                            </div>
                        </div> 
                        <div class="col-lg-12 col-12 ">
                            <button type="submit" class="mt-4 btn btn-primary float-right">Submit</button>
                            <a href="{{route('removetint.index')}}" class="mt-4  btn btn-warning float-right" style="margin-right:10px">Back</a>
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
