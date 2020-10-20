<?php

namespace App\Http\Controllers;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use App\Exports\UsersExport;

class ExportController extends Controller
{
    public function fileExport(){
        return Excel::download(new UsersExport, 'users-collection.xlsx');
    }
}
