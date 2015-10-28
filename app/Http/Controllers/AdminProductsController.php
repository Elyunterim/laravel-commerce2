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
use LaravelCommerce\Tag;


class AdminProductsController extends Controller
{

    private $productModel;
    private $categoryModel;
    private $tagModel;

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
        $products = $this->productModel->orderBy('id','DESC')->paginate(10);

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
        $tags = $request->only('tags');

        $tagsId = $this->storeTags($tags);

        $product = $this->productModel->fill($input);
        $product->save();
        $product->tags()->attach($tagsId);

        return redirect()->route('products');
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
        $product = $this->productModel->find($id);
        $categories = $category->lists('name','id');

        return view('products.edit', compact('product','categories'));
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

        $tags = $request->only('tags');
        $tagsId = $this->storeTags($tags);

        $this->productModel->find($id)->tags()->sync($tagsId);
        $this->productModel->find($id)->update($request->all());

        return redirect()->route('products');

    }

    private function storeTags($inputTags)
    {
        $tags = explode(',', $inputTags['tags']);
        $tags = array_map(function($item){

            return trim($item);
        }, $tags);
        $tags = array_filter($tags);
        $tagsIDs = array_map(function($tagName){
            return Tag::firstOrCreate(['name' => $tagName])->id;
        },$tags);

        return $tagsIDs;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $product = $this->productModel->find($id);

        $product->tags()->sync([]);

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

    public function storeImage(Requests\ProductImageRequest $request,  $id, ProductImage $productImage)
    {
        // Get file upload
        $file = $request->file('image');

        // Get extension of file
        $extension = $file->getClientOriginalExtension();

        $image = $productImage::create(['product_id'=>$id, 'extension'=>$extension]);

        Storage::disk('public_local')->put($image->id.'.'.$extension, File::get($file));

        return redirect()->route('products.images', ['id'=>$id]);

    }

    public function destroyImage($id, ProductImage $productImage)
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
