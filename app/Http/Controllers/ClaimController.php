<?php
namespace App\Http\Controllers;

use App\Models\ServiceRequest;
use Illuminate\Http\Request;

class ClaimController extends Controller
{
    public function index()
    {
        return view('auth.claim_code');
    }

    public function submit(Request $request)
    {
        $request->validate(['unique_code' => 'required|string']);
        
        $service = ServiceRequest::with('ship')->where('unique_code', $request->unique_code)->first();

        if (!$service) {
            return back()->with('error', 'Kode Unik tidak ditemukan. Pastikan Anda memasukkan kode yang benar.');
        }

        // Redirect directly to the public form
        return redirect()->route('public.form', $service->token)
            ->with('success', 'Berhasil membuka dokumen pelayanan!');
    }

    public function processClaim()
    {
        $code = session('pending_claim_code');
        if (!$code) {
            return redirect()->route('dashboard');
        }

        $service = ServiceRequest::where('unique_code', $code)->first();
        if ($service) {
            if ($service->company_id !== auth()->user()->company_id) {
                $service->update(['company_id' => auth()->user()->company_id]);
            }
            session()->forget('pending_claim_code');
            return redirect()->route('company.services.show', $service->id)
                ->with('success', 'Berhasil membuka dokumen pelayanan!');
        }

        return redirect()->route('dashboard');
    }
}
