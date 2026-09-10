<?php
namespace App\Http\Controllers;

use App\Models\Ship;
use App\Models\Company;
use Illuminate\Http\Request;

class ShipController extends Controller
{
    public function index()
    {
        $ships = Ship::with('company')->latest()->get();
        return view('ships.index', compact('ships'));
    }

    public function create()
    {
        $companies = Company::orderBy('name')->get();
        return view('ships.form', compact('companies'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'company_id' => 'required|exists:companies,id',
            'name' => 'required|string|max:255',
            'transmitter_no' => 'nullable|string|max:255',
            'book_no' => 'nullable|string|max:255',
            'fishing_gear' => 'nullable|string|max:255',
            'size' => 'nullable|string|max:255',
            'sipi_no' => 'nullable|string|max:255',
            'sipi_start' => 'nullable|date',
            'sipi_end' => 'nullable|date',
            'dpi' => 'nullable|string|max:255',
            'home_port' => 'nullable|string|max:255',
            'pelabuhan_keluar_terakhir' => 'nullable|string|max:255',
            'slo_issuer' => 'nullable|string|max:255',
            'license_type' => 'nullable|string|max:255',
        ]);

        Ship::create($validated);
        return redirect()->route('ships.index')->with('success', 'Data kapal berhasil ditambahkan');
    }

    public function edit(Ship $ship)
    {
        $companies = Company::orderBy('name')->get();
        return view('ships.form', compact('ship', 'companies'));
    }

    public function update(Request $request, Ship $ship)
    {
        $validated = $request->validate([
            'company_id' => 'required|exists:companies,id',
            'name' => 'required|string|max:255',
            'transmitter_no' => 'nullable|string|max:255',
            'book_no' => 'nullable|string|max:255',
            'fishing_gear' => 'nullable|string|max:255',
            'size' => 'nullable|string|max:255',
            'sipi_no' => 'nullable|string|max:255',
            'sipi_start' => 'nullable|date',
            'sipi_end' => 'nullable|date',
            'dpi' => 'nullable|string|max:255',
            'home_port' => 'nullable|string|max:255',
            'pelabuhan_keluar_terakhir' => 'nullable|string|max:255',
            'slo_issuer' => 'nullable|string|max:255',
            'license_type' => 'nullable|string|max:255',
        ]);

        $ship->update($validated);
        return redirect()->route('ships.index')->with('success', 'Data kapal berhasil diperbarui');
    }

    public function destroy(Ship $ship)
    {
        $ship->delete();
        return redirect()->route('ships.index')->with('success', 'Data kapal berhasil dihapus');
    }
}
