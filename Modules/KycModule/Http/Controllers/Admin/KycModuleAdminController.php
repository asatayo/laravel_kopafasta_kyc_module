<?php

namespace Modules\KycModule\Http\Controllers\Admin;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Modules\KycModule\Entities\Loan;


class KycModuleAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $loans = Loan::orderBy('amount', 'DESC')->get();
        return view('kycmodule::admin', compact('loans'));
    }



}
