@php use \Illuminate\Support\Facades\Auth; @endphp

@extends('layouts.app')

@section('content')
    <section class="app-ecommerce-details">
        <div class="card">
            <!-- Product Details starts -->
            <div class="card-body">
                <div class="row my-2">
                    <div class="col-12 col-md-5 d-flex align-items-center justify-content-center mb-2 mb-md-0">
                        <div class="d-flex align-items-center justify-content-center">
                            <img src="{{ $book->bannerUrl }}" class="img-fluid product-img" alt="product image"/>
                        </div>
                    </div>
                    <div class="col-12 col-md-7">
                        <h4>{{ $book->title }}</h4>
                        <span class="card-text item-company">By <a href="#"
                                                                   class="company-name">{{ $book->author->name }}</a></span>
                        <div class="ecommerce-details-price d-flex flex-wrap mt-1">
                            @php ($status = $book->status)
                            <h4 class="item-price me-1">
                                <span class="badge badge-glow bg-info">{{ $status }}</span>
                            </h4>
                            <ul class="unstyled-list list-inline ps-1 border-start">
                                <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                <li class="ratings-list-item"><i data-feather="star" class="unfilled-star"></i></li>
                            </ul>
                        </div>
                        {!! $book->description !!}
                        <hr/>
                        <div class="d-flex flex-column flex-sm-row pt-1">
                            @if (Auth::check())
                                <form action="{{ route('borrow.store', ['book' => $book]) }}" method="post">
                                    @csrf
                                    <button class="btn {{ $status !== 'Available' ? 'disabled' : '' }} btn-primary btn-cart me-0 me-sm-1 mb-1 mb-sm-0">
                                        <i data-feather="arrow-down-circle" class="me-50"></i>
                                        Borrow now
                                    </button>
                                </form>
                            @else
                                <a href="{{ route('auth.login') }}" class="btn btn-primary btn-cart me-0 me-sm-1 mb-1 mb-sm-0">
                                    <span>Login for Borrow</span>
                                </a>
                            @endif

                            <div class="btn-group dropdown-icon-wrapper btn-share">
                                <button type="button"
                                        class="btn btn-icon hide-arrow btn-outline-secondary dropdown-toggle"
                                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i data-feather="share-2"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a href="#" class="dropdown-item">
                                        <i data-feather="facebook"></i>
                                    </a>
                                    <a href="#" class="dropdown-item">
                                        <i data-feather="twitter"></i>
                                    </a>
                                    <a href="#" class="dropdown-item">
                                        <i data-feather="youtube"></i>
                                    </a>
                                    <a href="#" class="dropdown-item">
                                        <i data-feather="instagram"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Product Details ends -->

            <!-- Item features starts -->
            <div class="item-features">
                <div class="row text-center">
                    <div class="col-12 col-md-4 mb-4 mb-md-0">
                        <div class="w-75 mx-auto">
                            <i data-feather="award"></i>
                            <h4 class="mt-2 mb-1">100% Original</h4>
                            <p class="card-text">We provide original books, not copy books</p>
                        </div>
                    </div>
                    <div class="col-12 col-md-4 mb-4 mb-md-0">
                        <div class="w-75 mx-auto">
                            <i data-feather="clock"></i>
                            <h4 class="mt-2 mb-1">2 Day To Pick Up Book</h4>
                            <p class="card-text">You have 2 days to pick up the book, otherwise we will cancel your
                                order</p>
                        </div>
                    </div>
                    <div class="col-12 col-md-4 mb-4 mb-md-0">
                        <div class="w-75 mx-auto">
                            <i data-feather="shield"></i>
                            <h4 class="mt-2 mb-1">1 Month To Borrow Book</h4>
                            <p class="card-text">After picking up book, you have 1 month to borrow book.</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Item features ends -->

            <!-- Related Products starts -->
            <div class="card-body">
                <div class="mt-4 mb-2 text-center">
                    <h4>Related Books</h4>
                    <p class="card-text">People also search for this items</p>
                </div>
                <div class="swiper-responsive-breakpoints swiper-container px-4 py-2">
                    <div class="swiper-wrapper">
                        @foreach($related_books as $book)
                            <div class="swiper-slide">
                                <a href="{{ route('book.show', ['slug' => $book->slug]) }}">
                                    <div class="item-heading">
                                        <h5 class="text-truncate mb-0">{{ $book->title }}</h5>
                                        <small class="text-body">by {{ $book->author->name }}</small>
                                    </div>
                                    <div class="img-container w-50 mx-auto py-75">
                                        <img src="{{ $book->bannerUrl }}" class="img-fluid" alt="image"/>
                                    </div>
                                    <div class="item-meta">
                                        <ul class="unstyled-list list-inline mb-25">
                                            <li class="ratings-list-item"><i data-feather="star"
                                                                             class="filled-star"></i></li>
                                            <li class="ratings-list-item"><i data-feather="star"
                                                                             class="filled-star"></i></li>
                                            <li class="ratings-list-item"><i data-feather="star"
                                                                             class="filled-star"></i></li>
                                            <li class="ratings-list-item"><i data-feather="star"
                                                                             class="filled-star"></i></li>
                                            <li class="ratings-list-item"><i data-feather="star"
                                                                             class="unfilled-star"></i></li>
                                        </ul>
                                        <p class="card-text text-primary mb-0"> {{ $book->category->name }}</p>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                    <!-- Add Arrows -->
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>
            </div>
            <!-- Related Products ends -->
        </div>
    </section>
@endsection


@section('vendor_css')
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/vendors.min.css') }}">
    <link rel="stylesheet" type="text/css"
          href="{{ asset('app-assets/vendors/css/forms/spinner/jquery.bootstrap-touchspin.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/extensions/swiper.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/extensions/toastr.min.css') }}">
@endsection

@section('page_css')
    <link rel="stylesheet" type="text/css"
          href="{{ asset('app-assets/css/core/menu/menu-types/horizontal-menu.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/pages/app-ecommerce-details.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/forms/form-number-input.css') }}">
    <link rel="stylesheet" type="text/css"
          href="{{ asset('app-assets/css/plugins/extensions/ext-component-toastr.css') }}">
@endsection

@section('vendor_script')
    <script src="{{ asset('app-assets/vendors/js/ui/jquery.sticky.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/forms/spinner/jquery.bootstrap-touchspin.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/extensions/swiper.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/extensions/toastr.min.js') }}"></script>
@endsection


@section('script')
    <script src="{{ asset('app-assets/js/scripts/pages/app-ecommerce-details.js') }}"></script>
    <script src="{{ asset('app-assets/js/scripts/forms/form-number-input.js') }}"></script>
@endsection
