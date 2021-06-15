<?php

namespace App\Http\Controllers;

use App\Models\Companies;
use App\Models\Ingredient;
use App\Models\IngredientInProduct;
use App\Models\Measure;
use App\Models\Product;
use App\Models\Recipe;
use App\Models\Stock;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = auth()->user()->id;
        $role = auth()->user()->roles()->first()->id;

        if($role == 3){
            $products = Product::join('companies','products.company_id','companies.id')
                ->where('companies.user_id', '=', $user_id)
                ->select('products.*','companies.name as company_name')
                ->orderBy('id', 'DESC')->paginate(10);
        }elseif($role == 2){
            $products = Product::join('companies','products.company_id','companies.id')
                ->select('products.*','companies.name as company_name')
                ->orderBy('id', 'DESC')->paginate(10);
        }

        return view('recipe_management.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies = Companies::get();
        $ingredients = Ingredient::join('measures','ingredients.measure_unit','measures.id')
            ->select('ingredients.*','measures.name as measure_name')
            ->get();
        return view('recipe_management.products.create', compact('companies','ingredients'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'company' => 'required',
            'name' => 'required',
            'ingredient' => 'required',
            'quantity' => 'required'
        ]);

        $insert = new Product();
        $insert->name = $request->name;
        $insert->company_id = $request->company;
        $insert->save();

        $product_id = Product::orderBy('id', 'DESC')->first();

        foreach($request->ingredient as $key => $ingredient){
            $insert = new IngredientInProduct();
            $insert->product_id  = $product_id->id;
            $insert->ingredient_id  = $ingredient;
            $insert->quantity  = $request->quantity[$key];
            $insert->save();
        }

        return redirect()->route('products.index')->with('success', 'Product has been successfully created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $companies = Companies::get();
        $ingredients = Ingredient::join('measures','ingredients.measure_unit','measures.id')
            ->select('ingredients.*','measures.name as measure_name')
            ->get();
        $product = Product::find($id);
        $ingredient_in_product = IngredientInProduct::where('product_id', '=', $id)->get();
        return view('recipe_management.products.show', compact('companies','ingredients','product','ingredient_in_product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $companies = Companies::get();
        $ingredients = Ingredient::join('measures','ingredients.measure_unit','measures.id')
            ->select('ingredients.*','measures.name as measure_name')
            ->get();
        $product = Product::find($id);
        $ingredient_in_product = IngredientInProduct::where('product_id', '=', $id)->get();
        return view('recipe_management.products.edit', compact('companies','ingredients','product','ingredient_in_product'));
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
        $this->validate($request, [
            'company' => 'required',
            'name' => 'required',
            'ingredient' => 'required',
            'quantity' => 'required'
        ]);

        $insert = Product::find($id);
        $insert->name = $request->name;
        $insert->company_id = $request->company;
        $insert->save();

        IngredientInProduct::where('product_id','=', $id)->delete();
        foreach($request->ingredient as $key => $ingredient){
            $insert = new IngredientInProduct();
            $insert->product_id  = $id;
            $insert->ingredient_id  = $ingredient;
            $insert->quantity  = $request->quantity[$key];
            $insert->save();
        }

        return redirect()->route('products.index')->with('success', 'Product has been successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Recipe::where('product_id','=', $id)->delete();
        IngredientInProduct::where('product_id','=', $id)->delete();
        Product::find($id)->delete();
        return redirect()->route('products.index')->with('success', 'Product has been successfully deleted.');
    }
}
