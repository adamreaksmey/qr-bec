<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RelativeRegistrationForm;
use App\Models\Relatives;
use App\Models\User;

class MembersController extends Controller
{
    public function __construct(private User $user)
    {
    }
    public function registerRelatives(RelativeRegistrationForm $request)
    {
        $validated = $request->validated();
        $relatives = Relatives::create($validated);
        return response()->json([
            "created-relative" => $relatives
        ]);
    }

    public function getAllMembers(Request $request)
    {
        $query = $this->user->with('relatives');
        if ($request->keyword) {
            $search = $request->keyword;
            $query->where(function ($q) use ($search) {
                $q->where('phone_number', 'LIKE', '%' . $search . '%')
                    ->orWhere('name', 'LIKE', '%' . $search . '%');
            });
        }
        return $this->apiResponse($query->get());
    }

    public function updateUserStatus(Request $request)
    {
        $status = $request->status;
        $userId = $request->userId;
        $userExists = $this->user->where('id', $userId)->exists();
        if ($userExists) {
            return $this->user->where('id', $userId)->update([
                "status" => $request->status
            ]);
        }
        return response()->json([
            "message" => "User with id of $userId does not exist!"
        ]);
    }

    public function updateRelativeStatus(Request $request)
    {
        $relativeId = $request->relativeId;
        $status = $request->status;
        $relativeExists = $this->user->where('id', $relativeId)->exists();
        if ($relativeExists) {
            return $this->user->where('id', $relativeId)->update([
                "status" => $status
            ]);
        }
        return response()->json([
            "message" => "Relative with id of $relativeId does not exist!"
        ]);
    }
}
