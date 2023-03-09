<?php

namespace App\Actions;

use App\Models\Fish;

class FishUpdate extends ActionBase
{

    /**
     * execute
     *
     * @param  mixed $input
     * @return array
     */
    public function execute($input): array
    {
        $this->validate($input, [
            'id' => 'required',
            'name' => 'string|required',
            'scientific_name' => 'string|required',
        ]);

        $fish = Fish::where('id', '=', $input['id'])->update([
            'name' => $input['name'],
            'scientific_name' => $input['scientific_name'],
        ]);


        if ($fish) {
            $response = [
                'status' => 200,
                'message' => 'Peixe alterado com sucesso'
            ];
        } else {
            $response = [
                'status' => 400,
                'message' => 'Erro ao alterar peixe, verifique se o id esta correto'
            ];
        }

        return $response;
    }
}
