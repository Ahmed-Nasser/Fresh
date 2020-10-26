<?php

namespace App\Http\Controllers;


use App\Models\User;
use App\Traits\FractalBuilder;
use Illuminate\Http\Response;
use App\Http\Requests\StoreUserRequest;
use App\Http\Resources\UserTransformer;
use App\Http\Requests\UpdateUserRequest;

class UsersController extends Controller
{
    use FractalBuilder;
    /**
     * Display a listing of the resource.
     *
     * @return array
     */
    public function index()
    {
        if(request()->has('page') && request('page') == 0){
            return $this->fractalCollection(User::all(), new UserTransformer());
        } else{
            return $this->fractalCollectionPaginated(User::paginate(request('perPage') ?? 5), new UserTransformer());
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreUserRequest $request
     * @return void
     */
    public function store(StoreUserRequest $request)
    {
        $date = request(['name', 'email', 'password']);

        $user = new User();

        $user->name     = $date['name'];
        $user->email    = $date['email'];
        $user->password = $date['password'];

        return ($user->save()) ? json_encode('The user created successfully...'):
            json_encode('Something went wrong while creating a new resource.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return array
     */
    public function show($id)
    {
        return $this->fractalItem(User::findOrFail($id), new UserTransformer());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateUserRequest $request
     * @param int $id
     * @return Response
     */
    public function update(UpdateUserRequest $request, $id)
    {
        $date = request(['name', 'email', 'password']);

        $user = User::findOrFail($id);

        return ($user->update($date)) ? json_encode('The user updated successfully...'):
            json_encode('Something went wrong while updating a resource:'.$id.'.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
