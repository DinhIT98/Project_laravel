<?php

namespace App\Imports;
use App\Models\dt_products;
use App\Models\users;
use App\Models\products_categories;
use App\Models\imageupload;
use App\Models\dt_categories;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\Importable;
class Product implements ToModel,SkipsOnError
{
    use Importable,SkipsErrors;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new dt_products([
                    'product_code'     => $row[0],
                    'product_name'    => $row[1],
                    'description' => $row[2],
                    'price'    => $row[3],
                    'status'    => $row[4],
                    'warranty'    => $row[5],

                ]);
    }
    public function rules(): array
    {
        return [
            '*.product_code' => ['product_code', 'unique:dt_products.product_code']
        ];
    }
}
