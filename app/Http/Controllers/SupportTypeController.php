<?php

namespace App\Http\Controllers;

use App\SupportType;
use Illuminate\Http\Request;
use App\Http\Resources\SupportTypeResource;

class SupportTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return SupportTypeResource::collection(SupportType::with('children', 'parent')->get());
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
            'parent_id' => 'nullable|exists:support_types,id',
            'name' => 'required'
        ]);

        $support_type = SupportType::create($data);

        return new SupportTypeResource($support_type);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SupportType  $supportType
     * @return \Illuminate\Http\Response
     */
    public function show(SupportType $supportType)
    {
        return new SupportTypeResource($supportType->load(['parent', 'children']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SupportType  $supportType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SupportType $supportType)
    {
        $supportType->update($request->validate([
            'parent_id' => 'nullable|exists:support_types,id',
            'name' => 'sometimes|required'
        ]));

        return new SupportTypeResource($supportType);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SupportType  $supportType
     * @return \Illuminate\Http\Response
     */
    public function destroy(SupportType $supportType)
    {
        $supportType->delete();
    }
}
