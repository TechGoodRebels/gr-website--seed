<?php

foreach (glob(trailingslashit(__DIR__) . '*.render.php') as $file) {
    require_once $file;
}
