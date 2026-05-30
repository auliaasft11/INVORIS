@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>

        <h2 class="fw-bold text-success">
            Data Barang
        </h2>

        <p class="text-muted small">
            Daftar inventaris barang HMSI
        </p>

    </div>

    {{-- BUTTON ADMIN --}}
    @if(Auth::user()->role == 'admin')

    <button class="btn btn-success rounded-pill px-4 fw-bold shadow-sm"
            data-bs-toggle="modal"
            data-bs-target="#tambahBarang">

        + Tambah Barang

    </button>

    @endif

</div>

{{-- BUTTON USER --}}
@if(Auth::user()->role != 'admin')

<div class="d-flex justify-content-end mb-4">

    <button class="btn btn-success rounded-pill px-4 py-2 fw-bold shadow-sm"
            data-bs-toggle="modal"
            data-bs-target="#pinjamBarangModal">

        Pinjam Barang

    </button>

</div>

{{-- MODAL PINJAM BARANG --}}
<div class="modal fade"
     id="pinjamBarangModal"
     tabindex="-1">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content border-0"
             style="border-radius: 20px;">

            <form action="{{ route('peminjaman.store') }}"
                  method="POST">

                @csrf

                <div class="modal-body p-4">

                    <h5 class="fw-bold mb-4 text-center">
                        Form Peminjaman Barang
                    </h5>

                    {{-- PILIH BARANG --}}
                    <div class="mb-3">

                        <label class="fw-bold small mb-2">
                            Pilih Barang
                        </label>

                        <select name="barang_id"
                                class="form-select rounded-3"
                                required>

                            <option value="">
                                -- Pilih Barang --
                            </option>

                            @foreach($barangs as $barang)

                                @if($barang->stok > 0 && $barang->kondisi == 'Ready')

                                <option value="{{ $barang->id }}">
                                    {{ $barang->nama_barang }}
                                    (Stok: {{ $barang->stok }})
                                </option>

                                @endif

                            @endforeach

                        </select>

                    </div>

                    {{-- NAMA PEMINJAM --}}
                    <div class="mb-3">

                        <label class="fw-bold small mb-2">
                            Nama Peminjam
                        </label>

                        <input type="text"
                               name="nama_peminjam"
                               class="form-control rounded-3"
                               value="{{ Auth::user()->name }}"
                               readonly>

                    </div>

                    {{-- JUMLAH PINJAM --}}
                    <div class="mb-3">

                        <label class="fw-bold small mb-2">
                            Jumlah Pinjam
                        </label>

                        <input type="number"
                               name="jumlah_pinjam"
                               class="form-control rounded-3"
                               min="1"
                               required>

                    </div>

                    {{-- TANGGAL PINJAM --}}
                    <div class="mb-3">

                        <label class="fw-bold small mb-2">
                            Tanggal Pinjam
                        </label>

                        <input type="date"
                               name="tgl_pinjam"
                               class="form-control rounded-3"
                               required>

                    </div>

                    {{-- TANGGAL PENGEMBALIAN --}}
                    <div class="mb-4">

                        <label class="fw-bold small mb-2">
                            Tanggal Pengembalian
                        </label>

                        <input type="date"
                               name="tgl_kembali"
                               class="form-control rounded-3"
                               required>

                    </div>

                    <button type="submit"
                            class="btn btn-success w-100 rounded-3 fw-bold">

                        Ajukan Peminjaman

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endif

{{-- TABLE --}}
<div class="card border-0 shadow-sm"
     style="border-radius: 20px; overflow: hidden;">

    <table class="table align-middle mb-0">

        {{-- HEADER HITAM --}}
        <thead>

            <tr style="
                background: linear-gradient(90deg, #0f172a, #111827);
            ">

                <th class="px-5 py-4 border-0"
                    style="
                        background: transparent !important;
                        color: #ffffff !important;
                    ">

                    KODE

                </th>

                <th class="px-4 py-4 border-0"
                    style="
                        background: transparent !important;
                        color: #ffffff !important;
                    ">

                    NAMA BARANG

                </th>

                <th class="px-4 py-4 border-0"
                    style="
                        background: transparent !important;
                        color: #ffffff !important;
                    ">

                    KATEGORI

                </th>

                <th class="text-center px-5 py-4 border-0"
                    style="
                        background: transparent !important;
                        color: #ffffff !important;
                    ">

                    STOK

                </th>

                <th class="text-center px-5 py-4 border-0"
                    style="
                        background: transparent !important;
                        color: #ffffff !important;
                    ">

                    KONDISI

                </th>

            </tr>

        </thead>

        {{-- BODY --}}
        <tbody style="background-color: #ffffff;">

            @forelse($barangs as $b)

            <tr style="
                height: 85px;
                border-bottom: 1px solid #f1f1f1;
            ">

                {{-- KODE --}}
                <td class="px-5 fw-bold text-success">
                    {{ $b->kode_barang }}
                </td>

                {{-- NAMA --}}
                <td class="px-4 fw-semibold text-dark">
                    {{ $b->nama_barang }}
                </td>

                {{-- KATEGORI --}}
                <td class="px-4">

                    <span class="badge bg-light text-dark border px-3 py-2">
                        {{ $b->kategori }}
                    </span>

                </td>

                {{-- STOK --}}
                <td class="text-center px-5">

                    <span class="fw-bold text-primary">
                        {{ $b->stok }}
                    </span>

                </td>

                {{-- KONDISI --}}
                <td class="text-center px-5">

                    @if($b->kondisi == 'Ready')

                        <span class="badge bg-success px-4 py-2 rounded-pill">
                            Ready
                        </span>

                    @else

                        <span class="badge bg-danger px-4 py-2 rounded-pill">
                            Rusak
                        </span>

                    @endif

                </td>

            </tr>

            @empty

            <tr>

                <td colspan="5"
                    class="text-center py-5 text-muted">

                    Data barang kosong.

                </td>

            </tr>

            @endforelse

        </tbody>

    </table>

</div>

{{-- MODAL TAMBAH BARANG --}}
@if(Auth::user()->role == 'admin')

<div class="modal fade"
     id="tambahBarang"
     tabindex="-1">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content border-0"
             style="border-radius: 25px;">

            <form action="{{ route('barang.store') }}"
                  method="POST">

                @csrf

                <div class="modal-body p-4">

                    <h5 class="fw-bold mb-4 text-center">
                        Tambah Barang Baru
                    </h5>

                    {{-- KODE --}}
                    <div class="mb-3">

                        <label class="small fw-bold mb-2">
                            Kode Barang
                        </label>

                        <input type="text"
                               name="kode_barang"
                               class="form-control rounded-3"
                               placeholder="BRG-001"
                               required>

                    </div>

                    {{-- NAMA --}}
                    <div class="mb-3">

                        <label class="small fw-bold mb-2">
                            Nama Barang
                        </label>

                        <input type="text"
                               name="nama_barang"
                               class="form-control rounded-3"
                               required>

                    </div>

                    {{-- KATEGORI & STOK --}}
                    <div class="row">

                        <div class="col-6 mb-3">

                            <label class="small fw-bold mb-2">
                                Kategori
                            </label>

                            <select name="kategori"
                                    class="form-select rounded-3"
                                    required>

                                <option value="Elektronik">
                                    Elektronik
                                </option>

                                <option value="Multimedia">
                                    Multimedia
                                </option>

                                <option value="Furniture">
                                    Furniture
                                </option>

                            </select>

                        </div>

                        <div class="col-6 mb-3">

                            <label class="small fw-bold mb-2">
                                Stok
                            </label>

                            <input type="number"
                                   name="stok"
                                   class="form-control rounded-3"
                                   min="1"
                                   required>

                        </div>

                    </div>

                    {{-- KONDISI --}}
                    <div class="mb-3">

                        <label class="small fw-bold mb-2">
                            Kondisi
                        </label>

                        <select name="kondisi"
                                class="form-select rounded-3"
                                required>

                            <option value="Ready">
                                Ready
                            </option>

                            <option value="Rusak">
                                Rusak
                            </option>

                        </select>

                    </div>

                    <input type="hidden"
                           name="lokasi"
                           value="Gudang">

                    <button type="submit"
                            class="btn btn-success w-100 rounded-3 fw-bold py-2">

                        Simpan Barang

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endif

@endsection