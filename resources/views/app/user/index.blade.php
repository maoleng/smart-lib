@php use App\Enums\UserFilter @endphp

@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">User</h4>
        </div>

        <div class="row card-body">
            <div class="col-md-6">
                <label class="form-check-label" for="tiktok-123">Search</label>
                <div class="input-group">
                    <input value="{{ request()->get('q') }}" type="search" class="i-search form-control form-control-lg" placeholder="Button on right" aria-describedby="button-addon2" />
                    <button class="btn btn-outline-primary" id="button-addon2" type="button">Go</button>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Book borrowing</th>
                        <th>Created At</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($users as $user)
                        <tr data-id="{{ $user->id }}">
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->borrows_count }} books</td>
                            <td>{{ $user->created_at }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="card">
                    <div class="card-body">
                        {{ $users?->links('vendor.pagination.bootstrap') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('vendor_css')
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/vendors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/extensions/nouislider.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/extensions/toastr.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/forms/select/select2.min.css') }}">
@endsection

@section('page_css')
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/core/menu/menu-types/horizontal-menu.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/extensions/ext-component-sliders.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/pages/app-ecommerce.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/extensions/ext-component-toastr.css') }}">
@endsection

@section('vendor_script')
    <script src="{{ asset('app-assets/vendors/js/ui/jquery.sticky.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/extensions/wNumb.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/extensions/nouislider.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/extensions/toastr.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/forms/select/select2.full.min.js') }}"></script>
@endsection

@section('script')
    <script>
        $('.i-search').on('change', function () {
            appendParams('q', $(this).val())
        })
        function appendParams(key, value)
        {
            const url = new URL(window.location.href);
            url.searchParams.set(key, value);
            window.location.href = url.toString();
        }
    </script>
@endsection

