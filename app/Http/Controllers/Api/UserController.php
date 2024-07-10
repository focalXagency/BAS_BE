<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Controller;
use Illuminate\Support\Facades\Auth;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UserController extends Controller
{
    use ApiResponse;

    public function uploadFile(Request $request)
    {
        $request->validate([
            'file' => 'required|file',
        ]);

        $user = $request->user();
        $fileName = Str::slug($user->name . '_' . $user->id) . '_' . time() . '.' . $request->file->extension();

        $path = $request->file->storeAs('files', $fileName, 'public');

        // Update the user's path and remaining space
        $user->path = $path;
        $user->remaining_space -= $request->file->getSize();
        $user->save();

        return $this->successResponse($path, 'File uploaded successfully', 200);
    }

    public function downloadFile($fileName)
    {
        $user = Auth::user();
        $filePath = 'files/' . $fileName;

        // Check if the file belongs to the user
        if ($user->path !== $filePath) {
            return $this->errorResponse('This file does not belong to this user', 401);
        }

        return Storage::disk('public')->download($filePath);
    }
}
