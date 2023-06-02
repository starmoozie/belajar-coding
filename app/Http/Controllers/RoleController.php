<?php

namespace App\Http\Controllers;

use App\Models\Role as Model;
use App\Http\Requests\RoleRequest as Request;
use App\Http\Resources\Role\Resources;
use App\Http\Resources\Role\Collections;

class RoleController extends BaseController
{
    protected $model      = Model::class;
    protected $request    = Request::class;
    protected $resource   = Resources::class;
    protected $collection = Collections::class;
}
