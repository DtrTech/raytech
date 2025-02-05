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
                                <li class="breadcrumb-item"><a href="{{route('purchase_order.index')}}">Fulfill Transactions</a></li>
                                <li class="breadcrumb-item">Create</li>
                            </ol>
                        </nav>
        
                    </div>
                </div>
            </header>
        </div>
    </div>

    
    <div class="row layout-top-spacing">
        <div id="basic" class="col-lg-6 layout-spacing">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h4>Fulfill Transactions</h4>
                        </div>                 
                    </div>
                </div>
                <div class="widget-content widget-content-area" style="padding: 16px 15px">

                    <div class="row" >
                        <form enctype="multipart/form-data"method="post" action="{{ route('purchase_order.edit.fulfill_transaction_store', ['purchase_order' => $purchase_order->id]) }}">
                            @csrf
                            <div class="col-lg-12 col-12 ">
                                <div class="form-group">
                                    <label for="transaction_type">Transaction Type</label>
                                    <select name="transaction_type" id="transaction_type" class="form-control">
                                    <option value="">Select a transaction type...</option>
                                        <option value="contra">Contra</option>
                                        <option value="account">Account</option>
                                    </select>
                                </div>
                            </div>  
                            <div class="col-lg-12 col-12 ">
                                <div class="form-group">
                                    <label for="for">For</label>
                                    <select name="for" id="for" class="form-control">
                                        <option value="">Select a value...</option>
                                        <option value="receivable">Receivable</option>
                                        <option value="payable">Payable</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-lg-12 col-12 ">
                                <div class="form-group">
                                    <label for="debit_credit">Debit or Credit</label>
                                    <select id="debit_credit" name="debit_credit" class="form-control">
                                        <option value="1">Debit</option>
                                        <option value="-1">Credit</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-12 col-12 ">
                                <div class="form-group">
                                    <label for="currency">Currency</label>
                                    <select id="currency_id" name="currency_id" class="form-control">
                                        <option value="{{$purchase_order->currency_from_id??''}}">{{$purchase_order->currency_from->short_name??''}}</option>
                                        <option value="{{$purchase_order->currency_to_id??''}}">{{$purchase_order->currency_to->short_name??''}}</option>
                                    </select>
                                </div>
                            </div>
                            <div id="contra_fields" style="display: none;">
                            </div>

                            <div id="account_fields" style="display: none;">
                                <div class="col-lg-12 col-12 ">
                                    <div class="form-group">
                                        <label for="account_id">Account</label>
                                        <select id="account_id" name="account_id" placeholder="Select an account..." class="form-control">
                                            <option value="">Select an account...</option>
                                            @foreach($account_type as $row)
                                            <option value="{{$row->id}}">{{$row->account_type->account_type_name??''}} ({{$row->account_name??''}})</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-12">
                                <div class="form-group">
                                    <label for="amount">Amount</label>
                                    <input type="text" id="currency_amount" name="currency_amount" class="form-control" placeholder="amount">
                                </div>
                            </div>
                            <div class="col-lg-12 col-12 ">
                                <button type="submit" class="mt-4 btn btn-primary float-right">Submit</button>
                                <a href="{{route('purchase_order.edit',$purchase_order)}}" class="mt-4  btn btn-warning float-right" style="margin-right:10px">Back</a>
                            </div>  
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
    $(document).ready(function() {
    $('#transaction_type, #for').change(function() {
        var selectedTransactionType = $('#transaction_type').val();
        var selectedFor = $('#for').val();

        if (selectedTransactionType == 'contra') {
            $('#contra_fields').show();
            $('#account_fields').hide();
        } else if (selectedTransactionType == 'account') {
            $('#contra_fields').hide();
            $('#account_fields').show();
        } else {
            $('#contra_fields').hide();
            $('#account_fields').hide();
        }

        if (selectedFor == 'receivable') {
            $('#debit_credit').val('1');
            $('#currency_id').val('{{$purchase_order->currency_from_id??''}}');
            $('#currency_id option[value="{{$purchase_order->currency_to_id??''}}"]').hide();
            $('#currency_id option[value="{{$purchase_order->currency_from_id??''}}"]').show();
            $('#debit_credit option[value="-1"]').hide();
            $('#debit_credit option[value="1"]').show();
        } else if (selectedFor == 'payable') {
            $('#debit_credit').val('-1');
            $('#currency_id').val('{{$purchase_order->currency_to_id??''}}');
            $('#currency_id option[value="{{$purchase_order->currency_from_id??''}}"]').hide();
            $('#currency_id option[value="{{$purchase_order->currency_to_id??''}}"]').show();
            $('#debit_credit option[value="1"]').hide();
            $('#debit_credit option[value="-1"]').show();
        }
    });
});
</script>
@endsection
