<?php


namespace App\Http\Controllers;


use App\Models\FavoriteItem;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function create($itemId)
    {
        $userId = Auth::id();
        $item = Item::find($itemId);

        if (!$item->hasFavoriteUser($userId)) {
            $favorite = new FavoriteItem;
            $favorite->user_id = Auth::id();
            $favorite->item_id = $itemId;
            $favorite->save();
        }

        return response()->noContent(200);
    }

    public function delete($itemId)
    {
        FavoriteItem::where('user_id', Auth::id())
            ->where('item_id', $itemId)
            ->delete();
        return response()->noContent(200);
    }
}
