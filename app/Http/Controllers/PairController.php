<?php

namespace App\Http\Controllers;

use App\Currency;
use App\EventType;
use App\Pair;
use Exception;
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


    public function sync(Request $request, CurrencyLayer $cl)
    {
        $pairs = auth()->user()->pairs;
        foreach ($pairs as $pair) {
            $pair->sync($cl);
        }
        return back();
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
        return DataTables::of($pairs)->addColumn('owner', function (Pair $pair) {
                return $pair->owner->name;
            })->toJson();
    }
    /*public function index()
    {
        return view('pairs.index');
    }*/



    public function index(CurrencyLayer $cl)
    {
        $pairs = auth()->user()->pairs;
        Pair::syncIfNeeded($pairs, $cl);

        $trashed_pairs = auth()->user()->pairs()->onlyTrashed()->get();
        return  view('pairs.index')->with([
            'pairs' => $pairs,
            'trashed_pairs' => $trashed_pairs
        ]);

        return  view('pairs.index', compact(['pairs', 'trashed_pairs']));
    }


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
        try {
            $pair = Pair::create($attributes);
            $pair->sync($cl);
            session()->flash('suc', 'Pair has been Created suc');
        } catch (Exception $ex) {
            // throw $ex;
            session()->flash('suc', 'Duplicate entry, If you want to use this pair again, restore it.');
            return redirect(route('pairs.index'));
        }
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
        $events = EventType::all();
        $trashed_triggers = $pair->triggers()->onlyTrashed()->get();
        return view('pairs.view')->with([
            'pair' => $pair,
            'events' => $events,
            'trashed_triggers' => $trashed_triggers
    ]);
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
    public function per_destroy(Request $request)
    {
        if ($request->has('force_delete'))
        {
            Pair::where('id',$request->deletedId)->forceDelete();
            session()->flash('suc', 'Pair has been Deleted Permanently');
            return 'done';
        }
    }
    public function destroy(Request $request,Pair $pair)
    {

        $deleted = Pair::find($request->deletedId);
        $deleted->delete();
        session()->flash('suc', 'Pair has been Deleted suc');
        return "done";
    }

    public function restore(Request $request)
    {
        Pair::where('id', $request->deletedId)->restore();
        session()->flash('suc', 'Pair has been Restored suc');
        return 'done';
    }
}
