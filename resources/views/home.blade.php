@extends('layouts.app')

@section('content')

<div class="mb-4">

    <h2 class="fw-bold text-dark">
        Dashboard Overview
    </h2>

    <p class="text-muted">
        Selamat datang kembali,
        <strong>{{ Auth::user()->name }}</strong>!
    </p>

</div>

{{-- CARD SUMMARY --}}
<div class="row g-4 mb-5">

    {{-- TOTAL BARANG --}}
    <div class="col-md-4">

        <div class="card border-0 shadow-sm p-4"
             style="border-radius: 20px; background: #fff;">

            <div class="d-flex align-items-center">

                <div class="rounded-circle bg-success bg-opacity-10 p-3 me-3">
                    <span class="text-success fw-bold">📦</span>
                </div>

                <div>

                    <h6 class="text-muted mb-1 small fw-bold">
                        Total Jenis Barang
                    </h6>

                    <h3 class="fw-bold mb-0 text-dark">
                        {{ $totalBarang }}
                    </h3>

                </div>

            </div>

        </div>

    </div>

    {{-- TOTAL STOK --}}
    <div class="col-md-4">

        <div class="card border-0 shadow-sm p-4"
             style="border-radius: 20px; background: #fff;">

            <div class="d-flex align-items-center">

                <div class="rounded-circle bg-primary bg-opacity-10 p-3 me-3">
                    <span class="text-primary fw-bold">📊</span>
                </div>

                <div>

                    @if(Auth::user()->role == 'admin')

                        <h6 class="text-muted mb-1 small fw-bold">
                            Total Unit Stok
                        </h6>

                    @else

                        <h6 class="text-muted mb-1 small fw-bold">
                            Barang Ready
                        </h6>

                    @endif

                    <h3 class="fw-bold mb-0 text-dark">
                        {{ $totalStok }}
                    </h3>

                </div>

            </div>

        </div>

    </div>

    {{-- PEMINJAMAN --}}
    <div class="col-md-4">

        <div class="card border-0 shadow-sm p-4"
             style="border-radius: 20px; background: #fff;">

            <div class="d-flex align-items-center">

                <div class="rounded-circle bg-warning bg-opacity-10 p-3 me-3">
                    <span class="text-warning fw-bold">⏳</span>
                </div>

                <div>

                    @if(Auth::user()->role == 'admin')

                        <h6 class="text-muted mb-1 small fw-bold">
                            Transaksi Aktif
                        </h6>

                    @else

                        <h6 class="text-muted mb-1 small fw-bold">
                            Peminjaman Aktif
                        </h6>

                    @endif

                    <h3 class="fw-bold mb-0 text-dark">
                        {{ $barangPinjam }}
                    </h3>

                </div>

            </div>

        </div>

    </div>

</div>

{{-- TABLE --}}
<div class="card border-0 shadow-sm"
     style="border-radius: 20px; overflow: hidden;">

    <div class="card-body p-0">

        {{-- TITLE --}}
        <div class="px-4 pt-4 pb-2">

            @if(Auth::user()->role == 'admin')

                <h5 class="fw-bold text-dark mb-0">
                    Aktivitas Peminjaman Terbaru
                </h5>

            @else

                <h5 class="fw-bold text-dark mb-0">
                    Peminjaman Aktif
                </h5>

            @endif

        </div>

        <div class="table-responsive">

            <table class="table align-middle mb-0">

                {{-- HEADER --}}
                <thead style="background: linear-gradient(90deg, #146c43, #198754); color: white;">

                    <tr>

                        @if(Auth::user()->role == 'admin')

                            <th class="px-4 py-4">
                                PEMINJAM
                            </th>

                        @endif

                        <th class="py-4 px-4">
                            BARANG
                        </th>

                        <th class="py-4 px-4">
                            TGL PINJAM
                        </th>

                        <th class="py-4 px-4">
                            TGL KEMBALI
                        </th>

                        <th class="py-4 px-4 text-center">
                            STATUS
                        </th>

                    </tr>

                </thead>

                {{-- BODY --}}
                <tbody>

                    @forelse($recentActivities as $activity)

                    <tr style="height: 85px; border-bottom: 1px solid #f1f1f1;">

                        {{-- PEMINJAM --}}
                        @if(Auth::user()->role == 'admin')

                            <td class="px-4">

                                <span class="fw-bold text-dark">
                                    {{ $activity->nama_peminjam }}
                                </span>

                            </td>

                        @endif

                        {{-- BARANG --}}
                        <td class="px-4">

                            <span class="fw-semibold text-dark">
                                {{ $activity->barang->nama_barang ?? 'N/A' }}
                            </span>

                        </td>

                        {{-- TANGGAL PINJAM --}}
                        <td class="px-4">

                            <span class="fw-semibold text-success">
                                {{ \Carbon\Carbon::parse($activity->tgl_pinjam)->format('d M Y') }}
                            </span>

                        </td>

                        {{-- TANGGAL KEMBALI --}}
                        <td class="px-4">

                            <span class="fw-semibold text-danger">
                                {{ \Carbon\Carbon::parse($activity->tgl_kembali)->format('d M Y') }}
                            </span>

                        </td>

                        {{-- STATUS --}}
                        <td class="text-center px-4">

                            <span class="badge bg-warning text-dark px-4 py-2 rounded-pill shadow-sm">
                                {{ $activity->status }}
                            </span>

                        </td>

                    </tr>

                    @empty

                    <tr>

                        @if(Auth::user()->role == 'admin')

                            <td colspan="5"
                                class="text-center py-5 text-muted">

                                Belum ada aktivitas terbaru.

                            </td>

                        @else

                            <td colspan="4"
                                class="text-center py-5 text-muted">

                                Belum ada data peminjaman.

                            </td>

                        @endif

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection