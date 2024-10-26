<?php

function isMobile() {
    $userAgent = $_SERVER['HTTP_USER_AGENT'];
    $mobileAgents = [
        'Mobile', 'Android', 'Silk/', 'Kindle', 'BlackBerry', 'Opera Mini', 'Opera Mobi'
    ];

    foreach ($mobileAgents as $device) {
        if (strpos($userAgent, $device) !== false) {
            return true;
        }
    }
    return false;
}
?>
