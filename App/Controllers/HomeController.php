<?php

namespace App\Controllers;

use Ahc\Jwt\JWT;
use Ahc\Jwt\JWTException;
use App\Lib\Request;
use App\Lib\Response;
use App\Models\Emails;
use App\Models\User;
use Illuminate\Database\Capsule\Manager;
use OpenApi\Annotations\OpenApi;
use App\Publisher;
use function OpenApi\scan;

class HomeController
{
    /**
     * @OA\Info(
     *    title="Galih Test Odeo",
     *    version="1.0.0",
     * )
     * @OA\SecurityScheme  (
     *  securityScheme="jwt",
     *     type="apiKey",
     *     in="header",
     *     name="Authorization"
     * )
     */

    public function index(Request $req, Response $res)
    {
        return $res->renderHtml(__DIR__.'/../../views/index.html');
    }

    public function user(Request $req, Response $res)
    {
        $users = (new User())->get();
        return $res->toJSON($users);
    }

    /**
     * @OA\Post(
     * path="/login",
     * summary="Sign in",
     * description="Login by username, password",
     * operationId="authLogin",
     * tags={"auth"},
     * @OA\RequestBody(
     *    required=true,
     *    description="Pass user credentials",
     *    @OA\JsonContent(
     *       required={"username","password"},
     *       @OA\Property(property="username", type="string", format="email", example="galih"),
     *       @OA\Property(property="password", type="string", format="password", example="kolkijn123")
     *    ),
     * ),
     * @OA\Response(
     *    response=422,
     *    description="Wrong credentials response",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Unauthorized")
     *        )
     *     )
     * )
     */
    public function login(Request $req, Response $res)
    {
        $attributes = $req->getJson();
        try {
            $user = User::where('username', $attributes['username'])
                ->where('password', $attributes['password'])
                ->first();
            $jwt = new JWT('secret', 'HS256', 3600, 10);
            $token = $jwt->encode([
                'uid'    => $user->id,
                'scopes' => ['user'],
            ]);
            $user['token'] = $token;
            return $res->toJSON([$user]);
        }catch (\Exception $e){
            return $res->toJSON([$e->getMessage()]);
        }
    }

    public function docs(Request $req, Response $res)
    {
        return $res->renderHtml(__DIR__.'/../../views/docs.html');
    }

    public function docJson(Request $req, Response $res)
    {
        $openApi = scan(__DIR__);
        header('Content-Type: application/json');
        echo $openApi->toJson();
    }
    /**
     * @OA\Post(
     * path="/send_email",
     * summary="Send Email",
     * description="Login by username, password",
     * tags={"Email"},
     *  security={ {"jwt": {} }},
     * @OA\RequestBody(
     *    required=true,
     *    description="Send Email Endpoint",
     *    @OA\JsonContent(
     *       required={"username","password"},
     *       @OA\Property(property="to_email", type="string", format="email", example="galihabdullah471@gmail.com"),
     *       @OA\Property(property="title", type="string", format="text", example="user"),
     *       @OA\Property(property="message", type="string", format="text", example="PassWord12345")
     *    ),
     * ),
     * @OA\Response(
     *    response=422,
     *    description="Wrong credentials response",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Unauthorized")
     *        )
     *     )
     * )
     */
    public function sendEmail(Request $request, Response $response)
    {
        $header = $request->getBearerToken();
        if(!$header){
            $response->status(422);
            return $response->toJSON([
                'error' => 'Unauthenticated'
            ]);
        }
        try {
            $jwt = new JWT('secret', 'HS256', 3600, 10);
            $payload = $jwt->decode($header);
            $attibutes = $request->getJson();
            $attibutes['id_user'] = $payload['uid'];
            $attibutes['status'] = 'draft';
            (new Publisher(['queue' => 'sendEmail']))->send(json_encode($attibutes));
            $response->status(200);
            return $response->toJSON([
                'success' => 'Berhasil kirim email'
            ]);
        }catch (JWTException $e){
            $response->status(422);
            return $response->toJSON([
                'error' => $e->getMessage()
            ]);
        }catch (\Exception $e){
            $response->status(422);
            return $response->toJSON([
                'error' => $e->getMessage()
            ]);
        }

    }



}