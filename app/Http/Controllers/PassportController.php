<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class PassportController extends Controller
{
    /**
     * @OA\Get(
     *      path="/ping",
     *      operationId="getPingPongTest",
     *      tags={"Connectivity"},
     *      summary="Get PingPong Test",
     *      description="Returns pong",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *       )
     *     )
     */
    public function ping(){
        return response()->json('pong', 200);
    }

    /**
     * @OA\Post(
     *      path="/register",
     *      operationId="registerNewDevice",
     *      tags={"Authentication"},
     *      summary="Registers new device",
     *      description="Registers new device",
     *      @OA\Parameter(
     *          name="name",
     *          description="User's fullname",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="email",
     *          description="User's Email Address",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string | email"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="password",
     *          description="Authentication's Password",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Returns Access Token",
     *       )
     *     )
     */
    public function register(Request $request)
    {
        $this->validate($request, [
            'name'     => 'required|min:3',
            'email'    => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => bcrypt($request->password)
        ]);

        $token = $user->createToken('Laratoken')->accessToken;

        return response()->json(['token' => $token], 200);
    }

    /**
     * @OA\Post(
     *      path="/login",
     *      operationId="loginDevice",
     *      tags={"Authentication"},
     *      summary="Logins device",
     *      description="Logins device",
     *      @OA\Parameter(
     *          name="email",
     *          description="User's Email Address",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string | email"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="password",
     *          description="Authentication's Password",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Returns Access Token",
     *       )
     *     )
     */
    public function login(Request $request)
    {
        $credentials = [
            'email'    => $request->email,
            'password' => $request->password
        ];

        if (auth()->attempt($credentials)) {
            $token = auth()->user()->createToken('Laratoken')->accessToken;
            return response()->json(['token' => $token], 200);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }

    /**
     * @OA\Get(
     *      path="/v1/user",
     *      operationId="userInfo",
     *      tags={"User Actions"},
     *      summary="Shows logged-in user info",
     *      description="Shows logged-in user info",
     *      @OA\Response(
     *          response=200,
     *          description="logged-in user info details",
     *       )
     *     )
     */
    public function details()
    {
        return response()->json(['user' => auth()->user()], 200);
    }
}
