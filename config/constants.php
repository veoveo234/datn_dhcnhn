<?php

if (!defined('HTTP_SUCCESS')) {
    define('HTTP_SUCCESS', 200);
}

if (!defined('HTTP_STATUS_PAGE')) {
    define('HTTP_STATUS_PAGE', [
        'FORBIDDEN' => 403,
        'NOT_FOUND' => 404,
        'PAGE_EXPIRED' => 419,
        'SERVER_ERROR' => 500,
        'SERVICE_UNAVAILABLE' => 503,
    ]);
}

if (!defined('STATUS_ACTIVE')) {
    define(
        'STATUS_ACTIVE',
        [
            1 => 'Đang hoạt động',
            2 => 'Dừng hoạt động',
        ]
    );
}

