<?php

namespace App\Http\Controllers;

use App\Models\Companies;
use App\Models\Ingredient;
use App\Models\IngredientInProduct;
use App\Models\IngredientInStock;
use App\Models\Measure;
use App\Models\Product;
use App\Models\Recipe;
use App\Models\User;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Companies::join('users','companies.user_id','users.id')
            ->select('companies.*','users.name as user_name')
            ->orderBy('id', 'DESC')
            ->paginate(10);
        return view('recipe_management.companies.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::get();
        return view('recipe_management.companies.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *unique:tablename
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:companies',
            'author' => 'required'
        ]);
            $insert = new Companies();
        $insert->name = $request->name;
        $insert->user_id = $request->author;
        $insert->save();
        
        return redirect()->route('companies.index')->with('success', 'Companies has been successfully created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $company = Companies::find($id);
        $users = User::get();
        return view('recipe_management.companies.show', compact('company','users'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $company = Companies::find($id);
        $users = User::get();
        return view('recipe_management.companies.edit', compact('company','users'));
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
            'name' => 'required|unique:companies',
            'author' => 'required'
        ]);

        $insert = Companies::find($id);
        $insert->name = $request->name;
        $insert->user_id = $request->author;
        $insert->save();

        return redirect()->route('companies.index')->with('success', 'Companies has been successfully updated.');
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
            ->where('ingredients.company_id', '=', $id)
            ->delete();
        Product::join('ingredient_in_product', 'ingredient_in_product.product_id', 'products.id')
            ->join('ingredients', 'ingredient_in_product.ingredient_id', 'ingredients.id')
            ->where('ingredients.company_id', '=', $id)
            ->delete();
        IngredientInProduct::join('ingredients', 'ingredient_in_product.ingredient_id', 'ingredients.id')
            ->where('ingredients.company_id', '=', $id)
            ->delete();
        IngredientInStock::join('ingredients', 'ingredient_in_stock.ingredient_id', 'ingredients.id')
            ->where('ingredients.company_id', '=', $id)
            ->delete();
        Ingredient::where('company_id','=', $id)->delete();
        Measure::where('company_id','=', $id)->delete();
        Companies::find($id)->delete();

        return redirect()->route('companies.index')->with('success', 'Companies has been successfully deleted.');
    }
}
