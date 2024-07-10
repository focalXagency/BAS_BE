<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\AdminResource;
use App\Http\Resources\UserResource;
use App\Models\Admin;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use App\Http\Requests\AdminRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class AdminController extends Controller
{
    use ApiResponse;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admin = User::all();
        return $this->successResponse($admin, 'ok', 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminRequest $request)
    {
        $$this->validate($request, [
            'email' => 'required|email|unique:admins',
            'password' => 'required|min:6',
        ]);

        $admin = Admin::create([
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $admin = Admin::create($request->all());
        if ($admin) {
            return $this->successResponse(new AdminResource($admin), 'the admin created successfully', 200);
        } else {
            return $this->errorResponse('the admin not added',401);
        }
    }


    public function updateTotalSpace(Request $request, $userId)
    {
        $request->validate([
            'total_space' => 'required|integer',
        ]);

        $user = User::findOrFail($userId);
        $totalSpace = $request->total_space;

        // Update the total space for the user
        $user->total_space = $totalSpace;
        $user->save();

        // Calculate the remaining space
        $usedSpace = 0;
        $files = Storage::disk('public')->files($user->path);
        foreach ($files as $file) {
            $usedSpace += Storage::disk('public')->size($file);
        }
        $remainingSpace = $totalSpace - $usedSpace;

        return $this->successResponse(new UserResource($user), 'Total space updated successfully. Remaining space: ' . $remainingSpace . ' bytes', 200);
    }
}
