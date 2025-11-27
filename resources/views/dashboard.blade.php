@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

@push('styles')
    {{-- Load dashboard-specific CSS from Vite (fallback via layout asset exists) --}}
    @vite(['resources/css/dashboard.css'])
@endpush


    <div class="row">

        <!-- Welcome Section -->
        <div class="col-12 mb-4 mt-2">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Selamat Datang, {{ Auth::user()->name }}</h4>
                    <p class="card-text">Sistem Informasi Manajemen Aset</p>
                </div>
            </div>
        </div>

        <!-- Quick Stats -->
        <div class="col-md-3 mb-4">
    <div class="card-stat bg-primary">
        <h5>Total Tanah</h5>
        <h2>{{ $totalTanah ?? 0 }}</h2>
    </div>
</div>

<div class="col-md-3 mb-4">
    <div class="card-stat bg-success">
        <h5>Total Bangunan</h5>
        <h2>{{ $totalBangunan ?? 0 }}</h2>
    </div>
</div>

<div class="col-md-3 mb-4">
    <div class="card-stat bg-warning">
        <h5>Total Ruangan</h5>
        <h2>{{ $totalRuangan ?? 0 }}</h2>
    </div>
</div>

<div class="col-md-3 mb-4">
    <div class="card-stat bg-danger">
        <h5>Total Barang</h5>
        <h2>{{ $totalBarang ?? 0 }}</h2>
    </div>
</div>
        <!-- Recent Activity -->
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Aktivitas Terakhir</h5>
                </div>
                <div class="card-body">

                    @if (isset($recentActivities) && count($recentActivities) > 0)
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Aktivitas</th>
                                        <th>User</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($recentActivities as $activity)
                                        <tr>
                                            <td>{{ $activity->created_at->format('d/m/Y H:i') }}</td>
                                            <td>{{ $activity->description }}</td>

                                            <!-- Tampilkan nama user + role -->
                                            <td>
                                                {{ $activity->user->name }}
                                                <span class="text-muted">
                                                    ({{ $activity->user->role ?? 'Tidak ada role' }})
                                                </span>
                                            </td>

                                            <td>{{ $activity->status }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center text-muted">
                                                Tidak ada aktivitas terbaru
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-center text-muted">Tidak ada aktivitas terbaru</p>
                    @endif

                </div>
            </div>
        </div>

    </div>
@endsection

@push('scripts')
    <script>
        // Custom JS
    </script>
@endpush
