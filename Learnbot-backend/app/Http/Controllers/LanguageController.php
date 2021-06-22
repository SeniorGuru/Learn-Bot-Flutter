<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Word;

class LanguageController extends Controller {
    public function readAll() {
        $langs = Word::select('id', 'l', 'lang', 'bundleId')->get();
        return response()->json(['status' => 'success', 'data' => $langs]);
    }
}
