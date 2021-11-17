<?php

namespace App\Http\Controllers;

use App\Helpers\PaginationHelper;
use App\Http\Filters\JobFilter;
use App\Http\Resources\JobResource;
use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function showAllJobs(JobFilter $filter)
    {
        $jobs = Job::filter($filter)->paginate();
        $jobsCollection = JobResource::collection($jobs);
        return response()->json(PaginationHelper::paginate($jobsCollection->collection, 5));
    }

    public function showOneJobs($id)
    {
        return response()->json(JobResource::collection(Job::find($id)));
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'company' => 'required|string|min:3',
            'title' => 'required|string|min:5',
            'description' => 'required|string|min:5',
            'salary' => 'required|numeric',
            'location' => 'required|string|min:5',
            'category_id' => 'required',
            'user_id' => 'required'
        ]);

        $job = Job::create($request->all());

        return response()->json(new JobResource($job), 201);
    }

    public function update($id, Request $request)
    {
        $this->validate($request, [
            'company' => 'required|string|min:3',
            'title' => 'required|string|min:5',
            'description' => 'required|string|min:5',
            'salary' => 'required|numeric',
            'location' => 'required|string|min:5',
            'category_id' => 'required',
            'user_id' => 'required'
        ]);

        try {
            $job = Job::findOrFail($id);
            $job->update($request->all());

            return response()->json(new JobResource($job), 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Job not found!'], 404);
        }
    }

    public function delete($id)
    {
        try {
            Job::findOrFail($id)->delete();
            return response('Deleted Successfully', 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Job not found!'], 404);
        }
    }
}
