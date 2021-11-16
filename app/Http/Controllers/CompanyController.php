<?php

namespace App\Http\Controllers;

use App\Http\Resources\JobResource;
use App\Http\Resources\JobUserAppliedResource;
use App\Models\Job;
use App\Models\JobUserApplied;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyController extends Controller
{
    public function listApplied(Request $request)
    {
        return response()->json(JobUserAppliedResource::collection(JobUserApplied::all()));
    }

    public function createJob(Request $request)
    {
        $company = Auth::user();

        $this->validate($request, [
            'title' => 'required|string|min:5',
            'description' => 'required|string|min:5',
            'salary' => 'required|numeric',
            'location' => 'required|string|min:5',
            'category_id' => 'required',
            'user_id' => 'required'
        ]);

        $request['company'] = $company->name;

        $job = Job::create($request->all());

        return response()->json(new JobResource($job), 201);
    }
}
