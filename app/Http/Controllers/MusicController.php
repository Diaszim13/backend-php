<?php

namespace App\Http\Controllers;

use App\Models\Music;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

class MusicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        //
        $musics = Music::all();
        // Debugbar::info($musics);

        if (sizeof($musics) == 0) {
            return response()->json([
                "Success" => false,
                "message" => "nenhuma musica encontrada",
                "data" => []
            ]);
        }
        return response()->json([
            "Success" => true,
            "message" => "Aqui estao todas as suas musicas!",
            "data" => $musics
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $data = $request->all();
        Log::info($request);

        $music = Music::create($data);
        return response()->json(([
            "Success" => true,
            "message" => "Gravado com sucesso!",
            "data" => $music
        ]));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        //
        $music = Music::find($id);
        if(!$music)
        {
            return response()->json([
                "Success" => false,
                "message" => "Registro não encontrado!"
            ]);    
        }

        $music->delete();
        return response()->json([
            "Success" => true,
            "message" => "Gravado com sucesso!"
        ]);
    }

    /** Guarda o arquivo da msuca
     * /
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function upload(Request $request)
    {
        $audioFile = $request->file('audio_file');
        $path = $audioFile->store('public/audios');

        return response()->json(['message' => 'File uploaded successfully', 'path' => $path]);

    }
}