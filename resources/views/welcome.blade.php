<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title -->
    <title>Neubitz Currency</title>

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('front/logo2.png') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('front/style.css') }}">
    <link href="{{ asset('admin/plugins/DataTables/DataTables-1.10.18/css/jquery.dataTables.min.css') }}" rel="stylesheet" />
    <style>
        p{
            margin-bottom:0px;
        }
        .table td, .table th{
            vertical-align:middle;
        }
    </style>
</head>

<body>
    <!-- ##### Preloader ##### -->
    <div id="preloader">
        <i class="circle-preloader"></i>
    </div>

    <!-- ##### Header Area Start ##### -->
    <header class="header-area">
 <!-- Navbar Area -->
        <div class="cryptos-main-menu">
            <div class="classy-nav-container breakpoint-off">
                <div class="container">
                    <!-- Menu -->
                    <nav class="classy-navbar justify-content-between" id="cryptosNav">

                        <!-- Logo -->
                        <a class="nav-brand" href="/"><img style="width:auto;height:150px;" src="{{ asset('front/logo.png') }}" alt=""></a>

                        <!-- Navbar Toggler -->
                        <div class="classy-navbar-toggler">
                            <span class="navbarToggler"><span></span><span></span><span></span></span>
                        </div>

                        <!-- Menu -->
                        <div class="classy-menu">

                            <!-- close btn -->
                            <div class="classycloseIcon">
                                <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                            </div>

                            <!-- Nav Start -->
                            <div class="classynav">
                                <ul>
                                    <li><a href="#section1">About Us</a></li>
                                    <li><a href="#section2">Rate</a></li>
                                    <li><a href="#section3">Exchange</a></li>
                                </ul>

                                <!-- Newsletter Form -->
                                <div class="header-newsletter-form">
                                    <button class="btn cryptos-btn btn-3 m-2">Contact Customer Service</button>
                                </div>

                            </div>
                            <!-- Nav End -->
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- ##### Header Area End ##### -->

    <!-- ##### Hero Area Start ##### -->
    <section class="hero-area">
        <div class="hero-slides owl-carousel">

            <!-- Single Hero Slide -->
            <div class="single-hero-slide">
                <div class="container h-100">
                    <div class="row h-100 align-items-center">
                        <div class="col-12 col-md-7">
                            <div class="hero-slides-content">
                                <h2 data-animation="fadeInUp" data-delay="100ms">Take a step into the <span>Currency World</span></h2>
                                <!-- <h6 data-animation="fadeInUp" data-delay="400ms">Skip the Line <br>SAVE YOUR TIME!</h6> -->
                            </div>
                        </div>
                        <div class="col-12 col-md-5">
                            <div class="hero-slides-thumb" data-animation="fadeInUp" data-delay="1000ms">
                                <img src="{{ asset('front/currency.png') }}" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ##### Hero Area End ##### -->

    <!-- ##### Course Area Start ##### -->
    <div class="cryptos-feature-area section-padding-100-0" id="section1">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="section-heading text-center mx-auto">
                        <h3>Let’s change <br><span>the world</span> together</h3>
                        <p>At Neubitz, our goal is to provide a comprehensive solution for working adults living abroad to send provisions back home. As a newcomer in the money changer industry, we differentiate ourselves by offering top-notch digital remittance services along with support for exchanging and transferring major currencies. When you become a Neubitz user, you gain access to real-time comparison charts that provide the latest updates on foreign exchange rates.

                        Throughout the years, Neubitz has built a strong reputation for delivering high-quality and dependable services to our valued customers.</p>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <!-- Single Course Area -->
                <div class="col-12 col-md-6 col-xl-3">
                    <div class="single-feature-area mb-100 text-center">
                        
                        <img src="{{asset('front/1.png')}}" style="height:100px;margin-bottom:30px">
                        <h3>Safe &amp; Easy</h3>
                        <p>Trade Safely Without Risking Your Money</p>
                    </div>
                </div>

                <!-- Single Course Area -->
                <div class="col-12 col-md-6 col-xl-3">
                    <div class="single-feature-area mb-100 text-center">
                        <img src="{{asset('front/2.png')}}" style="height:100px;margin-bottom:30px">
                        <h3>Efficiency</h3>
                        <p>Fast, Convenient And Premium Service</p>
                    </div>
                </div>

                <!-- Single Course Area -->
                <div class="col-12 col-md-6 col-xl-3">
                    <div class="single-feature-area mb-100 text-center">
                        <img src="{{asset('front/3.png')}}" style="height:100px;margin-bottom:30px">
                        <h3>Transparency</h3>
                        <p>Best Rate Transfers without Hidden Charges</p>
                    </div>
                </div>

                <!-- Single Course Area -->
                <div class="col-12 col-md-6 col-xl-3">
                    <div class="single-feature-area mb-100 text-center">
                        <img src="{{asset('front/4.png')}}" style="height:100px;margin-bottom:30px">
                        <h3>Professional</h3>
                        <p>Professional Agents for Easy Money Transfer</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ##### Currency Area Start ##### -->
    <section class="currency-calculator-area section-padding-100 bg-img bg-overlay" style="background-image: url(img/bg-img/bg-2.jpg);" id="section3">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-heading text-center white mx-auto">
                        <h3 class="mb-4">Currency Calculator</h3>
                        <h5 class="mb-2">Experience a Quicker and Safer Method to Send Money Overseas
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    
                    <div class="text-center white mx-auto">
                        <h4 style="color:white">We Sell</h4>
                    </div>
                    <div class="currency-calculator mb-15 clearfix">
                        <form action="#" method="post" class="d-flex align-items-center justify-content-center">
                            <!-- Calculator Part -->
                            <div class="calculator-first-part d-flex align-items-center">
                                <input type="text" name="inputNumber"  placeholder="0.000" id="sell_amount" onkeyup="changeSellFromCurrency(this.value)">
                                <select id="selling_currency">
                                    @foreach($currency as $curren)
                                        <option value = "{{$curren->id}}">{{ $curren->short_name ??''}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- Equal Sign -->
                            <div class="equal-sign">=</div>

                            <!-- Calculator Part -->
                            <div class="calculator-first-part d-flex align-items-center">
                                <input type="text" name="inputNumber" placeholder="0.000" id="sell_myr_amount" onkeyup="changeSell(this.value)">
                                
                                <select>
                                    <option>MYR</option>
                                </select>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-12">
                    
                    <div class="text-center white mx-auto">
                        <h4 style="color:white">We Buy</h4>
                    </div>
                    <div class="currency-calculator mb-15 clearfix">
                        <form action="#" method="post" class="d-flex align-items-center justify-content-center">
                            <!-- Calculator Part -->
                            <div class="calculator-first-part d-flex align-items-center">
                                <input type="text" name="inputNumber" placeholder="0.000" onkeyup="changeBuy(this.value)" id="buying_amount">
                                
                                <select id="buying_currency">
                                    @foreach($currency as $curren)
                                        <option value = "{{$curren->id}}">{{ $curren->short_name ??''}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Equal Sign -->
                            <div class="equal-sign">=</div>

                            <!-- Calculator Part -->
                            <div class="calculator-first-part d-flex align-items-center">
                                <input type="text" name="inputNumber" placeholder="0.000" id="buying_myr_amount" onkeyup="changeCurrencyBuy(this.value)" >
                                <select>
                                    <option>MYR</option>
                                </select>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ##### Currency Area End ##### -->

    <!-- ##### Blog Area Start ##### -->
    <section class="cryptos-blog-area section-padding-100" id="section2">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-heading text-center mx-auto">
                        <h3><b>Exchange Rate</b></h3>
                        <p>Neubitz constantly works on expanding its market. Currently, you can send money to 50 countries globally and receive from over 30 countries via our service.</p>
                    </div>
                </div>
            </div>
            <div class="row align-items-center">
                <div class="col-12 col-lg-12">
                    <span style="float:right">Last Updated: <b style="color:#ffaf02" id="datetime"></b></span>
                    <div class="table-container">
                        <table id="currencyTable" class="table table-hover table-product" style="width:100%">
                            <thead>
                                <tr style="background-color:rgba(0,41,68,255);color:white">
                                    <th>No.</th>
                                    <th>Country</th>
                                    <th>Exchange Rate</th>
                                <tr>
                            </thead>
                            <tbody>
                                @foreach($currency as $row=> $curren)
                                <tr>
                                    <?php $userAgent = $_SERVER['HTTP_USER_AGENT']; ?>
                                    <td>{{$row+1}}</td>
                                    <td>
                                    <div class="p-content d-flex align-items-center">
                                    <img class="flag" src="{{asset('image/currency').'/'.$curren->short_name.'.png'}}" style="height:50px">
                                        @if(!preg_match('/Mobile|Android|iPhone|iPad|iPod|BlackBerry|Windows Phone/i', $userAgent))
                                        <p>&nbsp;&nbsp;{{$curren->short_name??''}} <span>{{$curren->currency_name??''}}</span></p>
                                        @endif
                                    </div>
                                    </td>
                                    <td>{{$curren->rate ??''}}</td>
                                <tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ##### Blog Area End ##### -->

    <!-- ##### Footer Area Start ##### -->
    <footer class="footer-area">
        
        <div class="bottom-footer-area">
            <div class="container h-100">
                <div class="row h-100 align-items-center justify-content-center">
                    <div class="col-12">
                        <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | Neubitz is made with <i class="fa fa-heart-o" aria-hidden="true"></i> Gary <i class="fa fa-heart-o" aria-hidden="true"></i> 
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    
<script src="{{ asset('front/js/jquery/jquery-2.2.4.min.js') }}"></script>   
<script src="{{ asset('front/js/bootstrap/popper.min.js') }}"></script>   
<script src="{{ asset('front/js/bootstrap/bootstrap.min.js') }}"></script>   
<script src="{{ asset('front/js/plugins/plugins.js') }}"></script>   
<script src="{{ asset('front/js/active.js') }}"></script>
<script src="{{ asset('admin/plugins/DataTables/DataTables-1.10.18/js/jquery.dataTables.min.js') }}"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const navLinks = document.querySelectorAll("nav ul li a");

        navLinks.forEach(link => {
            link.addEventListener("click", function(e) {
                e.preventDefault(); // Prevent the default link behavior

                const targetId = this.getAttribute("href").substring(1); // Get the target section's ID

                const targetSection = document.getElementById(targetId);

                if (targetSection) {
                    // Scroll to the target section smoothly
                    targetSection.scrollIntoView({ behavior: "smooth" });
                }
            });
        });
    });

    function changeSell(amount){
        var currency = document.getElementById('selling_currency').value;
        $.ajax({
            url: "{{ route('calculate_selling')}}?currency="+currency+"&amount="+amount,
            method: 'GET',
            success: function(data) {
                var sell_amount = document.getElementById("sell_amount");
                sell_amount.value = data;
            },
        })
    }

    function changeSellFromCurrency(amount){
        var currency = document.getElementById('selling_currency').value;
        $.ajax({
            url: "{{ route('calculate_selling_currency')}}?currency="+currency+"&amount="+amount,
            method: 'GET',
            success: function(data) {
                var sell_myr_amount = document.getElementById("sell_myr_amount");
                sell_myr_amount.value = data;
            },
        })
    }

    function changeBuy(amount){
        var currency = document.getElementById('buying_currency').value;
        $.ajax({
            url: "{{ route('calculate_buying')}}?currency="+currency+"&amount="+amount,
            method: 'GET',
            success: function(data) {
                var buying_myr_amount = document.getElementById("buying_myr_amount");
                buying_myr_amount.value = data;
            },
        })
    }

    function changeCurrencyBuy(amount){
        var currency = document.getElementById('buying_currency').value;
        $.ajax({
            url: "{{ route('calculate_buying_currency')}}?currency="+currency+"&amount="+amount,
            method: 'GET',
            success: function(data) {
                var buying_amount = document.getElementById("buying_amount");
                buying_amount.value = data;
            },
        })
    }


    function displayDateTime() {
      const dateTimeElement = document.getElementById("datetime");
      const now = new Date();

      const options = {
        weekday: 'long',
        year: 'numeric',
        month: 'long',
        day: 'numeric',
        hour: 'numeric',
        minute: 'numeric',
        second: 'numeric',
        hour12: true // Use 12-hour clock with AM/PM
      };

      const formattedDateTime = now.toLocaleString(undefined, options);

      dateTimeElement.textContent = formattedDateTime;
    }

    // Call the function to display date and time
    displayDateTime();

    // Update the date and time every second
    // setInterval(displayDateTime, 1000);
</script>   
</body>

</html>