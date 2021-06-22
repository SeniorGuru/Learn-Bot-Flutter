<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Verb;

class SearchController extends Controller {
    public function searchInfinitiv(Request $request) {
        $lang = $request->lang;
        $search_word = $request->search_word;

        $verbs = Verb::select('infinitiv_text','lang','english')->where('lang', '=', $lang)->where('infinitiv_text', 'like', '%'.$search_word.'%')->get();
        return response()->json(['status' => 'search success', 'data' => $verbs]);
    }
}
