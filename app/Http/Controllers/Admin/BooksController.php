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
        $results = Books::where(['owner_id' => $ownerId])
            ->orderBy('id', 'DESC')
            ->paginate($show);
        return $this->responseRender(
            collect($results)
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
            return $this->responseRender([], 201);
        } catch (QueryException $exception) {
            return $this->responseRender([
                'message' => $exception->getMessage()
            ], 400);
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
            return $this->responseRender([], 404);
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
                return $this->responseRender([], 404);
            }
            $books->title = $validated["title"];
            $books->author = $validated["author"];
            $books->published_at = $validated["published_at"] ?? null;
            $books->category = $validated["category"];
            $books->price = $validated["price"];
            $books->quantity = $validated["quantity"];
            $books->images = json_encode($validated["images"]);
            $books->save();
            return $this->responseRender([], 201);
        } catch (QueryException $exception) {
            return $this->responseRender([
                'message' => $exception->getMessage()
            ], 400);
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
                return $this->responseRender([], 404);
            }
            $books->delete();
            return $this->responseRender([], 204);
        } catch (QueryException $exception) {
            return $this->responseRender([], 400);
        }
    }
}