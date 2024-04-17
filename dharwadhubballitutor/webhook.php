<?php

use Mpdf\Utils\Arrays;

$arrayObject=[
        'mode'=>'subscribe',
        'challenge'=>'8007961759',
        'verify_token'=>'helloworld'
];
 header('Content-Type: application/json');
 echo json_encode($arrayObject);
?>