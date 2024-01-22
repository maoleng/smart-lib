<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
@include('components.layouts.head_tag')

<body class="horizontal-layout horizontal-menu content-detached-left-sidebar navbar-floating footer-static  "
      data-open="hover" data-menu="horizontal-menu" data-col="content-detached-left-sidebar">
@include('components.layouts.nav')
@include('components.layouts.menu')

<div class="app-content content ecommerce-application">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-detached content-right">
            <div class="content-body">
                {{ $slot }}
            </div>
        </div>
    </div>
</div>
@include('components.layouts.footer')
@include('components.layouts.script')
</body>


</html>
