@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Manage Book</h4>
        </div>

        <div class="row card-body">
            <div class="col-md-4">
                <label class="form-check-label" for="tiktok-123">Search</label>
                <div class="input-group">
                    <input value="{{ request()->get('q') }}" type="search" class="i-search form-control form-control-lg" placeholder="Button on right" aria-describedby="button-addon2" />
                    <button class="btn btn-outline-primary" id="button-addon2" type="button">Go</button>
                </div>
            </div>
            <div class="col-md-4">
                <label class="form-check-label" for="tiktok-123">Category</label>
                <select id="i-category" class="s-filter form-select" multiple="multiple">
                    @php ($category_ids = explode(',', request()->get('category_ids')))
                    @foreach($categories as $category)
                        <option {{ in_array($category->id, $category_ids) ? 'selected' : '' }} value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-check-label" for="tiktok">Author</label>
                <select id="i-author" class="s-filter form-select" multiple="multiple">
                    @php ($author_ids = explode(',', request()->get('author_ids')))
                    @foreach($authors as $author)
                        <option {{ in_array($author->id, $author_ids) ? 'selected' : '' }} value="{{ $author->id }}">{{ $author->name }}</option>
                    @endforeach
                </select>
            </div>

        </div>
        <div class="row">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Banner</th>
                        <th>Title</th>
                        <th>ISBN</th>
                        <th>Book Instances</th>
                        <th>Category</th>
                        <th>Author</th>
                        <th>Created At</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($books as $book)
                        <tr data-id="{{ $book->id }}">
                            <td>
                                <img src="{{ $book->banner }}" class="rounded me-1" height="170" alt="#" />
                            </td>
                            <td>{{ $book->title }}</td>
                            <td>{{ $book->ISBN }}</td>
                            <td>{{ $book->book_instances_count }} books</td>
                            <td>{{ $book->category->name }}</td>
                            <td>{{ $book->author->name }}</td>
                            <td>{{ $book->created_at }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="card">
                    <div class="card-body">
                        {{ $books->links('vendor.pagination.bootstrap') }}
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
        $('.s-filter').each(function () {
            var $this = $(this);
            $this.wrap('<div class="position-relative"></div>');
            $this.select2({
                tags: true,
                dropdownAutoWidth: true,
                dropdownParent: $this.parent(),
                width: '100%',
                containerCssClass: 'select-lg'
            });
        });
        $('#i-author').on('change', function () {
            appendParams('author_ids', $(this).val().toString())
        })
        $('#i-category').on('change', function () {
            appendParams('category_ids', $(this).val().toString())
        })

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

