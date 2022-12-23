<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ContactRequest;
use App\Http\Requests\Api\DealRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ContactController extends Controller
{

    public function index(): View
    {
        $accessTocken = $this->getAccessToken();
        $response = Http::withHeaders(["Authorization" => "Zoho-oauthtoken " . $accessTocken])->get(
            'https://www.zohoapis.eu/crm/v2/Contacts'
        );

        if ($response->successful()) {
            $contacts = json_decode($response)->data ?? [];
        }

        return view('api.contacts.index', compact('contacts'));
    }

    public function create(): View
    {
        return view('api.contacts.create');
    }


    public function store(ContactRequest $request): RedirectResponse
    {
        $accessTocken = $this->getAccessToken();

        $fields = [
            [
                'Email' => $request->email,
                'Last_Name' => $request->name,
                'Phone' => $request->phone,
            ]
        ];

        $response = Http::withHeaders(
            [
                "Authorization" => "Zoho-oauthtoken " . $accessTocken,
                "Content-Type" => "application/json",
            ]
        )->post('https://www.zohoapis.eu/crm/v2/Contacts', [
            "data" => $fields,
        ]);

        if ($response->successful()) {
            return redirect()->route('contacts.index')->with(
                'successful',
                "Contact \"{$fields[0]['Last_Name']}\" added successfully !"
            );
        }
    }


    public function createDealInContact($contactId): View
    {
        return view('api.contacts.createDealInContact', compact('contactId'));
    }

    public function storeDealInContact(DealRequest $request, $contactId): RedirectResponse
    {
        if ($contactId) {
            $accessTocken = $this->getAccessToken();
            $fields = [
                [
                    'Closing_Date' => $request->closing_date,
                    'Deal_Name' => $request->deal_name,
                    'Stage' => $request->stage,
                    "Contact_Name" => [
                        "id" => $contactId,
                    ],
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
                return redirect()->route('contacts.index')->with(
                    'successful',
                    "Deal in contact \"{$fields[0]['Deal_Name']}\" added successfully !"
                );
            }
        }
    }


    public function destroy($contactId): RedirectResponse
    {
        $accessTocken = $this->getAccessToken();

        $response = Http::withHeaders(["Authorization" => "Zoho-oauthtoken " . $accessTocken])->delete(
            'https://www.zohoapis.eu/crm/v2/Deals?ids='.$contactId);

        if ($response->successful()) {
            return redirect()->route('contacts.index')->with(
                'successful',
                "Deal with \"{$contactId}\" deleted successfully !"
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
