<?php
namespace App\Http\Controllers;

use App\Models\ServiceRequest;
use Illuminate\Http\Request;
use Illuminate\View\View;

class JadwalController extends Controller
{
    public function index(Request $request): View
    {
        $filter = $request->get('filter', 'upcoming');

        $query = ServiceRequest::with(['company', 'ship', 'documents'])
            ->where('status', 'submitted')
            ->whereNotNull('arrival_date');

        if ($filter === 'today') {
            $query->whereDate('arrival_date', now()->toDateString());
        } elseif ($filter === 'upcoming') {
            $query->whereDate('arrival_date', '>=', now()->toDateString());
        } elseif ($filter === 'past') {
            $query->whereDate('arrival_date', '<', now()->toDateString());
        }
        // 'all' shows everything

        $schedules = $query->orderBy('arrival_date', 'asc')
            ->orderBy('arrival_time', 'asc')
            ->get();

        $stats = [
            'today' => ServiceRequest::where('status', 'submitted')
                ->whereDate('arrival_date', now()->toDateString())->count(),
            'upcoming' => ServiceRequest::where('status', 'submitted')
                ->whereDate('arrival_date', '>', now()->toDateString())->count(),
            'past' => ServiceRequest::where('status', 'submitted')
                ->whereDate('arrival_date', '<', now()->toDateString())->count(),
        ];

        return view('admin.jadwal', compact('schedules', 'filter', 'stats'));
    }

    public function destroy(ServiceRequest $jadwal)
    {
        $jadwal->delete();
        return back()->with('success', 'Jadwal pelayanan berhasil dihapus.');
    }
}
