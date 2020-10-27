<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use App\Traits\FractalBuilder;
use App\Http\Requests\StoreUserRequest;
use App\Http\Resources\UserTransformer;
use App\Http\Requests\UpdateUserRequest;
use App\Repository\UserRepositoryInterface;

class UsersController extends Controller
{
    use FractalBuilder;

    private $repository;

    public function __construct(UserRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return array
     */
    public function index()
    {
        if(request()->has('page') && request('page') == 0){
            return $this->fractalCollection($this->repository->all(request()->all()), new UserTransformer());
        } else{
            return $this->fractalCollectionPaginated($this->repository->list(request()->all()), new UserTransformer());
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

        return ($this->repository->create($date)) ? json_encode('The user created successfully...'):
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
        return $this->fractalItem($this->repository->find($id), new UserTransformer());
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

        return ($this->repository->update($date, $id)) ? json_encode('The user updated successfully...'):
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
