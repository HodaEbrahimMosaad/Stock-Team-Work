<?php

namespace App\Http\Controllers;

use App\EventType;
use App\Trigger;
use Illuminate\Http\Request;

class TriggerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($pair, Request $request)
    {

        $attributes = Trigger::validate($request);

        $attributes['user_id'] = auth()->user()->id;
        $attributes['pair_id'] = $pair;

        try{
            Trigger::create($attributes);
        } catch (Exception $ex) {
            // throw $ex;
            session()->flash('suc', 'Duplicate entry, If you want to use this trigger again, restore it.');
            return redirect(route('pairs.show',$pair));
        }
        session()->flash('suc', 'Event has been Updated suc');
        return redirect(route('pairs.show',$pair));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Trigger  $trigger
     * @return \Illuminate\Http\Response
     */
    public function show(Trigger $trigger)
    {
        $events = EventType::all();
        return view('triggers.view')->with([
            'trigger'=>$trigger,
            'events'=>$events
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Trigger  $trigger
     * @return \Illuminate\Http\Response
     */
    public function edit(Trigger $trigger)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Trigger  $trigger
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Trigger $trigger)
    {

        $attributes = Trigger::validate($request);
        $trigger->update($attributes);
        session()->flash('suc', 'Event has been Updated suc');
        return redirect(route('triggers.show',$trigger->id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Trigger  $trigger
     * @return \Illuminate\Http\Response
     */
    public function per_destroy(Request $request)
    {
        if ($request->has('force_delete'))
        {
            Trigger::where('id',$request->deletedId)->forceDelete();
            session()->flash('suc', 'Pair has been Deleted Permanently');
            return 'done';
        }
    }
    public function destroy(Request $request,Trigger $trigger)
    {

        $deleted = Trigger::find($request->deletedId);
        $deleted->delete();
        session()->flash('suc', 'Trigger has been Deleted suc');
        return "done";
    }

    public function restore(Request $request)
    {
        Trigger::where('id', $request->deletedId)->restore();
        session()->flash('suc', 'Trigger has been Restored suc');
        return 'done';
    }
}
