<?php

namespace App\Services;

use Illuminate\Support\Str;
use App\Repositories\BooksRepository;

class BooksService
{
    /**
     * @var \App\Repositories\BooksRepository
     */
    protected $books = null;

    /**
     * 建構子
     */
    public function __construct(BooksRepository $repository)
    {
        $this->books = $repository;
    }

    /**
     * 取得當前登入者ID
     *
     * @return integer
     */
    public function getCurrentUserId(): int
    {
        return auth('api')->user()->id;
    }

    /**
     * 尋找指定的資料
     *
     * @param string|integer $uuid
     * @param integer $owner_id
     * @return array
     */
    public function find(string|int $uuid, int $owner_id)
    {
        return $this->books
            ->findByIdWithOwnerId($uuid, $owner_id)
            ->toArray();
    }

    /**
     * 尋找指定擁有者、 UUID的資料
     *
     * @param string|int $uuid
     * @param integer $owner_id 書籍擁有者ID
     * @return array
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function show(string|int $uuid, int $owner_id): array
    {
        return $this->books
            ->findByIdWithOwnerId($uuid, $owner_id)
            ->toArray();
    }

    /**
     * 取出所有書籍資料
     *
     * @param integer $owner_id
     * @param integer $size
     * @return array
     */
    public function paginate(int $owner_id, int $size = 10)
    {
        $paginator = $this->books
            ->listByOwnerId($owner_id, $size)
            ->paginate($size);
        return collect($paginator)
            ->only(['data', 'total', 'per_page', 'current_page'])
            ->toArray();
    }

    /**
     * 新增處理流程
     *
     * @param array $data
     * @return void
     */
    public function create(array $data)
    {
        return $this->books->create([
            "id" => (string) Str::uuid(),
            "owner_id" => $data["owner_id"],
            "title" => $data["title"],
            "author" => $data["author"],
            "published_at" => $data["published_at"] ?? null,
            "category" => $data["category"],
            "price" => $data["price"],
            "quantity" => $data["quantity"],
            "images" => $data["images"]
        ]);
    }

    /**
     * 修改處理流程
     *
     * @param string|int $uuid
     * @param array $data
     * @return void
     */
    public function update(string|int $uuid, array $data)
    {
        $owner_id = $this->getCurrentUserId();
        $books = $this->find($uuid, $owner_id);
        return $this->books->update($uuid, [
            'title' => $data["title"] ?? $books['title'],
            'author' => $data["author"] ?? $books['author'],
            'published_at' => $data["published_at"] ?? $books['published_at'],
            'category' => $data["category"] ?? $books['category'],
            'price' => $data["price"] ?? $books['price'],
            'quantity' => $data["quantity"] ?? $books['quantity'],
            'images' => $data["images"] ?? $books['images'],
        ]);
    }

    /**
     * 刪除指定的資料
     *
     * @param string|integer $uuid
     * @return void
     */
    public function findAndDelete(string|int $uuid)
    {
        $owner_id = $this->getCurrentUserId();
        $this->find($uuid, $owner_id);
        return $this->books->delete($uuid);
    }
}
