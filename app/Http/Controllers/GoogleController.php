<?php

use Google\Client;
use Illuminate\Http\Request;

class GoogleController extends Controller
{
    public function authorize()
    {
        $client = new Client();
        $client->setClientId(config('services.google.client_id'));
        $client->setClientSecret(config('services.google.client_secret'));
        $client->setRedirectUri(config('services.google.redirect'));

        $authUrl = $client->createAuthUrl(['https://www.googleapis.com/auth/drive']);
        return redirect()->to($authUrl);
    }

    public function callback(Request $request)
    {
        $client = new Client();
        $client->setClientId(config('services.google.client_id'));
        $client->setClientSecret(config('services.google.client_secret'));
        $client->setRedirectUri(config('services.google.redirect'));

        if ($request->has('code')) {
            $accessToken = $client->fetchAccessTokenWithAuthCode($request->code);
            // Guarda el token de acceso en la sesión o en la base de datos según tus necesidades
        }
    }
}
