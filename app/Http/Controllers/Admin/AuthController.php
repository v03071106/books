<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Database\QueryException;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginPostRequest;
use App\Http\Requests\RegisterPostRequest;

class AuthController extends Controller
{
    use \App\Traits\OutPut;

    /**
     * 登入處理
     *
     * @param  \App\Http\Requests\LoginPostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function login(LoginPostRequest $request)
    {
        $validated = $request->validated();
        $token = auth('api')->attempt($validated);
        if (false === $token) {
            return $this->responseRender(
                httpCode: 401,
                message: '帳號或密碼錯誤, 請重新輸入。'
            );
        }
        return $this->responseRender([
            'access_token' => $token,
        ]);
    }

    /**
     * 註冊處理
     *
     * @param  \App\Http\Requests\RegisterPostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function register(RegisterPostRequest $request)
    {
        $validated = $request->validated();
        try {
            User::create([
                "name" => $validated["name"],
                "email" => $validated["email"],
                "password" => $validated["password"],
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
     * 登出處理
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout() {
        auth('api')->logout();
        return $this->responseRender(httpCode: 204);
    }
}
