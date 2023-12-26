<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RelativeRegistrationForm;
use App\Models\Relatives;
use App\Models\User;

class MembersController extends Controller
{
    public function registerRelatives(RelativeRegistrationForm $request)
    {
        $validated = $request->validated();
        $relatives = Relatives::create($validated);
        return response()->json([
            "created-relative" => $relatives
        ]);
    }

    public function getAllMembers()
    {
        $allMembers = User::with('relatives')->get();
        return $this->apiResponse($allMembers);
    }
}
