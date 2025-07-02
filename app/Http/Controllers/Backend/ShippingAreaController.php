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

    //add division
    public function AddDivision() {
        return view('backend.ship.division.division_add');
    }//end

    //store division
    public function StoreDivision(Request $request) {
        ShipDivision::insert([
            'division_name' => strtoupper($request->division_name),
        ]);

        $notification = array (
            'message' => 'Division Inserted Successfully',
            'alert-type' => 'success'
        );
    
        return redirect()->route('all.division')->with($notification);
 
    }//end
}
