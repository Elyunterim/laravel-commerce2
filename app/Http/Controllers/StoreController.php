<?php

namespace LaravelCommerce\Http\Controllers;

use Illuminate\Http\Request;

use LaravelCommerce\Category;
use LaravelCommerce\Http\Requests;
use LaravelCommerce\Http\Controllers\Controller;
use LaravelCommerce\Product;
use Illuminate\Database\Eloquent\Collection;

class StoreController extends Controller
{

    /**
     * @var Category
     */
    private $category;
    /**
     * @var Product
     */
    private $product;
    /**
     * @var Tag
     */

    /**
     * @param Category $category
     * @param Product $product
     */
    function __construct(Category $category, Product $product)
    {
        $this->category = $category;
        $this->product = $product;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $featured = Product::featured()->get();
        $recommend = Product::recommend()->get();
        $categories = Category::all();

        return view('store.partial.index', compact('categories','featured','recommend'));
    }

    public function category($id)
    {
        $categories = $this->category->orderBy('name')->get();
        $products = $this->product->OfCategory($id)->get();

        return view('store.partial.products-category', compact('categories','products'));
    }


    public function product($id)
    {
        $categories = $this->category->orderBy('name')->get();
        $product = $this->product->find($id);
        return view('store.partial.product-details', compact('categories', 'product'));
    }
    /**
     * Show all products by tag.
     *
     * @param $id
     * @return \Illuminate\View\View
     */
    public function tag($id)
    {
        $categories = $this->category->orderBy('name')->get();
        $tag = $this->tag->find($id);
        return view('store.partial.products-tag', compact('categories', 'tag'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
