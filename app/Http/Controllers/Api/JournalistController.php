<?php

namespace App\Http\Controllers\Api;

use App\Journalist;
use App\Api\Message;
use App\Http\Controllers\Controller;
use App\Http\Requests; 
use App\Http\Requests\JournalistRequest;
use App\Http\Requests\AuthenticateRequest;



use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

use JWTAuth; 
// use JWTFactory; 
// use JWTAuthException; 
// use Tymon\JWTAuth\Payload;
 

class JournalistController extends Controller
{   

    private $journalist;

    function __construct()
    {
        $this->journalist = new Journalist();
    }

    // ==========================================================
    // ******** Cria um Jornalista no Banco de Dados ************

    public function register(JournalistRequest $request)
    {   
        
        try{

            $this->journalist->fill($request->all());
            $this->journalist->password = Hash::make(request('password'));
            $this->journalist->save();

            return response()->json(
                Message::success("Jornalista registrado com sucesso.",  $this->journalist)
            ,201);

        } catch (\Exception $e) {
            return response()->json(
                Message::error($e->getMessage())
            ,500);
        }
    }

    // ==========================================================
    // ******** Realiza a Autenticação do Jornalista ************

    public function login(AuthenticateRequest $request)
    {
        try{
            $credentials = $request->only('email', 'password');
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }

            return response()->json(
                Message::success("Login realizado com sucesso.", compact('token'))
            ,201);

        } catch ( \Exception $e) {
            return response()->json(
                Message::error($e->getMessage()),500
            );
        }
    }

    // ==============================================================
    // ******** Lista os Dados do Jornalista Autenticado ************

    public function me()
    {
        try{
            $this->journalist = JWTAuth::parseToken()->toUser();
            
            return response()->json(
                Message::success("Jornalista listado com sucesso.", $this->journalist)
            ,200);

        } catch ( \Exception $e) {
            return response()->json(
                Message::error($e->getMessage()),500
            );
        }
    }
}
