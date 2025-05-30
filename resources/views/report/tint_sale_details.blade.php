@extends('layouts.app')

@section('content')
<style>
    .table > tbody > tr > td{
        padding: 7px 7px 7px 7px;
        font-size: 12px;
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
                                <li class="breadcrumb-item">MONTHLY TECHNICIAN INSTALLATION REPORT (TINTED)</li>
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
                                    <button type="submit" class="btn btn-primary">Search</button>
                                    <button name="excel" class="btn btn-primary" value=1>Excel</button>
                                </div>
                            </div>
                        </form>
                        <span>TC => Total Commission, TRC => Total Remove Commission</span>
                    </div>

                    <?php 
                        $total_tc = 0;
                        $total_trc = 0;

                        foreach ($sale as $row) {
                            $total_tc += $row->total ?? 0;
                            $total_trc += $row->total_remove_commission ?? 0;
                        }
                    ?>
                    <table id="style-3" class="table style-3 dt-table-hover non-hover">
                        <thead>
                            <tr>
                                <th class="checkbox-column dt-no-sorting text-center">#</th>
                                <th>Date</th>
                                <th>Car Model</th>
                                <th>Car Plate</th>
                                <th>Product</th>
                                <th>FWS</th>
                                <th>RWS</th>
                                <th>R1</th>
                                <th>R2</th>
                                <th>L1</th>
                                <th>L2</th>
                                <th>R3</th>
                                <th>L3</th>
                                <th>SRF</th>
                                <th>SRF 2 </th>
                                <th>SRF Big</th>
                                <th>TC</th>
                                <th>TRC</th>
                                <!-- <th>Created At</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($sale as $num => $row)
                            <tr>
                                <td class="text-center"> {{$num+1}} </td>
                                <td>{{$row->sales_date??''}}</td>
                                <td>{{$row->car_model??''}}</td>
                                <td>{{$row->carplate??''}}</td>
                                <td>{{$row->product??''}}</td>
                                <td>{{$row->fws_worker->username??''}}<span style="font-size:0.7rem">{{$row->fws_remove_worker->username??''}}</span></td>
                                <td>{{$row->rws_worker->username??''}}<span style="font-size:0.7rem">{{$row->rws_remove_worker->username??''}}</span></td>
                                <td>{{$row->r1_worker->username??''}}<span style="font-size:0.7rem">{{$row->r1_remove_worker->username??''}}</span></td>
                                <td>{{$row->r2_worker->username??''}}<span style="font-size:0.7rem">{{$row->r2_remove_worker->username??''}}</span></td>
                                <td>{{$row->l1_worker->username??''}}<span style="font-size:0.7rem">{{$row->l1_remove_worker->username??''}}</span></td>
                                <td>{{$row->l2_worker->username??''}}<span style="font-size:0.7rem">{{$row->l2_remove_worker->username??''}}</span></td>
                                <td>{{$row->r3_worker->username??''}}<span style="font-size:0.7rem">{{$row->r3_remove_worker->username??''}}</span></td>
                                <td>{{$row->l3_worker->username??''}}<span style="font-size:0.7rem">{{$row->l3_remove_worker->username??''}}</span></td>
                                <td>{{$row->srf_worker->username??''}}<span style="font-size:0.7rem">{{$row->srf_remove_worker->username??''}}</span></td>
                                <td>{{$row->srf2_worker->username??''}}<span style="font-size:0.7rem">{{$row->srf2_remove_worker->username??''}}</span></td>
                                <td>{{$row->srfbig_worker->username??''}}<span style="font-size:0.7rem">{{$row->srfbig_remove_worker->username??''}}</span></td>
                                <td>{{$row->total??''}}</td>
                                <td>{{$row->total_remove_commission??''}}</td>
                                <!-- <td>{{$row->created_at??''}}</td> -->
                            </tr>
                            @endforeach
                        </tbody>
                        <tfooter>
                            <tr>
                                <td colspan="16" align="right"><b>All Total</b></td>
                                <td><b>{{ $total_tc }}</b></td>
                                <td><b>{{ $total_trc }}</b></td>
                                <!-- <td></td> -->
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
