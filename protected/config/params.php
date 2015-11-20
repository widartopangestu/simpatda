<?php

$file = dirname(__FILE__) . '/params.inc';
$content = file_get_contents($file);
$arr = unserialize(base64_decode($content));
return CMap::mergeArray(
                $arr, array(
            'upload_image_profile' => '/upload/user/',
            'member' => false,
            'adminEmail' => 'pangestu2art@gmail.com',
            'mail_type' => 'smtp', // smtp or email
            'copyrightInfo' => 'Copyright &copy; ' . date('Y') . ' by Pangestu |  All Rights Reserved.',
            'optionsPage' => array(10 => 10, 25 => 25, 50 => 50, 100 => 100, 500 => 500, 1000 => 1000),
            'jasper' => true,
            'jasper_url' => 'http://localhost:8082/jasperserver',
            'jasper_username' => 'jasperadmin',
            'jasper_password' => 'C430darinaC430',
                )
);
