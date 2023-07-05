<?php

namespace App\Docs\Swagger\Auth;

/**
 * @OA\Post(
 *     path="/api/v1/register",
 *     tags={"Auth"},
 *     summary="註冊使用者",
 *     description="註冊使用者後方便登入上架書籍",
 *     @OA\Parameter(
 *         name="name",
 *         description="名稱",
 *         required=true,
 *         in="query",
 *         @OA\Schema(
 *             type="string"
 *         )
 *     ),
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
 *         description="請求已經被實現，而且有一個新的資源已經依據請求的需要而建立。"
 *     ),
 *     @OA\Response(
 *         response=422,
 *         description="請求正確，但是由於含有格式錯誤，無法回應。"
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="通用錯誤訊息，伺服器遇到了一個未曾預料的狀況，導致了它無法完成對請求的處理。"
 *     ),
 * )
 */
class Register { }