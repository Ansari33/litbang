<?php
namespace App\Helpers;
class Google
{
    public function client()
    {
        $client = new \Google_Client();
        $client->setClientId('258170609020-5osceu8t4b0u0m72m695lsv5o0f4fjnr.apps.googleusercontent.com');
        $client->setClientSecret(env('GOOGLE_CLIENT_SECRET'));
        $client->setRedirectUri(env('GOOGLE_REDIRECT_URL'));
        $client->setScopes(explode(',', env('GOOGLE_SCOPES')));
        $client->setApprovalPrompt(env('GOOGLE_APPROVAL_PROMPT'));
        $client->setAccessType(env('GOOGLE_ACCESS_TYPE'));
        return $client;
    }
    public function doc($client)
    {
        $doc = new \Google_Service_Docs($client);
        return $doc;
    }
    public function drive($client)
    {
        $drive = new \Google_Service_Drive($client);
        return $drive;
    }
    public function service($client)
    {
        $service = new \Google_Service_Books($client);
        return $service;
    }
}
