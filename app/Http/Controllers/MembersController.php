<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RelativeRegistrationForm;
use App\Models\Relatives;
use App\Models\User;

class MembersController extends Controller
{
    public function __construct(private User $user, private Relatives $relatives)
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
            $query->when($request->keyword, function ($q) use ($request) {
                $search = $request->keyword;
                $q->where(function ($q) use ($search) {
                    $q->where('phone_number', 'LIKE', '%' . $search . '%')
                        ->orWhere('name', 'LIKE', '%' . $search . '%');
                });
            });
        }

        if ($request->status) {
            $query->when($request->status, function ($q) use ($request) {
                $search = $request->status;
                $q->where(function ($q) use ($search) {
                    $q->where('status', $search);
                });
            });
        }


        $query->orderByDesc('created_at');

        return $this->apiResponse($query->get());
    }

    public function updateUserStatus(Request $request)
    {
        $status = $request->status;
        $userId = $request->userId;
        $userExists = $this->user->where('id', $userId)->exists();
        $userHasRelatives = $this->checkUserRelationship($userId);

        if ($userExists) {

            if ($userHasRelatives) {
                return $this->apiResponse([
                    "message" => "User has relatives!",
                    "hasRelatives" => true
                ]);
            } else {
                $this->user->where('id', $userId)->update([
                    "status" => $status
                ]);
                return $this->apiResponse([
                    "message" => "User has been updated"
                ]);
            }
        }
        return $this->apiResponse([
            "message" => "User with id of $userId does not exist!"
        ]);
    }

    public function checkUserRelationship($id = 26)
    {
        return $this->user->where('id', $id)->first()->relatives()->exists();
    }

    public function updateRelativeStatus(Request $request)
    {
        $userId = $request->id;
        $status = $request->status;

        if ($request->isNotParent == 'false') {
            $this->user->where('id', $userId)->update([
                "status" => $status
            ]);
            return response()->json([
                "message" => "Parent has been updated"
            ]);
        } else {

            $this->relatives->where('id', $userId)->update([
                "status" => $status
            ]);
            return response()->json([
                "message" => "Relative has been updated"
            ]);
        }
    }

    public function getUsersRelatives(Request $request)
    {
        $relatives = $this->user->where("id", $request->id)->with("relatives")->first();
        return $this->apiResponse($relatives);
    }

    public function getAllRelatives(Request $request)
    {
        $query = $this->relatives->with('users');

        if ($request->keyword) {
            $query->when($request->keyword, function ($q) use ($request) {
                $search = $request->keyword;
                $q->where(function ($q) use ($search) {
                    $q->where('name', 'LIKE', '%' . $search . '%');
                });
            });
        }

        if ($request->status) {
            $query->when($request->status, function ($q) use ($request) {
                $search = $request->status;
                $q->where(function ($q) use ($search) {
                    $q->where('status', $search);
                });
            });
        }

        $query->orderByDesc('created_at');
        return $this->apiResponse($query->get());
    }
}
