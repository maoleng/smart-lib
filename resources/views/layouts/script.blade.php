

<!-- BEGIN: Vendor JS-->
<script src={{ asset('app-assets/vendors/js/vendors.min.js') }}></script>
<!-- BEGIN Vendor JS-->

<!-- BEGIN: Page Vendor JS-->
@yield('vendor_script')
<script src="{{ asset('app-assets/vendors/js/extensions/sweetalert2.all.min.js') }}"></script>
<script src="{{ asset('app-assets/vendors/js/extensions/polyfill.min.js') }}"></script>
<!-- END: Page Vendor JS-->

<!-- BEGIN: Theme JS-->
<script src={{ asset('app-assets/js/core/app-menu.js') }}></script>
<script src={{ asset('app-assets/js/core/app.js') }}></script>
<!-- END: Theme JS-->

@yield('script')
<script>
    $(window).on('load', function() {
        if (feather) {
            feather.replace({
                width: 14,
                height: 14
            });
        }
        @if ($errors->any())
            Swal.fire({
                title: 'Error!',
                text: '{{ $errors->first() }}',
                icon: 'error',
                customClass: {
                    confirmButton: 'btn btn-primary'
                },
                buttonsStyling: false
            });
        @endif
        @if ($success = session('success'))
            Swal.fire({
                title: 'Success!',
                text: '{{ $success }}',
                icon: 'success',
                customClass: {
                    confirmButton: 'btn btn-primary'
                },
                buttonsStyling: false
            });
        @endif
    })
</script>
