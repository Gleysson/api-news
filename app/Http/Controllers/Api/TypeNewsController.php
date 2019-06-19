<?php

namespace App\Http\Controllers\Api;
use App\TypeNews;
use App\Api\Message;

use JWTAuth;
use Illuminate\Http\Request;

use App\Http\Requests\TypeNewsRequest;
use App\Http\Controllers\Controller;

class TypeNewsController extends Controller
{
    function __construct()
    {
        $this->typeNews = new TypeNews();
    }

    // ====================================================
    // ******** Cria uma Novo Tipo de Notícia  ************

    public function create(TypeNewsRequest $request)
    {
        try{
            
            $id_journalist = JWTAuth::parseToken()->toUser()->id;
            $this->typeNews->fill($request->all());
            $this->typeNews->id_journalists = $id_journalist;
            $this->typeNews->save();
                
            return response()->json(
                Message::success("Tipo de Notícia Registrado com Sucesso.", $this->typeNews)
            ,200);

        } catch (\Exception $e) {
            return response()->json(
                Message::error($e->getMessage())
            ,500);
        }
    }

    // ===================================================================
    // ******** Atualiza um Tipo de Noticia no Banco de Dados ************

    public function update(TypeNewsRequest $request, $id)
    {
        try{
            $data = TypeNews::where('id', $id)->update(['name'=> $request->name]);
            response()->json($data);

            return response()->json(
                Message::success("Tipo de Notícia Atualizado com Sucesso.", [])
            ,200);

        } catch (\Exception $e) {
            return response()->json(
                Message::error($e->getMessage())
            ,500);
        }
    }

    // =================================================================
    // ******** Remove um Tipo de Noticia no Banco de Dados ************

    public function delete(Request $request, $id)
    {
        try{
            TypeNews::where('id', $id)->delete();

            return response()->json(
                Message::success("Tipo de Notícia Removido com Sucesso.", [])
            ,200);

        } catch (\Exception $e) {
            return response()->json(
                Message::error($e->getMessage())
            ,500);
        }

    }

    // ============================================================
    // ******** Lista o Tipo de Noticia por Jornalista ************

    public function me(Request $request)
    {
        try{

            $id_journalist = JWTAuth::parseToken()->toUser()->id;
            $data = TypeNews::where('id_journalists', $id_journalist)->get();

            return response()->json(
                Message::success("Tipo de Notícia Listado com Sucesso.", $data)
            ,200);

        } catch (\Exception $e) {
            return response()->json(
                Message::error($e->getMessage())
            ,500);
        }

    }
}
