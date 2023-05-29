<?php

namespace App\Http\Controllers;

use App\Models\UserAddress as Model;
use App\Http\Requests\UserAddressRequest as Request;
use App\Http\Resources\UserAddress\Resources;
use App\Http\Resources\UserAddress\Collections;

class UserAddressController extends BaseController
{
    protected $model      = Model::class;
    protected $request    = Request::class;
    protected $resource   = Resources::class;
    protected $collection = Collections::class;
}
