<?php

namespace App\Docs\Swagger\Books;

/**
 * @OA\Get(
 *     path="/api/v1/books",
 *     tags={"Books"},
 *     summary="取得所有書本資料",
 *     description="只能查詢屬於自己的書本資料",
 *     security={
 *         {
 *             "Authorization": {}
 *         }
 *     },
 *     @OA\Parameter(
 *         name="page",
 *         description="分頁",
 *         required=true,
 *         in="query",
 *         @OA\Schema(
 *             type="string",
 *             example=1,
 *         )
 *     ),
 *     @OA\Parameter(
 *         name="size",
 *         description="分頁呈現資料筆數",
 *         required=true,
 *         in="query",
 *         @OA\Schema(
 *             type="string",
 *             example=10,
 *         )
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="資源成功建立",
 *         @OA\MediaType(
 *             mediaType="application\json",
 *             @OA\Schema(
 *                 @OA\Property(
 *                     property="data",
 *                     type="object",
 *                     @OA\Property(
 *                         property="current_page",
 *                         type="integer",
 *                         description="當前頁面"
 *                     ),
 *                     @OA\Property(
 *                         property="data",
 *                         type="array",
 *                         description="每筆資料內容",
 *                         @OA\Items(
 *                             @OA\Property(
 *                                 property="id",
 *                                 type="string",
 *                                 description="UUID編號",
 *                                 example="fd824506-aa7f-4b61-987b-18a626a2cceb",
 *                             ),
 *                             @OA\Property(
 *                                 property="title",
 *                                 type="string",
 *                                 description="標題",
 *                                 example="理財通!!",
 *                             ),
 *                             @OA\Property(
 *                                 property="author",
 *                                 type="string",
 *                                 description="作者",
 *                                 example="阿囉哈",
 *                             ),
 *                             @OA\Property(
 *                                 property="published_at",
 *                                 type="string|null",
 *                                 description="發布時間",
 *                                 example="2023-07-04 23:44:37",
 *                             ),
 *                             @OA\Property(
 *                                 property="category",
 *                                 type="string",
 *                                 description="分類",
 *                                 example="阿囉哈",
 *                                 enum={"投資理財", "文創手作", "心靈雞湯", "程式語言"},
 *                             ),
 *                             @OA\Property(
 *                                 property="price",
 *                                 type="number",
 *                                 format="integer",
 *                                 description="價格",
 *                                 example=3
 *                             ),
 *                             @OA\Property(
 *                                 property="quantity",
 *                                 type="number",
 *                                 format="integer",
 *                                 description="數量",
 *                                 example=3
 *                             ),
 *                             @OA\Property(
 *                                 property="images",
 *                                 type="array",
 *                                 description="圖檔資料內容",
 *                                 @OA\Items(
 *                                     @OA\Property(
 *                                         property="name",
 *                                         type="string",
 *                                         description="圖片名稱",
 *                                         example="Sunshine",
 *                                     ),
 *                                     @OA\Property(
 *                                         property="path",
 *                                         type="string",
 *                                         description="圖片路徑",
 *                                         example="https://images.unsplash.com/photo-1536484049453-85de4ea3db6a?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1021&q=80",
 *                                     ),
 *                                 )
 *                             )
 *                         ),
 *                     ),
 *                     @OA\Property(
 *                         property="total",
 *                         type="integer",
 *                         description="總頁數"
 *                     ),
 *                     @OA\Property(
 *                         property="per_page",
 *                         type="integer",
 *                         description="下頁"
 *                     ),
 *                 )
 *             )
 *         )
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
class Index { }