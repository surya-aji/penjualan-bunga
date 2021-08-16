
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->
>
<!-- END: Head-->
@include('penjual.layout.top')
<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern  navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="">

    <!-- BEGIN: Header-->
  @include('penjual.layout.header')
    <!-- END: Header-->


    <!-- BEGIN: Main Menu-->
   @include('penjual.layout.nav')
    <!-- END: Main Menu-->

    <!-- BEGIN: Content-->
   @yield('content')
    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <!-- BEGIN: Footer-->
    @include('penjual.layout.footer')
    <!-- END: Footer-->

@include('penjual.layout.bottom')

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