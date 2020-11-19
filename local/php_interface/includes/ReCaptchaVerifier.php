<?php
/**
 * Created by PhpStorm.
 * User: Kurraz
 */

class ReCaptchaVerifier
{
    const SECRET = '6Lc49rkUAAAAAHj4Zludbowr8-3R85SNa2-7_kwp';
    const SITE_KEY = '6Lc49rkUAAAAAFhEO9lAGELK0HRW6WnfeZIh0PSU';

    const DEFAULT_TOKEN_VAR = 'g-recaptcha-response';

    static public function verify($token)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,"https://www.google.com/recaptcha/api/siteverify");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, array(
            'secret' => self::SECRET,
            'response' => $token,
            'remoteip' => $_SERVER['REMOTE_ADDR'],
        ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $out = json_decode(curl_exec($ch), true);
        curl_close ($ch);

        return $out['success'];
    }
}