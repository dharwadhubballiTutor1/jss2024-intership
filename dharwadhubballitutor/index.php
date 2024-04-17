<?php
$request = $_SERVER['REQUEST_URI'];
error_log($request);
$str = $request;
$pattern = "/^\/\?fbclid=/";
if (preg_match($pattern, $str) == 1) {
    $request = '/';
}
switch ($request) {
    case  '/dharwadhubballitutor/':
        require __DIR__ . '/views/index.php';
        break;
    case '':
        require __DIR__ . '/views/index.php';
        break;
    case '/dharwadhubballitutor/?fbclid=':
        require __DIR__ . '/views/index.php';
        break;
    case  '/dharwadhubballitutor/contact/':
        require __DIR__ . '/views/contact.php';
        break;
    case  '/dharwadhubballitutor/about/':
        require __DIR__ . '/views/about.php';
        break;
    case  '/dharwadhubballitutor/termsandconditions/':
        require __DIR__ . '/views/termsandconditions.php';
        break;
    case  '/dharwadhubballitutor/PrivacyPolicy/':
        require __DIR__ . '/views/PrivacyPolicy.php';
        break;
    case '/dharwadhubballitutor/admin/login.php':
        require __DIR__ . '/admin/views/login.php';
        break;
    case '/dharwadhubballitutor/webhooks':
        require __DIR__ . '/webhook.php';
        break;

    default:
        require __DIR__ . '/views/route.php';
        route::get($request);
        break;
}
