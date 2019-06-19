<?php

namespace App\Http\Controllers\Api;

use App\News;
use App\Api\Message;
use JWTAuth; 

use Illuminate\Http\Request;
use App\Http\Requests\NewsRequest;
use App\Http\Controllers\Controller;

class NewsController extends Controller
{
    function __construct(){
        $this->news = new News();
    }


    // =========================================================
    // **** Retorna Todas as Notícias de um Jornalista *********
 
    public function me(Request $request)
    {
        try{
            $id_journalist = JWTAuth::parseToken()->toUser()->id;
            $data =  News::where('id_journalist', $id_journalist)->get();

            return response()->json(
                Message::success("Notícias listadas com sucesso.", $data)
            ,200);

        } catch (\Exception $e) {
            return response()->json(
                Message::error($e->getMessage())
            ,500);
        }
    }


    // =========================================================
    // ******** Cria uma Notícias no Banco de Dados ************

    public function create(NewsRequest $request)
    {
        try{
            $id_journalist = JWTAuth::parseToken()->toUser()->id;
            $this->news->fill($request->all());
            $this->news->id_journalist = $id_journalist;
            $this->news->save();

            return response()->json(
                Message::success("Notícia registrada com sucesso.", $this->news)
            ,201);

        } catch (\Exception $e) {
            return response()->json(
                Message::error($e->getMessage())
            ,500);
        }
    }


    // =============================================================
    // ******** Atualiza uma Notícias no Banco de Dados ************

    public function update(NewsRequest $request, $id)
    {
        
        try{
            News::where('id', $id)->update([
                'id_type_news' => $request->id_type_news,
                'title' => $request->title,
                'description' => $request->description,
                'image' => $request->image
            ]);

            return response()->json(
                Message::success("Notícia atualizada com sucesso.", [])
            ,200);

        } catch (\Exception $e) {
            return response()->json(
                Message::error($e->getMessage())
            ,500);
        }
    }



    // ===========================================================
    // ******** Remove uma Notícias no Banco de Dados ************

    public function delete(Request $request, $id)
    {
        try{
            News::where('id', $id)->delete();

            return response()->json(
                Message::success("Notícia removida com sucesso.", [])
            ,200);

        } catch (\Exception $e) {
            return response()->json(
                Message::error($e->getMessage())
            ,500);
        }
    }

    // =============================================================
    // ******** Lista as Notícias por Tipo e Jornalista ************

    public function newsByType(Request $request, $id_type_news)
    {
        try{
            
            $id_journalist = JWTAuth::parseToken()->toUser()->id;
            $data =  News::where('id_journalist', $id_journalist)->where('id_type_news', $id_type_news)->get();

            return response()->json(
                Message::success("Notícias listadas com sucesso.", $data)
            ,200);

        } catch (\Exception $e) {
            return response()->json(
                Message::error($e->getMessage())
            ,500);
        }
    }

    
}
