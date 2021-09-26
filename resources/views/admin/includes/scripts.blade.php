<!-- jQuery -->
<script src="{{asset('asset/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('asset/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- jquery-validation -->
<script src="{{asset('asset/plugins/jquery-validation/jquery.validate.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('asset/js/adminlte.min.js')}}"></script>
<!-- DataTables -->
<script src="{{asset('asset/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('asset/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('asset/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('asset/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<!-- Sweetalert2 -->
<script src="{{asset('asset/plugins/sweetalert2/sweetalert2.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{asset('asset/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- Custom js -->
<script src="{{asset('asset/js/custom.js')}}"></script>

<script>
    // Ajax global CSRF token setup
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // / Side navbar active start  /
    // add active class and stay opened when selected
    var url = window.location;

    // for sidebar menu entirely but not cover treeview
    $('ul.nav-sidebar a').filter(function() {
        return this.href == url;
    }).addClass('active');

    // for treeview
    $('ul.nav-treeview a').filter(function() {
        return this.href == url;
    }).parentsUntil(".nav-sidebar > .nav-treeview").addClass('menu-open').prev('a').addClass('active');
    // / End side navbar active /

    const Toast = Swal.mixin({
        toast: true,
        position: "top-right",
        showConfirmButton: false,
        timer: 5000
    });

    @if(Session::has('success'))
    Toast.fire({
        icon: 'success',
        title: `{{Session::get('success')}}`
    })
    @elseif(Session::has('warning'))
    Toast.fire({
        icon: 'warning',
        title: `{{Session::get('warning')}}`
    })
    @elseif(Session::has('error'))
    Toast.fire({
        icon: 'error',
        title: `{{Session::get('error')}}`
    })
    @elseif(Session::has('info'))
    Toast.fire({
        icon: 'info',
        title: `{{Session::get('info')}}`
    })
    @endif
</script>
