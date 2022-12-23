<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;

class WelcomeController extends Controller
{

    public function index(): View
    {
        return view('welcome');
    }

    public function generateAccessToken()
    {
        $grantType = 'authorization_code';
        $clientId = env('ZOHO_CLIENT_ID');;
        $clientSecret = env('ZOHO_CLIENT_SECRET');
        $redirectUri = env('ZOHO_REDIRECT_URI');
        $code = env('ZOHO_GRAND_CODE');


        $response = Http::post(
            "https://accounts.zoho.eu/oauth/v2/token?client_id=" . $clientId . "&client_secret=" . $clientSecret . "&grant_type=" . $grantType. "&redirect_uri=" . $redirectUri . "&code=".$code
        );

        $response = json_decode($response, true);

        if (isset($response['error'])) {
            return redirect()->route('welcome')->with(
                'error',
                "Make new grand code, error: {$response['error']} !"
            );
        }else{
            return redirect()->route('welcome')->with(
                'successful',
                "Token created successfully ! Copy token and add to '.env' file in variable 'ZOHO_REFRESH_TOKEN' " . $response['refresh_token']
            );
        }



    }
}
