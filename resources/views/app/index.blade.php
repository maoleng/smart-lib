@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-3">

            <h6 class="filter-heading d-none d-lg-block">Filters</h6>

            <div class="card">
                <form class="card-body">
                    <div class="multi-range-price">
                        <h6 class="filter-title mt-0">Category</h6>
                        <ul class="list-unstyled price-range" id="price-range">
                            @php ($category_id = request()->get('category'))
                            @foreach($categories as $category)
                                <li>
                                    <div class="form-check">
                                        <input {{ $category->id == $category_id ? 'checked' : '' }} type="radio" value="{{ $category->id }}" id="category{{ $category->id }}" name="category" class="form-check-input" />
                                        <label class="form-check-label" for="category{{ $category->id }}">{{ $category->name }}</label>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div id="product-categories">
                        <h6 class="filter-title">Author</h6>
                        <ul class="list-unstyled categories-list">
                            @php ($author_id = request()->get('author'))
                            @foreach($authors as $author)
                                <li>
                                    <div class="form-check">
                                        <input {{ $author->id == $author_id ? 'checked' : '' }} type="radio" value="{{ $author->id }}" id="author{{ $author->id }}" name="author" class="form-check-input" />
                                        <label class="form-check-label" for="author{{ $author->id }}">{{ $author->name }}</label>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div id="clear-filters">
                        <button type="reset" class="btn-reset btn w-100 btn-primary">Clear All Filters</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-9">
            <section id="ecommerce-header">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="ecommerce-header-items">
                            <div class="result-toggler">
                                <button class="navbar-toggler shop-sidebar-toggler" type="button" data-bs-toggle="collapse">
                                    <span class="navbar-toggler-icon d-block d-lg-none"><i data-feather="menu"></i></span>
                                </button>
                                <div class="search-results">{{ $books->total() }} results found</div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <div class="body-content-overlay"></div>

            <section id="ecommerce-searchbar" class="ecommerce-searchbar">
                <div class="row mt-1">
                    <div class="col-sm-12">
                        <div class="input-group input-group-merge">
                            <input type="text" class="i-search form-control search-product" id="shop-search" placeholder="Search Book" aria-label="Search..." aria-describedby="shop-search" />
                            <span class="input-group-text"><i data-feather="search" class="text-muted"></i></span>
                        </div>
                    </div>
                </div>
            </section>

            <section id="ecommerce-products" class="grid-view">
                @foreach ($books as $book)
                    <div class="card ecommerce-card">
                        <div class="item-img text-center">
                            <a href="{{ route('book.show', ['slug' => $book->slug]) }}">
                                <img class="img-fluid card-img-top" src="{{ $book->bannerUrl }}" alt="img-placeholder" /></a>
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
                                    <h6 class="item-price">{{ $book->category->name }}</h6>
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
        </div>
    </div>
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
    <script>
        $('.btn-reset').on('click', function () {
            window.location.href = window.location.href.split('?')[0];
        })
        $('input[name="author"], input[name="category"]').on('click', function () {
            appendParams($(this).attr('name'), $(this).val());
        });
        $('.i-search').on('keyup', function (e) {
            if (e.keyCode === 13) {
                appendParams('q', $(this).val())
            }
        })
    </script>
@endsection
