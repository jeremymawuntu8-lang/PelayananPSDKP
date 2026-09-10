<?php
namespace App\Http\Controllers\Auth; 
use App\Http\Controllers\Controller; 
use App\Models\User; 
use App\Models\Company;
use Illuminate\Support\Facades\Auth; 
use Laravel\Socialite\Facades\Socialite; 
use Throwable;

class GoogleController extends Controller 
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    } 

    public function callback()
    {
        try {
            $g = Socialite::driver('google')->user();
            $u = User::where('google_id', $g->id)->orWhere('email', $g->email)->first(); 
            
            if (!$u) {
                // AUTO REGISTER COMPANY
                $company = Company::create([
                    'name' => $g->name ?? 'Perusahaan Baru',
                    'email' => $g->email,
                ]);

                $u = User::create([
                    'name' => $g->name ?? 'Pemilik Kapal',
                    'email' => $g->email,
                    'password' => bcrypt(str()->random(24)),
                    'role' => 'company',
                    'company_id' => $company->id,
                    'google_id' => $g->id,
                ]);
            } 
            
            if ($u->role !== 'company') {
                return redirect()->route('login')->withErrors(['email' => 'Login Google hanya untuk Pemilik Kapal/Company.']);
            }
            
            $u->update(['google_id' => $g->id, 'name' => $g->name ?: $u->name]);
            Auth::login($u, true);
            request()->session()->regenerate();
            
            // IF THEY CAME FROM /klaim, RE-ROUTE THEM!
            if (session('pending_claim_code')) {
                return redirect()->route('google.callback.claim');
            }
            
            return redirect()->intended(route('dashboard'));
        } catch(Throwable $e) {
            return redirect()->route('login')->withErrors(['email' => 'Login Google gagal: ' . $e->getMessage()]);
        }
    }
}
