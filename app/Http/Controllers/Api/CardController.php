<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Resources\CardResource;
use App\Models\Card;

class CardController extends Controller
{
    public function getAllCards(Request $request)
    {
        $access_token = $request->input('access_token');

        if (! $access_token || $access_token !== env('API_ACCESS_TOKEN')) {
            return response()->json(['error' => 'Invalid access token'], 401);
        }

        $cards = Card::query();

        if ($request->input('creation_date')) {
            $cards->whereDate('created_at', $request->input('creation_date'));
        }

        if ($request->input('status')) {
            // status could be the column and it will get filtered on basis of column
        }

        return CardResource::collection($cards->get());
    }

    public function store(Request $request)
    {
        $cardsCount = Card::count() + 1;

        $card = new Card();
        $card->title = 'Card '. Card::count()+1;
        $card->description = 'Description '. Card::count()+1;
        $card->column_id = $request->columnId;
        $card->sort_order = $cardsCount;
        $card->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Cards created successfully'
        ]);
    }

    public function processCardMovement(Request $request)
    {
        $card = Card::find($request->cardId);
        $card->column_id = $request->columnId;
        $card->save();

        foreach ($request->cardIds as $key => $cardId) {
            $card = Card::find($cardId);
            $card->sort_order = $key;
            $card->save();
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Cards moved successfully'
        ]);
    }
}
