<?php

namespace App\Http\Controllers;

use App\Models\BaseModel;

class ControllerBase extends Controller
{
    public function urlAPI()
    {
        return BaseModel::URI_API;
    }
}
