<?php

namespace App\Docs\Swagger\Auth;

/**
 * @OA\Post(
 *     path="/api/v1/login",
 *     tags={"Auth"},
 *     summary="獲取憑證",
 *     description="獲取憑證以便進行其他流程操作",
 *     @OA\Parameter(
 *         name="email",
 *         description="電子信箱",
 *         required=true,
 *         in="query",
 *         @OA\Schema(
 *             type="string"
 *         )
 *     ),
 *     @OA\Parameter(
 *         name="password",
 *         description="密碼",
 *         required=true,
 *         in="query",
 *         @OA\Schema(
 *             type="string"
 *         )
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="請求已經被實現，而且有一個新的資源已經依據請求的需要而建立"
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="帳號或密碼錯誤, 請重新輸入。"
 *     ),
 *     @OA\Response(
 *         response=422,
 *         description="請求正確，但是由於含有格式錯誤，無法回應"
 *     ),
 * )
 */
class Login { }