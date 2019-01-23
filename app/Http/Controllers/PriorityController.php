<?php

namespace App\Http\Controllers;

use App\Priority;
use Illuminate\Http\Request;
use App\Http\Resources\PriorityResource;

class PriorityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return PriorityResource::collection(Priority::withTrashed()->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'colour' => 'required|unique:priorities',
            'urgency' => 'required|integer',
        ]);

        $priority = Priority::create($data);

        return new PriorityResource($priority);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Priority  $priority
     * @return \Illuminate\Http\Response
     */
    public function show(Priority $priority)
    {
        return new PriorityResource($priority);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Priority  $priority
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Priority $priority)
    {
        $priority->update($request->validate([
            'name' => 'sometimes|required',
            'colour' => 'sometimes|required|unique:priorities',
            'urgency' => 'sometimes|required'
        ]));

        return new PriorityResource($priority);   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Priority  $priority
     * @return \Illuminate\Http\Response
     */
    public function destroy(Priority $priority)
    {
        $priority->delete();
    }
}
