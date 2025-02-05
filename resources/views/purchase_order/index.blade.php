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
                                <li class="breadcrumb-item">Purchase Order</li>
                            </ol>
                        </nav>
        
                    </div>
                </div>
            </header>
        </div>
    </div>

    
    <div class="row layout-spacing layout-top-spacing">
        <div class="col-lg-12">
            <div class="statbox widget box box-shadow">
                <div class="widget-content widget-content-area">
                    <button data-bs-toggle="modal" data-bs-target="#exampleModalCenter" class="btn btn-outline-primary mb-2 me-4 _effect--ripple waves-effect waves-light" style="margin:10px 10px;">Create</button>
                    <button data-bs-toggle="modal" data-bs-target="#exportdata" class="btn btn-outline-success mb-2 me-4 _effect--ripple waves-effect waves-light" style="margin:10px 10px;">Export</button>
                    <table id="style-3" class="table style-3 dt-table-hover non-hover">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Customer</th>
                                <th>Actions</th>
                                <th>Status</th>
                                <th>Reference</th>
                                <th>In</th>
                                <th>Out</th>
                                <th>Receivable Amount</th>
                                <th>Rate</th>
                                <th>Payable Amount</th>
                                <th>Processing Fee</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($purchase_order as $num => $row)
                            <tr>
                                <td > {{$row->created_at->format('j M y g:ia')}} </td>
                                <td style="color:white;">{{$row->user->name??''}}</td>
                                <td>
                                    <ul class="table-controls">
                                        <li>
                                            <a href="{{route('purchase_order.edit',$row)}}" class="bs-tooltip" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit" data-original-title="Edit"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 p-1 br-8 mb-1"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg></a>
                                        </li>
                                    </ul>
                                </td>
                                <td >@if(isset($row->status)&&$row->status=="Completed")<span class="shadow-none badge badge-success">Completed</span>@elseif(isset($row->status)&&$row->status=="Pending") <span class="shadow-none badge badge-warning">Pending</span> @elseif(isset($row->status)&&$row->status=="Partially Completed") <span class="shadow-none badge badge-primary">Partially Completed</span> @elseif(isset($row->status)&&$row->status=="Closed") <span class="shadow-none badge badge-danger">Closed</span> @else <span class="shadow-none badge badge-danger">Cancelled</span> @endif</td>
                                <td>{{$row->po_no??''}}</td>
                                <td style="color:white;">
                                    {{$row->currency_from->short_name??''}}
                                </td>
                                <td style="color:white;">
                                    {{$row->currency_to->short_name??''}}
                                </td>
                                <td>
                                    @if($row->currency_from)
                                        <img class="flag" src="{{asset('image/currency').'/'.$row->currency_from->short_name.'.png'}}">
                                    @endif{{ number_format($row->received_amount, 0, '.', ',') ?? '' }}</td>
                                <td>{{$row->currency_rate??''}}</td>
                                <td>
                                    @if($row->currency_to)
                                        <img class="flag" src="{{asset('image/currency').'/'.$row->currency_to->short_name.'.png'}}">
                                    @endif{{ number_format($row->payable_amount, 0, '.', ',') ?? '' }}</td>
                                <td>
                                    @if($row->currency_from)
                                        <img class="flag" src="{{asset('image/currency').'/'.$row->currency_from->short_name.'.png'}}">
                                    @endif{{$row->processing_fees??''}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exportdata" tabindex="-1" role="dialog" aria-labelledby="exportModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exportModalCenterTitle">Export Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background: none; box-shadow: none; padding: 0; margin: 0; display: grid; opacity: 1;">
                        <svg style="width: 17px; height: 17px; color: #fff;" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                    </button>
                </div>
                <div class="modal-body">
                </div>
            </div>
        </div>
    </div>  

    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Purchase Order</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background: none; box-shadow: none; padding: 0; margin: 0; display: grid; opacity: 1;">
                        <svg style="width: 17px; height: 17px; color: #fff;" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                    </button>
                </div>
                <div class="modal-body">
                    <form enctype="multipart/form-data" method="post" action="{{ route('purchase_order.store') }}">
                        @csrf
                        <div class="col-lg-12 col-12 ">
                            <div class="form-group">
                                <label for="t-text">Transaction Type</label>
                                <select id="type" name="type" placeholder="Select a type..." autocomplete="off" required onchange="toggleFields(this.value)">
                                    <option value="">Select type</option>
                                    <option value="po">PO</option>
                                    <option value="fr">FR</option>
                                    <option value="fp">FP</option>
                                    <option value="e">E</option>
                                    <option value="r">R</option>
                                </select>
                            </div>
                        </div>

                        <!-- Customer field -->
                        <div class="col-lg-12 col-12" id="customer_section">
                            <div class="form-group">
                                <label for="t-text">Customer</label>
                                <select id="user_id" name="user_id" placeholder="Select a customer..." autocomplete="off" required>
                                    <option value="">Select a customer...</option>
                                    @foreach($customer as $c)
                                        @if($c->is_active == 1)
                                            <option value="{{ $c->id }}">{{ $c->name ?? '' }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>  

                        <!-- Currency In field -->
                        <div class="col-lg-12 col-12" id="currency_in_section" style="display:none;">
                            <div class="form-group">
                                <label for="t-text">Currency In</label>
                                <select id="currency_from_id" name="currency_from_id" placeholder="Select a currency..." autocomplete="off" required onchange="checkCurrency()">
                                    <option value="">Select a currency...</option>
                                    @foreach($currency as $curr)
                                    <option value="{{$curr->id}}">{{$curr->short_name ?? ''}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Currency Out field -->
                        <div class="col-lg-12 col-12" id="currency_out_section" style="display:none;">
                            <div class="form-group">
                                <label for="t-text">Currency Out</label>
                                <select id="currency_to_id" name="currency_to_id" placeholder="Select a currency..." autocomplete="off" onchange="checkCurrency()" required>
                                    <option value="">Select a currency...</option>
                                    @foreach($currency as $curr2)
                                    <option value="{{$curr2->id}}">{{$curr2->short_name ?? ''}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Exchange Rate field -->
                        <div class="col-lg-12 col-12" id="exchange_rate_section" style="display:none;">
                            <div class="form-group">
                                <label for="t-text">Exchange Rate</label>
                                <input type="number" step="0.0001" min="0" id="currency_rate" name="currency_rate" placeholder="rate..." class="form-control" value="" onkeyup="countMoney()" required>
                            </div>
                        </div>  

                        <!-- Receivable Amount field -->
                        <div class="col-lg-12 col-12" id="receivable_amount_section" style="display:none;">
                            <div class="form-group">
                                <label for="t-text">Receivable Amount</label>
                                <input type="number" step="0.0001" min="0" name="received_amount" id="received_amount" placeholder="amount..." class="form-control" value="" onkeyup="countMoney()" required>
                            </div>
                        </div>  

                        <!-- Payable Amount field -->
                        <div class="col-lg-12 col-12" id="payable_amount_section" style="display:none;">
                            <div class="form-group">
                                <label for="t-text">Payable Amount</label>
                                <input type="number" step="0.0001" min="0" name="payable_amount" id="payable_amount" placeholder="amount..." class="form-control" value="" onkeyup="countMoney()" required>
                            </div>
                        </div>  

                        <!-- Processing Fee field -->
                        <div class="col-lg-12 col-12" id="processing_fee_section" style="display:none;">
                            <div class="form-group">
                                <label for="t-text">Processing Fee</label>
                                <input type="number" step="0.0001" min="0" name="processing_fees" placeholder="amount..." class="form-control" value="">
                            </div>
                        </div>  

                        <div class="col-lg-12 col-12 ">
                            <button type="submit" class="mt-4 btn btn-primary float-right">Submit</button>
                            <a  data-bs-dismiss="modal" aria-label="Close" class="mt-4 btn btn-danger float-right" style="margin-right:10px">Close</a>
                        </div>  
                    </form>
                </div>
            </div>
        </div>
    </div>  

<script>
    function toggleFields(value) {
        if (value === 'po') {
            // Show all fields for PO
            document.getElementById('customer_section').style.display = 'block';
            document.getElementById('currency_in_section').style.display = 'block';
            document.getElementById('currency_out_section').style.display = 'block';
            document.getElementById('exchange_rate_section').style.display = 'block';
            document.getElementById('receivable_amount_section').style.display = 'block';
            document.getElementById('payable_amount_section').style.display = 'block';
            document.getElementById('processing_fee_section').style.display = 'block';
            
            // Enable all fields for PO
            document.getElementById('currency_to_id').disabled = false;
            document.getElementById('currency_rate').disabled = false;
            document.getElementById('payable_amount').disabled = false;
            document.getElementById('received_amount').disabled = false;
        } else if (value === 'r' || value === 'fr') {
            // Show fields for R or FR
            document.getElementById('customer_section').style.display = 'block';
            document.getElementById('currency_in_section').style.display = 'block';
            document.getElementById('currency_out_section').style.display = 'none';
            document.getElementById('exchange_rate_section').style.display = 'none';
            document.getElementById('receivable_amount_section').style.display = 'block';
            document.getElementById('payable_amount_section').style.display = 'none';
            document.getElementById('processing_fee_section').style.display = 'block';
            
            // Disable fields for FR
            document.getElementById('currency_to_id').disabled = true;
            document.getElementById('currency_rate').disabled = true;
            document.getElementById('payable_amount').disabled = true;
            document.getElementById('currency_from_id').disabled = false;
            document.getElementById('received_amount').disabled = false;
        } else if (value === 'e' || value === 'fp') {
            // Show fields for E or FP
            document.getElementById('customer_section').style.display = 'block';
            document.getElementById('currency_in_section').style.display = 'none';
            document.getElementById('currency_out_section').style.display = 'block';
            document.getElementById('exchange_rate_section').style.display = 'none';
            document.getElementById('receivable_amount_section').style.display = 'none';
            document.getElementById('payable_amount_section').style.display = 'block';
            document.getElementById('processing_fee_section').style.display = 'none';
            
            // Disable fields for FP
            document.getElementById('currency_from_id').disabled = true;
            document.getElementById('currency_rate').disabled = true;
            document.getElementById('received_amount').disabled = true;
            document.getElementById('currency_to_id').disabled = false;
            document.getElementById('payable_amount').disabled = false;
        } else {
            // Hide all sections if none of the above conditions match
            document.getElementById('customer_section').style.display = 'none';
            document.getElementById('currency_in_section').style.display = 'none';
            document.getElementById('currency_out_section').style.display = 'none';
            document.getElementById('exchange_rate_section').style.display = 'none';
            document.getElementById('receivable_amount_section').style.display = 'none';
            document.getElementById('payable_amount_section').style.display = 'none';
            document.getElementById('processing_fee_section').style.display = 'none';
            
            // Disable all fields
            document.getElementById('currency_to_id').disabled = true;
            document.getElementById('currency_from_id').disabled = true;
            document.getElementById('currency_rate').disabled = true;
            document.getElementById('received_amount').disabled = true;
            document.getElementById('payable_amount').disabled = true;
        }
    }
</script>
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
    new TomSelect("#type",{
    create: true,
    sortField: false // Disable sorting
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

    function countMoney() {
    var currency_rate = parseFloat(document.getElementById('currency_rate').value);
    var received_amount = parseFloat(document.getElementById('received_amount').value);
    var payable_amount = parseFloat(document.getElementById('payable_amount').value);
    
    var changedInputId = event.target.id;

    if (changedInputId === 'currency_rate' || changedInputId === 'received_amount') {
        if (!isNaN(currency_rate) && !isNaN(received_amount)) {
            payable_amount = received_amount * currency_rate;
            document.getElementById('payable_amount').value = payable_amount.toFixed(2);
        }
    }

    if (changedInputId === 'currency_rate' || changedInputId === 'payable_amount') {
        if (!isNaN(currency_rate) && !isNaN(payable_amount)) {
            received_amount = payable_amount / currency_rate;
            document.getElementById('received_amount').value = received_amount.toFixed(2);
        }
    }
}
</script>
<script>
    c3 = $('#style-3').DataTable({
            "dom": "<'dt--top-section'<'row'<'col-12 col-sm-6 d-flex justify-content-sm-start justify-content-center'l><'col-12 col-sm-6 d-flex justify-content-sm-end justify-content-center mt-sm-0 mt-3'f>>>" +
        "<'table-responsive'tr>" +
        "<'dt--bottom-section d-sm-flex justify-content-sm-between text-center'<'dt--pages-count  mb-sm-0 mb-3'i><'dt--pagination'p>>",
            "oLanguage": {
                "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
                "sInfo": "Showing page _PAGE_ of _PAGES_",
                "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                "sSearchPlaceholder": "Search...",
               "sLengthMenu": "Results :  _MENU_",
            },
            "stripeClasses": [],
            "lengthMenu": [5, 10, 20, 50],
            "pageLength": 10,
            "order": [[0, "desc"]]
        });

        multiCheck(c3);
</script>
@endsection
