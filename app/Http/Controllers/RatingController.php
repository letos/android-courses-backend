<?php


namespace App\Http\Controllers;


use App\Models\RatingItem;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{

    public function like($itemId): Response
    {
        $rating = new RatingItem;
        $rating->user_id = Auth::id();
        $rating->item_id = $itemId;
        $rating->value = 1;
        $rating->save();
        return response()->noContent(200);
    }

    public function dislike($itemId): Response
    {
        $rating = new RatingItem;
        $rating->user_id = Auth::id();
        $rating->item_id = $itemId;
        $rating->value = -1;
        $rating->save();
        return response()->noContent(200);
    }

    public function delete($itemId): Response
    {
        RatingItem::where('user_id', Auth::id())
            ->where('item_id', $itemId)
            ->delete();
        return response()->noContent(200);
    }
}
