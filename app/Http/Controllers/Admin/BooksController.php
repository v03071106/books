<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Models\Books;
use App\Http\Controllers\Controller;
use App\Repositories\BooksRepository;
use App\Http\Requests\Books\PostRequest;
use App\Services\BooksService;

class BooksController extends Controller
{
    use \App\Traits\OutPut;

    /**
     * @var \App\Services\BooksService
     */
    protected $service = null;

    /**
     * 建構子
     *
     * @param BooksService $service
     */
    public function __construct(BooksService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Repositories\BooksRepository $repository
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $size = intval($request->input('size', 10));
        $owner_id = $this->service->getCurrentUserId();
        $paginator = $this->service->paginate($owner_id, $size);
        return $this->responseRender($paginator);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Books\PostRequest  $request
     * @param  \App\Repositories\BooksRepository $repository
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        $validated = $request->validated();
        $this->service->create([
            "owner_id" => $this->service->getCurrentUserId(),
            "title" => $validated["title"],
            "author" => $validated["author"],
            "published_at" => $validated["published_at"] ?? null,
            "category" => $validated["category"],
            "price" => $validated["price"],
            "quantity" => $validated["quantity"],
            "images" => $validated["images"]
        ]);
        return $this->responseRender(httpCode: 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @param  \App\Repositories\BooksRepository $repository
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $owner_id = $this->service->getCurrentUserId();
        $books = $this->service->show($id, $owner_id);
        return $this->responseRender($books);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Books\PostRequest  $request
     * @param  int  $id
     * @param  \App\Repositories\BooksRepository $repository
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, $id)
    {
        $validated = $request->validated();
        $this->service->update($id, $validated);
        return $this->responseRender(httpCode: 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->service->findAndDelete($id);
        return $this->responseRender(httpCode: 204);
    }
}
