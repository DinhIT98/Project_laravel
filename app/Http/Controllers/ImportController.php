<?php

namespace App\Http\Controllers;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use App\Imports\ProductsImport;
use App\Imports\Product;
use App\Imports\UsersImport;
use App\Imports\ProductsAndUsersImport;
use App\Http\Requests\ImportCsvFileRequest;
use App\Imports\ValidateCsvFile;
use Illuminate\Support\Facades\Validator;


class ImportController extends Controller
{
    public function fileImport(ImportCsvFileRequest $request){

        // $request->validate([

        //     'csv_file' => 'max:10240|required|mimes:csv,xlsx',
        // ]);
        $validator = new ValidateCsvFile();
        // $file=$request->file('csv_file');
        // $import=new Product;
        // $import->import($file);
        // $errors = [];
        // foreach($import->errors() as $key=> $error){
        //     foreach($error as $errorInfo){
        //         // dd($errorInfo[2]);
        //         $errors[$key]=$errorInfo[2];
        //     }
        // }
        // dd($import);
        // dd($import->errors()->getMessage());


        Excel::import($validator, $request->file('csv_file'));
        // dd($validator->errors);
        if (count($validator->errors)) {
            $errors = [];
            foreach ($validator->errors as $key => $error) {

                dd($error->getMessage());
                $errors[$key] = $key;
                // $errors[$key]=$error;
            }
            (new ProductsImport($errors))->queue($request->file('csv_file'));
            // dd($errors);

            return redirect()->back()->with('errors', 'row number ' . implode(',', $errors) . ' contain incorrect data');
        } elseif (!$validator->isValidFile) {

            return redirect()->back();
        }

        (new ProductsImport())->queue($request->file('csv_file'));

        return redirect()->back();
        // return redirect()-> back()->with('errors',$errors);
    }
}
