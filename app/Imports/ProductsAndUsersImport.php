<?php
namespace App\Imports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class ProductsAndUsersImport implements WithMultipleSheets
{
    public function sheets(): array
    {
        return [
            '0' => new ProductsImport(),
            '1' => new UsersImport(),
        ];
    }
}
