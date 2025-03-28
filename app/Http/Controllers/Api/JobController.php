<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreJobRequest;
use App\Http\Requests\UpdateJobRequest;
use App\Http\Resources\JobCollection;
use App\Http\Resources\JobResource;
use App\Models\Job;
use App\Services\JobFilterService;
use App\Traits\ResponseApi;
use GuzzleHttp\Psr7\Request;

class JobController extends Controller
{
    use ResponseApi;
    
    protected $jobFilterService;

    public function __construct(JobFilterService $jobFilterService)
    {
        $this->jobFilterService = $jobFilterService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filters = $request->query('filter', []);
        $query = Job::query()->with(['languages', 'locations', 'categories', 'jobAttributeValues']);
        $jobs = $this->jobFilterService->applyFilters($query, $filters);
        return $this->responseSuccess('Jobs retrieved successfully', new JobCollection($jobs->paginate(10)));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreJobRequest $request)
    {
        $job = Job::create($request->validated());
        $job->languages()->sync($request->input('languages'));
        $job->locations()->sync($request->input('locations'));
        $job->categories()->sync($request->input('categories'));
        $job->jobAttributeValues()->createMany($request->input('attributes'));
        return $this->responseSuccess('Job created successfully', new JobResource($job));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $job = Job::with(['languages', 'locations', 'categories', 'jobAttributeValues'])->findOrFail($id);
        return $this->responseSuccess('Job retrieved successfully', new JobResource($job));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateJobRequest $request, string $id)
    {
        $job = Job::findOrFail($id);
        $job->update($request->validated());
        $job->languages()->sync($request->input('languages'));
        $job->locations()->sync($request->input('locations'));
        $job->categories()->sync($request->input('categories'));
        $job->jobAttributeValues()->delete();
        $job->jobAttributeValues()->createMany($request->input('attributes'));
        return $this->responseSuccess('Job updated successfully', new JobResource($job));   
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $job = Job::findOrFail($id);
        $job->delete();
        return $this->responseSuccess('Job deleted successfully');
    }
}
