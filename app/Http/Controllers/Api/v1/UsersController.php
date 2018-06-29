<?php

namespace App\Http\Controllers\Api\v1;

use Dingo\Api\Http\Request;
use App\Models\User;

class UsersController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Dingo\Api\Http\Response
     */
    public function index()
    {
        // Get list users
        return $this->json(User::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Dingo\Api\Http\Response
     */
    public function create(Request $request)
    {
        //
        return $this->json($request);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Dingo\Api\Http\Request $request request parameters
     *
     * @return \Dingo\Api\Http\Response
     */
    public function store(Request $request)
    {
        $user = $request->toArray();
        // return
        return response()->json(User::create($user['params']));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id Id User
     *
     * @return \Dingo\Api\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id ID User
     *
     * @return \Dingo\Api\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Dingo\Api\Http\Request $request request parameter
     * @param  int $id                          ID User
     *
     * @return \Dingo\Api\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id ID USer
     *
     * @return \Dingo\Api\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
