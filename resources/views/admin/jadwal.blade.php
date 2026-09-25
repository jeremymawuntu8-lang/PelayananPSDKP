@extends('layouts.app')
@section('title', 'Jadwal Kedatangan')
@section('page-title', 'Jadwal Kedatangan')
@section('breadcrumb')
<li class="breadcrumb-item active">Jadwal</li>
@endsection

@push('styles')
<style>
    /* ===== LIVING DASHBOARD STYLES ===== */
    
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }
    @keyframes pulse-glow {
        0%, 100% { box-shadow: 0 0 15px rgba(236, 163, 19, 0.3); }
        50% { box-shadow: 0 0 30px rgba(236, 163, 19, 0.6); }
    }
    @keyframes shimmer {
        0% { background-position: -200% 0; }
        100% { background-position: 200% 0; }
    }
    @keyframes float {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-6px); }
    }
    @keyframes blink-dot {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.3; }
    }
    @keyframes slideInLeft {
        from { opacity: 0; transform: translateX(-40px); }
        to { opacity: 1; transform: translateX(0); }
    }
    @keyframes countUp {
        from { opacity: 0; transform: scale(0.5); }
        to { opacity: 1; transform: scale(1); }
    }

    .jadwal-page { padding: 0 0.5rem; }

    /* ===== HERO STATS ===== */
    .hero-stats {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1.5rem;
        margin-bottom: 2rem;
    }
    .hero-stat-card {
        background: white;
        border-radius: 1.25rem;
        padding: 1.75rem;
        position: relative;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0,0,0,0.04);
        border: 1px solid rgba(0,0,0,0.04);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        animation: fadeInUp 0.6s ease both;
        cursor: pointer;
        text-decoration: none !important;
    }
    .hero-stat-card:nth-child(1) { animation-delay: 0.1s; }
    .hero-stat-card:nth-child(2) { animation-delay: 0.2s; }
    .hero-stat-card:nth-child(3) { animation-delay: 0.3s; }
    .hero-stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 35px rgba(0,0,0,0.1);
    }
    .hero-stat-card.active-filter {
        border: 2px solid;
    }
    .hero-stat-card.active-filter.today-card { border-color: #F59E0B; background: linear-gradient(135deg, #FFFBEB 0%, #FEF3C7 100%); }
    .hero-stat-card.active-filter.upcoming-card { border-color: #3B82F6; background: linear-gradient(135deg, #EFF6FF 0%, #DBEAFE 100%); }
    .hero-stat-card.active-filter.past-card { border-color: #6B7280; background: linear-gradient(135deg, #F9FAFB 0%, #F3F4F6 100%); }
    
    .hero-stat-card::before {
        content: '';
        position: absolute;
        top: 0; right: 0;
        width: 120px; height: 120px;
        border-radius: 50%;
        opacity: 0.08;
        transform: translate(30px, -30px);
    }
    .today-card::before { background: #F59E0B; }
    .upcoming-card::before { background: #3B82F6; }
    .past-card::before { background: #6B7280; }

    .stat-icon-wrap {
        width: 56px; height: 56px;
        border-radius: 1rem;
        display: flex; align-items: center; justify-content: center;
        margin-bottom: 1rem;
        transition: transform 0.3s ease;
    }
    .hero-stat-card:hover .stat-icon-wrap { transform: scale(1.1); }
    .today-card .stat-icon-wrap { background: linear-gradient(135deg, #F59E0B, #D97706); }
    .upcoming-card .stat-icon-wrap { background: linear-gradient(135deg, #3B82F6, #2563EB); }
    .past-card .stat-icon-wrap { background: linear-gradient(135deg, #6B7280, #4B5563); }
    .stat-icon-wrap i { color: white; font-size: 1.3rem; }
    
    .stat-number {
        font-size: 2.5rem;
        font-weight: 800;
        line-height: 1;
        margin-bottom: 0.25rem;
        animation: countUp 0.8s ease both;
    }
    .today-card .stat-number { color: #B45309; }
    .upcoming-card .stat-number { color: #1D4ED8; }
    .past-card .stat-number { color: #374151; }
    .stat-label {
        font-size: 0.85rem;
        font-weight: 600;
        color: #6B7280;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    /* ===== FILTER BAR ===== */
    .filter-bar {
        display: flex;
        gap: 0.5rem;
        margin-bottom: 2rem;
        background: white;
        border-radius: 1rem;
        padding: 0.5rem;
        box-shadow: 0 2px 10px rgba(0,0,0,0.04);
        border: 1px solid rgba(0,0,0,0.05);
        animation: fadeInUp 0.6s ease 0.35s both;
    }
    .filter-btn {
        padding: 0.6rem 1.25rem;
        border-radius: 0.75rem;
        border: none;
        font-weight: 700;
        font-size: 0.82rem;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        color: #6B7280;
        background: transparent;
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
    }
    .filter-btn:hover { background: #F3F4F6; color: #1F2937; }
    .filter-btn.active-today { background: linear-gradient(135deg, #F59E0B, #D97706); color: white; box-shadow: 0 4px 12px rgba(245,158,11,0.3); }
    .filter-btn.active-upcoming { background: linear-gradient(135deg, #3B82F6, #2563EB); color: white; box-shadow: 0 4px 12px rgba(59,130,246,0.3); }
    .filter-btn.active-past { background: linear-gradient(135deg, #6B7280, #4B5563); color: white; box-shadow: 0 4px 12px rgba(107,114,128,0.3); }
    .filter-btn.active-all { background: linear-gradient(135deg, #1F2937, #111827); color: white; box-shadow: 0 4px 12px rgba(31,41,55,0.3); }

    /* ===== SCHEDULE CARDS ===== */
    .schedule-card {
        background: white;
        border-radius: 1.25rem;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0,0,0,0.04);
        border: 1px solid rgba(0,0,0,0.04);
        margin-bottom: 1.25rem;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        animation: slideInLeft 0.5s ease both;
    }
    .schedule-card:hover {
        transform: translateX(5px);
        box-shadow: 0 8px 30px rgba(0,0,0,0.08);
    }
    .schedule-card.is-today {
        border-left: 5px solid #F59E0B;
        animation: pulse-glow 3s infinite ease-in-out, slideInLeft 0.5s ease both;
    }
    .schedule-card.is-past {
        opacity: 0.6;
        border-left: 5px solid #D1D5DB;
    }
    .schedule-card-inner {
        display: flex;
        align-items: stretch;
        min-height: 140px;
    }

    /* Date column */
    .date-column {
        min-width: 140px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 1.5rem;
        position: relative;
    }
    .is-today .date-column {
        background: linear-gradient(180deg, #FFFBEB 0%, #FEF3C7 100%);
    }
    .date-big {
        font-size: 3rem;
        font-weight: 900;
        line-height: 1;
        color: #0A3D6B;
    }
    .is-today .date-big { color: #B45309; }
    .date-month {
        font-size: 0.85rem;
        font-weight: 700;
        color: #6B7280;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    .time-badge {
        margin-top: 0.75rem;
        padding: 0.4rem 1rem;
        border-radius: 2rem;
        font-weight: 800;
        font-size: 0.9rem;
        background: linear-gradient(135deg, #0A3D6B, #1A5288);
        color: white;
        box-shadow: 0 3px 10px rgba(10, 61, 107, 0.3);
    }
    .is-today .time-badge {
        background: linear-gradient(135deg, #F59E0B, #D97706);
        box-shadow: 0 3px 10px rgba(245,158,11,0.3);
    }
    .today-pulse {
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
        margin-top: 0.5rem;
        padding: 0.25rem 0.75rem;
        border-radius: 2rem;
        background: #EF4444;
        color: white;
        font-size: 0.65rem;
        font-weight: 800;
        letter-spacing: 1px;
        text-transform: uppercase;
    }
    .today-pulse .dot {
        width: 6px; height: 6px;
        background: white;
        border-radius: 50%;
        animation: blink-dot 1s infinite;
    }

    /* Info column */
    .info-column {
        flex: 1;
        padding: 1.5rem 1.5rem 1.5rem 1.75rem;
        border-left: 1px solid #F3F4F6;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }
    .ship-name {
        font-size: 1.15rem;
        font-weight: 800;
        color: #0A3D6B;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-bottom: 0.4rem;
    }
    .ship-name i { color: #3B82F6; }
    .owner-name {
        font-size: 0.85rem;
        font-weight: 600;
        color: #6B7280;
        margin-bottom: 0.5rem;
    }
    .owner-name i { color: #9CA3AF; margin-right: 0.25rem; }
    .subject-text {
        font-size: 0.82rem;
        color: #4B5563;
        margin-bottom: 0.75rem;
    }
    .attendance-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
        padding: 0.35rem 0.9rem;
        border-radius: 2rem;
        font-size: 0.78rem;
        font-weight: 700;
    }
    .attendance-badge.sendiri {
        background: linear-gradient(135deg, #ECFDF5, #D1FAE5);
        color: #065F46;
        border: 1px solid #A7F3D0;
    }
    .attendance-badge.diwakilkan {
        background: linear-gradient(135deg, #EFF6FF, #DBEAFE);
        color: #1E40AF;
        border: 1px solid #93C5FD;
    }
    .delegate-note {
        margin-top: 0.25rem;
        font-size: 0.75rem;
        color: #6B7280;
        font-weight: 600;
        padding-left: 0.25rem;
    }
    .doc-tags {
        display: flex;
        flex-wrap: wrap;
        gap: 0.4rem;
        margin-top: 0.6rem;
    }
    .doc-tag {
        font-size: 0.68rem;
        padding: 0.25rem 0.6rem;
        border-radius: 0.5rem;
        background: #F3F4F6;
        color: #374151;
        font-weight: 600;
        border: 1px solid #E5E7EB;
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
    }
    .doc-tag i { color: #3B82F6; font-size: 0.6rem; }

    /* Action column */
    .action-column {
        min-width: 160px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 1.5rem;
        gap: 0.6rem;
        border-left: 1px solid #F3F4F6;
    }
    .action-btn {
        width: 100%;
        padding: 0.6rem 1rem;
        border-radius: 0.75rem;
        font-weight: 700;
        font-size: 0.8rem;
        border: none;
        cursor: pointer;
        text-decoration: none;
        text-align: center;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.4rem;
        transition: all 0.3s ease;
    }
    .action-btn.primary {
        background: linear-gradient(135deg, #0A3D6B, #1A5288);
        color: white;
        box-shadow: 0 3px 10px rgba(10,61,107,0.2);
    }
    .action-btn.primary:hover { transform: translateY(-2px); box-shadow: 0 6px 15px rgba(10,61,107,0.3); color: white; }
    .action-btn.whatsapp {
        background: linear-gradient(135deg, #25D366, #128C7E);
        color: white;
        box-shadow: 0 3px 10px rgba(37,211,102,0.2);
    }
    .action-btn.whatsapp:hover { transform: translateY(-2px); box-shadow: 0 6px 15px rgba(37,211,102,0.3); color: white; }

    /* Empty state */
    .empty-state {
        text-align: center;
        padding: 5rem 2rem;
        background: white;
        border-radius: 1.25rem;
        box-shadow: 0 4px 20px rgba(0,0,0,0.04);
        animation: fadeInUp 0.6s ease both;
    }
    .empty-state i {
        font-size: 4rem;
        color: #D1D5DB;
        animation: float 3s infinite ease-in-out;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .hero-stats { grid-template-columns: 1fr; gap: 1rem; }
        .schedule-card-inner { flex-direction: column; }
        .date-column { flex-direction: row; gap: 1rem; min-width: auto; padding: 1rem 1.5rem; }
        .is-today .date-column { border-radius: 0; }
        .date-big { font-size: 2rem; }
        .info-column { border-left: none; border-top: 1px solid #F3F4F6; }
        .action-column { flex-direction: row; border-left: none; border-top: 1px solid #F3F4F6; min-width: auto; }
        .action-btn { flex: 1; }
        .filter-bar { flex-wrap: wrap; }
    }
</style>
@endpush

@section('content')
<div class="jadwal-page">

    {{-- Hero Stats --}}
    <div class="hero-stats">
        <a href="{{ route('jadwal.index', ['filter' => 'today']) }}" class="hero-stat-card today-card {{ $filter == 'today' ? 'active-filter' : '' }}">
            <div class="stat-icon-wrap">
                <i class="fas fa-calendar-day"></i>
            </div>
            <div class="stat-number">{{ $stats['today'] }}</div>
            <div class="stat-label">Hari Ini</div>
        </a>
        <a href="{{ route('jadwal.index', ['filter' => 'upcoming']) }}" class="hero-stat-card upcoming-card {{ $filter == 'upcoming' ? 'active-filter' : '' }}">
            <div class="stat-icon-wrap">
                <i class="fas fa-clock"></i>
            </div>
            <div class="stat-number">{{ $stats['upcoming'] }}</div>
            <div class="stat-label">Akan Datang</div>
        </a>
        <a href="{{ route('jadwal.index', ['filter' => 'past']) }}" class="hero-stat-card past-card {{ $filter == 'past' ? 'active-filter' : '' }}">
            <div class="stat-icon-wrap">
                <i class="fas fa-history"></i>
            </div>
            <div class="stat-number">{{ $stats['past'] }}</div>
            <div class="stat-label">Sudah Lewat</div>
        </a>
    </div>

    {{-- Filter Bar --}}
    <div class="filter-bar">
        <a href="{{ route('jadwal.index', ['filter' => 'today']) }}" class="filter-btn {{ $filter == 'today' ? 'active-today' : '' }}">
            <i class="fas fa-sun"></i> Hari Ini
        </a>
        <a href="{{ route('jadwal.index', ['filter' => 'upcoming']) }}" class="filter-btn {{ $filter == 'upcoming' ? 'active-upcoming' : '' }}">
            <i class="fas fa-arrow-right"></i> Akan Datang
        </a>
        <a href="{{ route('jadwal.index', ['filter' => 'past']) }}" class="filter-btn {{ $filter == 'past' ? 'active-past' : '' }}">
            <i class="fas fa-hourglass-end"></i> Sudah Lewat
        </a>
        <a href="{{ route('jadwal.index', ['filter' => 'all']) }}" class="filter-btn {{ $filter == 'all' ? 'active-all' : '' }}">
            <i class="fas fa-th-list"></i> Semua
        </a>
    </div>

    {{-- Schedule Cards --}}
    @if($schedules->count() > 0)
        @foreach($schedules as $i => $s)
        @php
            $isToday = $s->arrival_date->isToday();
            $isPast = $s->arrival_date->isPast() && !$isToday;
        @endphp
        <div class="schedule-card {{ $isToday ? 'is-today' : '' }} {{ $isPast ? 'is-past' : '' }}" style="animation-delay: {{ $i * 0.08 }}s;">
            <div class="schedule-card-inner">
                
                {{-- Date Column --}}
                <div class="date-column">
                    <div class="date-big">{{ $s->arrival_date->format('d') }}</div>
                    <div class="date-month">{{ $s->arrival_date->translatedFormat('M Y') }}</div>
                    <div class="time-badge">
                        <i class="fas fa-clock me-1"></i>{{ $s->arrival_time }}
                    </div>
                    @if($isToday)
                    <div class="today-pulse">
                        <span class="dot"></span> HARI INI
                    </div>
                    @endif
                </div>

                {{-- Info Column --}}
                <div class="info-column">
                    <div class="ship-name">
                        <i class="fas fa-ship"></i>
                        {{ $s->ship->name ?? '-' }}
                    </div>
                    <div class="owner-name">
                        <i class="fas fa-user-tie"></i> {{ $s->company->name ?? '-' }}
                    </div>
                    <div class="subject-text">
                        {{ Str::limit($s->subject, 70) }}
                    </div>
                    
                    <div class="d-flex align-items-center flex-wrap gap-2">
                        @php $attendances = explode(',', $s->attendance_type); @endphp
                        @if(in_array('pemilik', $attendances))
                            <span class="attendance-badge sendiri">
                                <i class="fas fa-user-tie"></i> Pemilik
                            </span>
                        @endif
                        @if(in_array('nahkoda', $attendances))
                            <span class="attendance-badge" style="background: rgba(2, 119, 189, 0.1); color: #0277BD; border: 1px solid rgba(2, 119, 189, 0.2);">
                                <i class="fas fa-ship"></i> Nahkoda
                            </span>
                        @endif
                        @if(in_array('diwakilkan', $attendances))
                            <span class="attendance-badge diwakilkan">
                                <i class="fas fa-users"></i> Diwakilkan
                            </span>
                        @endif
                    </div>
                    @if(in_array('diwakilkan', $attendances) && $s->attendance_notes)
                        <div class="delegate-note">→ {{ $s->attendance_notes }}</div>
                    @endif

                    @if($s->violation_reasons)
                        <div class="d-flex flex-wrap gap-1 mt-1">
                            @php
                                $reasonLabels = [
                                    'ketidaktahuan_aturan' => 'Ketidaktahuan aturan',
                                    'ketidaktahuan_batas_wilayah' => 'Ketidaktahuan batas wilayah',
                                    'cuaca_buruk' => 'Cuaca buruk',
                                    'mengantar_logistik' => 'Mengantar Logistik',
                                    'kerusakan_kapal' => 'Kerusakan kapal',
                                    'abk_sakit' => 'ABK sakit',
                                    'kondisi_darurat' => 'Kondisi darurat',
                                    'lainnya' => 'Lainnya',
                                ];
                                $vReasons = explode(',', $s->violation_reasons);
                            @endphp
                            @foreach($vReasons as $vr)
                                <span class="badge bg-warning bg-opacity-10 text-warning" style="font-size: 0.7rem;">
                                    <i class="fas fa-exclamation-circle me-1"></i>{{ $reasonLabels[$vr] ?? $vr }}
                                </span>
                            @endforeach
                            @if($s->violation_other)
                                <span class="badge bg-secondary bg-opacity-10 text-secondary" style="font-size: 0.7rem;">{{ $s->violation_other }}</span>
                            @endif
                        </div>
                    @endif

                    @if($s->documents->count() > 0)
                    <div class="doc-tags">
                        @foreach($s->documents as $doc)
                        <span class="doc-tag">
                            <i class="fas fa-file-alt"></i> {{ $doc->type ?? $doc->original_name }}
                        </span>
                        @endforeach
                    </div>
                    @endif
                </div>

                {{-- Action Column --}}
                <div class="action-column">
                    <a href="{{ route('services.show', $s->id) }}" class="action-btn primary">
                        <i class="fas fa-file-alt"></i> Lihat Detail
                    </a>
                    @if($s->company && $s->company->phone)
                    <a href="https://wa.me/62{{ ltrim($s->company->phone, '0') }}" target="_blank" class="action-btn whatsapp">
                        <i class="fab fa-whatsapp"></i> Hubungi
                    </a>
                    @endif
                    <form action="{{ route('jadwal.destroy', $s->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus jadwal ini? Data pelayanan juga akan terhapus.');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="action-btn" style="background: #FEF2F2; color: #DC2626; border: 1px solid #FCA5A5; width: 100%; margin-top: 0.5rem;">
                            <i class="fas fa-trash-alt"></i> Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    @else
        <div class="empty-state">
            <i class="fas fa-calendar-times mb-3"></i>
            <h4 class="fw-bold text-muted mt-2">Tidak Ada Jadwal</h4>
            <p class="text-muted" style="max-width: 400px; margin: 0 auto;">Belum ada pemilik kapal yang mengkonfirmasi jadwal kedatangan untuk filter ini.</p>
        </div>
    @endif
</div>
@endsection
