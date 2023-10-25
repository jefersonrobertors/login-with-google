<?php

declare(strict_types=1);

namespace app\library;

use Google\Client;
use Google\Service\Oauth2;
use GuzzleHttp\Client as GuzzleHttpClient;

final class GoogleClient {

    public readonly Client $client;

    private $data;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function init()
    {
        $guzzleClient = new GuzzleHttpClient(['curl' => [CURLOPT_SSL_VERIFYPEER => false]]);
        $this->client->setHttpClient($guzzleClient);
        $this->client->setAuthConfig(__DIR__ . "/../../credentials.json");
        $this->client->setRedirectUri('http://localhost:8080');
        $this->client->addScope('email');
        $this->client->addScope('profile');
    }

    public function generateAuthUrl() {
        return $this->client->createAuthUrl();
    }

    public function authorized() {
        if(isset($_GET['code'])) {
            $token = $this->client->fetchAccessTokenWithAuthCode($_GET['code']);
            $this->client->setAccessToken($token['access_token']);
            $googleService = new Oauth2($this->client);
            $this->data = $googleService->userinfo->get();
            return true;
        }
        return false;
    }

    public function getData() {
        return $this->data;
    }
}
?>