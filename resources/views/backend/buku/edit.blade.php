@extends('backend.layouts.app')

@push('css')
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}" />
@endpush

@section('title', 'Edit Buku')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="app-ecommerce">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-6 row-gap-4">
                <div class="d-flex flex-column justify-content-center">
                    <h4 class="mb-1">Edit Buku</h4>
                    <p class="mb-0">Edit spesifikasi dan detail buku</p>
                </div>
                <div class="d-flex align-content-center flex-wrap gap-4">
                    <a href="{{ route('panel.books.index') }}" class="btn btn-label-primary">Kembali</a>
                    <button type="submit" class="btn btn-primary" form="formUpdateBuku">Update</button>
                </div>
            </div>

            <form action="{{ route('panel.books.update', $book->id) }}" method="post" enctype="multipart/form-data" id="formUpdateBuku">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-8">
                        <div class="card mb-6">
                            <div class="card-header">
                                <h5 class="card-title">Detail Buku</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label">Kode Buku</label>
                                    <input type="text" class="form-control @error('code') is-invalid @enderror" name="code" value="{{ $book->code ?? old('code') }}">
                                    @error('code')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Judul Buku</label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ $book->title ?? old('title') }}">
                                    @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label">Author</label>
                                        <input type="text" class="form-control @error('author') is-invalid @enderror" name="author" value="{{ $book->author ?? old('author') }}">
                                        @error('author')
                                            <span class="invalid-feedback" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label">Stok Buku</label>
                                        <input type="number" class="form-control @error('stock') is-invalid @enderror" name="stock" value="{{ $book->stock ?? old('stock') }}">
                                        @error('stock')
                                            <span class="invalid-feedback" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Deskripsi</label>
                                    <textarea class="form-control @error('description') is-invalid @enderror" name="description" rows="10">{{ $book->description ?? old('description') }}</textarea>
                                    @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card mb-6">
                            <div class="card-header">
                                <h5 class="card-title">Kategori Buku</h5>
                            </div>
                            <div class="card-body">
                                <select class="select2 form-select @error('category') is-invalid @enderror" name="category[]" multiple>
                                    @foreach ($categories as $item)
                                        <option {{ $book->bookCategories->where('category_id', $item->id)->first() ? 'selected' : '' }} value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                @error('category')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="card mb-6">
                            <div class="card-header">
                                <h5 class="card-title">Cover Buku</h5>
                            </div>
                            <div class="card-body">
                                <img src="{{ asset('storage/' . $book->cover) }}" width="100%" alt="" class="mb-4">
                                <input type="file" name="cover" class="form-control @error('cover') is-invalid @enderror" accept="image/*">
                                @error('cover')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('js')
<script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>
<script>
    const select2 = $('.select2')
    if (select2.length) {
        select2.each(function () {
            var $this = $(this);
            $this.wrap('<div class="position-relative"></div>').select2({
                placeholder: 'Pilih kategori',
                dropdownParent: $this.parent(),
                minimumResultsForSearch: Infinity,
                search: function () {
                    var term = $(this).val();
                    if (term.length < 2) {
                        return false;
                    }
                }
            });
        });
    }
</script>
@endpush