<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RelativeRegistrationForm;
use App\Models\Relatives;

class MembersController extends Controller
{
    public function registerRelatives(RelativeRegistrationForm $request)
    {
        $validated = $request->validated();
        $relatives = Relatives::create([
            
        ]);
    }
}
