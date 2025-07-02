<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\User;

class SmartIdController extends Controller
{
    public function home(Request $request)
    {
        $user = null;

        if ($request->session()->has('access_token')) {
            $res = Http::withToken($request->session()->get('access_token'))
                ->get(env('SMARTID_AUTH_URL') . '/api/user');

            if ($res->ok()) {
                $user = $res->json();
            }
        }

        return view('beranda', compact('user'));
    }

    public function redirectToSmartId(Request $request)
    {
        $request->session()->put('state', $state = Str::random(40));

        $query = http_build_query([
            'client_id' => env('SMARTID_CLIENT_ID'),
            'redirect_uri' => env('SMARTID_REDIRECT_URI'),
            'response_type' => 'code',
            'scope' => '',
            'state' => $state,
            'prompt' => 'consent',
        ]);

        return redirect(env('SMARTID_AUTH_URL') . '/oauth/authorize?' . $query);
    }

    public function callback(Request $request)
    {
        // Tangani jika user menolak akses (deny)
        if ($request->has('error')) {
            return redirect('/')
                ->with('error', $request->get('error_description', 'Akses ditolak'));
        }

        $state = $request->session()->pull('state');

        if (strlen($state) === 0 || $state !== $request->state) {
            abort(403, 'Invalid state');
        }

        $response = Http::asForm()->post(env('SMARTID_AUTH_URL') . '/oauth/token', [
            'grant_type' => 'authorization_code',
            'client_id' => env('SMARTID_CLIENT_ID'),
            'client_secret' => env('SMARTID_CLIENT_SECRET'),
            'redirect_uri' => env('SMARTID_REDIRECT_URI'),
            'code' => $request->code,
        ]);

        if ($response->failed()) {
            abort(500, 'Failed to get token');
        }

        session(['access_token' => $response->json()['access_token']]);

        return redirect()->route('home');
    }


    public function clientHome()
    {
        $token = session('access_token');

        if (!$token) {
            return redirect()->route('login.smartid');
        }

        $userData = Http::withToken($token)
            ->get(env('SMARTID_AUTH_URL') . '/api/user')
            ->json();

        $user = User::firstOrCreate(
            ['smartid_id' => $userData['id']],
            [
                'name' => $userData['name'],
                'email' => $userData['email'],
                'password' => bcrypt(Str::random(32)),
            ]
        );

        Auth::login($user);

        return view('client.home', compact('user'));
    }

    public function logoutClient()
    {
        session()->forget('access_token');
        Auth::logout();

        return redirect('/');
    }

    public function logoutAll()
    {
        session()->forget('access_token');
        Auth::logout();

        $logoutUrl = env('SMARTID_AUTH_URL') . '/logout?redirect_uri=' . urlencode(url('/'));
        return redirect($logoutUrl);
    }
}
