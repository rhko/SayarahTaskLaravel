<?php

namespace App\Http\Controllers;

use App\Google\Custom\CurlFilesRequest;
use App\Google\Custom\FunctionFilesRequest;
use App\Google\DriveContainer;
use Illuminate\Http\Request;

class GoogleDriveController extends Controller
{
    public function index(DriveContainer $driveContainer) {
        $client = $driveContainer->getClient();
        if (session()->has('access_token')) {
            $client->setAccessToken(session()->get('access_token'));

            //1 by functions
            // $drive = new \Google_Service_Drive($client);
            // $filesRequest = new FunctionFilesRequest($drive);
            // $filesList = $filesRequest->getFiles();

            //2 by curl
            $filesRequest = new CurlFilesRequest($client);
            $filesList = $filesRequest->getFiles();

            return view('index', compact('filesList'));
        } else {
            // $callback_uri = 'http://localhost:8000/drive/callback';
            return redirect($driveContainer->getCallbackUrl());
        }
    }

    public function callback(DriveContainer $driveContainer, Request $request) {
        $client = $driveContainer->getClient();
        if(!$request->has('code')) {
            $auth_url = $client->createAuthUrl();
            return redirect($auth_url);
        } else {
            $accessToken = $client->fetchAccessTokenWithAuthCode($request->code);
            session()->put('access_token', $accessToken['access_token']);
            return redirect()->route('home');
        }
    }
}
