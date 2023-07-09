<?php

namespace App\Interfaces;

use Illuminate\Pagination\LengthAwarePaginator;

interface RepositoryInterface
{
    /**
     * 取出分頁後的數據
     *
     */
    public function listByOwnerId();

    /**
     * 尋找指定資料
     *
     * @param string|integer $id
     * @return void
     */
    public function findById(string|int $id);

    /**
     * 新增資料
     *
     * @param array $request
     * @return void
     */
    public function create(array $request);

    /**
     * 修改指定資料
     *
     * @param string|integer $id
     * @param array $request
     * @return void
     */
    public function update(string|int $id, array $request);

    /**
     * 刪除指定資料
     *
     * @param string|integer $id
     * @return void
     */
    public function delete(string|int $id);
}
