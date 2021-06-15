<?php

namespace App\Http\Controllers;

use App\Models\IngredientInProduct;
use App\Models\IngredientInStock;
use App\Models\Product;
use App\Models\Recipe;
use App\Models\Stock;
use Illuminate\Http\Request;

class RecipeController extends Controller
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
            $recipes = Recipe::join('products','recipes.product_id','products.id')
                ->join('companies','products.company_id', 'companies.id')
                ->where('companies.user_id', '=', $user_id)
                ->select('recipes.*','products.name as products_name')
                ->orderBy('id', 'DESC')->paginate(10);
        }elseif($role == 2){
            $recipes = Recipe::join('products','recipes.product_id','products.id')
                ->select('recipes.*','products.name as products_name')
                ->orderBy('id', 'DESC')->paginate(10);
        }

        return view('recipe_management.recipes.index', compact('recipes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::get();
        return view('recipe_management.recipes.create', compact('products'));
    }

    public function productInfo($id, $person)
    {
        $today = date("Y-m-d", time());
        $productIngredients = IngredientInProduct::join('ingredients','ingredient_in_product.ingredient_id','ingredients.id')
                                ->join('measures','ingredients.measure_unit','measures.id')
                                ->select('ingredient_in_product.*','measures.name as measure_name','ingredients.id as ingredient_id','ingredients.name as ingredient_name')
                                ->where('ingredient_in_product.product_id','=', $id)->get();

        $table = '<table class="table table-bordered"><tr><th>Ingredient</th><th>Now Use</th><th>In stock for next</th><th>Total person for next</th></tr>';
        foreach($productIngredients as $ingredient){
            $in_stocks = IngredientInStock::join('ingredients','ingredient_in_stock.ingredient_id','ingredients.id')
                ->join('measures','ingredients.measure_unit','measures.id')
                ->where('ingredient_in_stock.date_expire', '>=', $today)
                ->where('ingredient_in_stock.ingredient_id', '=', $ingredient->ingredient_id)
                ->select('ingredient_in_stock.*','ingredients.name as ingredient_name','ingredients.id as ingredient_id','measures.name as measure_name')
                ->orderBy('ingredient_in_stock.date_expire', 'ASC')->get();

            $current_total = 0;
            foreach($in_stocks as $in_stock){
                if($in_stock->spending_total != $in_stock->quantity){
                    $current_total+= $in_stock->quantity - $in_stock->spending_total;
                }
            }

            $total = ($ingredient->quantity) * $person;
            $availability = $current_total - $total;
            if($availability >= 0){
                $now_available_for = $availability / $ingredient->quantity;
                $table.='<tr><td>'.$ingredient->ingredient_name.'</td><td>'.$total.' '.$ingredient->measure_name.'</td><td>'.$availability.' '.$ingredient->measure_name.'</td><td>'.number_format((int)$now_available_for, 0, '.', '') . '</td></tr>';
                $error[] = false;
            }else{
                $table.='<tr><td><span style="color: red;">'.$ingredient->ingredient_name.'</span></td><td><span style="color: red;">'.$total.' '.$ingredient->measure_name.'</span></td><td><span style="color: red;"><b>no available</b></span></td><td><span style="color: red;">0</span></td></tr>';
                $error[] = true;
            }
        }
        $table.= '</table>';

        $result = [$table,$error];

      return ($result);
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
            'total_person' => 'required',
            'product' => 'required'
        ]);

        $today = date("Y-m-d", time());
        $productIngredients = IngredientInProduct::join('ingredients','ingredient_in_product.ingredient_id','ingredients.id')
            ->where('ingredient_in_product.product_id','=', $request->product)
            ->select('ingredient_in_product.*','ingredients.id as ingredient_id')
            ->get();

        foreach($productIngredients as $ingredient){
            $total_spend = $ingredient->quantity * $request->total_person;

            $in_stocks = IngredientInStock::join('ingredients','ingredient_in_stock.ingredient_id','ingredients.id')
                ->where('ingredient_in_stock.date_expire', '>=', $today)
                ->where('ingredient_in_stock.ingredient_id', '=', $ingredient->ingredient_id)
                ->select('ingredient_in_stock.*','ingredients.id as ingredient_id')
                ->orderBy('ingredient_in_stock.date_expire', 'ASC')
                ->get();

            $individual_ingredient_spend = 0;
            foreach($in_stocks as $in_stock){
                if($in_stock->spending_total != $in_stock->quantity){
                    $current_total = $in_stock->quantity - $in_stock->spending_total;
                    $spend_first = $current_total - $total_spend;
                    if($spend_first <= 0){
                        $individual_ingredient_spend = $current_total;
                        $total_spend = $total_spend - $individual_ingredient_spend;
                    }else{
                        $individual_ingredient_spend = $total_spend;
                        $total_spend = $total_spend - $individual_ingredient_spend;
                    }
                    $individual_ingredient_spend_total = $individual_ingredient_spend + $in_stock->spending_total;

                    $update = IngredientInStock::find($in_stock->id);
                    $update->spending_total = $individual_ingredient_spend_total;
                    $update->save();
                }
            }
        }

        $insert = new Recipe();
        $insert->product_id = $request->product;
        $insert->total_person = $request->total_person;
        $insert->status = 1;
        $insert->save();

        return redirect()->route('recipes.index')->with('success', 'Recipe has been successfully created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $products = Product::get();
        $recipe = Recipe::find($id);
        return view('recipe_management.recipes.show', compact('products','recipe'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $recipe = Recipe::find($id);
        return view('recipe_management.recipes.edit', compact('recipe'));
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
            'status' => 'required'
        ]);

        $insert = Recipe::find($id);
        $insert->status = $request->status;
        $insert->save();

        return redirect()->route('recipes.index')->with('success', 'Recipe has been successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Recipe::find($id)->delete();

        return redirect()->route('recipes.index')->with('success', 'Recipe has been successfully deleted.');
    }
}
