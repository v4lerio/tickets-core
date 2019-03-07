<?php

namespace App\Http\Controllers;

use App\Email;
use Illuminate\Http\Request;
use App\Http\Resources\EmailResource;
use Illuminate\Support\Facades\Crypt;

class EmailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return EmailResource::collection(Email::all());
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
            'priority_id' => 'required|exists:priorities,id', // check if it exists
            'department_id' => 'required|exists:departments,id', // ditto
            'email_address' => 'required|email',
            'from_address' => 'required|email',
            'username' => 'nullable',
            'password' => 'nullable',
            'inbound_enabled' => 'boolean',
            'inbound_server' => 'required',
            'inbound_port' => 'required|integer',
            'inbound_protocol' => 'required|in:pop,imap',
            'inbound_encryption' => 'required|in:none,ssl',
            'fetch_frequency' => 'sometimes|required|integer',
            'fetch_amount' => 'sometimes|required|integer',
            'delete_on_fetch' => 'required|boolean',
            'smtp_enabled' => 'required|boolean',
            'smtp_server' => 'required',
            'smtp_port' => 'required|integer',
            'smtp_auth_required' => 'required|boolean'
        ]);

        // the password should be stored encrypted.
        $data['password'] = Crypt::encryptString($data['password']);

        $email = Email::create($data);

        return new EmailResource($email);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Email  $email
     * @return \Illuminate\Http\Response
     */
    public function show(Email $email)
    {
        return new EmailResource($email);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Email  $email
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Email $email)
    {
        $email->update($request->validate([
            'priority_id' => 'sometimes|required|exists:priorities,id', // check if it exists
            'department_id' => 'sometimes|required|exists:departments,id', // ditto
            'email_address' => 'sometimes|required|email',
            'from_address' => 'sometimes|required|email',
            'username' => 'sometimes|nullable',
            'password' => 'sometimes|nullable',
            'inbound_enabled' => 'sometimes|boolean',
            'inbound_server' => 'sometimes|required',
            'inbound_port' => 'sometimes|required|integer',
            'inbound_protocol' => 'sometimes|required|in:pop,imap',
            'inbound_encryption' => 'sometimes|required|in:none,ssl',
            'fetch_frequency' => 'sometimes|required|integer',
            'fetch_amount' => 'sometimes|required|integer',
            'delete_on_fetch' => 'sometimes|required|boolean',
            'smtp_enabled' => 'sometimes|required|boolean',
            'smtp_server' => 'sometimes|required',
            'smtp_port' => 'sometimes|required|integer',
            'smtp_auth_required' => 'sometimes|required|boolean'
        ]));

        return new EmailResource($email);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Email  $email
     * @return \Illuminate\Http\Response
     */
    public function destroy(Email $email)
    {
        $email->delete();
    }
}
