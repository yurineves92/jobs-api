<?php

namespace App\Http\Controllers;

use App\Http\Resources\ReplyUserJobResource;
use App\User;
use App\Http\Resources\UserResource;
use App\Models\JobUserApplied;
use App\Models\ReplyUserJob;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Instantiate a new UserController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Get the authenticated User.
     *
     * @return Response
     */
    public function profile()
    {
        return response()->json(['user' => new UserResource(Auth::user())], 200);
    }

    /**
     * Get all User.
     *
     * @return Response
     */
    public function allUsers()
    {
        return response()->json(['users' => UserResource::collection(User::all())], 200);
    }

    /**
     * Get one user.
     *
     * @return Response
     */
    public function singleUser($id)
    {
        try {
            $user = User::findOrFail($id);

            return response()->json(['user' => new UserResource($user)], 200);
        } catch (\Exception $e) {

            return response()->json(['message' => 'user not found!'], 404);
        }
    }

    /**
     * User Apllied one Job
     * 
     * @return Response
     */
    public function appliedJob(Request $request)
    {
        $this->validate($request, [
            'job_id' => 'required',
            'user_id' => 'required'
        ]);

        $applied = JobUserApplied::where('user_id', $request['user_id'])->get();

        if (count($applied) > 0) {
            return response()->json(['message' => 'You have already applied for this vacancy!'], 200);
        }

        $job = JobUserApplied::create($request->all());

        return response()->json($job, 201);
    }

    /**
     * Replying User
     * 
     * @return Response
     */
    public function replyingUser(Request $request)
    {
        $this->validate($request, [
            'job_id' => 'required',
            'user_id' => 'required',
            'message' => 'required'
        ]);

        $reply = ReplyUserJob::create($request->all());

        return response()->json(new ReplyUserJobResource($reply), 201);
    }
}
