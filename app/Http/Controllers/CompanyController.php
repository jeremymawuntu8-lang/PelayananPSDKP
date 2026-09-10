<?php
namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index()
    {
        $companies = Company::with('ships')->orderBy('name')->get();
        return view('companies.index', compact('companies'));
    }

    public function create()
    {
        return view('companies.form');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:255',
            'address' => 'nullable|string'
        ]);

        Company::create($validated);
        return redirect()->route('companies.index')->with('success', 'Data pemilik kapal berhasil ditambahkan');
    }

    public function edit(Company $company)
    {
        return view('companies.form', compact('company'));
    }

    public function update(Request $request, Company $company)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:255',
            'address' => 'nullable|string'
        ]);

        $company->update($validated);
        return redirect()->route('companies.index')->with('success', 'Data pemilik kapal berhasil diperbarui');
    }

    public function destroy(Company $company)
    {
        $company->delete();
        return redirect()->route('companies.index')->with('success', 'Data pemilik kapal berhasil dihapus');
    }
}
