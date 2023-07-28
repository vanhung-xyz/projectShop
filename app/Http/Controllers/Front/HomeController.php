<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function index()
    {
        $menProducts = product::where('featured', true)->where('product_category_id', 1)->get();
        $womenProducts = product::where('featured', true)->where('product_category_id', 2)->get();

        $blogs = Blog::orderBy('id', 'desc')->limit(3)->get();


        return view('front.index', compact('menProducts', 'womenProducts', 'blogs'));
    }
}
