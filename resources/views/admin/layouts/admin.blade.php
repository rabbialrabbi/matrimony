<!DOCTYPE html>
<html>
@include('admin.includes.head')
@stack('style')
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    <!-- Navbar -->
@include('admin.includes.navbar')
<!-- /.navbar -->

    <!-- Main Sidebar Container -->
@include('admin.includes.sidebar')
<!-- Main Sidebar Container end -->
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
    {{--    @include('includes.breadcrumb')--}}

    @yield('content')

    <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    @include('admin.includes.footer')

    {{--<!-- Control Sidebar -->--}}
    {{--    <aside class="control-sidebar control-sidebar-dark">--}}
    {{--        <!-- Control sidebar content goes here -->--}}

    {{--    </aside>--}}
    {{--    <!-- /.control-sidebar -->--}}
</div>
<!-- ./wrapper -->

@include('admin.includes.scripts')
@stack('script')
</body>
</html>
