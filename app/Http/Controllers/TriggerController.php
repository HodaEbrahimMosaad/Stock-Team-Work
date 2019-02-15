<?php

namespace App\Http\Controllers;

use App\Trigger;
use Illuminate\Http\Request;

class TriggerController extends Controller
{

    public function view(Trigger $trigger)
    {
        return view('triggers.view', compact('trigger'));
    }

    public function create()
    {
        return view('triggers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attributes = Trigger::validate($request);
        $pair = Trigger::create($attributes);
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Trigger  $trigger
     * @return \Illuminate\Http\Response
     */
    public function edit(Trigger $trigger)
    {
        return view('triggers.edit', compact('trigger'));
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
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Trigger  $trigger
     * @return \Illuminate\Http\Response
     */
    public function destroy(Trigger $trigger)
    {
        $trigger->delete();
        return back();
    }
}
