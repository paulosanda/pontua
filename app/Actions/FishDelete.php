<?php

namespace App\Actions;

use App\Models\Fish;

class FishDelete extends ActionBase
{

    public function execute($id)
    {
        $fish = Fish::where('id', $id)->delete();

        if ($fish) {
            $response = [
                'status' => 200,
                'message' => 'Peixe deletado com sucesso'
            ];
        } else {
            $response = [
                'status' => 400,
                'message' => 'O peixe não pode ser deletado'
            ];
        }

        return $response;
    }
}
