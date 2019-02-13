<?php

namespace App\Http\Controllers;

use App\Pair;
use Illuminate\Http\Request;
use App\Services\CurrencyLayer;

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
    public function index(CurrencyLayer $cl)
    {
        $pairs = auth()->user()->pairs;  
        Pair::syncIfNeeded($pairs, $cl);
        return view('pairs.index', compact('pairs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pairs.create');
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
        return redirect('/home');
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
        return view('pairs.edit', compact('pair'));
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
        return redirect('/home');
        //return redirect(route('index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pair  $pair
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pair $pair)
    {
        $pair->delete();
        return redirect('/home');
        //return redirect(route('index'));
    }

}
