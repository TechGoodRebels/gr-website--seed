<?php

foreach (glob(trailingslashit(__DIR__) . '*.class.php') as $file) {
    require_once $file;
}
