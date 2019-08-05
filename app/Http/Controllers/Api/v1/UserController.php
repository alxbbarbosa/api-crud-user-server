<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \App\Http\Requests\StoreUpdateUserFormRequest;

class UserController extends Controller
{
    protected $user;

    public function __construct(User $user)
    {
        $this->middleware('auth:api');
        $this->user = $user;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->user->paginate(10);
        return response()->json(compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateUserFormRequest $request)
    {
        $data = $request->only('name', 'email', 'password');

        $data['password'] = bcrypt($data['password']);
        $user             = User::create($data);
        $message          = 'Please confirm yourself by clicking on verify user button sent to you on your email';
        return response()->json(compact('message','user'), 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = $this->user->find($id);

        if (!$user) {
            return response()->json(['error' => 'Not_found'], 404);
        }

        return response()->json(compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateUserFormRequest $request, $id)
    {
        $data = $request->only('name', 'email', 'password');

        $user = $this->user->find($id);

        if (!$user) {
            return response()->json(['error' => 'Not_found'], 404);
        }
        $data['password'] = bcrypt($data['password']);
        $user->update($data);
        return response()->json(compact('user'));
    }

    public function updatePassword(Request $request, $id)
    {
        $this->validate($request,
            [
                'old_password' => 'required',
                'new_password' => 'required|min:6',
                'new_password_confirmation' => 'same:new_password'
        ]);

        $user = $this->user->find($id);
        if (!$user) {
            return response()->json(['error' => 'Not_found'], 404);
        }

        $old_password = $request->input('old_password');
        if (!password_verify($old_password, $user->password)) {
            return response()->json(['error' => 'Incorrect_password'], 422);
        }
        $password = bcrypt($request->input('new_password'));
        $user->update(['password' => $password]);
        return response()->json(['user password has been updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = $this->user->find($id);

        if (!$user) {
            return response()->json(['error' => 'Not_found'], 404);
        }

        if ($user->id === auth()->user()->id) {
            return response()->json(['error' => 'Bad_request'], 400);
        }
        $user->delete();
        return response()->json([]);
    }
}