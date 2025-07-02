<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $user = null;

        if ($request->session()->has('access_token')) {
            $response = Http::withToken($request->session()->get('access_token'))
                ->get(env('SMARTID_AUTH_URL') . '/api/user');

            if ($response->ok()) {
                $user = $response->json();
            }
        }

        return view('beranda', compact('user'));
    }
}
