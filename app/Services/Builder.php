<?php

namespace App\Services;

use Carbon\Carbon;
use Carbon\CarbonInterface;

class Builder {

    public function transformProduct($item)
    {
        return [
            'id' => $item->product->id,
            'name' => $item->product->name
        ];
    }

    public function formatSingleTime($time)
    {
        $var = Carbon::createFromFormat('Y-m-d H:i:s', $time, 'UTC');

        return $var->setTimezone('Asia/Dhaka')->format('F j, Y g:i a');
    }

    public function processHashed($id)
    {
        return strtoupper(substr($id, 2));
    }
}
