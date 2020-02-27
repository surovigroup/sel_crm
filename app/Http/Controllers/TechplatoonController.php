<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Traits\Woocommerce;

class TechplatoonController extends Controller
{
    use Woocommerce;
    
    public function brand($brand)
    {
        $category = $this->techplatoon->get('products/categories/'.$brand);
        $total_product = $category->count;

        $page = 1;
        $per_page = 50;
        $page_count = intval(ceil($total_product / $per_page));
        $requested_page = intval(request('page'));
        if($requested_page > 0 && $requested_page <= $page_count){
            $page = $requested_page;
        }
        $products = $this->techplatoon->get('products', [
            'per_page'  => $per_page,
            'page' => $page,
            'category'  => $brand
        ]);

        return view('techplatoon.brand', [
            'products'  => $products,
            'total_product' => $total_product,
            'page_count' => $page_count
        ]);
    }

    public function update(Request $request)
    {
        $data = [
            'stock_quantity' => $request->stock_quantity,
            'regular_price' => $request->regular_price,
            'sale_price' => $request->sale_price,
        ];

        $response = $this->techplatoon->put('products/'.$request->id, $data);

        return json_encode($response);
    }
}
