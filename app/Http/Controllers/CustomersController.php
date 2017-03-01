<?php

namespace App\Http\Controllers;

use App\Customers;
use Illuminate\Http\Request;

class CustomersController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function getData()
    {
        $model = Customers::searchPaginateAndOrder();
        $columns = Customers::$columns;

        return response()
               ->json([
                  'model' => $model,
                  'columns' => $columns
               ]);
    }
}
