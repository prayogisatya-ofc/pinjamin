@extends('backend.layouts.app')

@section('title', 'Detail Buku')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="app-ecommerce">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-6 row-gap-4">
                <div class="d-flex flex-column justify-content-center">
                    <h4 class="mb-1">Detail Buku</h4>
                    <p class="mb-0">Lihat spesifikasi dan detail buku</p>
                </div>
                <div class="d-flex align-content-center flex-wrap gap-4">
                    <a href="{{ route('panel.books.index') }}" class="btn btn-label-primary">Kembali</a>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="card mb-6">
                        <div class="row">
                            <div class="col-md-4">
                                <img src="{{ asset('storage/' . $book->cover) }}" alt="" class="rounded-start h-100 w-100">
                            </div>
                            <div class="card-body d-flex col-md-8">
                                <table class="w-100 align-middle">
                                    <tr>
                                        <th class="pb-2">Kode Buku</th>
                                        <td class="pb-2">: #{{ $book->code }}</td>
                                    </tr>
                                    <tr>
                                        <th class="pb-2">Judul Buku</th>
                                        <td class="pb-2">: {{ $book->title }}</td>
                                    </tr>
                                    <tr>
                                        <th class="pb-2">Penulis</th>
                                        <td class="pb-2">: {{ $book->author }}</td>
                                    </tr>
                                    <tr>
                                        <th class="pb-2">Stok Buku</th>
                                        <td class="pb-2">: <span class="text-primary">{{ $book->stock }}</span></td>
                                    </tr>
                                    <tr>
                                        <th class="pb-2">Stok Tersedia</th>
                                        <td class="pb-2">: <span class="text-success">{{ $book->current_stock }}</span></td>
                                    </tr>
                                    <tr>
                                        <th class="pb-2">Kategori</th>
                                        <td class="pb-2">: 
                                            @foreach ($book->bookCategories as $item)
                                                <span class="badge bg-label-primary">{{ $item->category->name }}</span>
                                            @endforeach
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card mb-6">
                        <div class="card-body">
                            <table>
                                <tr>
                                    <th class="pb-2">Deskripsi</th>
                                    <td class="pb-2"></td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <div class="overflow-hidden mb-1" style="max-height: 100px" id="description">
                                            {!! Str::markdown($book->description) !!}
                                        </div>
                                    </td>
                                </tr>
                            </table>
                            <a href="#" id="read-more" onclick="toggleReadMore()">Selengkapnya</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-6">
                <div class="card-header">
                    <h5 class="card-title mb-0">Buku Dipinjam</h5>
                </div>
                <div class="table-responsive">
                    <table class="table w-100 text-nowrap">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>Nama Peminjam</th>
                                <th>Tanggal Pinjam</th>
                                <th>Tanggal Kembali</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $bookRented = $book->bookRented()->paginate(10);
                            @endphp
                            @forelse ($bookRented as $item)
                            <tr>
                                <td class="text-center">{{ ($bookRented->currentPage() - 1) * $bookRented->perPage() + $loop->iteration }}</td>
                                <td>{{ $item->rent->user->name }}</td>
                                <td>{{ $item->rent->rent_date->format('d-m-Y') }}</td>
                                <td>{{ $item->rent->return_date->format('d-m-Y') }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center">Buku tidak ada yang meminjam</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    {{ $bookRented->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
<script>
    function toggleReadMore() {
        const description = document.getElementById(`description`);
        const button = document.getElementById(`read-more`);

        if (description.style.maxHeight === '100px') {
            description.style.maxHeight = 'none';
            button.textContent = 'Lebih Sedikit';
        } else {
            description.style.maxHeight = '100px';
            button.textContent = 'Selengkapnya';
        }
    }
</script>
@endpush