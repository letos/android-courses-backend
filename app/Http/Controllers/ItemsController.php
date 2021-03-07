<?php


namespace App\Http\Controllers;


use App\Models\Item;
use Illuminate\Http\Request;

class ItemsController extends Controller
{

    public function import(Request $request)
    {
        $itemsJson = $request->json()->all();
        $dataElements = $itemsJson['data'];
        foreach ($dataElements as $element) {
            $item = new Item;
            $item->title = $element['title'];
            $item->description = $element['description'];
            $item->image_url = $element['image_url'];
            $item->save();
        }
    }

    public function index(Request $request)
    {

    }
}
