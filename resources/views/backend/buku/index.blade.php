@extends('backend.layouts.app')

@push('css')
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}" />
@endpush

@section('title', 'Buku')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="app-ecommerce">
            <div
                class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-6 row-gap-4">
                <div class="d-flex flex-column justify-content-center">
                    <h4 class="mb-1">Buku</h4>
                    <p class="mb-0">Semua daftar buku yang ada di {{ config('app.name') }}</p>
                </div>
            </div>

            @if (session('success'))
                <div class="alert alert-success alert-dismissible" role="alert">
                    {!! session('success') !!}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="card mb-6">
                <div class="card-body">
                    <form action="" method="get">
                        <div class="row">
                            <div class="col-md-3 mb-3 mb-md-0">
                                <div class="input-group input-group-merge h-100">
                                    <span class="input-group-text" id="basic-addon-search31"><i class="ti ti-search"></i></span>
                                    <input type="search" class="form-control" placeholder="Cari..." name="search" value="{{ request('search') }}" aria-label="Cari..." aria-describedby="basic-addon-search31">
                                </div>
                            </div>
                            <div class="col-md-3 mb-3 mb-md-0">
                                <select name="category" class="select2 form-select">
                                    <option value="">Pilih kategori</option>
                                    @foreach ($categories as $item)
                                        <option value="{{ $item->slug }}" {{ request('category') == $item->slug ? 'selected' : '' }}>{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2 mb-3 mb-md-0">
                                <button class="btn btn-primary h-100" type="submit"><i class="ti ti-search ti-sm"></i></button>
                            </div>
                            <div class="col-md-4">
                                <a href="{{ route('panel.books.create') }}" class="btn btn-primary float-start float-md-end h-100">Tambah</a>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="table-responsive">
                    <table class="table w-100">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>Kode Buku</th>
                                <th>Judul Buku</th>
                                <th>Penulis</th>
                                <th class="text-center">Stok Buku</th>
                                <th class="text-center">Stok Tersedia</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($data as $item)
                                <tr>
                                    <td class="text-center">{{ ($data->currentPage() - 1) * $data->perPage() + $loop->iteration }}</td>
                                    <td>{{ $item->code }}</td>
                                    <td>{{ $item->title }}</td>
                                    <td>{{ $item->author }}</td>
                                    <td class="text-center text-primary">{{ $item->stock }}</td>
                                    <td class="text-center text-success">{{ $item->current_stock }}</td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-2">
                                            <a href="{{ route('panel.books.show', $item->id) }}" class="btn btn-sm btn-icon text-success shadow-sm"><i class="ti ti-eye"></i></a>
                                            <a href="{{ route('panel.books.edit', $item->id) }}" class="btn btn-sm btn-icon text-primary shadow-sm"><i class="ti ti-edit"></i></a>
                                            <button type="submit" form="delete-{{ $item->id }}"
                                                class="btn btn-sm btn-icon text-danger shadow-sm"
                                                onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')"><i
                                                    class="ti ti-trash"></i></button>
                                        </div>
                                        <form action="{{ route('panel.books.destroy', $item->id) }}" method="post"
                                            id="delete-{{ $item->id }}">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-center" colspan="7">Tidak ada data yang tersedia.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    {{ $data->appends(['search' => request('search'), 'category' => request('category')])->links() }}
                </div>
            </div>
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
                placeholder: "Pilih kategori",
                dropdownParent: $this.parent(),
                allowClear: true
            });
        });
    }
</script>
@endpush