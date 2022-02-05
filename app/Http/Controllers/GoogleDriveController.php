<?php

namespace App\Http\Controllers;

use App\Google\Custom\CurlFilesRequest;
use App\Google\Custom\FunctionFilesRequest;
use App\Google\DriveContainer;
use Illuminate\Http\Request;

class GoogleDriveController extends Controller
{
    private DriveContainer $driveContainer;
    private \Google_Client $client;

    public function __construct(DriveContainer $driveContainer)
    {
        $this->driveContainer = $driveContainer;
        $this->client = $driveContainer->getClient();
    }

    public function index() {
        if (session()->has('access_token')) {
            $this->client->setAccessToken(session()->get('access_token'));

            //1 by functions
            // $filesRequest = new FunctionFilesRequest($this->client);

            //2 by curl
            $filesRequest = new CurlFilesRequest($this->client);

            $filesList = $filesRequest->getFiles();

            return view('index', compact('filesList'));
        } else {
            // $callback_uri = 'http://localhost:8000/drive/callback';
            return redirect($this->driveContainer->getCallbackUrl());
        }
    }

    public function callback(Request $request) {
        if(!$request->has('code')) {
            $auth_url = $this->client->createAuthUrl();
            return redirect($auth_url);
        } else {
            $accessToken = $this->client->fetchAccessTokenWithAuthCode($request->code);
            session()->put('access_token', $accessToken['access_token']);
            return redirect()->route('home');
        }
    }
}
