<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function pdf(){
        $products = Product::orderby('name')->get();
        $pdf = PDF::loadView('product-list', compact('products'));
        return $pdf->download('product-list.pdf');
    }

    function generateCSV() {
        $flights = Flight::orderBy('id')->get();

        $filename = '../storage/flight.csv';

        $file = fopen($filename,'w+');

        foreach($flights as $f){
            fputcsv($file,[
                $f->flight_code,
                $f->origin,
                $f->destination,
                $f->price,
            ]);
        }

        fclose($file);

        return response()->download($filename);
    }
}
