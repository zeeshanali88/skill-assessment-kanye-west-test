<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Quote;
use Illuminate\Http\Request;
use Auth;

class QuotesController extends Controller
{
    public function index(Request $request) {
        $no_of_quotes = $request->input('no_of_quotes', 5);
        $quotes = Quote::inRandomOrder()->limit($no_of_quotes)->get();
        return response()->json(['quotes' => $quotes], 200);
    }
    public function favourite_quotes(Request $request) {
        $favourite_quotes = Quote::whereRaw("id in (select quote_id from favourite_quotes where user_id = ?)", ['user_id' => Auth::id()])->get();
        return response()->json(['favourite_quotes' => $favourite_quotes], 200);
    }
}
