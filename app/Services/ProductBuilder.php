<?php

namespace App\Services;

use Carbon\Carbon;
use Carbon\CarbonInterface;
use Illuminate\Support\Facades\Log;

class ProductBuilder extends Builder {

    public function transformProduct($item)
    {
        Log::info($item);
        $final = [
            'id' => $item->id,
            'name' => $item->name,
            'slug' => $item->slug,
            'created_at' => $this->formatSingleTime($item->created_at),
            'updated_at' => $this->formatSingleTime($item->updated_at),
        ];

        return $final;
    }
}
