@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Manage Book</h4>
            <button data-bs-toggle="modal" data-bs-target="#modal-create-book" type="button" class="btn btn-primary waves-effect waves-float waves-light">
                Create book
            </button>
            <div class="modal fade" id="modal-create-book" tabindex="-1" aria-labelledby="addNewAddressTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header bg-transparent">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body pb-5 px-sm-4 mx-50">
                            <h1 class="address-title text-center mb-1" id="addNewAddressTitle">Create Book</h1>

                            <form action="{{ route('admin.book.store') }}" method="post" enctype="multipart/form-data" class="row gy-1 gx-2">
                                @csrf
                                @include('app.book.form')
                            </form>
                        </div>
                    </div>
                </div>
            </div>
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
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($books as $book)
                        <tr data-id="{{ $book->id }}">
                            <td>
                                <img src="{{ $book->bannerUrl }}" class="rounded me-1" height="170" alt="#" />
                            </td>
                            <td>{{ $book->title }}</td>
                            <td>{{ $book->ISBN }}</td>
                            <td>
                                <a href="{{ route('admin.book.show', ['book' => $book]) }}">{{ $book->book_instances_count }} books</a>
                            </td>
                            <td>{{ $book->category->name }}</td>
                            <td>{{ $book->author->name }}</td>
                            <td>{{ $book->created_at }}</td>
                            <td>
                                <a class="me-1" href="#" data-bs-toggle="modal" data-bs-target="#edit-{{ $book->id }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-send font-medium-2 text-body">
                                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                    </svg>
                                </a>
                                <a data-book_id="{{ $book->id }}" class="me-25 btn-delete" href="javascript:void(0)" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Xóa" aria-label="Preview Invoice">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye font-medium-2 text-body">
                                        <polyline points="3 6 5 6 21 6"></polyline>
                                        <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                    </svg>
                                </a>
                                <div class="modal fade" id="edit-{{ $book->id }}" tabindex="-1" aria-labelledby="addNewAddressTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header bg-transparent">
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body pb-5 px-sm-4 mx-50">
                                                <h1 class="address-title text-center mb-1" id="addNewAddressTitle">Edit Book</h1>

                                                <form action="{{ route('admin.book.update', ['book' => $book]) }}" method="post" enctype="multipart/form-data" class="row gy-1 gx-2">
                                                    @csrf
                                                    @method('PUT')
                                                    @include('app.book.form')
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
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
        $('.btn-delete').on('click', function () {
            const bookId = $(this).data('book_id')
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                customClass: {
                    confirmButton: 'btn btn-primary',
                    cancelButton: 'btn btn-outline-danger ms-1'
                },
                buttonsStyling: false
            }).then(function (result) {
                if (result.value) {
                    $.ajax({
                        type: 'DELETE',
                        url: `/admin/book/${bookId}/`,
                        data: {
                            _token: '{{ csrf_token() }}',
                        },
                    }).then(function () {
                        window.location.reload()
                    })
                }
            });
        })


        $('.select2').each(function () {
            var $this = $(this);
            $this.wrap('<div class="position-relative"></div>');
            $this.select2({
                tags: true,
                dropdownAutoWidth: true,
                dropdownParent: $this.parent(),
                width: '100%',
            });
        });
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
    </script>
@endsection

