<?php

namespace App\Http\Controllers;

use App\Models\Companies;
use App\Models\Ingredient;
use App\Models\IngredientInProduct;
use App\Models\IngredientInRecipe;
use App\Models\IngredientInStock;
use App\Models\Measure;
use App\Models\Product;
use App\Models\Recipe;
use App\Models\Stock;
use Illuminate\Http\Request;

class IngredientController extends Controller
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
            $ingredients = Ingredient::join('measures','ingredients.measure_unit','measures.id')
                ->join('companies', 'ingredients.company_id', 'companies.id')
                ->where('companies.user_id', '=', $user_id)
                ->select('ingredients.*', 'companies.name as company_name', 'measures.name as measure_name')
                ->orderBy('id', 'DESC')
                ->paginate(10);
        }elseif($role == 2){
            $ingredients = Ingredient::join('measures','ingredients.measure_unit','measures.id')
                ->join('companies', 'ingredients.company_id', 'companies.id')
                ->select('ingredients.*', 'companies.name as company_name', 'measures.name as measure_name')
                ->orderBy('id', 'DESC')
                ->paginate(10);
        }

        return view('recipe_management.ingredients.index', compact('ingredients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user_id = auth()->user()->id;
        $role = auth()->user()->roles()->first()->id;

        $measures = Measure::get();
        if($role == 3){
            $companies = Companies::where('user_id', '=', $user_id)->get();
        }elseif($role == 2){
            $companies = Companies::get();
        }
        return view('recipe_management.ingredients.create', compact('measures','companies'));
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
            'name' => 'required',
            'measure_unit' => 'required',
            'company' => 'required',
        ]);

        $insert = new Ingredient();
        $insert->name = $request->name;
        $insert->measure_unit = $request->measure_unit;
        $insert->company_id = $request->company;
        $insert->save();

        return redirect()->route('ingredients.index')->with('success', 'Ingredient has been successfully created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user_id = auth()->user()->id;
        $role = auth()->user()->roles()->first()->id;

        $ingredient = Ingredient::find($id);
        $measures = Measure::get();
        if($role == 3){
            $companies = Companies::where('user_id', '=', $user_id)->get();
        }elseif($role == 2){
            $companies = Companies::get();
        }
        return view('recipe_management.ingredients.show', compact('ingredient', 'measures', 'companies'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user_id = auth()->user()->id;
        $role = auth()->user()->roles()->first()->id;

        $ingredient = Ingredient::find($id);
        $measures = Measure::get();
        if($role == 3){
            $companies = Companies::where('user_id', '=', $user_id)->get();
        }elseif($role == 2){
            $companies = Companies::get();
        }
        return view('recipe_management.ingredients.edit', compact('ingredient','measures','companies'));
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
            'name' => 'required',
            'measure_unit' => 'required',
            'company' => 'required',
        ]);

        $insert = Ingredient::find($id);
        $insert->name = $request->name;
        $insert->measure_unit = $request->measure_unit;
        $insert->company_id = $request->company;
        $insert->save();

        return redirect()->route('ingredients.index')->with('success', 'Ingredient has been successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Recipe::join('products', 'recipes.product_id', 'products.id')
            ->join('ingredient_in_product', 'ingredient_in_product.product_id', 'products.id')
            ->join('ingredients', 'ingredient_in_product.ingredient_id', 'ingredients.id')
            ->where('ingredients.id', '=', $id)
            ->delete();
        Product::join('ingredient_in_product', 'ingredient_in_product.product_id', 'products.id')
            ->join('ingredients', 'ingredient_in_product.ingredient_id', 'ingredients.id')
            ->where('ingredients.id', '=', $id)
            ->delete();
        IngredientInProduct::join('ingredients', 'ingredient_in_product.ingredient_id', 'ingredients.id')
            ->where('ingredients.id', '=', $id)
            ->delete();
        IngredientInStock::join('ingredients', 'ingredient_in_stock.ingredient_id', 'ingredients.id')
            ->where('ingredients.id', '=', $id)
            ->delete();
        Ingredient::find($id)->delete();

        return redirect()->route('ingredients.index')->with('success', 'Ingredient has been successfully deleted.');
    }
}
