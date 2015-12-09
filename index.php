<?php

require 'includes/facebook.php';

$file = "cat.jpg";

$facebook = new Facebook(array(
    'appId' => 'your appId',
    'secret' => 'your secret',
    'fileUpload' => true,
    'cookie' => true
));

$post_params = array(
    'access_token' => $facebook->getAccessToken(),
    'published' => true,
    'message' => 'Hello Facebook~',
    'source' => '@' . realpath($file)
);


$user = $facebook->getUser();

if ($user) {
    try {
        $upload_photo = $facebook->api('/me/photos', 'POST', $post_params);
        echo "ok";
    } catch (Exception $e) {
        echo 'error===>' . $e->getMessage();
    }
}
if ($user) {
    $logoutUrl = $facebook->getLogoutUrl();
} else {
    $loginUrl = $facebook->getLoginUrl();
    header('Location: ' . $loginUrl);
}
