<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLocationRequest;
use App\Http\Requests\UpdateLocationRequest;
use App\Http\Resources\LocationCollection;
use App\Http\Resources\LocationResource;
use App\Models\Location;
use App\Traits\ResponseApi;

class LocationController extends Controller
{
    use ResponseApi;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $locations = Location::paginate(10);
        return $this->responseSuccess('Locations retrieved successfully', new LocationCollection($locations));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLocationRequest $request)
    {
        $location = Location::create($request->validated());
        return $this->responseSuccess('Location created successfully', new LocationResource($location));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $location = Location::findOrFail($id);
        return $this->responseSuccess('Location retrieved successfully', new LocationResource($location));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLocationRequest $request, string $id)
    {
        $location = Location::findOrFail($id);
        $location->update($request->validated());
        return $this->responseSuccess('Location updated successfully', new LocationResource($location));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $location = Location::findOrFail($id);
        $location->delete();
        return $this->responseSuccess('Location deleted successfully');
    }
}
