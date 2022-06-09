<?php


foreach (glob(trailingslashit(__DIR__) . '*.option.php') as $file) {
    require_once $file;
}
