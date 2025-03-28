<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAttributeRequest;
use App\Http\Requests\UpdateAttributeRequest;
use App\Http\Resources\AttributeCollection;
use App\Models\Attribute;
use App\Traits\ResponseApi;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Http\Request;

class AttributeController extends Controller
{
    use ResponseApi;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $attributes = Attribute::paginate(10);
        return $this->responseSuccess('Attributes retrieved successfully', new AttributeCollection($attributes));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAttributeRequest $request)
    {
        $attribute = Attribute::create($request->validated());
        return $this->responseSuccess('Attribute created successfully', $attribute);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $attribute = Attribute::findOrFail($id);
        return $this->responseSuccess('Attribute retrieved successfully', $attribute);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAttributeRequest $request, string $id)
    {
        $attribute = Attribute::findOrFail($id);
        $attribute->update($request->validated());
        return $this->responseSuccess('Attribute updated successfully', $attribute);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $attribute = Attribute::findOrFail($id);
        $attribute->delete();
        return $this->responseSuccess('Attribute deleted successfully', null);
    }
}
