# 個人書櫃

## 開發目標設定
1. 登入之後才可以
    1. 新增 Book
        > 請參考 `App\Http\Controllers\Admin\BooksController`
    2. Book 的擁有者，才有權限進行編輯跟刪除
        > 請參考 `App\Http\Controllers\Admin\BooksController`

2. 回傳相應的 http status code
    > 依照 [API 文檔](https://app.swaggerhub.com/apis-docs/COURTDREAM3/bookstore-api/1.0.0) 建議回傳

    > `Validation` 欄位驗證錯誤時會拋出 `422`

3. 使用 resources 或任何方式來整理 response 的資料。
    > `create`、 `update` 失敗時除了回拋 `400` 外, 會再拋出錯誤訊息

    > `Validation` 欄位驗證錯誤時會拋出相關 error message 訊息

4. 可使用 Laravel 8 以上的版本。
    > 目前使用 `laravel 9.52.10`

5. 請自行設計 DB 的 table 結構，只有使用 uuid 的需求。
    > `uuid` 用於 `books` table 中的 `id` 欄位, 並指定為 `PK鍵`

6. 完成後，請提供 Github 連結。
    > 多一次練習機會, 每次都有不一樣的收穫!! 感謝

7. 紀錄編輯 book 的 log
    > 本來想用 `mysql trigger` 來做紀錄, 但最後還是選擇使用 `Model` 的 `booted()` 事件來完成