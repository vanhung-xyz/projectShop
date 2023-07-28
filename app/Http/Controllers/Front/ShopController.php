<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductComment;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    //
    public function show($id){
        $product = Product::findOrFail($id);

        $avgRating = 0;
        $sumRating = array_sum(array_column($product->productComments->toArray(), 'rating'));
        $countRating = count($product->productComments);
        if ($countRating !=0){
            $avgRating = $sumRating/$countRating;
        }

        $relatedProducts = Product::where('product_category_id', $product->product_category_id)
        ->where('tag', $product->tag)
        ->limit(4)
        ->get();


        return view('front.shop.show', compact('product', 'avgRating', 'relatedProducts'));
    }

    public function postComment(Request $request) {
        ProductComment::create($request->all());

        return redirect()->back();
    }

    public function index(Request $request)
    {
        //Get categories:
        $categories = ProductCategory::all();

        //Get products:
        $perPage = $request->show ?? 3;
        $sortBy = $request->sort_by ?? 'latest';
        $search = $request->search ?? '';

        $products = Product::where('name', 'like', '%' . $search . '%');

        switch ($sortBy) {
            case 'latest':
                $products = $products->orderBy('id');
                break;
            case 'olest':
                $products = $products->orderByDesc('id');
                break;
            case 'name_ascending':
                $products = $products->orderBy('name');
                break;
            case 'name_descending':
                $products = $products->orderByDesc('name');
                break;
            case 'price-ascending':
                $products = $products->orderBy('price');
                break;
            case 'price-descending';
                $products = $products->orderByDesc('price');
                break;
            default:
                $products = $products->orderBy('id');
        }

        $products = $products->paginate($perPage);

        $products->appends(['sort_by' => $sortBy, 'show' => $perPage]);

        return view('front.shop.index', compact('categories', 'products'));
    }

    public function category($categoryName , Request $request) {
        //Get categories:
        $categories = ProductCategory::all();

        //Get Products:
        $products = ProductCategory::where('name', $categoryName)->first()->products->toQuery()->paginate();

        return view('front.shop.index', compact('categories', 'products'));
    }
}
