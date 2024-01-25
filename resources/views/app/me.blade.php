@php use \Carbon\Carbon; @endphp

@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Book Borrowing</h4>
        </div>
        <div class="row">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Banner</th>
                        <th>Title</th>
                        <th>ISBN</th>
                        <th>Code</th>
                        <th>Book At</th>
                        <th>Borrow At</th>
                        <th>Due At</th>
                        <th>Return At</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($borrows as $borrow)
                        <tr data-id="{{ $borrow->bookInstance->book->id }}">
                            <td>
                                <img src="{{ $borrow->bookInstance->book->bannerUrl }}" class="rounded me-1" height="170" alt="#" />
                            </td>
                            <td>{{ $borrow->bookInstance->book->title }}</td>
                            <td>{{ $borrow->bookInstance->book->ISBN }}</td>
                            <td>{{ $borrow->bookInstance->code }}</td>
                            <td>{{ Carbon::make($borrow->book_at)->toDateString() }}</td>
                            <td>{{ Carbon::make($borrow->borrow_at)?->toDateString() }}</td>
                            <td>{{ Carbon::make($borrow->expected_return_at)?->toDateString() }}</td>
                            <td>{{ Carbon::make($borrow->actual_return_at)?->toDateString() }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="card">
                    <div class="card-body">
                        {{ $borrows->links('vendor.pagination.bootstrap') }}
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
