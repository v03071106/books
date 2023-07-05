<?php

namespace App\Traits;

/**
 * 整合統一回傳方式
 */
Trait OutPut
{
    /**
     * Undocumented function
     *
     * @param array $data
     * @param string|null $message
     * @param integer $httpCode
     * @return \Illuminate\Http\JsonResponse
     */
    public function responseRender(array $data = [], ?string $message = null, int $httpCode = 200)
    {
        $info = collect();
        if (0 !== count($data)) {
            $info->put('data', $data);
        }
        if (null !== $message) {
            $info->put('message', $message);
        }
        $headers = array('Content-Type' => 'application/json; charset=utf-8');
        return response()
            ->json($info, $httpCode, $headers, JSON_UNESCAPED_UNICODE);
    }
}
