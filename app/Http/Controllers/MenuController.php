<?php

namespace App\Http\Controllers;

use App\Models\Menu as Model;
use App\Http\Requests\MenuRequest as Request;
use App\Http\Resources\Menu\Resources;
use App\Http\Resources\Menu\Collections;

class MenuController extends BaseController
{
    protected $model      = Model::class;
    protected $request    = Request::class;
    protected $resource   = Resources::class;
    protected $collection = Collections::class;
}
