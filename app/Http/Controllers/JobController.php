<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function showAllUsers()
    {
        return response()->json(Job::all());
    }

    public function showOneUser($id)
    {
        return response()->json(Job::find($id));
    }

    public function create(Request $request)
    {
        $job = Job::create($request->all());

        return response()->json($job, 201);
    }

    public function update($id, Request $request)
    {
        $job = Job::findOrFail($id);
        $job->update($request->all());

        return response()->json($job, 200);
    }

    public function delete($id)
    {
        Job::findOrFail($id)->delete();
        return response('Deleted Successfully', 200);
    }
}
