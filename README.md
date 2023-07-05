# 個人書櫃

## 開發環境軟體版本
  * centos / 7.9.2009
    * php / 8.1.20
    * apache / 2.4.6
    * composer / 2.5.8
  * mariadb / 10.7.8
  * nginx / 1.22.1
  * redis / 6.2.11
  * phpMyAdmin / 5.2.1
  * redisAdmin / 1.19.2

## 訪問 api/doc 可以參考 swagger api 文檔

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


## 以下幾個問題，提供給您做參考。

1. 密碼（password）缺乏驗證機制。
    > 應該是指密碼的組合嚴謹度
    > > 至少需要 8 個字符、 至少需要一個大寫字母和一個小寫字母
    >
    > > 至少需要一個字母、 至少需要一個數字、 至少需要一個符號
    >
    > > 確保密碼在同一數據洩露中出現少於 0 次

2. StoreRequest 應該對價格（price）、數量（quantity）和圖片（images）進行驗證。
    > 應該是指 `App\Http\Requests\Books\PostRequest.php` 中的 `rules()` 應該再更嚴謹一些
    > 已加強針對欄位: 價格（price）、數量（quantity）限制應輸入範圍為 1 ~ 32767
    > 已加強針對欄位: 圖片（images）驗證 `path` 應為 `url` 格式

3. owner_id 應該建立關聯。
    > 可建立, 但需求中亦無提出, 應釐清需求是否要再設計其他API, 例如(客戶資料上傳書籍API需求)

4. “show” 不應僅限於作者可見。
    > 應釐清需求邏輯是否為: 非書籍擁有者〝可見〞或〝不可見〞

5. 更新（update）的彈性不足，如果沒有強制要求必填項目，則原本存在的資料都會被刪除。
    > 應該是指資料可以再次被修改為空值並通過〝驗證邏輯〞,導致原本新增時候的資料被清空?
    > 測試起來沒有上述狀況發生

6. 應引入服務層（service）和資料存取層（repository）的概念。
    > 要更進一步學習拆分概念