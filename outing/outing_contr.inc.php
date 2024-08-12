<?php

declare(strict_types=1);

function is_input_empty(bool $exeat, string $outingReason, string $outingDuration, string $outingDestination, string $outingTransport)
{
    if (empty($outingReason) || empty($outingDuration) || empty($outingDestination) || empty($outingTransport)) {
        return true;
    }else {
     return false;
    }
}

