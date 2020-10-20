<?php

namespace App\Exports;


use App\Models\users;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
class UsersExport implements FromCollection , WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return users::select('name','email','phone','sex','address')->get();
    }
    public function headings() :array {
    	return ["name", "email", "phone", "sex","address"];
    }
}
