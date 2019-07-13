<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Link;
use App\Models\Category;

class IndexController extends Controller
{
    public function index()
    {
//        $links = Link::select("*")->orderBy('visited', 'desc')->get();
        $categories = Category::where("parent_id","><", 0)->orderBy("priority", "asc")->get();
//        dd($categories);
        foreach ($categories as $category) {
//            $links[$category->id] = $category->links()->get();
            $links[$category->name] = 0;
            foreach ($category->links()->get() as $link) {
                $links[$category->name] += 1;
            }
        }

        return view('index', [
            'links' => $links,
            'categories' => $categories,
        ]);
    }
}
