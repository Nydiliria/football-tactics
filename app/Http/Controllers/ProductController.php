<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show(Product $product)
    {
        return view();
    }

    public function create()
    {
        return view('product.create');
    }

    public function store()
    {

    }
}
