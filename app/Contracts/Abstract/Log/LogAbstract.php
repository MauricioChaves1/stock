<?php

namespace App\Contracts\Abstract\Log;

use App\Models\Log_entry;
use App\Models\Log_out;
use App\Models\Production;

abstract class LogAbstract
{
    abstract protected function saveLogEntry(Production $data, Log_entry $log, array $request): void;
    abstract protected function saveLogOut(Production $data, Log_out $log, array $request): void;
}
