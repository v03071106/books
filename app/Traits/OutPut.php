<?php

namespace App\Traits;

/**
 * 整合統一回傳方式
 */
Trait OutPut
{
    public function responseRender(array $data, int $httpCode = 200)
    {
        return response()
            ->json($data, $httpCode);
    }
}
