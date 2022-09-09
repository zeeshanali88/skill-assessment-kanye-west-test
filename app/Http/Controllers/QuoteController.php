<?php

namespace App\Http\Controllers;

use App\Models\FavouriteQuotes;
use App\Models\Quote;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Auth;


class QuoteController extends Controller
{
    public function index(Request $request) {
        $quotes_count = $request->input('quotes_count', 5);
        $quotes = Quote::inRandomOrder()->limit($quotes_count)->get();
        return Inertia::render('QuoteListing', compact('quotes'));
    }

    public function AddQuoteToFavouriteList(Request $request, $quote_id) {
        if(FavouriteQuotes::whereUserId(Auth::id())->whereQuoteId($quote_id)->exists())
            return response()->json(['color' => 'red', 'message' => 'Quote already added to favourite'], 200);
        FavouriteQuotes::create(['user_id' => Auth::id(), 'quote_id' => $quote_id]);
        return response()->json(['color' => 'green', 'message' => 'Quote added to favourite'], 200);
    }

    public function favouriteQuotes() {
        $quotes = $this->getFavouriteQuotes();
        return Inertia::render('QuoteListing', compact('quotes'));
    }

    public function removeQuoteFromFavourites($quote_id) {
        FavouriteQuotes::whereUserId(Auth::id())->whereQuoteId($quote_id)->delete();
        $quotes = $this->getFavouriteQuotes();
        return response()->json(['color' => 'green', 'message' => 'Quote removed from favourites', 'quotes' => $quotes], 200);
    }

    public function getFavouriteQuotes() {
        return Quote::whereRaw("id in (select quote_id from favourite_quotes where user_id = ?)", ['user_id' => Auth::id()])->get();
    }
}
