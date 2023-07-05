<?php

namespace App\Docs\Swagger\Books;

/**
 * @OA\Delete(
 *     path="/api/v1/books/{id}",
 *     tags={"Books"},
 *     summary="刪除書本",
 *     description="只能刪除屬於自己的書本資料",
 *     security={
 *         {
 *             "Authorization": {}
 *         }
 *     },
 *     @OA\Parameter(
 *         name="id",
 *         description="UUID",
 *         required=true,
 *         in="path",
 *         @OA\Schema(
 *             type="string"
 *         )
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="資源成功建立"
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="請求格式錯誤"
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="需要授權以回應請求"
 *     ),
 *     @OA\Response(
 *         response=403,
 *         description="用戶端並無訪問權限，例如未被授權，所以伺服器拒絕給予應有的回應"
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="請求失敗，請求所希望得到的資源未被在伺服器上發現，但允許使用者的後續請求。"
 *     ),
 * )
 */
class Destroy { }