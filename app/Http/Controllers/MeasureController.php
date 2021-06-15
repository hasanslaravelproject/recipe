<?php

namespace App\Http\Controllers;

use App\Models\Companies;
use App\Models\Ingredient;
use App\Models\IngredientInProduct;
use App\Models\IngredientInStock;
use App\Models\Measure;
use App\Models\Product;
use App\Models\Recipe;
use Illuminate\Http\Request;

class MeasureController extends Controller
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
            $measures = Measure::join('companies','measures.company_id', 'companies.id')
                ->where('companies.user_id', '=', $user_id)
                ->select('measures.*', 'companies.name as company_name')
                ->orderBy('id', 'DESC')
                ->paginate(10);
        }elseif($role == 2){
            $measures = Measure::join('companies','measures.company_id', 'companies.id')
                ->select('measures.*', 'companies.name as company_name')
                ->orderBy('id', 'DESC')
                ->paginate(10);
        }

        return view('recipe_management.measures.index', compact('measures'));
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

        if($role == 3){
            $companies = Companies::where('user_id', '=', $user_id)->get();
        }elseif($role == 2){
            $companies = Companies::get();
        }
        return view('recipe_management.measures.create', compact('companies'));
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
            'company' => 'required'
        ]);

        $insert = new Measure();
        $insert->name = $request->name;
        $insert->company_id = $request->company;
        $insert->save();

        return redirect()->route('measures.index')->with('success', 'Measure has been successfully created.');
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

        if($role == 3){
            $companies = Companies::where('user_id', '=', $user_id)->get();
        }elseif($role == 2){
            $companies = Companies::get();
        }
        $measure = Measure::find($id);
        return view('recipe_management.measures.show', compact('measure','companies'));
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

        if($role == 3){
            $companies = Companies::where('user_id', '=', $user_id)->get();
        }elseif($role == 2){
            $companies = Companies::get();
        }
        $measure = Measure::find($id);
        return view('recipe_management.measures.edit', compact('measure','companies'));
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
            'company' => 'required'
        ]);

        $insert = Measure::find($id);
        $insert->name = $request->name;
        $insert->company_id = $request->company;
        $insert->save();

        return redirect()->route('measures.index')->with('success', 'Measure has been successfully updated.');
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
            ->where('ingredients.measure_unit', '=', $id)
            ->delete();
        Product::join('ingredient_in_product', 'ingredient_in_product.product_id', 'products.id')
            ->join('ingredients', 'ingredient_in_product.ingredient_id', 'ingredients.id')
            ->where('ingredients.measure_unit', '=', $id)
            ->delete();
        IngredientInProduct::join('ingredients', 'ingredient_in_product.ingredient_id', 'ingredients.id')
            ->where('ingredients.measure_unit', '=', $id)
            ->delete();
        IngredientInStock::join('ingredients', 'ingredient_in_stock.ingredient_id', 'ingredients.id')
            ->where('ingredients.measure_unit', '=', $id)
            ->delete();
        Ingredient::where('measure_unit','=', $id)->delete();
        Measure::find($id)->delete();

        return redirect()->route('measures.index')->with('success', 'Measure has been successfully deleted.');
    }
}
