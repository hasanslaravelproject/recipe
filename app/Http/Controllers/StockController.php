<?php

namespace App\Http\Controllers;

use App\Models\Ingredient;
use App\Models\IngredientInStock;
use App\Models\Measure;
use App\Models\Stock;
use Illuminate\Http\Request;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $today = date("Y-m-d", time());
        $role = auth()->user()->roles()->first()->id;
        $user_id = auth()->user()->id;

        if($role == 2){
            $ingredients = Ingredient::paginate(10);
            $current_stocks = IngredientInStock::join('ingredients','ingredient_in_stock.ingredient_id','ingredients.id')
                ->join('measures','ingredients.measure_unit','measures.id')
                ->where('ingredient_in_stock.date_expire', '>=', $today)
                ->select('ingredient_in_stock.*','ingredients.name as ingredient_name','ingredients.id as ingredient_id','measures.name as measure_name')
                ->orderBy('ingredient_in_stock.date_expire', 'ASC')->get();
        }elseif($role == 3){
            $ingredients = Ingredient::join('companies', 'ingredients.company_id','companies.id')
                            ->where('companies.user_id','=',$user_id)
                            ->paginate(10);
            $current_stocks = IngredientInStock::join('ingredients','ingredient_in_stock.ingredient_id','ingredients.id')
                ->join('measures','ingredients.measure_unit','measures.id')
                ->join('companies','ingredients.company_id', 'companies.id')
                ->where('ingredient_in_stock.date_expire', '>=', $today)
                ->where('companies.user_id', '=', $user_id)
                ->select('ingredient_in_stock.*','ingredients.name as ingredient_name','ingredients.id as ingredient_id','measures.name as measure_name')
                ->orderBy('ingredient_in_stock.date_expire', 'ASC')->get();
        }


        return view('recipe_management.stocks.index', compact('current_stocks','ingredients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $role = auth()->user()->roles()->first()->id;
        $user_id = auth()->user()->id;

        if($role == 2){
            $ingredients = Ingredient::join('measures','ingredients.measure_unit', 'measures.id')
                ->select('ingredients.*','measures.name as measure_name')
                ->get();
        }else{
            $ingredients = Ingredient::join('measures','ingredients.measure_unit', 'measures.id')
                ->join('companies', 'ingredients.company_id','companies.id')
                ->where('companies.user_id','=',$user_id)
                ->select('ingredients.*','measures.name as measure_name')
                ->get();
        }

        return view('recipe_management.stocks.create', compact('ingredients'));
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
            'ingredient' => 'required',
            'quantity' => 'required',
            'expire_date' => 'required'
        ]);

        $insert = new IngredientInStock();
        $insert->ingredient_id = $request->ingredient;
        $insert->quantity = $request->quantity;
        $insert->date_expire = $request->expire_date;
        $insert->save();

        return redirect()->route('stocks.index')->with('success', 'Stock has been successfully create.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = auth()->user()->roles()->first()->id;
        $user_id = auth()->user()->id;

        if($role == 2){
            $ingredients = Ingredient::get();
        }else{
            $ingredients = Ingredient::join('companies', 'ingredients.company_id','companies.id')
                ->where('companies.user_id','=',$user_id)
                ->select('ingredients.*')
                ->get();
        }

        $dates = IngredientInStock::select('created_at')->orderBy('id','DESC')->get()->toArray();
        $created_at = [];
        foreach($dates as $date){
            array_push($created_at, date('Y-m-d', strtotime($date['created_at'])));
        }
        $created_dates = array_unique($created_at);
        $all_stocks = IngredientInStock::join('ingredients','ingredient_in_stock.ingredient_id','ingredients.id')
            ->join('measures','ingredients.measure_unit','measures.id')
            ->select('ingredient_in_stock.*','ingredients.name as ingredient_name','measures.name as measure_name')
            ->orderBy('id', 'DESC')->paginate(10);

        return view('recipe_management.stocks.show', compact('all_stocks','created_dates','ingredients'));
    }

    public function searchStock()
    {
        $role = auth()->user()->roles()->first()->id;
        $user_id = auth()->user()->id;

        if($role == 2){
            $ingredients = Ingredient::get();
        }else{
            $ingredients = Ingredient::join('companies', 'ingredients.company_id','companies.id')
                ->where('companies.user_id','=',$user_id)
                ->select('ingredients.*')
                ->get();
        }

        $search_date = $_GET['date'];
        $search_ingredient = $_GET['ingredient'];
        $dates = IngredientInStock::select('created_at')->orderBy('id','DESC')->get()->toArray();
        $created_at = [];

        if($search_date != '' && $search_ingredient != ''){
            foreach($dates as $date){
                if(date('Y-m-d', strtotime($date['created_at'])) == date('Y-m-d', strtotime($search_date)))
                {
                    array_push($created_at, date('Y-m-d', strtotime($date['created_at'])));
                }
            }
            $all_stocks = IngredientInStock::join('ingredients','ingredient_in_stock.ingredient_id','ingredients.id')
                ->join('measures','ingredients.measure_unit','measures.id')
                ->where('ingredient_in_stock.ingredient_id','=',$search_ingredient)
                ->select('ingredient_in_stock.*','ingredients.name as ingredient_name','measures.name as measure_name')
                ->orderBy('id', 'DESC')->paginate(10);
        }elseif($search_date != ''){
            foreach($dates as $date){
                if(date('Y-m-d', strtotime($date['created_at'])) == date('Y-m-d', strtotime($search_date)))
                {
                    array_push($created_at, date('Y-m-d', strtotime($date['created_at'])));
                }
            }
            $all_stocks = IngredientInStock::join('ingredients','ingredient_in_stock.ingredient_id','ingredients.id')
                ->join('measures','ingredients.measure_unit','measures.id')
                ->select('ingredient_in_stock.*','ingredients.name as ingredient_name','measures.name as measure_name')
                ->orderBy('id', 'DESC')->paginate(10);
        }elseif($search_ingredient != ''){
            foreach($dates as $date){
                array_push($created_at, date('Y-m-d', strtotime($date['created_at'])));
            }
            $all_stocks = IngredientInStock::join('ingredients','ingredient_in_stock.ingredient_id','ingredients.id')
                ->join('measures','ingredients.measure_unit','measures.id')
                ->where('ingredient_in_stock.ingredient_id','=',$search_ingredient)
                ->select('ingredient_in_stock.*','ingredients.name as ingredient_name','measures.name as measure_name')
                ->orderBy('id', 'DESC')->paginate(10);
        }else{
            return redirect()->back()->with('success', 'Please choose one parameter.');
        }

        $created_dates = array_unique($created_at);

        return view('recipe_management.stocks.show', compact('all_stocks','created_dates','ingredients'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = auth()->user()->roles()->first()->id;
        $user_id = auth()->user()->id;

        if($role == 2){
            $ingredients = Ingredient::join('measures','ingredients.measure_unit', 'measures.id')
                ->select('ingredients.*','measures.name as measure_name')
                ->get();
        }else{
            $ingredients = Ingredient::join('measures','ingredients.measure_unit', 'measures.id')
                ->join('companies', 'ingredients.company_id','companies.id')
                ->where('companies.user_id','=',$user_id)
                ->select('ingredients.*','measures.name as measure_name')
                ->get();
        }
        $stock = IngredientInStock::find($id);
        return view('recipe_management.stocks.edit', compact('ingredients', 'stock'));
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
            'ingredient' => 'required',
            'quantity' => 'required',
            'expire_date' => 'required'
        ]);

        $insert = IngredientInStock::find($id);
        $insert->ingredient_id = $request->ingredient;
        $insert->quantity = $request->quantity;
        $insert->date_expire = $request->expire_date;
        $insert->save();

        return redirect()->route('stocks.show','stock-history')->with('success', 'Stock has been successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        IngredientInStock::find($id)->delete();

        return redirect()->route('stocks.show','stock-history')->with('success', 'Stock has been successfully deleted.');
    }
}
