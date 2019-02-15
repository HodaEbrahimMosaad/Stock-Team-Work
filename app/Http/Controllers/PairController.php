<?php

namespace App\Http\Controllers;

use App\Currency;
use App\Pair;
use Illuminate\Http\Request;
use App\Services\CurrencyLayer;
use Yajra\DataTables\DataTables;

class PairController extends Controller
{

    public function __construct()
    {
        // TODO: dispatch created, updated events if you want
        $this->middleware(['can:manage,pair'])->only(['show', 'edit', 'update', 'destroy']);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function getPairs(CurrencyLayer $cl)
    {
        $pairs = auth()->user()->pairs;
        Pair::syncIfNeeded($pairs, $cl);
        //return  Datatables::of($pairs)->make(true);
        return DataTables::of($pairs)->addColumn('owner', function (Pair $pair) {
                return $pair->owner->name;
            })->toJson();
    }
    public function index()
    {
        return view('pairs.index2');
    }



    /*public function index(CurrencyLayer $cl)
    {
        $pairs = auth()->user()->pairs;
        Pair::syncIfNeeded($pairs, $cl);
        return  view('pairs.index2', compact('pairs'));
    }*/


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $currencies = Currency::all();
        return view('pairs.create', compact('currencies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, CurrencyLayer $cl)
    {
        $attributes = Pair::validate($request);
        $attributes['user_id'] = auth()->user()->id;
        $pair = Pair::create($attributes);
        $pair->sync($cl);
        session()->flash('suc', 'Pair has been Created suc');
        return redirect(route('pairs.index'));
        //return redirect(route('index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pair  $pair
     * @return \Illuminate\Http\Response
     */
    public function show(Pair $pair, CurrencyLayer $cl)
    {
        Pair::syncIfNeeded([$pair], $cl);
        return view('pairs.view', compact('pair'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pair  $pair
     * @return \Illuminate\Http\Response
     */
    public function edit(Pair $pair)
    {
        $currencies = Currency::all();
        return view('pairs.edit')->with([
            'currencies' => $currencies,
            'pair' => $pair
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pair  $pair
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pair $pair, CurrencyLayer $cl)
    {
        $attributes = Pair::validate($request);
        $pair->update($attributes);
        $pair->sync($cl);
        session()->flash('suc', 'Pair has been Updated suc');
        return redirect(route('pairs.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pair  $pair
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,Pair $pair)
    {
        $deleted = Pair::find($request->deletedId);
        $deleted->delete();
        session()->flash('suc', 'Pair has been Deleted suc');
        return "done";
    }

}
