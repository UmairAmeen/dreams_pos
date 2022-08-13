@include('backend.includes.header')
@include('backend.includes.top-nav')
@include('backend.includes.sidebar')
<div class="page-wrapper">
    @yield('content')
</div>
@include('backend.includes.footer')

@yield('script')