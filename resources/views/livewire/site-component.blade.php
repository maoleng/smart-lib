<div>
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
        @foreach ($products ?? [] as $product)
            <div class="card ecommerce-card">
                <div class="item-img text-center">
                    <a href="{{ route('detail', $product->id) }}">
                        <img class="img-fluid card-img-top" src="{{ $product->image }}" alt="img-placeholder" /></a>
                </div>
                <div class="card-body">
                    <div class="item-wrapper">
                        <div class="item-rating">
                            <ul class="unstyled-list list-inline">
                                {!! starRating($product->rate) !!}
                            </ul>
                        </div>
                        <div>
                            <h6 class="item-price">{{ prettyPrice($product->price) }}</h6>
                        </div>
                    </div>
                    <h6 class="item-name">
                        <a class="text-body" href="{{ route('detail', $product->id) }}">{{ $product->name }}</a>
                        <span class="card-text item-company">Bởi <a href="#" class="company-name">{{ $product->company_name }}</a></span>
                    </h6>
                    <p class="card-text item-description">
                        {{ $product->description }}
                    </p>
                </div>
                <div class="item-options text-center">
                    <div class="item-wrapper">
                        <div class="item-cost">
                            <h4 class="item-price">$339.99</h4>
                        </div>
                    </div>
                    <a href="#" data-id="{{ $product->id }}" class="btn-add_to_cart btn btn-primary btn-cart">
                        <i data-feather="shopping-cart"></i>
                        <span class="add-to-cart">Thêm vào giỏ hàng</span>
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
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-center mt-2">
                        <li class="page-item prev-item"><a class="page-link" href="#"></a></li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item" aria-current="page"><a class="page-link" href="#">4</a></li>
                        <li class="page-item"><a class="page-link" href="#">5</a></li>
                        <li class="page-item"><a class="page-link" href="#">6</a></li>
                        <li class="page-item"><a class="page-link" href="#">7</a></li>
                        <li class="page-item next-item"><a class="page-link" href="#"></a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </section>
</div>


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
    <script src={{ asset('app-assets/js/scripts/pages/app-ecommerce.js') }}></script>
@endsection
