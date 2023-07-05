<?php

namespace App\Docs\Swagger\Auth;

/**
 * @OA\Post(
 *     path="/api/v1/logout",
 *     tags={"Auth"},
 *     summary="註銷憑證",
 *     description="註銷已登入的使用者",
 *     security={
 *         {
 *             "Authorization": {}
 *         }
 *     },
 *     @OA\Response(
 *         response=204,
 *         description="伺服器成功處理了請求，沒有返回任何內容"
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="需要授權以回應請求"
 *     ),
 *     @OA\Response(
 *         response=403,
 *         description="用戶端並無訪問權限，例如未被授權，所以伺服器拒絕給予應有的回應"
 *     ),
 * )
 */
class Logout { }