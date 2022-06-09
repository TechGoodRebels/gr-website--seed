<?php

namespace GoodRebels\Theme;


if (!class_exists(__NAMESPACE__ . '\Key') && class_exists('\GoodRebels\Helpers\Key')) {
    abstract class Key extends \GoodRebels\Helpers\Key {}
}
