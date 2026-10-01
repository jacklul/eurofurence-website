<?php

if (defined('CRON_SECRET_PATH')) {
    return;
}

define('CRON_SECRET_PATH', __DIR__ . '/../cron-secret.config.php');

if (is_file(CRON_SECRET_PATH)) {
    require_once CRON_SECRET_PATH; // file must define CRON_SECRET constant, set to empty means to disable protection
} /*else {
    file_put_contents(CRON_SECRET_PATH, "<?php\n//define('CRON_SECRET', '');\n");
}*/

function is_cron_secret_ok(): bool
{
    if (!defined('CRON_SECRET')) {
        return false;
    }

    return empty(CRON_SECRET) || (!empty($_GET['secret']) && !empty(CRON_SECRET) && $_GET['secret'] === CRON_SECRET);
}
