<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

use App\Models\Books;
use App\Http\Controllers\Controller;
use App\Http\Requests\Books\PostRequest;

class BooksController extends Controller
{
    use \App\Traits\OutPut;

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $show = $request->input('size', 10);
        $show = intval($show);
        $ownerId = auth('api')->user()->id;
        $paginator = Books::where(['owner_id' => $ownerId])
            ->orderBy('id', 'DESC')
            ->paginate($show);
        $paginator->transform(function ($item) {
            $item->images = json_decode($item->images);
            return $item;
        });
        return $this->responseRender(
            collect($paginator)
                ->only(['data', 'total', 'per_page', 'current_page'])
                ->toArray()
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Books\PostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        $validated = $request->validated();
        try {
            Books::create([
                "id" => (string) Str::uuid(),
                "owner_id" => auth('api')->user()->id,
                "title" => $validated["title"],
                "author" => $validated["author"],
                "published_at" => $validated["published_at"] ?? null,
                "category" => $validated["category"],
                "price" => $validated["price"],
                "quantity" => $validated["quantity"],
                "images" => json_encode($validated["images"])
            ]);
            return $this->responseRender(httpCode: 201);
        } catch (QueryException $exception) {
            return $this->responseRender(
                httpCode: 500,
                message: $exception->getMessage()
            );
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ownerId = auth('api')->user()->id;
        $books = Books::where(['id' => $id, 'owner_id' => $ownerId])->first();
        if (null === $books) {
            return $this->responseRender(
                httpCode: 404,
                message: "{$id} 資料不存在, 請重新操作。"
            );
        }
        return $this->responseRender($books->toArray());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Books\PostRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, $id)
    {
        $validated = $request->validated();
        try {
            $ownerId = auth('api')->user()->id;
            $books = Books::where(['id' => $id, 'owner_id' => $ownerId])->first();
            if (null === $books) {
                return $this->responseRender(
                    httpCode: 404,
                    message: "{$id} 資料不存在, 請重新操作。"
                );
            }
            $books->title = $validated["title"];
            $books->author = $validated["author"];
            $books->published_at = $validated["published_at"] ?? null;
            $books->category = $validated["category"];
            $books->price = $validated["price"];
            $books->quantity = $validated["quantity"];
            $books->images = json_encode($validated["images"]);
            $books->save();
            return $this->responseRender(httpCode: 201);
        } catch (QueryException $exception) {
            return $this->responseRender(
                httpCode: 500,
                message: $exception->getMessage()
            );
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $ownerId = auth('api')->user()->id;
            $books = Books::where(['id' => $id, 'owner_id' => $ownerId])->first();
            if (null === $books) {
                return $this->responseRender(
                    httpCode: 404,
                    message: "{$id} 資料不存在, 請重新操作。"
                );
            }
            $books->delete();
            return $this->responseRender(httpCode: 204);
        } catch (QueryException $exception) {
            return $this->responseRender(
                httpCode: 500,
                message: $exception->getMessage()
            );
        }
    }
}
