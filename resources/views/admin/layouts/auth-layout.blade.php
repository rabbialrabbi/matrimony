<!DOCTYPE html>
<html>
@include('admin.includes.head')
@stack('style')
<body class="hold-transition login-page">

<div class="login-box">

    @yield('content')

</div>

@include('admin.includes.scripts')
@stack('script')
</body>
</html>

