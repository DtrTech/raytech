@extends('layouts.app')
<style>
    .custom-select {
    position: relative;
}

.custom-select select {
    width: 100%;
    padding: 10px;
    font-size: 16px;
    border: 1px solid #ccc;
    border-radius: 5px;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
}

.custom-select__image {
    position: absolute;
    top: 50%;
    right: 10px;
    transform: translateY(-50%);
    width: 30px;
    height: 30px;
    background-size: cover;
    background-position: center;
    border-radius: 5px;
}

.custom-select__image img {
    width: 100%;
    height: 100%;
    border-radius: 5px;
}


.custom-select::after {
    content: '';
    position: absolute;
    top: 50%;
    right: 10px;
    transform: translateY(-50%);
    width: 0;
    height: 0;
    border-left: 6px solid transparent;
    border-right: 6px solid transparent;
    border-top: 6px solid #333;
    pointer-events: none;
    display: none;
}

.to-id-custom-select {
    position: relative;
}

.to-id-custom-select select {
    width: 100%;
    padding: 10px;
    font-size: 16px;
    border: 1px solid #ccc;
    border-radius: 5px;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
}

.to-id-custom-select__image {
    position: absolute;
    top: 50%;
    right: 10px;
    transform: translateY(-50%);
    width: 30px;
    height: 30px;
    background-size: cover;
    background-position: center;
    border-radius: 5px;
}

.to-id-custom-select__image img {
    width: 100%;
    height: 100%;
    border-radius: 5px;
}

.to-id-custom-select::after {
    content: '';
    position: absolute;
    top: 50%;
    right: 10px;
    transform: translateY(-50%);
    width: 0;
    height: 0;
    border-left: 6px solid transparent;
    border-right: 6px solid transparent;
    border-top: 6px solid #333;
    pointer-events: none;
    display: none;
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
                                <li class="breadcrumb-item">Currency Rate</li>
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
                            <h4>Currency Rate Details</h4>
                        </div>                 
                    </div>
                </div>
                <div class="widget-content widget-content-area" style="padding: 16px 15px">

                    <div class="row" >
                        <form enctype="multipart/form-data" @if (isset($currency_rate)) method="post" action="{{ route('currency_rate.update',$currency_rate) }}" @else method="post" action="{{ route('currency_rate.store') }}" @endif>
                        @csrf
                        <div class="col-lg-12 col-12 ">
                            <div class="form-group">
                                <label for="t-text">From</label>
                                <div class="custom-select ">
                                    <select class="form-select" aria-label="Default select example" name="from_id">
                                        <option value="">-- Select --</option>
                                        @foreach($currency as $g)
                                            <option value="{{ $g->id }}" data-image="{{ asset('image/currency').'/'.$g->short_name.'.png' }}" {{ isset($currency_rate) && $currency_rate->from_id == $g->id ? 'selected' : '' }}>
                                                {{ $g->short_name ?? "" }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="custom-select__image"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-12 ">
                            <div class="form-group">
                                <label for="t-text">From Amount</label>
                                <input id="t-text" type="text" name="amount_from" placeholder="amount" class="form-control" value="{{$currency_rate->amount_from??''}}" required>
                            </div>
                        </div>   
                        <div class="col-lg-12 col-12 ">
                            <div class="form-group">
                                <label for="t-text">To</label>
                                <div class="to-id-custom-select">
                                    <select class="form-select" aria-label="Default select example" name="to_id">
                                        <option value="">-- Select --</option>
                                        @foreach($currency as $g)
                                            <option value="{{ $g->id }}" data-image1="{{ asset('image/currency').'/'.$g->short_name.'.png' }}" <?php echo isset($currency_rate) && $currency_rate->to_id == $g->id ? 'selected' : '' ?>>
                                                {{ $g->short_name ?? "" }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="to-id-custom-select__image"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-12 ">
                            <div class="form-group">
                                <label for="t-text">To Amount</label>
                                <input id="t-text" type="text" name="amount_to" placeholder="amount" class="form-control" value="{{$currency_rate->amount_to??''}}" required>
                            </div>
                        </div> 
                        <div class="col-lg-12 col-12 ">
                            <div class="form-group">
                                <label for="t-text">We Buy</label>
                                <input id="t-text" type="text" name="we_buy" placeholder="" class="form-control" value="{{$currency_rate->we_buy??''}}">
                            </div>
                        </div>  
                        <div class="col-lg-12 col-12 ">
                            <div class="form-group">
                                <label for="t-text">We Sell</label>
                                <input id="t-text" type="text" name="we_sell" placeholder="" class="form-control" value="{{$currency_rate->we_sell??''}}" >
                            </div>
                        </div>
                        <button type="submit" class="mt-2  btn btn-primary float-right" style="margin-right:10px">Save</button>
                        <a href="{{route('currency_rate.index')}}" class="mt-2  btn btn-warning float-right" style="margin-right:10px">Back</a>
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
    document.addEventListener('DOMContentLoaded', function() {
    var fromSelect = document.querySelector('.custom-select select');
    var fromImageContainer = document.querySelector('.custom-select__image');

    fromSelect.addEventListener('change', function() {
        var selectedOption = fromSelect.options[fromSelect.selectedIndex];
        var imageUrl = selectedOption.getAttribute('data-image');
        fromImageContainer.style.backgroundImage = 'url("' + imageUrl + '")';
    });

    var initialFromOption = fromSelect.options[fromSelect.selectedIndex];
    var initialFromImageUrl = initialFromOption.getAttribute('data-image');
    fromImageContainer.style.backgroundImage = 'url("' + initialFromImageUrl + '")';

    var toSelect = document.querySelector('.to-id-custom-select select');
    var toImageContainer = document.querySelector('.to-id-custom-select__image');

    toSelect.addEventListener('change', function() {
        var selectedOption = toSelect.options[toSelect.selectedIndex];
        var imageUrl1 = selectedOption.getAttribute('data-image1');
        toImageContainer.style.backgroundImage = 'url("' + imageUrl1 + '")';
    });

    var initialToOption = toSelect.options[toSelect.selectedIndex];
    var initialToImageUrl1 = initialToOption.getAttribute('data-image1');
    toImageContainer.style.backgroundImage = 'url("' + initialToImageUrl1 + '")';
});
    </script>
@endsection
