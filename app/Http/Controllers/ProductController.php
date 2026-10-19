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
        return $this->productIndexView(['id' => $id]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        return $this->productIndexView(['openAddProductModal' => true]);
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
        return $this->productIndexView(['openEditProductId' => $product->id]);
    }

    private function productIndexView(array $modalState = [])
    {
        $products = \DB::table('products')
            ->leftJoin('categories', 'products.category', '=', 'categories.id')
            ->leftJoin('sellers', 'products.vendor', '=', 'sellers.id')
            ->select('products.code', 'products.rank', 'products.category as product_category_id', 'products.vendor as product_vendor_id', 'sellers.name as vname', 'products.id', 'products.name', 'products.unit', 'products.price', 'products.status', 'categories.category')
            ->orderBy('products.updated_at', 'desc')
            ->get();

		$id = isset($modalState['id']) ? $modalState['id'] : null;
        $category = $this->category;
        $seller = $this->seller;
        return view('products.index', array_merge(compact('products', 'id', 'category', 'seller'), $modalState));
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
