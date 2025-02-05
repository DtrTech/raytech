<!--  BEGIN SIDEBAR  -->
@php
use Illuminate\Support\Str;
$currentRoute = request()->route()->getName();
@endphp
<div class="sidebar-wrapper sidebar-theme">

<nav id="sidebar">

	<div class="navbar-nav theme-brand flex-row  text-center">
		<div class="nav-logo">
			<div class="nav-item theme-logo">
				<a href="#">
					<img src="../src/assets/img/logo.svg" class="navbar-logo" alt="logo">
				</a>
			</div>
			<div class="nav-item theme-text">
				<a href="#" class="nav-link"> Raytech </a>
			</div>
		</div>
		<div class="nav-item sidebar-toggle">
			<div class="btn-toggle sidebarCollapse">
				<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevrons-left"><polyline points="11 17 6 12 11 7"></polyline><polyline points="18 17 13 12 18 7"></polyline></svg>
			</div>
		</div>
	</div>
	<div class="shadow-bottom"></div>
	<ul class="list-unstyled menu-categories" id="accordionExample">
		<li class="menu {{ $currentRoute == 'dashboard' ? 'active' : ''}}">
			<a href="#dashboard" data-bs-toggle="collapse" aria-expanded="true" class="dropdown-toggle">
				<div class="">
					<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
					<span>Dashboard</span>
				</div>
				<div>
					<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
				</div>
			</a>
			<ul class="collapse submenu list-unstyled {{ $currentRoute == 'dashboard' ? 'show' : ''}}"" id="dashboard" data-bs-parent="#accordionExample">
				<li class="{{ $currentRoute == 'dashboard' ? 'active' : ''}}">
					<a href="#"> Analytics </a>
				</li>
			</ul>
		</li>
		<li class="menu {{ $currentRoute == 'sale' ? 'active' : ''}}">
			<a href="{{route('sale.index')}}" aria-expanded="false" class="dropdown-toggle">
				<div class="">
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user">
					<path d="M12 2a5 5 0 0 1 5 5v2a5 5 0 0 1-10 0V7a5 5 0 0 1 5-5zm0 10a5 5 0 0 1 5 5v2a5 5 0 0 1-10 0v-2a5 5 0 0 1 5-5zm0 10a5 5 0 0 1-5-5h10a5 5 0 0 1-5 5z"></path>
				</svg>
					<span>Sales</span>
				</div>
			</a>
		</li>
		<li class="menu {{ $currentRoute == 'product.index'||$currentRoute == 'removetint.index'||$currentRoute == 'worker.index' ? 'active' : ''}}">
			<a href="#settings" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
				<div class="">
					<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-zap"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"></polygon></svg>
					<span>Settings</span>
				</div>
				<div>
					<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
				</div>
			</a>
			<ul class="collapse submenu list-unstyled {{ $currentRoute == 'product.index'||$currentRoute == 'removetint.index'||$currentRoute == 'worker.index' ? 'show' : ''}}" id="settings" data-bs-parent="#accordionExample">
				<li class="{{ $currentRoute == 'product.index' ? 'active' : ''}}">
					<a href="{{route('product.index')}}"> Product </a>
				</li>
				<li class="{{ $currentRoute == 'removetint.index' ? 'active' : ''}}">
					<a href="{{route('removetint.index')}}"> Tinted Remove  </a>
				</li>
				<li class="{{ $currentRoute == 'worker.index' ? 'active' : ''}}">
					<a href="{{route('worker.index')}}"> Worker </a>
				</li>
			</ul>
		</li>

		
	</ul>
	
</nav>

</div>
<!--  END SIDEBAR  -->