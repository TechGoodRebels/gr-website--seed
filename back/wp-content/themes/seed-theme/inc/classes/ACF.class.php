<?php

namespace GoodRebels\Theme;


if (!class_exists(__NAMESPACE__ . '\ACF') && class_exists('\GoodRebels\Helpers\ACF')) {
    abstract class ACF extends \GoodRebels\Helpers\ACF {}
}
