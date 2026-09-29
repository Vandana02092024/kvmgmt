<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Seller;
use App\Product;
use App\Http\Requests;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{
    protected $category;
    protected $seller;

    public function __construct()
    {
        $this->middleware('auth');
        $this->category = Category::lists('category', 'id');
        $this->seller   = Seller::lists('name', 'id');
        $this->seller->prepend('- Select Vendor -', '');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index($id=null)
    {
        $products = \DB::table('products')
            ->leftJoin('categories', 'products.category', '=', 'categories.id')
            ->leftJoin('sellers', 'products.vendor', '=', 'sellers.id')
            ->select('products.code', 'products.rank', 'sellers.name as vname', 'products.id', 'products.name', 'products.unit', 'products.price','products.status', 'categories.category')
            ->orderBy('products.updated_at','desc')
			->get();

        return view('products.index', compact('products','id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        $category   = $this->category;
        $seller     = $this->seller;
        return view('products.create',compact('category','seller'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        Product::create($request->all());
        return redirect()->route('product.index')->with('message','Product has been added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }
	public function proArchive($id, Request $request)
    {


		$statusCode = $request->st;


		if($statusCode == 1) {
		Product::where('id', '=', $id)->update(['status'   => 0]);
		return redirect()->route('product.index')->with('message','Archived successfully!');

		} else {
		Product::where('id', '=', $id)->update(['status'   => 1]);
		return redirect()->route('product.index')->with('message','Unarchived successfully!');
		}



    }



      /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $category = $this->category;
        $seller   = $this->seller;
        return view('products.edit',compact(['category','product','seller']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $product->update($request->all());
        return redirect()->route('product.index')->with('message','Product has been updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function updateProductPrice(Request $request)
    {
        $up['price'] = $request['price'];
        $id = $request['id'];

        $product = Product::where('id', '=', $id)->update($up);
        return response()->json(['result'=>$product]);
    }
}
