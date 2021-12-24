<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class transactionController extends Controller
{

    public function index()
    {
        // $categories = Category::paginate(10);
        return view('admin.transaction.index');
    }

   
}
