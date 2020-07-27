<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pet;
use Exception;
use App\Http\Resources\Pet as PetResource;
use App\Http\Resources\PetCollection;
use App\Http\Requests\PetRequest;


class PetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Pet $pet)
    {
        $pets = $pet->all();
        $petsCollection = new PetCollection($pets);
        return response()->json($petsCollection, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\PetRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PetRequest $request)
    {
        try {
            $pet = new Pet();
            $pet->fill($request->all());
            $pet->save();

            return response()->json(new PetResource($pet), 200);
        } catch (\Exception $e) {
            return response()->json([
                'title' => 'Erro',
                'msg' => 'Erro interno do servidor'
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pet  $pet
     * @return \Illuminate\Http\Response
     */
    public function show(Pet $pet)
    {
        try {
            return response()->json(new PetResource($pet), 200);
        } catch (Exception $e) {
            return response()->json([
                'title' => 'Erro',
                'msg' => 'Erro interno do servidor'
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\PetRequest  $request
     * @param  \App\Models\Pet  $pet
     * @return \Illuminate\Http\Response
     */
    public function update(PetRequest $request, Pet $pet)
    {
        try {
            $pet->fill($request->all());
            $pet->save();

            return response()->json(new PetResource($pet), 200);
        } catch (Exception $erro) {
            return response()->json([
                'title' => 'Erro',
                'msg' => 'Erro interno do servidor'
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pet  $pet
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pet $pet)
    {
        try {
            $pet->delete();

            return response()->json([], 204);
        } catch (Exception $e) {
            return response()->json([
                'title' => 'erro',
                'msg' => 'Erro interno do servidor'
            ], 500);
        }
    }
}
