<!-- Start Header -->
@include('backend.includes.header')
<!-- Header End -->

<!-- Start Topbar -->
@include('backend.includes.top-nav')
<!-- Topbar End -->

<!-- Start Left Sidebar -->
@include('backend.includes.sidebar')
<!-- Left Sidebar End -->

<!-- ============================================================== -->
<!-- Start Page Content here -->
<!-- ============================================================== -->
<div class="page-wrapper">
    @yield('content')
</div>
<!-- Page Content End -->

<!-- Start Footer -->
@include('backend.includes.footer')
<!-- Footer End -->

@yield('script')