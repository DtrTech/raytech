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
                                <li class="breadcrumb-item"><a href="{{route('purchase_order.index')}}">Purchase Order</a></li>
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
                            <h4>Purchase Order</h4>
                        </div>                 
                    </div>
                </div>
                <div class="widget-content widget-content-area" style="padding: 16px 15px">

                    <div class="row" >
                        <form enctype="multipart/form-data" @if (isset($purchase_order)) method="post" action="{{ route('purchase_order.update',$purchase_order) }}" @else method="post" action="{{ route('purchase_order.store') }}" @endif>
                        @csrf
                            <div class="col-lg-12 col-12 ">
                                <div class="form-group">
                                    <label for="t-text">Customer</label>
                                    <select id="user_id" name="user_id" placeholder="Select a customer..." autocomplete="off" required>
                                        <option value="">Select a customer...</option>
                                        @foreach($customer as $c)
                                        <option value="{{$c->id}}" <?php echo isset($purchase_order)&&$purchase_order->user_id == $c->id?'selected':'' ?>>{{$c->username??''}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>  
                            <div class="col-lg-12 col-12 ">
                                <div class="form-group">
                                    <label for="t-text">Currency In</label>
                                    <select id="currency_from_id" name="currency_from_id" placeholder="Select a currency..." autocomplete="off" onchange="checkCurrency()" required>
                                        <option value="">Select a currency...</option>
                                        @foreach($currency as $curr)
                                        <option value="{{$curr->id}}" <?php echo isset($purchase_order)&&$purchase_order->currency_from_id == $curr->id?'selected':'' ?>>{{$curr->short_name??''}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-12 col-12 ">
                                <div class="form-group">
                                    <label for="t-text">Currency Out</label>
                                    <select id="currency_to_id" name="currency_to_id" placeholder="Select a currency..." autocomplete="off"  onchange="checkCurrency()" required>
                                        <option value="">Select a currency...</option>
                                        @foreach($currency as $curr2)
                                        <option value="{{$curr2->id}}" <?php echo isset($purchase_order)&&$purchase_order->currency_to_id == $curr2->id?'selected':'' ?>>{{$curr2->short_name??''}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-12 col-12 ">
                                <div class="form-group">
                                    <label for="t-text">Exchange Rate</label>
                                    <input type="number" step="0.0001" min="0" id="currency_rate" name="currency_rate" placeholder="rate..." class="form-control" value="{{$purchase_order->currency_rate??''}}" onkeyup="countMoney()" required>
                                </div>
                            </div>  
                            <div class="col-lg-12 col-12 ">
                                <div class="form-group">
                                    <label for="t-text">Receivable Amount</label>
                                    <input type="number" step="0.0001" min="0" name="received_amount" id="received_amount" placeholder="amount..." class="form-control" value="{{$purchase_order->received_amount??''}}" onkeyup="countMoney()" required>
                                </div>
                            </div>  
                            <div class="col-lg-12 col-12 ">
                                <div class="form-group">
                                    <label for="t-text">Payable Amount</label>
                                    <input type="number" step="0.0001" min="0" name="payable_amount" id="payable_amount" placeholder="amount..." class="form-control" value="{{$purchase_order->payable_amount??''}}" required>
                                </div>
                            </div>  
                            <div class="col-lg-12 col-12 ">
                                <div class="form-group">
                                    <label for="t-text">Processing Fee</label>
                                    <input type="number" step="0.0001" min="0" name="processing_fees" placeholder="amount..." class="form-control" value="{{$purchase_order->processing_fees??''}}" >
                                </div>
                            </div>  
                            <div class="col-lg-12 col-12 ">
                                    <button type="submit" class="mt-4 btn btn-primary float-right">Submit</button>
                                    <a href="{{route('purchase_order.index')}}" class="mt-4  btn btn-warning float-right" style="margin-right:10px">Back</a>
                                
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
    new TomSelect("#user_id",{
    create: true,
        sortField: {
            field: "text",
            direction: "asc"
        }
    });
    new TomSelect("#currency_from_id",{
    create: true,
        sortField: {
            field: "text",
            direction: "asc"
        }
    });
    new TomSelect("#currency_to_id",{
    create: true,
        sortField: {
            field: "text",
            direction: "asc"
        }
    });

    function checkCurrency(){
        var currency_from_id = document.getElementById('currency_from_id').value;
        var currency_to_id = document.getElementById('currency_to_id').value;
        if (currency_from_id && currency_to_id) {
            $.ajax({
                url: '{{ route("purchase_order.getCurrencyRate") }}',
                type: 'GET',
                data: { currency_from_id: currency_from_id,currency_to_id:currency_to_id }, // Example data to send
                success: function(response) {
                    console.log(response.new_rate);
                    document.getElementById('currency_rate').value = response.new_rate;
                    countMoney();

                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    // Handle errors
                }
            });
        }
    }

    function countMoney(){
        var currency_rate = document.getElementById('currency_rate').value;
        var received_amount = document.getElementById('received_amount').value;
        var payable_amount = document.getElementById('payable_amount').value;
        if (currency_rate !== null && currency_rate !== "" && received_amount !== null && received_amount !== "" ) {
            document.getElementById('payable_amount').value = received_amount*currency_rate;
        }
    }
</script>
@endsection
