<?php

namespace App\Http\Controllers\Service\Log;

use App\Contracts\Abstract\Log\LogAbstract;
use App\Models\Log_entry;
use App\Models\Log_out;
use App\Models\Production;

class LogService extends LogAbstract
{
    public function __construct(array $request, Production $data)
    {
        switch ($request['option']) {
            case 'entry':
                $log = new Log_entry();
                $this->saveLogEntry($data, $log, $request);

                break;

            case 'out':
                $log = new log_out();
                $this->saveLogOut($data, $log, $request);
                break;
        }
    }

    protected function saveLogOut(Production $data, Log_out $log, array $request): void
    {
        $log->create([

            'reason_out' => $request['reason'],
            'quantity' => $request['quantity'],
            'production_id' => $data->id,
            'date_out' => $data->created_at,
            'user_id' => auth('api')->id()

        ]);
    }

    protected function saveLogEntry(Production $data, Log_entry $log, array $request): void
    {
        $log->create([

            'reason_entry' => $request['reason'],
            'quantity' => $request['quantity'],
            'production_id' => $data->id,
            'date_entry' => $data->created_at,
            'user_id' => auth('api')->id()
        ]);
    }
}
