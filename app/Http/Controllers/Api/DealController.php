<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\DealRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;

class DealController extends Controller
{

    public function index(): View
    {
        $accessTocken = $this->getAccessToken();
        $response = Http::withHeaders(["Authorization" => "Zoho-oauthtoken " . $accessTocken])->get(
            'https://www.zohoapis.eu/crm/v2/Deals'
        );

        if ($response->successful()) {
            $deals = json_decode($response)->data ?? [];
        }

        return view('api.deals.index', compact('deals'));
    }


    public function create(): View
    {
        return view('api.deals.create');
    }


    public function store(DealRequest $request): RedirectResponse
    {

        $accessTocken = $this->getAccessToken();
        $fields = [
            [
                'Closing_Date' => $request->closing_date,
                'Deal_Name' => $request->deal_name,
                'Stage' => $request->stage,
            ]
        ];

        $response = Http::withHeaders(
            [
                "Authorization" => "Zoho-oauthtoken " . $accessTocken,
                "Content-Type" => "application/json",
            ]
        )->post('https://www.zohoapis.eu/crm/v2/Deals', [
            "data" => $fields,
        ]);


        if ($response->successful()) {
            return redirect()->route('deals.index')->with(
                'successful',
                "Deal \"{$fields[0]['Deal_Name']}\" added successfully !"
            );
        }
    }


    public function destroy($dealId): RedirectResponse
    {

        $accessTocken = $this->getAccessToken();

        $response = Http::withHeaders(["Authorization" => "Zoho-oauthtoken " . $accessTocken])->delete(
            'https://www.zohoapis.eu/crm/v2/Deals?ids='.$dealId);


        if ($response->successful()) {
            return redirect()->route('deals.index')->with(
                'successful',
                "Deal with \"{$dealId}\" deleted successfully !"
            );
        }
    }

    private function getAccessToken(): string
    {
        $grantType = "refresh_token";
        $clientId = env('ZOHO_CLIENT_ID');
        $clientSecret = env('ZOHO_CLIENT_SECRET');
        $refreshToken = env('ZOHO_REFRESH_TOKEN');

        $response = Http::post(
            "https://accounts.zoho.eu/oauth/v2/token?refresh_token=" . $refreshToken . "&client_id=" . $clientId . "&client_secret=" . $clientSecret . "&grant_type=" . $grantType
        );
        return json_decode($response)->access_token;
    }
}
