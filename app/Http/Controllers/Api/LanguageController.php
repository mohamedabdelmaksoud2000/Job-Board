<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLanguageRequest;
use App\Http\Requests\UpdateLanguageRequest;
use App\Http\Resources\LanguageCollection;
use App\Http\Resources\LanguageResource;
use App\Models\Language;
use App\Traits\ResponseApi;


class LanguageController extends Controller
{
    use ResponseApi;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $languages = Language::paginate(10);
        return $this->responseSuccess('Languages retrieved successfully',new LanguageCollection($languages));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLanguageRequest $request)
    {
        $language = Language::create($request->validated());
        return $this->responseSuccess('Language created successfully', new LanguageResource($language));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $language = Language::findOrFail($id);
        return $this->responseSuccess('Language retrieved successfully', new LanguageResource($language));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLanguageRequest $request, string $id)
    {
        $language = Language::findOrFail($id);
        $language->update($request->validated());
        return $this->responseSuccess('Language updated successfully', new LanguageResource($language));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $language = Language::findOrFail($id);
        $language->delete();
        return $this->responseSuccess('Language deleted successfully');
    }
}
