<?php

namespace App\Imports;
use App\Models\dt_products;
use App\Models\users;
use App\Models\products_categories;
use App\Models\imageupload;
use App\Models\dt_categories;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;


class ProductsImport implements ToModel,ShouldQueue, WithChunkReading, WithStartRow
{
    use Importable;

  /**
   * @var errors
   */
    private $errors;

  /**
   * @var row
   */
    private $row = 1;
/**
   * UsersImport constructor.
   * @param StoreEntity $store
   */
  /**
   * UsersImport constructor.
   * @param StoreEntity $store
   */
    public function __construct($errors = [])
    {
        $this->errors = $errors;
    }

    public function model(array $row)
    {
      if (array_key_exists(++$this->row, $this->errors)) {
          return null;
      }

      $validator = Validator::make($row, [
          '0' => [
              'required',
              'string',
          ],
          '1' => [
              'required',
              'string',
          ],
          '2' => [
              'required',
              'string',

          ],
          '3' => [
            'required',
            'int',
        ],
        '4' => [
            'required',
            'string',
        ],
        '5' => [
            'required',
            'string',

        ],
      ]);

      if ($validator->fails()) {
          return null;
      }

      DB::beginTransaction();
      try {
          dt_products::create([

            'product_code'     => $row[0],
            'product_name'    => $row[1],
            'description' => $row[2],
            'price'    => $row[3],
            'status'    => $row[4],
            'warranty'    => $row[5]
          ]);
        //   DB::commit();
        $product_id=dt_products::selectRaw('max(id)')->get();
        $id=$product_id[0]['max(id)'];
        $category_id=dt_categories::where('name',$row[6])->select('id')->get();
        $category_id=$category_id[0]['id'];
        // dd($category_id,$id);
          products_categories::create([
            'product_id'     =>$id,
            'category_id'    =>$category_id,

          ]);
        $images = explode(",",$row[7]);
        foreach($images as $img){
            imageupload::create([
                'content_id' =>$id,
                'path' =>$img,

            ]);
        }
          DB::commit();
      } catch (Exceptions $e) {
          DB::rollBack();
          Log::debug($e);
      }
    }
    // public function model(array $row)
    // {
    //     return new dt_products([
    //         'product_code'     => $row[0],
    //         'product_name'    => $row[1],
    //         'description' => $row[2],
    //         'price'    => $row[3],
    //         'status'    => $row[4],
    //         'warranty'    => $row[5],

    //     ]);
    // }
    public function chunkSize(): int
    {
        return 500;
    }

    public function startRow(): int
    {
        return 2;
    }


    /**

    */

}
