<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function getMenu()
    {
        $menu = Menu::getTree();

        return response()->json(['success' => true, 'menu' => $menu], 200);
    }
}
