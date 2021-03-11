<?php


namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $user = User::find(Auth::id());
        return $user->toJson(JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
    }

    public function avatar(Request $request)
    {
        $user = User::find(Auth::id());
        $user->avatar = $request->get('avatar_url');
        $user->save();
    }
}
