<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ShipDivision;
use App\Models\ShipDistrict;
use App\Models\ShipState;
use Carbon\Carbon;

class ShippingAreaController extends Controller
{
    //All division
    public function AllDivision() {
        $division = ShipDivision::latest()->get();
        return view('backend.ship.division.division_all', compact('division'));
    }//end
}
