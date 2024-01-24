<div class="div-banner">
    @isset($book)
        <p>Use this banner</p>
        <div class="d-flex justify-content-center">
            <img class="img-fluid pb-5" width="170px" src="{{ $book->bannerUrl }}">
        </div>
    @endif
    <div class="col-12 pb-2">
        <div class="form-floating">
            <input name="banner" type="file" class="form-control" id="floating-label1" placeholder="Or choose another banner" />
            <label for="floating-label1">{{ isset($book) ? 'Or choose another banner' : 'Choose a banner' }}</label>
        </div>
    </div>
</div>
<div class="col-12 pb-2">
    <div class="form-floating">
        <input name="title" value="{{ $book->title ?? null }}" type="text" class="form-control" id="floating-label1" placeholder="Title" />
        <label for="floating-label1">Title</label>
    </div>
</div>
<div class="col-12 pb-2">
    <div class="form-floating">
        <textarea name="description" class="form-control" placeholder="" id="floatingTextarea2" style="height: 200px">{{ $book->description ?? null }}</textarea>
        <label for="floatingTextarea2">Description</label>
    </div>
</div>
<div class="col-12">
    <div class="form-floating">
        <input name="ISBN" value="{{ $book->ISBN ?? null }}" type="text" class="form-control" id="floating-label1" placeholder="ISBN"/>
        <label for="floating-label1">ISBN</label>
    </div>
</div>
<div class="col-12">
    <label class="form-check-label" for="select2-author-{{ $book->id ?? null }}">Author</label>
    <select name="author_id" class="select2 form-select" id="select2-author-{{ $book->id ?? null }}">
        @foreach($authors as $author)
            <option {{ $author->id === ($book->author_id ?? null) ? 'selected' : '' }} value="{{ $author->id }}">{{ $author->name }}</option>
        @endforeach
    </select>
</div>
<div class="col-12">
    <label class="form-check-label" for="select2-category-{{ $book->id ?? null }}">Category</label>
    <select name="category_id" class="select2 form-select" id="select2-category-{{ $book->id ?? null }}">
        @foreach($categories as $category)
            <option {{ $category->id === ($book->category_id ?? null) ? 'selected' : '' }} value="{{ $category->id }}">{{ $category->name }}</option>
        @endforeach
    </select>
</div>
<div class="col-12 text-center">
    <button type="submit" class="btn btn-primary me-1 mt-2">{{ isset($book) ? 'Update' : 'Create' }}</button>
    <button type="reset" class="btn btn-outline-secondary mt-2" data-bs-dismiss="modal" aria-label="Close">
        Cancel
    </button>
</div>
