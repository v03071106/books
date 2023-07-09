<?php

namespace App\Repositories;

use Illuminate\Database\QueryException;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Models\Books;
use App\Interfaces\RepositoryInterface;

class BooksRepository implements RepositoryInterface
{
    /**
     * 取得資料並指定回傳為分頁
     *
     * @param integer $owner_id 書籍擁有者ID
     * @param integer $size 每頁呈現筆數
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function listByOwnerId(int $owner_id = 0)
    {
        // 回傳資料可以用 get() 或是 paginate() 來接值
        // https://stackoverflow.com/a/26781551
        return Books::where(['owner_id' => $owner_id])
            ->orderBy('id', 'DESC');
    }

    /**
     * 尋找指定資料
     *
     * @param string|integer $uuid
     * @return \App\Models\Books
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function findById(string|int $uuid): Books
    {
        $books = Books::find($uuid);
        if (false === $books) {
            throw new ModelNotFoundException('Books not found by ID ' . $uuid);
        }

        return $books;
    }

    /**
     * 尋找指定擁有者、 UUID的資料
     *
     * @param string|int $uuid
     * @param integer $owner_id 書籍擁有者ID
     * @return \App\Models\Books
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function findByIdWithOwnerId(string|int $uuid, int $owner_id)
    {
        $wheres = ['id' => $uuid, 'owner_id' => $owner_id];
        $book = Books::where($wheres)->firstOrFail();
        return $book;
    }

    /**
     * 新增資料
     *
     * @param array $data
     * @return \App\Models\Books
     */
    public function create(array $data)
    {
        try {
            return Books::create([
                "id" => $data["id"],
                "owner_id" => $data["owner_id"],
                "title" => $data["title"],
                "author" => $data["author"],
                "published_at" => $data["published_at"] ?? null,
                "category" => $data["category"],
                "price" => $data["price"],
                "quantity" => $data["quantity"],
                "images" => $data["images"]
            ]);
        } catch (QueryException $exception) {
            logger($exception->getMessage(), $exception->getTrace());
            throw $exception;
        }
    }

    /**
     * 修改指定資料
     *
     * @param string|int $uuid
     * @param array $data
     * @return \App\Models\Books
     * @throws Exception
     */
    public function update(string|int $uuid, array $data)
    {
        try {
            $books = Books::find($uuid);
            $books->title = $data["title"];
            $books->author = $data["author"];
            $books->published_at = $data["published_at"] ?? null;
            $books->category = $data["category"];
            $books->price = $data["price"];
            $books->quantity = $data["quantity"];
            $books->images = $data["images"];
            $books->save();
            return $books;
        } catch (QueryException $exception) {
            logger($exception->getMessage(), $exception->getTrace());
            throw $exception;
        }
    }

    /**
     * 刪除指定資料
     *
     * @param string|int $uuid
     * @return void
     * @throws Exception
     */
    public function delete(string|int $uuid)
    {
        try {
            $books = Books::find($uuid);
            $books->delete();
        } catch (QueryException $exception) {
            logger($exception->getMessage(), $exception->getTrace());
            throw $exception;
        }
    }
}
