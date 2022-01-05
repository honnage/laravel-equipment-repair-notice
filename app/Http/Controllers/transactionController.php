<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;
use App\Models\transaction;

class TransactionController extends Controller
{
    public function index()
    {
        $transaction = transaction::orderBy('id', 'desc')->get();
        return view('admin.transaction.index', compact('transaction'));
    }

    public function create()
    {
        $transaction = transaction::all();
        return view('admin.transaction.form',  compact('transaction'));
    }
}
