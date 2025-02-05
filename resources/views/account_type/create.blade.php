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
                                <li class="breadcrumb-item">Account Type</li>
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
                            <h4>Account Type Details</h4>
                        </div>                 
                    </div>
                </div>
                <div class="widget-content widget-content-area" style="padding: 16px 15px">

                    <div class="row" >
                        <form enctype="multipart/form-data" @if (isset($account_type)) method="post" action="{{ route('account_type.update',$account_type) }}" @else method="post" action="{{ route('account_type.store') }}" @endif>
                        @csrf
                        <div class="col-lg-12 col-12 ">
                            <div class="form-group">
                                <label for="t-text">Account Type Name</label>
                                <input id="t-text" type="text" name="account_type_name" placeholder="name" class="form-control" value="{{$account_type->account_type_name??''}}" required>
                            </div>
                        </div>
                        <div class="col-lg-12 col-12 ">
                            <div class="form-group">
                                <label for="t-text">Status</label>
                                <select class="form-select" aria-label="Default select example" name="is_active">
                                    <option value="1" <?php echo isset($account_type)&&$account_type->is_active == 1?'selected':'' ?>>Active</option>
                                    <option value="0" <?php echo isset($account_type)&&$account_type->is_active == 0?'selected':'' ?>>Inactive</option>
                                </select>
                            </div>
                        </div> 
                        <button type="submit" class="mt-2  btn btn-primary float-right" style="margin-right:10px">Save</button>
                        <a href="{{route('account_type.index')}}" class="mt-2  btn btn-warning float-right" style="margin-right:10px">Back</a>
                        </form> 
                    </div>
                </div> 
            </div>
        </div>
    </div>


</div>
@endsection
@section('scripts')
@endsection
