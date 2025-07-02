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

    //edit division
    public function EditDivision($id) {
        $division = ShipDivision::findOrFail($id);

        return view('backend.ship.division.division_edit', compact('division'));
    }//end


    //update division
    public function UpdateDivision(Request $request) {
        $division_id = $request->id;

        ShipDivision::findOrFail($division_id)->update([
            'division_name' => strtoupper($request->division_name),
        ]);

        $notification = array (
            'message' => 'Division Updated Successfully',
            'alert-type' => 'success'
        );
    
        return redirect()->route('all.division')->with($notification);
    }//end

    //delete division
    public function DeleteDivision($id) {
        ShipDivision::findOrFail($id)->delete();

        $notification = array (
            'message' => 'Division Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
