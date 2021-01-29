<?php
require_once './jwt/BeforeValidException.php';
require_once './jwt/ExpiredException.php';
require_once './jwt/SignatureInvalidException.php';
require_once './jwt/JWT.php';

use \Firebase\JWT\JWT;

$key = "example_key";


if($_SERVER['REQUEST_METHOD'] === 'POST'){
    // get income json and convert it to an object
    $incoming = json_decode(file_get_contents('php://input'));
  
    $token = array(
        "iss" => "http://example.org", // issuer
        "aud" => "http://example.com", //audience
        "iat" => time(), // issued at time
        "nbf" => time()+1, // not (valid) before
        "exp" => time() + 60, // expire at time()+3600*24
        "user"=> $incoming // my data to send
     );
    $jwt = JWT::encode($token, $key);

    echo $jwt;
}