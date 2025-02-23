@extends('admin.admin_dashboard')

@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<div class="page-content"> 
<!--breadcrumb-->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
<div class="breadcrumb-title pe-3">Inactive Vendor Details</div>
<div class="ps-3">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0 p-0">
            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Inactive Vendor Details</li>
        </ol>
    </nav>
</div>
</div>
<!--end breadcrumb-->
<div class="container">
    <div class="main-body">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{route('inactive.vendor.approve')}}" method="post">
                        @csrf  

                    <input type="hidden" name="id" value="{{ $inActiveVendorDetails->id }}">

                    <div class="row mb-3">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Shop Name</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            <input type="text" class="form-control" name="name" value="{{ $inActiveVendorDetails->name }}" disabled/>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3">
                            <h6 class="mb-0">User Name</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            <input type="text" class="form-control" name="username" value="{{$inActiveVendorDetails->username}}"/>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Vendor Email</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            <input type="email" class="form-control" name="email" value="{{$inActiveVendorDetails->email}}" />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Vendor Phone</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            <input type="text" class="form-control" name="phone" value="{{$inActiveVendorDetails->phone}}" />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Vendor Address</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            <input type="text" class="form-control" name="address" value="{{$inActiveVendorDetails->address}}" />
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Join Date</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            <input type="text" class="form-control" name="vendor_join" value="{{$inActiveVendorDetails->vendor_join}}"/>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Vendor Info</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            <textarea class="form-control" name="vendor_short_info"
                            id="vendor_short_info" placeholder="Vendor Info" rows="3">
                            {{$inActiveVendorDetails->vendor_short_info}}
                            </textarea>
                        </div>
                    </div>


                    <div class="row mb-3">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Vendor Logo</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            <img id="showImage" src="{{(!empty($inActiveVendorDetails->photo)) ? url('upload/vendor_images/'.$inActiveVendorDetails->photo) : url('upload/no_image.jpg')}}" alt="Vendor" style="width: 100px; height: 100px;">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3"></div>
                        <div class="col-sm-9 text-secondary">
                            <input type="submit" class="btn btn-danger px-4" value="Active Vendor" />
                        </div>
                    </div>
                </form>
            </div>
         </div>
    </div>
</div>
</div>
</div>

@endsection