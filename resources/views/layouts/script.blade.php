

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
    function appendParams(key, value)
    {
        const url = new URL(window.location.href);
        url.searchParams.set(key, value);
        window.location.href = url.toString();
    }
    $(window).on('load', function() {
        if (feather) {
            feather.replace({
                width: 14,
                height: 14
            });
        }

        @php
            $error = $errors->any() ? $errors->first() : session('error');
            $success = session('success');
        @endphp

        @if ($error || $success)
            Swal.fire({
                title: '{{ $error ? "Error" : "Success" }}!',
                text: '{{ $error ?: $success }}',
                icon: '{{ $error ? "error" : "success" }}',
                customClass: {
                    confirmButton: 'btn btn-primary'
                },
                buttonsStyling: false
            });
        @endif

    })
</script>
