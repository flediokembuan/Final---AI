<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    /**
     * Show the unified login page.
     */
    public function showLogin()
    {
        if (Auth::check()) {
            if (Auth::user()->isAdmin()) {
                return redirect()->route('admin.dashboard');
            }
            return redirect()->route('pmb.biodata');
        }

        return view('auth.login');
    }

    /**
     * Redirect to Google OAuth provider.
     */
    public function redirectToGoogle(Request $request)
    {
        $clientId = config('services.google.client_id');
        $clientSecret = config('services.google.client_secret');

        // Check if demo query or missing credentials for offline testing
        if ($request->has('demo') || empty($clientId) || empty($clientSecret)) {
            $demoRole = $request->query('role', 'applicant');
            $demoEmail = ($demoRole === 'admin') ? 'panitia.pmb@unklab.ac.id' : 'gabriel.mamahit@gmail.com';
            $demoName = ($demoRole === 'admin') ? 'Panitia PMB UNKLAB' : 'Gabriel J. Mamahit';
            $demoAvatar = 'https://ui-avatars.com/api/?name=' . urlencode($demoName) . '&background=00105B&color=fff';

            // Auto-Routing Role based on Email Domain
            return $this->processOAuthUser($demoEmail, $demoName, $demoAvatar, 'google_demo_' . md5($demoEmail), true);
        }

        return Socialite::driver('google')->redirect();
    }

    /**
     * Handle callback from Google OAuth.
     */
    public function handleGoogleCallback(Request $request)
    {
        try {
            $googleUser = Socialite::driver('google')->user();
        } catch (\Throwable $e) {
            return redirect()->route('login')->withErrors([
                'email' => 'Gagal mengautentikasi akun Google: ' . $e->getMessage() . '. Pastikan kredensial GOOGLE_CLIENT_ID dan GOOGLE_CLIENT_SECRET pada .env sudah valid.',
            ]);
        }

        $email = strtolower(trim($googleUser->getEmail()));
        $name = $googleUser->getName() ?? $googleUser->getNickname() ?? ucwords(str_replace(['.', '_', '-'], ' ', Str::before($email, '@')));
        $avatar = $googleUser->getAvatar();
        $googleId = $googleUser->getId();

        return $this->processOAuthUser($email, $name, $avatar, $googleId, false);
    }

    /**
     * Shared logic for processing OAuth user and auto-routing by domain.
     */
    protected function processOAuthUser(string $email, string $name, ?string $avatar, ?string $googleId, bool $isDemoFallback = false)
    {
        $isUnklabStaff = Str::endsWith($email, '@unklab.ac.id');

        if ($isUnklabStaff) {
            // Auto-Route to Admin
            $user = User::firstOrCreate(
                ['email' => $email],
                [
                    'name' => $name,
                    'role' => 'admin',
                    'google_id' => $googleId,
                    'avatar' => $avatar,
                ]
            );

            // Ensure role is admin and update avatar/google_id
            $user->update([
                'role' => 'admin',
                'google_id' => $googleId ?? $user->google_id,
                'avatar' => $avatar ?? $user->avatar,
            ]);

            Auth::login($user, true);
            request()->session()->regenerate();

            $msg = $isDemoFallback
                ? 'Berhasil masuk sebagai Panitia PMB via Google OAuth (Simulasi / Kredensial .env siap dihubungkan).'
                : 'Berhasil masuk ke Dashboard Admin PMB UNKLAB menggunakan Akun Google Resmi.';

            return redirect()->intended(route('admin.dashboard'))->with('success', $msg);
        }

        // Auto-Route to Applicant
        $user = User::firstOrCreate(
            ['email' => $email],
            [
                'name' => $name,
                'role' => 'applicant',
                'google_id' => $googleId,
                'avatar' => $avatar,
            ]
        );

        if ($googleId || $avatar) {
            $user->update([
                'google_id' => $googleId ?? $user->google_id,
                'avatar' => $avatar ?? $user->avatar,
            ]);
        }

        // Ensure user has an application record
        Application::firstOrCreate(
            ['user_id' => $user->id],
            [
                'status' => 'draft',
                'full_name' => $user->name,
            ]
        );

        Auth::login($user, true);
        request()->session()->regenerate();

        $msg = $isDemoFallback
            ? 'Berhasil masuk sebagai Calon Mahasiswa via Google OAuth (Simulasi Akun Google).'
            : 'Selamat datang! Anda berhasil masuk menggunakan Akun Google.';

        return redirect()->intended(route('pmb.biodata'))->with('success', $msg);
    }

    /**
     * Handle single login route for both Admin and Applicant.
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'nullable|string',
        ]);

        $email = strtolower(trim($request->email));
        $isUnklabStaff = Str::endsWith($email, '@unklab.ac.id');

        // Flow 1: Panitia PMB (@unklab.ac.id)
        if ($isUnklabStaff) {
            $user = User::where('email', $email)->where('role', 'admin')->first();

            if (!$user || !Hash::check($request->password, $user->password)) {
                return back()->withInput()->withErrors([
                    'email' => 'Kombinasi email panitia dan kata sandi tidak valid. Hubungi administrator PMB.',
                ]);
            }

            Auth::login($user, $request->boolean('remember'));
            $request->session()->regenerate();

            return redirect()->intended(route('admin.dashboard'));
        }

        // Flow 2: Calon Mahasiswa Baru (Email Pribadi) -> auto firstOrCreate
        $nameFromEmail = ucwords(str_replace(['.', '_', '-'], ' ', Str::before($email, '@')));

        $user = User::firstOrCreate(
            ['email' => $email],
            [
                'name' => $nameFromEmail,
                'password' => $request->password ? Hash::make($request->password) : null,
                'role' => 'applicant',
            ]
        );

        // Ensure user has an application record
        Application::firstOrCreate(
            ['user_id' => $user->id],
            [
                'status' => 'draft',
                'full_name' => $user->name,
            ]
        );

        Auth::login($user, $request->boolean('remember'));
        $request->session()->regenerate();

        return redirect()->intended(route('pmb.biodata'));
    }

    /**
     * Log the user out.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Anda telah berhasil keluar.');
    }
}
