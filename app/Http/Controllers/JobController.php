<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function showAllJobs()
    {
        return response()->json(Job::all());
    }

    public function showOneJobs($id)
    {
        return response()->json(Job::find($id));
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

        return response()->json($job, 201);
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

            return response()->json($job, 200);
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
