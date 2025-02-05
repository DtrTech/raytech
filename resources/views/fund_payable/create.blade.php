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
                                <li class="breadcrumb-item">Fund Payable</li>
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
                            <h4>Fund Payable Details</h4>
                        </div>                 
                    </div>
                </div>
                <div class="widget-content widget-content-area" style="padding: 16px 15px">

                    <div class="row" >
                        <form enctype="multipart/form-data" @if (isset($fund_payable)) method="post" action="{{ route('fund_payable.update',$fund_payable) }}" @else method="post" action="{{ route('fund_payable.store') }}" @endif>
                        @csrf
                        <div class="col-lg-12 col-12">
                            <div class="form-group">
                                <label for="t-text">PO</label>
                                <select class="form-select" aria-label="Default select example" name="purchase_order_id" id="purchase_order_id">
                                    <option value="">-- Select --</option>
                                    @foreach($purchase_order as $g)
                                        <option value="{{ $g->id }}" {{ isset($fund_payable) && $fund_payable->purchase_order_id == $g->id ? 'selected' : '' }}>{{ $g->po_no ?? "" }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-12 col-12">
                            <div class="form-group">
                                <label for="t-text">Customer</label>
                                <select class="form-select" aria-label="Default select example" name="user_id" id="user_id">
                                    <option value="">-- Select --</option>
                                    @foreach($purchase_order as $g)
                                        <option value="{{ $g->user_id }}" data-po-id="{{ $g->id }}" style="display: none" {{ isset($fund_payable) && $fund_payable->user_id == $g->user_id ? 'selected' : '' }}>{{ $g->user->name ?? "" }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-12 col-12 ">
                            <div class="form-group">
                                <label for="t-text">Amount</label>
                                <input id="t-text" type="text" name="amount" placeholder="amount" class="form-control" value="{{$fund_payable->amount??''}}" required>
                            </div>
                        </div>
                        <div class="col-lg-12 col-12 ">
                            <div class="form-group">
                                <label for="t-text">Remark</label>
                                <input id="t-text" type="text" name="remark" placeholder="remark" class="form-control" value="{{$fund_payable->remark??''}}" required>
                            </div>
                        </div> 
                        <div class="col-lg-12 col-12">
                            <div class="form-group">
                                <label for="t-text">Currency</label>
                                <select class="form-select" aria-label="Default select example" name="currency" id="currency">
                                    <option value="">-- Select --</option>
                                    @foreach($purchase_order as $g)
                                        <option value="{{ $g->currency_to_id }}" data-po-id="{{ $g->id }}" style="display: none" {{ isset($fund_payable) && $fund_payable->currency_to_id == $g->currency_to_id ? 'selected' : '' }}>{{ $g->currency_to->short_name ?? "" }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="mt-2  btn btn-primary float-right" style="margin-right:10px">Save</button>
                        <a href="{{route('fund_payable.index')}}" class="mt-2  btn btn-warning float-right" style="margin-right:10px">Back</a>
                        </form> 
                    </div>
                </div> 
            </div>
        </div>
    </div>


</div>
@endsection
@section('scripts')
<script>
    // Function to filter users and currencies based on selected purchase order
    document.getElementById('purchase_order_id').addEventListener('change', function() {
        var selectedPoId = this.value;
        var usersDropdown = document.getElementById('user_id');
        var currencyDropdown = document.getElementById('currency');
        
        // Hide all user options
        for (var i = 0; i < usersDropdown.options.length; i++) {
            usersDropdown.options[i].style.display = 'none';
        }
        
        // Hide all currency options
        for (var i = 0; i < currencyDropdown.options.length; i++) {
            currencyDropdown.options[i].style.display = 'none';
        }
        
        // Show options corresponding to the selected purchase order for users
        for (var i = 0; i < usersDropdown.options.length; i++) {
            var option = usersDropdown.options[i];
            if (option.getAttribute('data-po-id') === selectedPoId || option.value === '') {
                option.style.display = '';
            }
        }
        
        // Show options corresponding to the selected purchase order for currencies
        for (var i = 0; i < currencyDropdown.options.length; i++) {
            var option = currencyDropdown.options[i];
            if (option.getAttribute('data-po-id') === selectedPoId || option.value === '') {
                option.style.display = '';
            }
        }
    });
</script>
@endsection
