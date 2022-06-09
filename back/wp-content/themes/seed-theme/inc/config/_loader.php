<?php

foreach (glob(trailingslashit(__DIR__) . '*.config.php') as $file) {
    require_once $file;
}
