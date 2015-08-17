<?php

namespace LaravelCommerce\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use LaravelCommerce\Category;
use LaravelCommerce\Http\Requests;
use LaravelCommerce\Http\Controllers\Controller;
use LaravelCommerce\Product;
use LaravelCommerce\ProductImage;


class AdminProductsController extends Controller
{

    private $productModel;

    public function __construct(Product $productModel)
    {
        $this->productModel = $productModel;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $products = $this->productModel->paginate(10);
        return view ('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(Category $category)
    {
        $categories = $category->lists('name','id');

        return view ('products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Requests\ProductRequest $request)
    {
        $input = $request->all();

        $product = $this->productModel->fill($input);

        $product->save();

        return redirect('admin/products');
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
    public function edit($id, Category $category)
    {
        $categories = $category->lists('name','id');

        $product = $this->productModel->find($id);

        return view('products.edit', compact('product','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Requests\ProductRequest $request, $id)
    {
        $this->productModel->find($id)->update($request->all());

        return redirect('admin/products');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $this->productModel->find($id)->delete();

        return redirect('admin/products');
    }

    public function exemplo()
    {
        $nome = "Andre";
        $sobrenome = "Silva";

        return view('exemplo',['nome' => $nome, 'sobrenome' => $sobrenome]);

    }

    public function images($id)
    {
        $product = $this->productModel->find($id);

        return view('products.images', compact('product'));
    }

    public function createImage($id)
    {

        $product = $this->productModel->find($id);

        return view('products.create_image', compact('product'));
    }

    public function storeImage(Request $request,  $id, ProductImage $productImage)
    {
        $file = $request->file('image');

        $extension = $file->getClientOriginalExtension();

        $image = $productImage::create(['product_id'=>$id, 'extension'=>$extension]);

        Storage::disk('public_local')->put($image->id.'.'.$extension, File::get($file));

        return redirect()->route('products.images', ['id'=>$id]);

    }

    public function destroyImage(Request $request, $id, ProductImage $productImage)
    {
        $image = $productImage->find($id);

        if(file_exists(public_path() .'/uploads/' .$image->id.'.'.$image->extension))
            {
                Storage::disk('public_local')->delete($image->id.'.'.$image->extension);
            }

        $product = $image->product;

        $image->delete();

        return redirect()->route('products.images', ['id' => $product->id]);
    }
}
