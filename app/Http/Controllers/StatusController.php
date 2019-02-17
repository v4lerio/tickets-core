<?php

namespace App\Http\Controllers;

use App\Status;
use Illuminate\Http\Request;
use App\Http\Resources\StatusResource;

class StatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return StatusResource::collection(Status::orderBy('name')->get());
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
            'description' => 'required',
            'state' => 'required|in:' . implode(',', Status::$state_types)
        ]);

        $status = Status::create($data);

        return new StatusResource($status);
    }

    /**
     * Display the specified resource.
     *
     * @param  Status $status
     * @return \Illuminate\Http\Response
     */
    public function show(Status $status)
    {
        return new StatusResource($status);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Status $status
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Status $status)
    {
        $status->update($request->validate([
            'name' => 'sometimes|required',
            'description' => 'sometimes|required',
            'state' => 'sometimes|required|in:' . implode(',', Status::$state_types)
        ]));

        return new StatusResource($status);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Status  $status
     * @return \Illuminate\Http\Response
     */
    public function destroy(Status $status)
    {
        $status->delete();
    }
}
