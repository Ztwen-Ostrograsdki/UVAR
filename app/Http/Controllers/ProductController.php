<?php

namespace App\Http\Controllers;

use App\ModelsHelpers\ImageStores\Storer;
use App\Models\Product;
use App\Traits\Validators\ProductsValidators;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    use ProductsValidators;
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('products.index');
    }

    public function getProducts()
    {
       $products = Product::withTrashed('deleted_at')->latest()->get();
       $boughtedProducts = Product::withTrashed('deleted_at')->where('bought', true)->latest()->get();
        $totalBoughtByProduct = [];
        foreach ($products as $product) {
            $totalBoughtByProduct[$product->id] = $product->totalBought();
        }
        return response()->json(['products' => $products, 'totalBoughtByProduct' => $totalBoughtByProduct, 'boughtedProducts' => $boughtedProducts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $v = $this->validateProduct($request->all());
        if ($v->fails()) {
            return response()->json(['errors' => $v->errors()]);
        }
        else{
            $product = Product::create(['name' => $request->name, 'description' => $request->description, 'price' => (int)$request->price, 'total' => (int)$request->total]);

            if ($product) {
                if ($request->filled('image')) {
                    $storer = (new Storer($request->image, $product->id))->__PRODUCT_STORER();
                    if ($storer) {
                        return response()->json(['success' => "L'article {$product->name} a bien été créé"]);
                    }
                    else{
                        return response()->json(['success' => "L'article {$product->name} a bien été créé, mais une erreure s'est produite lors du stockage de l'image jointe"]);
                    }
                }
                else{
                    return response()->json(['success' => "L'article {$product->name} a bien été créé"]);
                }
            }

            
        }

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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        $product = Product::find($id);
        if (!is_int($id) || !$product) {
            return abort(404, 'Page introuvable');
        }
        $oldName = Product::where('name', $request->name)->first();
        $storer = true;
        $make = false;

        if ($oldName && $oldName->id == $id) {
            $v = $this->validateProduct($request->all(), 'name');
        }
        else{
            $v = $this->validateProduct($request->all());
        }
        if ($v->fails()) {
            return response()->json(['errors' => $v->errors()]);
        }
        if (!$product) {
            return abort(403, "Requête non autorisée");
        }
        if ($request->image !== "" &&  $request->image !== null) {
            $storer = (new Storer($request->image, $id))->__PRODUCT_STORER();
        }
        if ($storer) {
            $make = $product->update(['name' => $request->name, 'description' => $request->description, 'price' => $request->price, 'total' => $request->total]);
            if ($make) {
                return response()->json(['success' => "Mise à jour réussie!"]);
            }
        }
        else{
            return response()->json(["errors" => "Erreure de stockage de l'image"]);
        }
        
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
}
