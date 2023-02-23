<?php

namespace Modules\KycModule\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class KycModuleLoanFormController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function form($id, $name)
    {
        return view('kycmodule::forms.'.$name);
    }


}
