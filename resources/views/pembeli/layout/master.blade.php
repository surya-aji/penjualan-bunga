
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->
@include('pembeli.layout.top')
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="horizontal-layout horizontal-menu  navbar-floating footer-static  " data-open="hover" data-menu="horizontal-menu" data-col="">

    <!-- BEGIN: Header-->
    @include('pembeli.layout.header')
    <!-- END: Header-->


    <!-- BEGIN: Main Menu-->
    @include('pembeli.layout.nav')
    <!-- END: Main Menu-->

    <!-- BEGIN: Content-->
        @yield('content')
    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <!-- BEGIN: Footer-->
    @include('pembeli.layout.footer')
    <!-- END: Footer-->

    @include('pembeli.layout.bottom')
    <script>
        $(window).on('load', function() {
            if (feather) {
                feather.replace({
                    width: 14,
                    height: 14
                });
            }
        })
    </script>
</body>
<!-- END: Body-->

</html>