<?php

declare(strict_types=1);

function is_input_empty(int $studentId,string $outingTimeIn,string $outingTimeOut)
{
    if (empty($studentId) || empty($outingTimeIn) || empty($outingTimeOut)) {
        return true;
    }else {
     return false;
    }
}