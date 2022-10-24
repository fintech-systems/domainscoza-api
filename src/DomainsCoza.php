<?php

namespace FintechSystems\DomainsCoza;

use Exception;
use Illuminate\Support\Facades\Http;

class DomainsCoza
{
    private $url;

    private $username;

    private $password;

    private $token;

    public function __construct($client)
    {
        $this->url = $client['url'];
        $this->username = $client['username'];
        $this->password = $client['password'];

        if (! $this->url) {
            $error = 'The API URL was not found. Please check your environment settings.';
            ray($error)->red();
            throw new Exception($error);
        }
    }

    /**
     * List
     *
     * This function will give you a filtered list of domains
     *
     * https://docs.domains.co.za/#list
     */
    public function list()
    {
        return $this->get('domain/list');
    }

    /**
     * Login
     *
     * Obtain bearer token
     *
     * https://docs.domains.co.za/#authentication-2
     */
    public function login()
    {
        $result = $this->post('login', [
            'username' => $this->username,
            'password' => $this->password,
        ]);

        $this->token = $result['token'];
    }

    public function token()
    {
        return $this->token;
    }

    private function get($endpoint, $data = [])
    {
        $response = Http::withToken($this->token)
            ->get("$this->url/$endpoint", $data);

        ray($response->json());

        return $response->json();
    }

    private function post($endpoint, $data = [])
    {
        $response = Http::asForm()
            ->post("$this->url/$endpoint", $data);

        ray($response->json());

        return $response->json();
    }

    public function echoPhrase($message)
    {
        return $message;
    }
}
