<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;

trait AdminCheckTrait
{
    public function isAdmin()
    {
        if (!Auth::user()->is_admin) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Unauthorized',
            ], 403);
        }

        return null;
    }
}
