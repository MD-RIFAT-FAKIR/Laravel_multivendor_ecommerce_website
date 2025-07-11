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
    }//end


    ////////District/////////////

    //All district
    public function AllDistrict() {
        $district = ShipDistrict::latest()->get();
        return view('backend.ship.district.district_all', compact('district'));
    }//end

    //add district
    public function AddDistrict() {
        $division = ShipDivision::orderBy('division_name','ASC')->get();
        return view('backend.ship.district.district_add', compact('division'));
    }//end

    //store district
    public function StoreDistrict(Request $request) {
        ShipDistrict::insert([
            'division_id' => $request->division_id,
            'districts_name' => strtoupper($request->districts_name),
        ]);

        $notification = array (
            'message' => 'District Inserted Successfully',
            'alert-type' => 'success'
        );
    
        return redirect()->route('all.district')->with($notification);
 
    }//end

    //edit district
    public function EditDistrict($id) {
        $division = ShipDivision::orderBy('division_name','ASC')->get();
        $district = ShipDistrict::findOrFail($id);
        

        return view('backend.ship.district.district_edit', compact('division', 'district'));
    }//end

    //update district
    public function UpdateDistrict(Request $request) {
        $district_id = $request->id;

        ShipDistrict::findOrFail($district_id)->update([
            'division_id' => $request->division_id,
            'districts_name' => strtoupper($request->districts_name),
        ]);

        $notification = array (
            'message' => 'District Updated Successfully',
            'alert-type' => 'success'
        );
    
        return redirect()->route('all.district')->with($notification);
    }//end

    //delete district
    public function DeleteDistrict($id) {
        ShipDistrict::findOrFail($id)->delete();

        $notification = array (
            'message' => 'District Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }//end


    ////////State/////////////

    //All state
    public function AllState() {
        $state = ShipState::latest()->get();
        return view('backend.ship.state.state_all', compact('state'));
    }//end
}
