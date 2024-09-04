<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Api\{
    StoreFilmRequest,
    UpdateFilmRequest,
};
use App\Interfaces\FilmRepositoryInterface;
use App\Classes\ApiResponseClass;
use App\Http\Resources\FilmResource;
use Illuminate\Support\Facades\DB;


class FilmController extends Controller
{
    //
    private FilmRepositoryInterface $filmRepositoryInterface;
    public function __construct(FilmRepositoryInterface $filmRepositoryInterface)
    {
        $this->filmRepositoryInterface = $filmRepositoryInterface;
    }
    
    public function index()
    {
        $data = $this->filmRepositoryInterface->index();
        return ApiResponseClass::sendResponse(FilmResource::collection($data), '', 200);
    }

    public function create()
    {
        //
    }

    public function store(StoreFilmRequest $request)
    {
        $posterPath = $request->file('poster')->store('images');
        $data = [
            'title'     => $request->title,
            'sinopsis'  => $request->sinopsis,
            'poster'    => $posterPath,
            'year'      => $request->year,
            'genre_id'  => $request->genre_id,
        ];

        DB::beginTransaction();
        try{
            $film = $this->filmRepositoryInterface->store($data);
            DB::commit();
            return ApiResponseClass::sendResponse(new FilmResource($film), 'Film Create Successful', 201);
        } catch(\Exception $ex) {
            return ApiResponseClass::rollback($ex);
        }
    }

    public function show(string $id)
    {
        $film = $this->filmRepositoryInterface->getById($id);
        return ApiResponseClass::sendResponse(new FilmResource($film), '', 200);
    }

    public function edit(string $id)
    {
        //
    }

    public function update(UpdateFilmRequest $request, $id)
    {
        $posterPath = $request->file('poster')->store('images');
        $updateData = [
            'title'     => $request->title,
            'sinopsis'  => $request->sinopsis,
            'poster'    => $posterPath,
            'year'      => $request->year,
            'genre_id'  => $request->genre_id,
        ];
        DB::beginTransaction();
        try{
            $film = $this->filmRepositoryInterface->update($updateData, $id);
            DB::commit();
            return ApiResponseClass::sendResponse('Film Update Successful', 201);
        } catch(\Exception $ex) {
            return ApiResponseClass::rollback($ex);
        }
    }

    public function destroy(string $id)
    {
        $this->filmRepositoryInterface->delete($id);
        return ApiResponseClass::sendResponse('Film Delete Successful', 204);
    }
}
