<?php

namespace Tutis\Exception;

use Exception;

final class InactivePassException extends Exception
{
    public function __construct()
    {
        return parent::__construct('Inactive Pass');
    }
}