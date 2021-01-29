<?php
require_once './jwt/BeforeValidException.php';
require_once './jwt/ExpiredException.php';
require_once './jwt/SignatureInvalidException.php';
require_once './jwt/JWT.php';

use Firebase\JWT\ExpiredException;
use \Firebase\JWT\JWT;

$key = "example_key";


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // get income json and convert it to an object
        $incoming = json_decode(file_get_contents('php://input'));

        // extract the token value
        $token = $incoming->token;

        // decode the token value
        $decoded = JWT::decode($token, $key, array('HS256'));


        echo "<pre>" . print_r($decoded, true) . "<pre>";
    } catch (ExpiredException $e) {
        echo $e->getMessage();
    }
}
