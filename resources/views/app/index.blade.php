@extends('layouts.app')

@section('content')
    <section id="ecommerce-header">
        <div class="row">
            <div class="col-sm-12">
                <div class="ecommerce-header-items">
                    <div class="result-toggler">
                        <button class="navbar-toggler shop-sidebar-toggler" type="button" data-bs-toggle="collapse">
                            <span class="navbar-toggler-icon d-block d-lg-none"><i data-feather="menu"></i></span>
                        </button>
                    </div>
                    <div class="view-options d-flex">
                        <div class="btn-group" role="group">
                            <input type="radio" class="btn-check" name="radio_options" id="radio_option1" autocomplete="off" checked />
                            <label class="btn btn-icon btn-outline-primary view-btn grid-view-btn" for="radio_option1"><i data-feather="grid" class="font-medium-3"></i></label>
                            <input type="radio" class="btn-check" name="radio_options" id="radio_option2" autocomplete="off" />
                            <label class="btn btn-icon btn-outline-primary view-btn list-view-btn" for="radio_option2"><i data-feather="list" class="font-medium-3"></i></label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="body-content-overlay"></div>

    <section id="ecommerce-products" class="grid-view">
        @foreach ($books as $book)
            <div class="card ecommerce-card">
                <div class="item-img text-center">
                    <a href="{{ route('book.show', ['slug' => $book->slug]) }}">
                        <img class="img-fluid card-img-top" src="{{ $book->banner }}" alt="img-placeholder" /></a>
                </div>
                <div class="card-body">
                    <div class="item-wrapper">
                        <div class="item-rating">
                            <ul class="unstyled-list list-inline">
                                <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                <li class="ratings-list-item"><i data-feather="star" class="unfilled-star"></i></li>
                            </ul>
                        </div>
                        <div>
                            <h6 class="item-price">{{ 'con hang' }}</h6>
                        </div>
                    </div>
                    <h6 class="item-name">
                        <a class="text-body" href="{{ route('book.show', ['slug' => $book->slug]) }}">{{ $book->title }}</a>
                        <span class="card-text item-company">By <a href="#" class="company-name">{{ $book->author->name }}</a></span>
                    </h6>
                    <p class="card-text item-description">
                        There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing
                    </p>
                </div>
                <div class="item-options text-center">
                    <div class="item-wrapper">
                        <div class="item-cost">
                            <h4 class="item-price">$339.99</h4>
                        </div>
                    </div>
                    <a href="{{ route('book.show', ['slug' => $book->slug]) }}" class=" btn btn-primary btn-cart">
                        <span class="add-to-cart">Xem</span>
                    </a>
                </div>
            </div>
        @endforeach
    </section>
    <!-- E-commerce Products Ends -->

    <!-- E-commerce Pagination Starts -->
    <section id="ecommerce-pagination">
        <div class="row">
            <div class="col-sm-12">
                {{ $books->links('vendor.pagination.bootstrap-5') }}
            </div>
        </div>
    </section>
@endsection


@section('vendor_css')
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/vendors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/extensions/nouislider.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/extensions/toastr.min.css') }}">
@endsection

@section('page_css')
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/core/menu/menu-types/horizontal-menu.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/extensions/ext-component-sliders.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/pages/app-ecommerce.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/extensions/ext-component-toastr.css') }}">
@endsection

@section('vendor_script')
    <script src={{ asset('app-assets/vendors/js/ui/jquery.sticky.js') }}></script>
    <script src={{ asset('app-assets/vendors/js/extensions/wNumb.min.js') }}></script>
    <script src={{ asset('app-assets/vendors/js/extensions/nouislider.min.js') }}></script>
    <script src={{ asset('app-assets/vendors/js/extensions/toastr.min.js') }}></script>
@endsection


@section('script')

@endsection
