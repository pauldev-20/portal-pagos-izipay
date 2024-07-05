<?php

namespace App\Helpers;

class AuthenticableOdoo {
    private string $username;
    private string $password;

    public function __construct() {
        $this->username = env('API_USERNAME');
        $this->password = env('API_PASSWORD');
    }

    public function authorized(string $basic): bool
    {
        $credentials = explode(':', base64_decode(substr($basic,6)));
        $user = $credentials[0];
        $pass = $credentials[1];

        return ($user == $this->username && $pass == $this->password);
    }

    public static function authorizedPeticion(string $basic): bool
    {
        return app(AuthenticableOdoo::class)->authorized($basic);
    }
}