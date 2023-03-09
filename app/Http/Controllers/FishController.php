<?php

namespace App\Http\Controllers;

use App\Actions\FishDelete;
use Illuminate\Http\Request;
use App\Actions\FishStore;
use Illuminate\Http\JsonResponse;
use App\Models\Fish;
use App\Actions\FishUpdate;
use Illuminate\Support\Facades\Auth;

class FishController extends Controller
{
    /**
     * index
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $user_id = Auth::user()->id;

        $fish = Fish::where('user_id', $user_id)->get();

        return response()->json($fish, 200);
    }

    /**
     * store
     *
     * @param  mixed $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $fish = app(FishStore::class)->execute([
            'name' => $request->name,
            'scientific_name' => $request->scientific_name
        ]);

        return response()->json($fish, 200);
    }

    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $id
     * @return JsonResponse
     */
    public function update(Request $request, $id): JsonResponse
    {
        $response = app(FishUpdate::class)->execute([
            'id' => $id,
            'name' => $request->name,
            'scientific_name' => $request->scientific_name
        ]);

        return response()->json($response['message'], $response['status']);
    }

    /**
     * delete
     *
     * @param  mixed $id
     * @return JsonResponse
     */
    public function delete($id): JsonResponse
    {
        $response = app(FishDelete::class)->execute($id);

        return response()->json($response['message'], $response['status']);
    }
}
