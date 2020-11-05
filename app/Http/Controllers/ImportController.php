<?php

namespace App\Http\Controllers;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use App\Imports\ProductsImport;
use App\Imports\UsersImport;
use App\Imports\ProductsAndUsersImport;
use App\Http\Requests\ImportCsvFileRequest;
use App\Imports\ValidateCsvFile;
use Illuminate\Support\Facades\Validator;


class ImportController extends Controller
{
    public function fileImport(ImportCsvFileRequest $request){
        $validator = new ValidateCsvFile();
        // $this->validate($request, array(
        //     'file'   => 'max:10240|required|mimes:csv,xlsx',
        //   ));
        // Excel::import(new ProductsImport, $request->file('csv_file')->store('temp'));
        // return back();
        Excel::import($validator, $request->file('csv_file'));
        if (count($validator->errors)) {
            $errors = [];
            foreach ($validator->errors as $key => $error) {
                $errors[$key] = $key;
            }
            (new ProductsImport($errors))->queue($request->file('csv_file'));
            // dd($errors);
            return redirect()->back()->with('errors', 'row number ' . implode(',', $errors) . ' contain incorrect data');
        } elseif (!$validator->isValidFile) {

            return redirect()->back();
        }

        (new ProductsImport())->queue($request->file('csv_file'));

        return redirect()->back();
    }
}
