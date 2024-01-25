@php use App\Enums\BookStatus; @endphp

@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">
                <a href="{{ route('admin.book.index') }}">Manage Book </a>< {{ $book->title }}
            </h4>
            <button data-bs-toggle="modal" data-bs-target="#modal-create-book" type="button" class="btn btn-primary waves-effect waves-float waves-light">
                Create book instance
            </button>
            <div class="modal fade" id="modal-create-book" tabindex="-1" aria-labelledby="addNewAddressTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header bg-transparent">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body pb-5 px-sm-4 mx-50">
                            <h1 class="address-title text-center mb-1" id="addNewAddressTitle">Create Book</h1>

                            <form action="{{ route('admin.book-instance.store') }}" method="post" enctype="multipart/form-data" class="row gy-1 gx-2">
                                @csrf
                                <div class="col-12">
                                    <div class="form-floating">
                                        <input name="code" type="text" class="form-control" id="floating-label1" placeholder="code"/>
                                        <label for="floating-label1">Code</label>
                                    </div>
                                </div>
                                <input type="hidden" name="book_id" value="{{ $book->id }}">
                                <div class="col-12 text-center">
                                    <button type="submit" class="btn btn-primary me-1 mt-2">Create</button>
                                    <button type="reset" class="btn btn-outline-secondary mt-2" data-bs-dismiss="modal" aria-label="Close">
                                        Cancel
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Code</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($book_instances as $book_instance)
                        <tr data-id="{{ $book_instance->id }}">
                            <td>{{ $book_instance->code }}</td>
                            @php ($status = $book_instance->status)
                            <td>{{ BookStatus::getDescription($status) }}</td>
                            <td>
                                @if ($status === BookStatus::BORROWING || $status === BookStatus::EXPIRED)
                                    <button type="button" class="btn-return btn btn-gradient-secondary">User return book</button>
                                @elseif($status === BookStatus::WAIT_TO_PICK_UP)
                                    <button type="button" class="btn-pick_up btn btn-gradient-primary">User pick up book</button>
                                @else
                                    <button type="button" class="btn-delete btn btn-gradient-danger">Delete</button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="card">
                    <div class="card-body">
                        {{ $book_instances->links('vendor.pagination.bootstrap') }}
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
        function handleAction(action, message) {
            $('.btn-' + action).on('click', function () {
                const bookInstanceId = $(this).parent().parent().data('id');
                Swal.fire({
                    title: 'Are you sure?',
                    text: message,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes!',
                    customClass: {
                        confirmButton: 'btn btn-primary',
                        cancelButton: 'btn btn-outline-danger ms-1'
                    },
                    buttonsStyling: false
                }).then(function (result) {
                    if (result.value) {
                        const baseUrl = `https://${window.location.host}`;
                        const url = `${baseUrl}/admin/book-instance/${action === 'delete' ? '' : action + '/'}${bookInstanceId}/`;
                        const data = { _token: '{{ csrf_token() }}' };
                        $.ajax({
                            type: action === 'delete' ? 'DELETE' : 'POST',
                            url: url,
                            data: data,
                        }).then(function () {
                            window.location.reload();
                        });
                    }
                });
            });
        }

        handleAction('return', 'User are returning book ?');
        handleAction('pick_up', 'User are picking up book ?');
        handleAction('delete', "You won't be able to revert this!");



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
        function appendParams(key, value)
        {
            const url = new URL(window.location.href);
            url.searchParams.set(key, value);
            window.location.href = url.toString();
        }
    </script>
@endsection

