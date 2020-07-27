<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Exception;
use App\Http\Resources\User as UserResource;
use App\Http\Resources\UserCollection;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{
    // Index -> Trazer todas os registros
    // Store -> Salvar um registro
    // Show -> Visualizar um registro
    // Update -> Realizar atualiação de um registro
    // Destroy -> Remover um registro

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
        $users = $user->all();
        $usersCollection = new UserCollection($users);
        return response()->json($usersCollection, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\UserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        try {
            $user = new User();
            $user->fill($request->all());
            $user->save();

            return response()->json(new UserResource($user), 200);
        } catch (Exception $e) {
            return response()->json([
                'title' => 'Erro',
                'msg' => 'Erro interno do servidor'
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        try {
            return response()->json(new UserResource($user), 200);
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
     * @param  \Illuminate\Http\UserRequest  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $user)
    {
        try {
            $user->fill($request->all());
            $user->save();

            return response()->json(new UserResource($user), 200);
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
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        try {
            $user->delete();

            return response()->json([], 204);
        } catch (Exception $e) {
            return response()->json([
                'title' => 'erro',
                'msg' => 'Erro interno do servidor'
            ], 500);
        }
    }
}
