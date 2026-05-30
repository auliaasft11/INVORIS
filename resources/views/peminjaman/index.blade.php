@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>

        {{-- JUDUL ADMIN / USER --}}
        @if(Auth::user()->role == 'admin')

            <h2 class="fw-bold text-success">
                Peminjaman
            </h2>

            <p class="text-muted small">
                Daftar barang yang sedang dipinjam
            </p>

        @else

            <h2 class="fw-bold text-success">
                Riwayat Peminjaman
            </h2>

            <p class="text-muted small">
                Riwayat peminjaman barang Anda
            </p>

        @endif

    </div>

    {{-- BADGE ADMIN --}}
    @if(Auth::user()->role == 'admin')

        <span class="badge bg-secondary px-4 py-2 rounded-pill shadow-sm">
            Mode Admin
        </span>

    @endif

</div>

{{-- TABLE --}}
<div class="card border-0 shadow-sm"
     style="border-radius: 20px; overflow: hidden;">

    <table class="table align-middle mb-0">

        {{-- HEADER --}}
        <thead>

            <tr style="
                background: linear-gradient(90deg, #111827, #1f2937);
            ">

                <th style="
                    background: transparent !important;
                    color: white !important;
                " class="px-4 py-4 border-0">

                    TGL PINJAM

                </th>

                <th style="
                    background: transparent !important;
                    color: white !important;
                " class="py-4 border-0">

                    TGL KEMBALI

                </th>

                @if(Auth::user()->role == 'admin')

                <th style="
                    background: transparent !important;
                    color: white !important;
                " class="py-4 border-0">

                    PEMINJAM

                </th>

                @endif

                <th style="
                    background: transparent !important;
                    color: white !important;
                " class="py-4 border-0">

                    BARANG

                </th>

                <th style="
                    background: transparent !important;
                    color: white !important;
                " class="text-center py-4 border-0">

                    JUMLAH

                </th>

                <th style="
                    background: transparent !important;
                    color: white !important;
                " class="text-center py-4 border-0">

                    STATUS

                </th>

                @if(Auth::user()->role == 'admin')

                <th style="
                    background: transparent !important;
                    color: white !important;
                " class="text-center py-4 pe-4 border-0">

                    AKSI

                </th>

                @endif

            </tr>

        </thead>

        {{-- BODY --}}
        <tbody style="background-color: #ffffff;">

            @forelse($peminjamans as $p)

            <tr style="
                height: 85px;
                border-bottom: 1px solid #f1f1f1;
            ">

                {{-- TANGGAL PINJAM --}}
                <td class="px-4">

                    <div class="fw-bold text-success">
                        {{ $p->tgl_pinjam }}
                    </div>

                </td>

                {{-- TANGGAL KEMBALI --}}
                <td>

                    <div class="fw-bold text-danger">
                        {{ $p->tgl_kembali }}
                    </div>

                </td>

                {{-- PEMINJAM --}}
                @if(Auth::user()->role == 'admin')

                    <td>

                        <span class="fw-bold text-dark">
                            {{ $p->nama_peminjam }}
                        </span>

                    </td>

                @endif

                {{-- BARANG --}}
                <td>

                    <div class="fw-semibold text-dark">
                        {{ $p->barang->nama_barang ?? 'N/A' }}
                    </div>

                </td>

                {{-- JUMLAH --}}
                <td class="text-center">

                    <span class="badge bg-light text-dark border px-3 py-2">
                        {{ $p->jumlah_pinjam }}
                    </span>

                </td>

                {{-- STATUS --}}
                <td class="text-center">

                    @if($p->status == 'Dipinjam')

                        <span class="badge bg-warning text-dark px-4 py-2 rounded-pill shadow-sm">
                            {{ $p->status }}
                        </span>

                    @else

                        <span class="badge bg-success px-4 py-2 rounded-pill shadow-sm">
                            {{ $p->status }}
                        </span>

                    @endif

                </td>

                {{-- AKSI ADMIN --}}
                @if(Auth::user()->role == 'admin')

                <td class="text-center pe-4">

                    @if($p->status == 'Dipinjam')

                    <form id="form-selesai-{{ $p->id }}"
                          action="{{ route('peminjaman.selesai', $p->id) }}"
                          method="POST">

                        @csrf
                        @method('PUT')

                        <button type="button"
                                class="btn btn-success btn-sm rounded-pill px-4 shadow-sm btn-selesai"
                                data-id="{{ $p->id }}">

                            Selesai

                        </button>

                    </form>

                    @else

                        <span class="text-muted small">
                            Sudah selesai
                        </span>

                    @endif

                </td>

                @endif

            </tr>

            @empty

            <tr>

                @if(Auth::user()->role == 'admin')

                    <td colspan="7"
                        class="text-center py-5 text-muted">

                        Tidak ada barang yang sedang dipinjam.

                    </td>

                @else

                    <td colspan="5"
                        class="text-center py-5 text-muted">

                        Belum ada riwayat peminjaman.

                    </td>

                @endif

            </tr>

            @endforelse

        </tbody>

    </table>

</div>

{{-- SWEET ALERT SUCCESS --}}
@if(session('success'))

<script>

document.addEventListener('DOMContentLoaded', function () {

    Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: "{{ session('success') }}",
        confirmButtonColor: '#10b981',
        timer: 2200,
        showConfirmButton: false
    });

});

</script>

@endif

{{-- SWEET ALERT ERROR --}}
@if(session('error'))

<script>

document.addEventListener('DOMContentLoaded', function () {

    Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: "{{ session('error') }}",
        confirmButtonColor: '#ef4444'
    });

});

</script>

@endif

{{-- SWEET ALERT CONFIRM --}}
<script>

document.addEventListener('DOMContentLoaded', function () {

    const selesaiButtons = document.querySelectorAll('.btn-selesai');

    selesaiButtons.forEach(function(button) {

        button.addEventListener('click', function () {

            let id = this.dataset.id;

            Swal.fire({
                title: 'Selesaikan Peminjaman?',
                text: 'Pastikan barang sudah dikembalikan.',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#10b981',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Ya, Selesaikan',
                cancelButtonText: 'Batal'

            }).then((result) => {

                if (result.isConfirmed) {

                    document.getElementById('form-selesai-' + id).submit();

                }

            });

        });

    });

});

</script>

@endsection