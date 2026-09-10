<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\ServiceRequest;
use App\Models\Company;
use App\Models\Ship;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $user = auth()->user();
        if ($user->role === 'company') {
            $services = ServiceRequest::where('company_id', $user->company_id)
                ->with('ship')
                ->latest()
                ->get();
            return view('company.dashboard', compact('services'));
        }

        $stats = [
            'companies' => Company::count(),
            'ships' => Ship::count(),
            'total_services' => ServiceRequest::count(),
            'submitted' => ServiceRequest::whereIn('status', ['draft', 'submitted'])->count(),
            'completed' => ServiceRequest::where('status', 'completed')->count(),
        ];

        $upcomingArrivals = ServiceRequest::with(['company', 'ship'])
            ->where('status', 'submitted')
            ->whereDate('arrival_date', '>=', now()->toDateString())
            ->orderBy('arrival_date', 'asc')
            ->orderBy('arrival_time', 'asc')
            ->get();

        $services = ServiceRequest::with(['company', 'ship'])->latest()->take(10)->get();
        return view('admin.dashboard', compact('stats', 'upcomingArrivals', 'services'));
    }
}
