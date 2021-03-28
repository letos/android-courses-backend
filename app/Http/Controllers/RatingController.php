<?php


namespace App\Http\Controllers;


use App\Models\Item;
use App\Models\RatingItem;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{

    public function like($itemId): Response
    {
        $userId = Auth::id();
        $this->updateOrCreateRating($itemId, $userId, 1);
        return response()->noContent(200);
    }

    public function dislike($itemId): Response
    {
        $userId = Auth::id();
        $this->updateOrCreateRating($itemId, $userId, -1);
        return response()->noContent(200);
    }

    public function delete($itemId): Response
    {
        RatingItem::where('user_id', Auth::id())
            ->where('item_id', $itemId)
            ->delete();
        return response()->noContent(200);
    }

    private function updateOrCreateRating($itemId, $userId, $value)
    {
        $item = Item::find($itemId);
        if ($item->userLiked($userId) || $item->userDisliked($userId)) {
            $rating = RatingItem::where('user_id', $userId)->where('item_id', $itemId)->first();
            $rating->value = $value;
            $rating->save();
        } else {
            $rating = new RatingItem;
            $rating->user_id = $userId;
            $rating->item_id = $itemId;
            $rating->value = $value;
            $rating->save();
        }
    }
}
