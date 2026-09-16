<?php
namespace App\Http\Controllers;

use App\Models\ServiceRequest;
use App\Models\Company;
use App\Models\Ship;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ServiceRequestController extends Controller
{
    public function index()
    {
        $services = ServiceRequest::with(['company', 'ship'])->latest()->get();
        return view('services.index', compact('services'));
    }

    public function create()
    {
        $companies = Company::orderBy('name')->get();
        $ships = Ship::with('company')->orderBy('name')->get();
        return view('services.create', compact('companies', 'ships'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'company_name' => 'required|string|max:255',
            'ship_name' => 'nullable|string|max:255',
            'category' => 'nullable|string',
            'subject' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'analysis' => 'nullable|string',
            'indikasi' => 'nullable|string',
            'indikasi_pelanggaran' => 'nullable|string',
            'duga_langgar' => 'nullable|string',
            'period_violation_start' => 'nullable|date',
            'period_violation_end' => 'nullable|date',
            'pelabuhan_keluar_terakhir' => 'nullable|string',
            'mulai_melanggar' => 'nullable|date',
            'frekuensi_pelanggaran' => 'nullable|integer',
            'upt_terdekat' => 'nullable|string',
            'observation_date' => 'nullable|date',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            
            // New ServiceRequest fields
            'analyst' => 'nullable|string',
            'verificator' => 'nullable|string',
            'unit_kerja' => 'nullable|string',
            'lembar_indikasi' => 'nullable|string',
            'surat_analisis_nomor' => 'nullable|string',
            'skat_nomor' => 'nullable|string',
            'masa_berlaku' => 'nullable|date',
            
            // Company
            'company_name' => 'required|string|max:255',
            'company_phone' => 'nullable|string|max:20',
            
            // Ship fields
            'transmitter_no' => 'nullable|string',
            'book_no' => 'nullable|string',
            'fishing_gear' => 'nullable|string',
            'size' => 'nullable|string',
            'sipi_no' => 'nullable|string',
            'sipi_start' => 'nullable|date',
            'sipi_end' => 'nullable|date',
            'dpi' => 'nullable|string',
            'home_port' => 'nullable|string',
            'slo_issuer' => 'nullable|string',
            'license_type' => 'nullable|string',

            'doc_type' => 'nullable|string',
            'nomor_surat' => 'nullable|string',
            'document' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:10240', // 10MB
        ]);

        $token = Str::random(40);
        $category = empty($validated['category']) ? 'Pelayanan' : $validated['category'];
        $subject = empty($validated['subject']) ? ('Layanan ' . $category . ' - ' . now()->format('dmY-Hi')) : $validated['subject'];
        
        // Process Company
        $companyName = trim($validated['company_name']);
        $company = Company::where('name', $companyName)->first();
        if (!$company) {
            $company = Company::create([
                'name' => $companyName,
                'phone' => $validated['company_phone'] ?? null,
                // Add default password or whatever is needed for a company if any
                'email' => strtolower(str_replace(' ', '', $companyName)) . '_' . uniqid() . '@example.com',
                'password' => bcrypt('password'),
            ]);
        } else if (!empty($validated['company_phone'])) {
            $company->update(['phone' => $validated['company_phone']]);
        }
        $final_company_id = $company->id;

        $final_ship_id = null;

        // Process Ship by Name
        if (!empty($validated['ship_name'])) {
            $shipName = trim($validated['ship_name']);
            $ship = Ship::where('name', $shipName)->where('company_id', $final_company_id)->first();
            
            if ($ship) {
                $final_ship_id = $ship->id;
                $ship->update([
                    'transmitter_no' => $validated['transmitter_no'] ?? $ship->transmitter_no,
                    'book_no' => $validated['book_no'] ?? $ship->book_no,
                    'fishing_gear' => $validated['fishing_gear'] ?? $ship->fishing_gear,
                    'size' => $validated['size'] ?? $ship->size,
                    'sipi_no' => $validated['sipi_no'] ?? $ship->sipi_no,
                    'sipi_start' => $validated['sipi_start'] ?? $ship->sipi_start,
                    'sipi_end' => $validated['sipi_end'] ?? $ship->sipi_end,
                    'dpi' => $validated['dpi'] ?? $ship->dpi,
                    'home_port' => $validated['home_port'] ?? $ship->home_port,
                    'slo_issuer' => $validated['slo_issuer'] ?? $ship->slo_issuer,
                    'license_type' => $validated['license_type'] ?? $ship->license_type,
                ]);
            } else {
                $newShip = Ship::create([
                    'company_id' => $final_company_id,
                    'name' => $shipName,
                    'transmitter_no' => $validated['transmitter_no'] ?? null,
                    'book_no' => $validated['book_no'] ?? null,
                    'fishing_gear' => $validated['fishing_gear'] ?? null,
                    'size' => $validated['size'] ?? null,
                    'sipi_no' => $validated['sipi_no'] ?? null,
                    'sipi_start' => $validated['sipi_start'] ?? null,
                    'sipi_end' => $validated['sipi_end'] ?? null,
                    'dpi' => $validated['dpi'] ?? null,
                    'home_port' => $validated['home_port'] ?? null,
                    'slo_issuer' => $validated['slo_issuer'] ?? null,
                    'license_type' => $validated['license_type'] ?? null,
                ]);
                $final_ship_id = $newShip->id;
            }
        }

        // Auto-generate a unique 6-digit code
        do {
            $generatedCode = (string) mt_rand(100000, 999999);
        } while (ServiceRequest::where('unique_code', $generatedCode)->exists());

        $service = ServiceRequest::create([
            'token' => $token,
            'unique_code' => $generatedCode,
            'created_by' => auth()->id(),
            'company_id' => $final_company_id,
            'ship_id' => $final_ship_id,
            'category' => $category,
            'subject' => $subject,
            'description' => $validated['description'] ?? null,
            'analysis' => $validated['analysis'] ?? null,
            'indikasi' => $validated['indikasi'] ?? null,
            'indikasi_pelanggaran' => $validated['indikasi_pelanggaran'] ?? null,
            'duga_langgar' => $validated['duga_langgar'] ?? null,
            'period_violation_start' => $validated['period_violation_start'] ?? null,
            'period_violation_end' => $validated['period_violation_end'] ?? null,
            'pelabuhan_keluar_terakhir' => $validated['pelabuhan_keluar_terakhir'] ?? null,
            'mulai_melanggar' => $validated['mulai_melanggar'] ?? null,
            'frekuensi_pelanggaran' => $validated['frekuensi_pelanggaran'] ?? null,
            'upt_terdekat' => $validated['upt_terdekat'] ?? null,
            'observation_date' => $validated['observation_date'] ?? null,
            'latitude' => $validated['latitude'] ?? null,
            'longitude' => $validated['longitude'] ?? null,
            'analyst' => $validated['analyst'] ?? null,
            'verificator' => $validated['verificator'] ?? null,
            'unit_kerja' => $validated['unit_kerja'] ?? null,
            'lembar_indikasi' => $validated['lembar_indikasi'] ?? null,
            'surat_analisis_nomor' => $validated['surat_analisis_nomor'] ?? null,
            'skat_nomor' => $validated['skat_nomor'] ?? null,
            'masa_berlaku' => $validated['masa_berlaku'] ?? null,
            'status' => 'draft'
        ]);

        if ($request->hasFile('document')) {
            $file = $request->file('document');
            $path = $file->store('service_documents', 'public');
            
            $service->documents()->create([
                'type' => $validated['doc_type'] ?? 'Dokumen Pelayanan',
                'nomor_surat' => $validated['nomor_surat'] ?? null,
                'file_path' => $path,
                'original_name' => $file->getClientOriginalName()
            ]);
        }

        $whatsappLink = $service->getWhatsappLink();
        $fonnteToken = env('FONNTE_TOKEN');
        $botSent = false;

        if ($whatsappLink && $fonnteToken) {
            // Send via Fonnte API automatically
            $phone = preg_replace('/[^0-9]/', '', $service->company->phone);
            if (str_starts_with($phone, '0')) $phone = '62' . substr($phone, 1);
            
            $url = url('/klaim');
            $msg = "Yth. {$service->company->name},\n\nTerdapat pemberitahuan/pelayanan PSDKP baru untuk kapal Anda.\n\nSilakan kunjungi sistem kami di:\n{$url}\n\nLalu masukkan Kode Unik berikut untuk membuka dokumen Anda:\n*{$service->unique_code}*\n\nTerima kasih,\nPSDKP Pelayanan";

            try {
                $response = \Illuminate\Support\Facades\Http::withHeaders([
                    'Authorization' => $fonnteToken
                ])->post('https://api.fonnte.com/send', [
                    'target' => $phone,
                    'message' => $msg,
                ]);
                if ($response->successful()) {
                    $botSent = true;
                }
            } catch (\Exception $e) {
                \Log::error('Fonnte send error: ' . $e->getMessage());
            }
        }

        if ($whatsappLink && !$botSent) {
            // Fallback to manual wa.me link
            return redirect()->route('services.show', $service->id)
                ->with('success', 'Pelayanan berhasil dibuat.')
                ->with('open_wa_link', $whatsappLink);
        }

        return redirect()->route('services.show', $service->id)
            ->with('success', 'Pelayanan berhasil dibuat.' . ($botSent ? ' Pesan WA berhasil dikirim otomatis via Bot Server.' : ''));
    }

    public function show(ServiceRequest $service)
    {
        $service->load(['company', 'ship', 'creator', 'documents']);
        return view('services.show', compact('service'));
    }

    public function updateStatus(Request $request, ServiceRequest $service)
    {
        $request->validate(['status' => 'required|in:draft,submitted,in_review,completed,need_revision,cancelled']);
        $service->update(['status' => $request->status]);
        return back()->with('success', 'Status pelayanan diperbarui');
    }

    // Public Form Methods
    public function publicForm($token)
    {
        $service = ServiceRequest::where('token', $token)->with(['company', 'ship', 'documents'])->firstOrFail();
        
        if (in_array($service->status, ['completed', 'cancelled'])) {
            return view('services.public_closed');
        }
        
        return view('services.public', compact('service'));
    }

    public function publicStore(Request $request, $token)
    {
        $service = ServiceRequest::where('token', $token)->firstOrFail();
        
        if (in_array($service->status, ['completed', 'cancelled'])) {
            return redirect()->route('public.form', $token);
        }

        $validated = $request->validate([
            'arrival_date' => 'required|date',
            'arrival_day' => 'required|string',
            'arrival_time' => 'required|in:09:00,11:00,14:00',
            'attendance_type' => 'required|in:pemilik,nahkoda,diwakilkan',
            'attendance_notes' => 'required_if:attendance_type,diwakilkan|nullable|string',
            'response' => 'nullable|string',
            'doc_surat_kuasa' => 'required_if:attendance_type,diwakilkan|nullable|file|mimes:pdf,png,jpg,jpeg|max:10240',
            'doc_keterangan_dokter' => 'nullable|file|mimes:pdf,png,jpg,jpeg|max:10240',
            'doc_kwitansi' => 'nullable|file|mimes:pdf,png,jpg,jpeg|max:10240',
            'doc_cuaca' => 'nullable|file|mimes:png,jpg,jpeg|max:10240',
        ]);

        $service->update([
            'company_response' => $validated['response'] ?? null,
            'arrival_date' => $validated['arrival_date'],
            'arrival_day' => $validated['arrival_day'],
            'arrival_time' => $validated['arrival_time'],
            'attendance_type' => $validated['attendance_type'],
            'attendance_notes' => $validated['attendance_notes'] ?? null,
            'status' => 'submitted',
            'responded_at' => now(),
        ]);

        $docTypes = [
            'doc_surat_kuasa' => 'Surat Kuasa',
            'doc_keterangan_dokter' => 'Surat Keterangan Dokter',
            'doc_kwitansi' => 'Kwitansi Logistik',
            'doc_cuaca' => 'Dokumentasi Cuaca',
        ];

        foreach ($docTypes as $inputName => $typeLabel) {
            if ($request->hasFile($inputName)) {
                $file = $request->file($inputName);
                $service->documents()->create([
                    'type' => $typeLabel,
                    'file_path' => $file->store('service_documents', 'public'),
                    'original_name' => $file->getClientOriginalName()
                ]);
            }
        }

        return redirect()->route('public.form', $token)->with('success', 'Tanggapan, Jadwal Kehadiran, dan Dokumen berhasil dikirim. Terima kasih.');
    }
}
