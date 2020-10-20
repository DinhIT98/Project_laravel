<?php

namespace App\Imports;
use App\Models\users;
use App\Models\dt_products;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
class UsersImport implements ToModel,WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {   $product_id=dt_products::selectRaw('max(id)')->get();
        $id=$product_id[0]['max(id)'];
        return new users([
            'name'     => $row[0],
            'email'    => $row[1],
            'phone' => $row[2],
            'sex'    => $row[3],
            'address'    =>$id,
        ]);
    }
    public function startRow(): int
    {
        return 2;
    }
}
