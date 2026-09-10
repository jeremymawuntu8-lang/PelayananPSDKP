<?php
namespace App\Http\Controllers;

use App\Models\ServiceRequest;
use Illuminate\Http\Request;

class CompanyServiceController extends Controller
{
    public function show(ServiceRequest $service)
    {
        if ($service->company_id !== auth()->user()->company_id) {
            abort(403, 'Unauthorized access to this service request.');
        }

        $service->load(['ship', 'documents', 'creator']);
        return view('company.service', compact('service'));
    }

    public function respond(Request $request, ServiceRequest $service)
    {
        if ($service->company_id !== auth()->user()->company_id) {
            abort(403);
        }

        $request->validate([
            'response' => 'required|string|min:10'
        ]);

        $service->update([
            'company_response' => $request->response,
            'responded_at' => now(),
            'status' => 'submitted'
        ]);

        return back()->with('success', 'Tanggapan berhasil dikirim dan akan segera ditinjau oleh petugas PSDKP.');
    }

    public function claim(Request $request)
    {
        $request->validate([
            'unique_code' => 'required|string'
        ]);

        $service = ServiceRequest::where('unique_code', $request->unique_code)->first();

        if (!$service) {
            return back()->with('error', 'Kode Unik tidak ditemukan. Pastikan Anda memasukkan kode yang benar.');
        }

        // Update the company_id so it belongs to this Google user's company account
        if ($service->company_id !== auth()->user()->company_id) {
            $service->update([
                'company_id' => auth()->user()->company_id
            ]);
        }

        // Redirect directly to the service/broadcast page!
        return redirect()->route('company.services.show', $service->id)
                         ->with('success', 'Berhasil masuk ke dokumen pelayanan.');
    }
}
