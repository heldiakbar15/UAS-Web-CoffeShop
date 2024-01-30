<?php
  
namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use App\Models\Product;
 
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $product = Product::orderBy('created_at', 'DESC')->simplePaginate(7);
  
        return view('products.index', compact('product'));
    }
  
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }
  
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Product::create($request->all());
 
        return redirect()->route('products')->with('success', 'Product added successfully');
    }
  
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::findOrFail($id);
  
        return view('products.show', compact('product'));
    }
  
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
  
        return view('products.edit', compact('product'));
    }
  
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::findOrFail($id);
  
        $product->update($request->all());
  
        return redirect()->route('products')->with('success', 'product updated successfully');
    }
  
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
  
        $product->delete();
  
        return redirect()->route('products')->with('success', 'product deleted successfully');
    }

    public function products(Request $request)
    {
        if($keywoard){
            $this->db->like('name', $keywoard);
        }

        return $this->db->get('products', $limit, $start)->result_array();
    }

    public function search(Request $request) {
    if($request->has('search')) {
        $product = Product::where('name', 'LIKE', '%'.$request->search.'%')->get();
    }
    else {
        $product = Product::all();
    }

    return view('products.index',['products' => $product]);
    
    }
}
/**$search = $request->input('search');

        $products = Product::where('name','like','%'.$search.'%')
                    ->orWhere('description','like','%'.$search.'%')
                    ->paginate(2);

        return view('products.index',compact('products'));
**/