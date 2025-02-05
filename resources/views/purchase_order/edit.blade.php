@extends('layouts.app')
<style>
    .table-wrapper {
      overflow-x: hidden; /* Hide horizontal scrollbar */
      overflow-y: hidden; /* Hide vertical scrollbar */
  }
</style>
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
    <div id="basic" class="col-lg-12 layout-spacing">
      <div class="statbox widget box box-shadow">
        <div class="widget-header">
            <div class="row">
                <div>
                    @if(isset($purchase_order->status) && $purchase_order->status == "Completed")
                        <span class="badge badge-success mb-2 me-4" style="margin:10px 10px; font-size:18px;">Complete</span>
                    @elseif(isset($purchase_order->status) && $purchase_order->status == "Closed")
                        <span class="badge badge-danger mb-2 me-4" style="margin:10px 10px; font-size:18px;">Closed</span>
                    @elseif(isset($purchase_order->status) && $purchase_order->status == "Pending")
                        <span class="badge badge-warning mb-2 me-4" style="margin:10px 10px; font-size:18px;">Pending</span>
                    @elseif(isset($purchase_order->status) && $purchase_order->status == "Partially Completed")
                        <span class="badge badge-primary mb-2 me-4" style="margin:10px 10px; font-size:18px;">Partially Completed</span>
                    @else
                        <span class="badge badge-danger mb-2 me-4" style="margin:10px 10px; font-size:18px;">Canceled</span>
                    @endif
                    <span style="font-size:20px; color:white; font-weight:900;">{{$purchase_order->po_no ?? ''}}</span>
                </div>
                <div class="col-lg-12 col-12">
                    <button onclick="copyText()" class="mt-2 me-4 btn btn-secondary _effect--ripple waves-effect waves-light float-right">Copy</button>
                    
                    <!-- Dropdown for Action button -->
                    <div class="dropdown float-right">
                        <button class="btn btn-primary mt-2 me-4 dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                            Action
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <li><a class="dropdown-item" id="togglePoButton">Open / Close</a></li>
                            <li><a data-bs-toggle="modal" data-bs-target="#exampleModalCenter" class="dropdown-item" href="#">Fulfill / Contra</a></li>
                        </ul>
                    </div>
                    
                    <a href="{{ route('purchase_order.index') }}" class="mt-2 me-4 _effect--ripple waves-effect waves-light float-right btn btn-warning" style="margin-right:10px">Back</a>
                </div>
            </div>
        </div>
        <div class="widget-content widget-content-area" style="padding: 16px 15px">
            <div class="row" >
                <div class="table-responsive theme-scrollbar col-md-6">
                    <table class="display" style="width:100%">
                        <tbody>
                            <tr>
                                <td width="47%" align="right" style="padding-right:10px"><b>Date</b></td>
                                <td width="3%">: </td>
                                <td width="50%">{{$purchase_order->created_at->format('j M y g:ia')}}</td>
                            </tr>
                            <tr style="{{ $purchase_order->type === 'fp' ? 'display:none;' : '' }}">
                                <td width="47%" align="right" style="padding-right:10px"><b>Currency In</b></td>
                                <td width="3%">: </td>
                                <td width="50%">
                                    @if($purchase_order->currency_from)
                                        <img class="flag" src="{{asset('image/currency').'/'.$purchase_order->currency_from->short_name.'.png'}}">
                                        {{$purchase_order->currency_from->short_name??''}}
                                    @endif
                                </td>
                            </tr>
                            <tr><td><br></td><td></td><td><br></td></tr>
                            <tr style="{{ $purchase_order->type === 'fr' ? 'display:none;' : '' }}">
                                <td width="47%" align="right" style="padding-right:10px"><b>Currency Out</b></td>
                                <td width="3%">: </td>
                                <td width="50%">
                                    @if($purchase_order->currency_to)
                                        <img class="flag" src="{{asset('image/currency').'/'.$purchase_order->currency_to->short_name.'.png'}}">
                                        {{$purchase_order->currency_to->short_name??''}}
                                    @endif
                                </td>
                            </tr>
                            <tr style="{{ $purchase_order->type === 'fp' ? 'display:none;' : '' }}">
                                <td width="47%" align="right" style="padding-right:10px"><b>Receivable Amount</b></td>
                                <td width="3%">: </td>
                                <td width="50%">{{ number_format($purchase_order->received_amount, 0, '.', ',') ?? '' }}</td>
                            </tr>
                            <tr style="{{ $purchase_order->type === 'fp' ? 'display:none;' : '' }}">
                                <td width="47%" align="right" style="padding-right:10px"><b>Fullfilled Receivable Amount</b></td>
                                <td width="3%">: </td>
                                <td width="50%">{{ number_format($purchase_order->fulfilled_receivable_amount, 0, '.', ',') ?? '' }}</td>
                            </tr>
                            <tr style="{{ $purchase_order->type === 'fp' ? 'display:none;' : '' }}">
                                <td width="47%" align="right" style="padding-right:10px"><b>Receivable Balance</b></td>
                                <td width="3%">: </td>
                                <td width="50%">{{ number_format($purchase_order->receivable_balance, 0, '.', ',') ?? '' }}</td>
                            </tr>
                            <tr style="{{ in_array($purchase_order->type, ['fr', 'fp']) ? 'display:none;' : '' }}">
                                <td width="47%" align="right" style="padding-right:10px"><b>Exchange Rate</b></td>
                                <td width="3%">: </td>
                                <td width="50%">{{$purchase_order->currency_rate??''}}</td>
                            </tr>
                            <tr style="{{ $purchase_order->type === 'fr' ? 'display:none;' : '' }}">
                                <td width="47%" align="right" style="padding-right:10px"><b>Payable Amount</b></td>
                                <td width="3%">: </td>
                                <td width="50%">{{ number_format($purchase_order->payable_amount, 0, '.', ',') ?? '' }}</td>
                            </tr>
                            <tr style="{{ $purchase_order->type === 'fr' ? 'display:none;' : '' }}">
                                <td width="47%" align="right" style="padding-right:10px"><b>Fullfilled Payable Amount</b></td>
                                <td width="3%">: </td>
                                <td width="50%">{{ number_format($purchase_order->fulfilled_payable_amount, 0, '.', ',') ?? '' }}</td>
                            </tr>
                            <tr style="{{ $purchase_order->type === 'fr' ? 'display:none;' : '' }}">
                                <td width="47%" align="right" style="padding-right:10px"><b>Pay Balance</b></td>
                                <td width="3%">: </td>
                                <td width="50%">{{$purchase_order->pay_balance??''}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="table-responsive theme-scrollbar col-md-6">
                    <form enctype="multipart/form-data" method="post" action="{{ route('purchase_order.update_remark',$purchase_order) }}">
                        @csrf
                        <table class="display" style="width:100%">
                            <tbody>
                                <tr>
                                    <td width="47%" align="right" style="padding-right:10px"><b>Customer</b></td>
                                    <td width="3%">: </td>
                                    <td width="50%"><a href="{{route('customer.view',$purchase_order->user_id)}}" style="color:cyan; text-decoration:underline;">[{{$purchase_order->user_id}}] {{$purchase_order->user->name}}</a></td>
                                </tr>
                                <tr>
                                    <td width="47%" align="right" style="padding-right:10px"><b>Enquiry ID</b></td>
                                    <td width="3%">: </td>
                                    <td width="50%">-</td>
                                </tr>
                                <tr>
                                    <td width="47%" align="right" style="padding-right:10px"><b>Marketing Remark</b></td>
                                    <td width="3%">: </td>
                                    <td width="50%"><textarea name="marketing_remark" id="marketing_remark" placeholder="" class="form-control" value="{{$purchase_order->marketing_remark??''}}" >{{$purchase_order->marketing_remark??''}}</textarea></td>
                                </tr>
                                <tr><td><br></td><td><br></td><td><br></td></tr>
                                <tr>
                                    <td width="47%" align="right" style="padding-right:10px"><b>Operation Remark</b></td>
                                    <td width="3%">: </td>
                                    <td width="50%"><textarea name="operation_remark" id="operation_remark" placeholder="" class="form-control" value="{{$purchase_order->operation_remark??''}}" >{{$purchase_order->operation_remark??''}}</textarea></td>
                                </tr>
                                <tr style="{{ $purchase_order->type === 'fp' ? 'display:none;' : '' }}">
                                    <td width="47%" align="right" style="padding-right:10px"><b>Processing Fee</b></td>
                                    <td width="3%">: </td>
                                    <td width="50%">{{$purchase_order->processing_fees}}</td>
                                </tr>
                                <tr style="{{ in_array($purchase_order->type, ['fr', 'fp']) ? 'display:none;' : '' }}">
                                    <td width="47%" align="right" style="padding-right:10px"><b>Profit and Loss</b></td>
                                    <td width="3%">: </td>
                                    <td width="50%">-</td>
                                </tr>
                                <tr>
                                    <td width="47%" align="right" style="padding-right:10px"><b>Created by</b></td>
                                    <td width="3%">: </td>
                                    <td width="50%">[{{$purchase_order->created_by_id}}] {{$purchase_order->created_by->username}}</td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="col-lg-12 col-12 ">
                            <button type="submit" class="mt-4 btn btn-primary float-right">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
  </div>

<div class="row layout-spacing layout-top-spacing">
    <div class="col-lg-12">
        <div class="statbox widget box box-shadow">
            <div class="widget-content widget-content-area table-wrapper">
            <h3 style="margin:10px;">Transactions</h3>
                <table id="style-3" class="table style-3 dt-table-hover non-hover">
                    <thead>
                        <tr>
                            <th class="checkbox-column dt-no-sorting text-center">#</th>
                            <th>Date</th>
                            <th>Reference</th>
                            <th>Transaction Type</th>
                            <th>Debit/Credit</th>
                            <th>Currency</th>
                            <th>Amount</th>
                            <th>Bank</th>
                            <th>Account Balance</th>
                            <th>Customer</th>
                            <th>Created By</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($purchase_order_transaction as $transaction)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $transaction->created_at }}</td>
                                <td>{{ $transaction->reference }}</td>
                                <td>{{ $transaction->transaction_type }}</td>
                                <td>
                                    @if($transaction->debit_credit == 1)
                                        Debit
                                    @elseif($transaction->debit_credit == -1)
                                        Credit
                                    @endif
                                </td>
                                <td><img class="flag" src="{{asset('image/currency').'/'.$transaction->currencies->short_name.'.png'}}"> {{ $transaction->currencies->short_name ?? '' }}</td>
                                <td>{{ $transaction->currency_amount }}</td>
                                <td>{{ $transaction->account->account_type->account_type_name ?? '' }}</td>
                                <td>{{ $transaction->account_balance }}</td>
                                <td>{{$purchase_order->user->username}}</td>
                                <td>{{ $transaction->created_at }}</td>
                                <td id="toggleCancelButton" >@if(isset($transaction->status)&&$transaction->status=="Completed")<span class="shadow-none badge badge-success">Completed</span>@elseif(isset($transaction->status)&&$transaction->status=="Pending") <span class="shadow-none badge badge-warning">Pending</span> @elseif(isset($transaction->status)&&$transaction->status=="Closed") <span class="shadow-none badge badge-success">Closed</span> @else <span class="shadow-none badge badge-danger">Cancelled</span> @endif</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
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
                    <div class="col-lg-12 col-12" style="{{ in_array($purchase_order->type, ['fp', 'fr']) ? 'display:none;' : '' }}">
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
                            <option style="{{ $purchase_order->type === 'fp' ? 'display:none;' : '' }}" value="1" {{ $purchase_order->type === 'fr' ? 'selected' : '' }}>Debit</option>
                            <option style="{{ $purchase_order->type === 'fr' ? 'display:none;' : '' }}" value="-1" {{ $purchase_order->type === 'fp' ? 'selected' : '' }}>Credit</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-12 col-12 ">
                        <div class="form-group">
                            <label for="currency">Currency</label>
                            <select id="currency_id" name="currency_id" class="form-control">
                                <option style="{{ $purchase_order->type === 'fp' ? 'display:none;' : '' }}" {{ $purchase_order->type === 'fr' ? 'selected' : '' }} value="{{$purchase_order->currency_from_id??''}}">{{$purchase_order->currency_from->short_name??''}}</option>
                                <option style="{{ $purchase_order->type === 'fr' ? 'display:none;' : '' }}" {{ $purchase_order->type === 'fp' ? 'selected' : '' }} value="{{$purchase_order->currency_to_id??''}}">{{$purchase_order->currency_to->short_name??''}}</option>
                            </select>
                        </div>
                    </div>
                    <div id="contra_fields" style="display: none;">
                        <div class="col-lg-12 col-12 ">
                            <div class="form-group">
                                <label for="reference_id">Contra</label>
                                <select id="reference_id" name="reference_id" placeholder="Select a contra" class="form-control">
                                    <option value="">Select a contra</option>
                                    @foreach($contra as $contras)
                                        <option value="{{ $contras->id }}">
                                            {{ $contras->user->name ?? '' }} 
                                            @if($contras->payable_amount && $contras->received_amount)
                                                (Payable: {{ $contras->payable_amount }}, Receiveable: {{ $contras->received_amount }})
                                            @else
                                                ({{ $contras->payable_amount ?? $contras->received_amount }})
                                            @endif
                                            {{ $contras->po_no ?? '' }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
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
@endsection
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    function copyText() {
        const purchaseOrderNo = "{{$purchase_order->po_no}}";
        const customerCode = "{{$purchase_order->user->customer_code}}";
        const userName = "{{$purchase_order->user->name}}";
        const currencyFrom = "{{$purchase_order->currency_from ? $purchase_order->currency_from->short_name : ''}}";
        const currencyRate = "{{$purchase_order->currency_rate}}";
        let receivedAmount = {{$purchase_order->received_amount ?? 0}};
        let payableAmount = {{$purchase_order->payable_amount ?? 0}};
        const currencyTo = "{{$purchase_order->currency_to ? $purchase_order->currency_to->short_name : ''}}";
        const type = "{{$purchase_order->type}}";

        receivedAmount = receivedAmount.toLocaleString();
        payableAmount = payableAmount.toLocaleString();
        let copiedText;

        if (type === "po") {
            copiedText = `[${purchaseOrderNo}] ${customerCode} ${userName}_${receivedAmount} ${currencyFrom} @ ${currencyRate} = ${payableAmount} ${currencyTo}`;
        } else if (type === "fp") {
            copiedText = `[${purchaseOrderNo}] ${customerCode} ${userName}_ ${payableAmount} ${currencyTo}`;
        } else if (type === "fr") {
            copiedText = `[${purchaseOrderNo}] ${customerCode} ${userName}_${receivedAmount} ${currencyFrom}`;
        } else {
            copiedText = "Invalid type";
        }

        const textarea = document.createElement('textarea');
        textarea.value = copiedText;
        document.body.appendChild(textarea);

        textarea.select();
        document.execCommand('copy');

        document.body.removeChild(textarea);

        Swal.fire({
            icon: 'success',
            title: 'Copied!',
            text: textarea.value,
            timer: 3000,
            showConfirmButton: false,
            customClass: {
                popup: 'sweetalert-dark',
                title: 'sweetalert-dark-title',
                content: 'sweetalert-dark-content'
            }
        });
    }
</script>
<style>
    .sweetalert-dark {
        background-color: #2b2b2b !important;
        color: #ffffff !important;
    }

    .sweetalert-dark-title {
        color: #ffffff !important;
    }

    .sweetalert-dark-content {
        color: #ffffff !important;
    }
</style>
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
            "pageLength": 10
        });

        multiCheck(c3);

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
</script>

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

<script>

    var cancelTransactionRoute = "{{ route('purchase_order.close_po', $purchase_order) }}";
    var csrfToken = "{{ csrf_token() }}";

    document.getElementById('toggleCancelButton').addEventListener('click', function() {
        Swal.fire({
            title: 'Are you sure you want to cancel this transaction?',
            icon: 'question',
            showDenyButton: true,
            confirmButtonColor: '#3085d6',
            denyButtonColor: '#28a745',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes',
            denyButtonText: 'No',
            customClass: {
                popup: 'sweetalert-dark',
                title: 'sweetalert-dark-title',
                content: 'sweetalert-dark-content'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                handlePoAction(cancelTransactionRoute, 'The purchase order has been closed.', 'An error occurred while closing the purchase order.');
            }
        });
    });

    function handlePoAction(route, successMessage, errorMessage) {
        fetch(route, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({})
        })
        .then(response => response.json())
        .then(data => {
            Swal.fire({
                title: 'Success!',
                text: successMessage,
                icon: 'success',
                customClass: {
                    popup: 'sweetalert-dark',
                    title: 'sweetalert-dark-title',
                    content: 'sweetalert-dark-content'
                }
            }).then(() => {
                location.reload();
            });
        })
        .catch(error => {
            Swal.fire({
                title: 'Error!',
                text: errorMessage,
                icon: 'error',
                customClass: {
                    popup: 'sweetalert-dark',
                    title: 'sweetalert-dark-title',
                    content: 'sweetalert-dark-content'
                }
            });
        });
    }

    var closePoRoute = "{{ route('purchase_order.close_po', $purchase_order) }}";
    var openPoRoute = "{{ route('purchase_order.open_po', $purchase_order) }}";
    var csrfToken = "{{ csrf_token() }}";

    document.getElementById('togglePoButton').addEventListener('click', function() {
        Swal.fire({
            title: 'What would you like to do?',
            text: "Choose an action.",
            icon: 'question',
            showCancelButton: true,
            showDenyButton: true,
            confirmButtonColor: '#3085d6',
            denyButtonColor: '#28a745',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Close it',
            denyButtonText: 'Open it',
            customClass: {
                popup: 'sweetalert-dark',
                title: 'sweetalert-dark-title',
                content: 'sweetalert-dark-content'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                handlePoAction(closePoRoute, 'The purchase order has been closed.', 'An error occurred while closing the purchase order.');
            } else if (result.isDenied) {
                handlePoAction(openPoRoute, 'The purchase order has been opened.', 'An error occurred while opening the purchase order.');
            }
        });
    });

    function handlePoAction(route, successMessage, errorMessage) {
        fetch(route, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({})
        })
        .then(response => response.json())
        .then(data => {
            Swal.fire({
                title: 'Success!',
                text: successMessage,
                icon: 'success',
                customClass: {
                    popup: 'sweetalert-dark',
                    title: 'sweetalert-dark-title',
                    content: 'sweetalert-dark-content'
                }
            }).then(() => {
                location.reload();
            });
        })
        .catch(error => {
            Swal.fire({
                title: 'Error!',
                text: errorMessage,
                icon: 'error',
                customClass: {
                    popup: 'sweetalert-dark',
                    title: 'sweetalert-dark-title',
                    content: 'sweetalert-dark-content'
                }
            });
        });
    }
</script>
@endsection
