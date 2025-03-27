@extends('layouts.app')

@section('content')
<style>
    .table > tbody > tr > td{
        padding: 7px 7px 7px 7px;
        font-size: 12px;
        border: 1px solid black;
    }

    .table > thead > tr > th{
        border: 1px solid black;
    }
</style>
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
                                <li class="breadcrumb-item">Worker Sales Report</li>
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
                    <div class="table-form d-flex justify-content-between align-items-center" style="margin:10px !important">
                        <!-- Date and Search button grouped together -->
                        <form method="GET">
                            <div class="d-flex">
                                <div class="form-group">
                                    <input type="date" class="form-control form-control-sm" name="date_from" value="{{$date_from??''}}">
                                </div>
                                <div class="form-group">
                                    <input type="date" class="form-control form-control-sm" name="date_to" value="{{$date_to??''}}">
                                </div>
                                <div class="form-group">
                                    <select class="form-control form-control-sm" name="worker_id">
                                        <option value="">--select--</option>
                                        @foreach($worker as $w)
                                        <option value="{{$w->id}}" <?php echo isset($worker_id)&&$worker_id == $w->id?'selected':''?>>{{$w->name??''}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Search</button>
                                    <!-- <button name="excel" class="btn btn-primary" value=1>Excel</button> -->
                                </div>
                            </div>
                        </form>
                        <span>TC => Total Commission, TRC => Total Remove Commission</span>
                    </div>

                    
                    <table id="style-3" class="table style-3 dt-table-hover non-hover">
                        <thead>
                            <tr>
                                <th class="checkbox-column dt-no-sorting text-center" rowspan="2">#</th>
                                <th rowspan="2">Date</th>
                                <th rowspan="2">Car Plate</th>
                                <th rowspan="2">Item</th>
                                @foreach($select_worker as $work)
                                    <th colspan="3" class="t-no-sorting text-center">{{$work->username ?? ''}}</th>
                                @endforeach
                                @if($select_worker->count()>1)
                                <th rowspan="2" class="t-no-sorting text-center">Total S</th>
                                <th rowspan="2" class="t-no-sorting text-center">Total W</th>
                                <th rowspan="2" class="t-no-sorting text-center">Total T</th>
                                @endif
                            </tr>
                            <tr>
                                @foreach($select_worker as $work)
                                    <th class="t-no-sorting text-center">S</th>
                                    <th class="t-no-sorting text-center">W</th>
                                    <th class="t-no-sorting text-center">T</th>
                                @endforeach
                            </tr>
                        </thead>
                        @php
                            // Initialize total variables
                            $totalSalesCommission = 0;
                            $totalWorkCommission = 0;
                            $grandTotalCommission = 0;
                            $workerTotals = [];

                            foreach ($select_worker as $worker) {
                                $workerTotals[$worker->id] = [
                                    'sale' => 0,
                                    'work' => 0,
                                    'total' => 0
                                ];
                            }
                        @endphp

                        <tbody>
                            @foreach($item_sale as $num => $row)
                            <tr>
                                <td class="text-center"> {{$num+1}} </td>
                                <td>{{$row->sales_date??''}}</td>
                                <td>{{$row->car_plate??''}}</td>
                                <td>{{$row->item->item_name??''}}</td>
                                @foreach($select_worker as $worker)
                                    @php 
                                        $sale = $worker->id."_sale";
                                        $work = $worker->id."_work";
                                        $total = $worker->id."_total";

                                        // Sum up each worker's sales, work, and total
                                        $workerTotals[$worker->id]['sale'] += $row->$sale ?? 0;
                                        $workerTotals[$worker->id]['work'] += $row->$work ?? 0;
                                        $workerTotals[$worker->id]['total'] += $row->$total ?? 0;
                                    @endphp
                                    <td class="text-center">{{$row->$sale ?? ''}}</td>
                                    <td class="text-center">{{$row->$work ?? ''}}</td>
                                    <td class="text-center">{{$row->$total ?? ''}}</td>
                                @endforeach
                                @php
                                    // Sum up overall totals
                                    $totalSalesCommission += $row->sales_commission ?? 0;
                                    $totalWorkCommission += $row->work_commission ?? 0;
                                    $grandTotalCommission += ($row->sales_commission + $row->work_commission) ?? 0;
                                @endphp
                                @if($select_worker->count()>1)
                                <td class="text-center">{{$row->sales_commission ?? ''}}</td>
                                <td class="text-center">{{$row->work_commission ?? ''}}</td>
                                <td class="text-center">{{$row->sales_commission + $row->work_commission ?? ''}}</td>
                                @endif
                            </tr>
                            @endforeach
                        </tbody>

                        <tfooter>
                            <tr>
                                <td colspan="4" align="right"><b>All Total</b></td>
                                @foreach($select_worker as $worker)
                                    <td class="text-center"><b>{{$workerTotals[$worker->id]['sale']}}</b></td>
                                    <td class="text-center"><b>{{$workerTotals[$worker->id]['work']}}</b></td>
                                    <td class="text-center"><b>{{$workerTotals[$worker->id]['total']}}</b></td>
                                @endforeach
                                
                                @if($select_worker->count()>1)
                                <td class="text-center"><b>{{$totalSalesCommission}}</b></td>
                                <td class="text-center"><b>{{$totalWorkCommission}}</b></td>
                                <td class="text-center"><b>{{$grandTotalCommission}}</b></td>
                                @endif
                            </tr>
                        </tfooter>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
@section('scripts')
<script>
    c3 = $('#style-3').DataTable({
        "ordering": false,
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
            "lengthMenu": [50, 100, 200, 500, 1000],
            "pageLength": 500
        });

        multiCheck(c3);
</script>
@endsection
