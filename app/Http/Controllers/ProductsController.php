<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\ShoppingCart;

class ProductsController extends Controller
{
    public function __construct(){
        //con el middleware auth indicamos la excepciones donde no se requiere estar logeado
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // identificar sesion del usuario
        $sessionName= 'shopping_cart_id';
        // obtenemos el valor de la sesion
        $shopping_cart_id = $request->session()->get($sessionName);

        //obtenemos el carrito de la BD
        $shopping_cart = ShoppingCart::findOrCreateById($shoppping_cart_id);

        //actualiamos el nombre de la sesion con los datos del carrito encontrado o creado
        $request->session()->put($sessionName, $shopping_cart->id);

        $products = Product::paginate(20);
        if ($request->wantsJson()) {
            return $products->toJson();
        }
        return view('products.index', ['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $product = new Product;
        return view('products.create', ["product" => $product]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $options = [
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price
        ];
        if(Product::create($options)){
            return redirect('/productos');
        }else{
            return view('products.create');
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
        $product = Product::find($id);
        return view('products.show', ['product' => $product]);
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
        $product = Product::find($id);
        return view("products.edit", ["product" => $product]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //buscamos el producto en la BD
        $product = Product::find($id);
        
        //asignamos nuevos valores que vienen desde el request
        $product->title = $request->title;
        $product->price = $request->price;
        $product->description = $request->description;
        
        if($product->save()){
            return redirect('/');
        }else{
            return view("products.edit", ["product" => $product]);
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
        Product::destroy($id);
        return redirect('/productos');
    }
}
