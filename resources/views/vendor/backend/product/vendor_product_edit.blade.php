@extends('vendor.vendor_dashboard')
@section('vendor')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<div class="page-content">

				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Edit Vendor Product</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Edit Product</li>
							</ol>
						</nav>
					</div>
				</div>
				<!--end breadcrumb-->

              <div class="card">
				  <div class="card-body p-4">
					  <h5 class="card-title">Edit Product</h5>
					  <hr/>
					  <form id="myForm" method="post" action="{{ route('vendor.update.product') }}" >
                            @csrf  
							
							<input type="hidden" name="id" value="{{ $Product->id }}">

                       <div class="form-body mt-4">
					    <div class="row">
						   <div class="col-lg-8">
                           <div class="border border-3 p-4 rounded">
							<div class="form-group mb-3">
								<label for="inputProductTitle" class="form-label">Product Name</label>
								<input type="text" name="product_name" class="form-control" id="inputProductTitle" value="{{ $Product->product_name }}">
							</div>
							<div class="form-group mb-3">
								<label for="inputProductTitle" class="form-label">Product Tags</label>
								<input type="text" name="product_tags" class="form-control visually-hidden __web-inspector-hide-shortcut__" data-role="tagsinput" value="{{ $Product->product_tags }}">
							</div>
							<div class="form-group mb-3">
								<label for="inputProductTitle" class="form-label">Product Size</label>
								<input type="text" name="product_size" class="form-control visually-hidden __web-inspector-hide-shortcut__" data-role="tagsinput" value="{{ $Product->product_size }}">
							</div>
							<div class="form-group mb-3">
								<label for="inputProductTitle" class="form-label">Product Color</label>
								<input type="text" name="product_color" class="form-control visually-hidden __web-inspector-hide-shortcut__" data-role="tagsinput" value="{{ $Product->product_color }}">
							</div>
							<div class="form-group mb-3">
                                <label for="inputProductDescription" class="form-label">Short Description</label>
                                <textarea class="form-control" name="short_descp" id="inputProductDescription" rows="3">{{ $Product->short_descp }}</textarea>
							</div>
							<div class="mb-3">
                                <label for="inputProductDescription" class="form-label">Long Description</label>
                                <textarea id="mytextarea" name="long_descp">{!! $Product->long_descp !!}</textarea>
							</div>


							

                            
                        </div>
						   </div>
						   <div class="col-lg-4">
							<div class="border border-3 p-4 rounded">
                              <div class="row g-3">
								<div class="form-group col-md-6">
									<label for="inputPrice" class="form-label">Product Price</label>
									<input type="text" name="selling_price" class="form-control" id="inputPrice" value="{{ $Product->selling_price }}">
								  </div>
								  <div class="form-group col-md-6">
									<label for="inputCompareatprice" class="form-label">Discount Price</label>
									<input type="text" name="discount_price" class="form-control" id="inputCompareatprice" value="{{ $Product->discount_price }}">
								  </div>
								  <div class="form-group col-md-6">
									<label for="inputCostPerPrice" class="form-label">Product Code</label>
									<input type="text" name="product_code" class="form-control" id="inputCostPerPrice" value="{{ $Product->product_code }}">
								  </div>
								  <div class="form-group col-md-6">
									<label for="inputStarPoints" class="form-label">Product Qty</label>
									<input type="text" name="product_qty" class="form-control" id="inputStarPoints" value="{{ $Product->product_qty }}">
								  </div>
								  <div class="form-group col-12">
									<label for="inputProductType" class="form-label">Product Brand</label>
									<select class="form-select" name="brand_id" id="inputProductType">
										<option></option>
										@foreach($Brands as $brand)
										<option value="{{ $brand->id }}" {{ $brand->id == $Product->brand_id ? 'selected' : '' }}>{{ $brand->brand_name }}</option>
										@endforeach
									  </select>
								  </div>
								  <div class="form-group col-12">
									<label for="inputVendor" class="form-label">Product Category</label>
									<select class="form-select" name="category_id" id="inputVendor">
										<option></option>
										@foreach($Category as $cat)
										<option value="{{ $cat->id }}" {{ $cat->id == $Product->category_id ? 'selected' : '' }}>{{ $cat->category_name }}</option>
										@endforeach
									  </select>
								  </div>
								  <div class="form-group col-12">
									<label for="inputCollection" class="form-label">Product Subcategory</label>
									<select class="form-select" name="subcategory_id" id="inputCollection">
										<option></option>
                                        @foreach($Subcategory as $subcat)
										<option value="{{ $subcat->id }}" {{ $subcat->id == $Product->subcategory_id ? 'selected' : ''}}>{{ $subcat->subcategory_name }}</option>
										@endforeach
									  </select>
								  </div>
								  <div class="col-12">
									<div class="row g-3">
										<div class="col-md-6">
											<div class="form-check">
												<input class="form-check-input" name="hot_deals" type="checkbox" value="1" id="hot_deals" {{ $Product->hot_deals == 1 ? 'checked' : ''}} >
												<label class="form-check-label" for="hot_deals">Hot Deals</label>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-check">
												<input class="form-check-input" name="featured" type="checkbox" value="1" id="featured" {{ $Product->featured == 1 ? 'checked' : ''}}>
												<label class="form-check-label" for="featured">Featured</label>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-check">
												<input class="form-check-input" name="special_offer" type="checkbox" value="1" id="special_offer" {{ $Product->special_offer == 1 ? 'checked' : ''}}>
												<label class="form-check-label" for="special_offer">Special Offer</label>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-check">
												<input class="form-check-input" name="special_deals" type="checkbox" value="1" id="special_deals" {{ $Product->special_deals == 1 ? 'checked' : ''}}>
												<label class="form-check-label" for="special_deals">Special Deal</label>
											</div>
										</div>
									</div>
								  </div>
									<hr>
								  <div class="col-12">
									  <div class="d-grid">
										 <input type="submit" class="btn btn-primary px-4" value="Save Changes" />
									  </div>
								  </div>
							  </div> 
						  </div>
						  </div>
					   </div><!--end row-->
					</div>
				  </div>
				</form>
			  </div>
			</div>

<!--update product main thambnail image  -->
<div class="page-content">
	<h6 class="mb-0 text-uppercase">Update Main Thambnail Image</h6>
	<hr>
	<div class="card-body">
		<form method="post" action="{{ route('vendor.update.product.thambnail') }}" enctype="multipart/form-data">
			@csrf  

			<input type="hidden" name="id" value="{{ $Product->id }}" >
			<input type="hidden" name="old_img" value="{{ $Product->product_thambnail }}" >

			<div class="mb-3">
				<label for="formFile" class="form-label">Select Main Thambnail Image</label>
				<input class="form-control" type="file" name="product_thambnail" id="formFile">
			</div>
			<div class="mb-3">
				<label for="formFile" class="form-label"></label>
				<img src="{{ asset($Product->product_thambnail) }}" style="width: 100px; height: 100px;">
			</div>
			<hr>
			<input type="submit" class="btn btn-primary px-4" value="Save Changes" />
		</form>	
	</div>
</div>

<!-- end update product main thambnail image  -->

<!-- update product multi images -->
<div class="page-content">
	<h6 class="mb-0 text-uppercase">Update Product's Multi Image</h6>
	<hr>
<div class="card">
	<div class="card-body">
		<table class="table mb-0 table-striped">
			<thead>
				<tr>
					<th scope="col">#SL</th>
					<th scope="col">Image</th>
					<th scope="col">Change Image</th>
					<th scope="col">Actions</th>
				</tr>
			</thead>
			<tbody>
			<form method="post" action="{{ route('vendor.update.product.multiimg') }}" enctype="multipart/form-data">
				@csrf  
				@foreach($mulImgs as $key => $img)
				<tr>
					<th scope="row">{{ $key+1 }}</th>
					<td><img src="{{ asset($img->photo_name) }}" style="width: 70px; height: 40px"></td>
					<td><input type="file" class="form-group" name="mul_img[{{ $img->id }}]"></td>
					<td>
						<input type="submit" class="btn btn-primary px-4" value="Update Image" />
						<a href="{{ route('vendor.delete.product.multiimg',$img->id) }}" class="btn btn-danger" id="delete">Delete</a>
					</td>
				</tr>
				@endforeach
			</form>
			</tbody>
		</table>
	</div>
</div>
</div>
<!-- end update product multi images -->



<!-- form validation -->
<script type="text/javascript">
    $(document).ready(function (){
        $('#myForm').validate({
            rules: {
                product_name: {
                    required : true,
                }, 
                 short_descp: {
                    required : true,
                }, 
                 product_thambnail: {
                    required : true,
                }, 
                 multi_img: {
                    required : true,
                }, 
                 selling_price: {
                    required : true,
                },                   
                 product_code: {
                    required : true,
                }, 
                 product_qty: {
                    required : true,
                }, 
                 brand_id: {
                    required : true,
                }, 
                 category_id: {
                    required : true,
                }, 
                 subcategory_id: {
                    required : true,
                }, 
            },
            messages :{
                product_name: {
                    required : 'Please Enter Product Name',
                },
                short_descp: {
                    required : 'Please Enter Short Description',
                },
                product_thambnail: {
                    required : 'Please Select Product Thambnail Image',
                },
                multi_img: {
                    required : 'Please Select Product Multi Image',
                },
                selling_price: {
                    required : 'Please Enter Selling Price',
                }, 
                product_code: {
                    required : 'Please Enter Product Code',
                },
                 product_qty: {
                    required : 'Please Enter Product Quantity',
                },

            },
            errorElement : 'span', 
            errorPlacement: function (error,element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight : function(element, errorClass, validClass){
                $(element).addClass('is-invalid');
            },
            unhighlight : function(element, errorClass, validClass){
                $(element).removeClass('is-invalid');
            },
        });
    });
    
</script>

		<!-- main Thambnail img show script -->
		<script type="text/javascript">
			function mainThamUrl(input){
				if (input.files && input.files[0]) {
					var reader = new FileReader();
					reader.onload = function(e){
						$('#mainThmb').attr('src',e.target.result).width(80).height(80);
					};
					reader.readAsDataURL(input.files[0]);
				}
			}
		</script>

		<!-- multiple img show script -->
		<script> 
		
		$(document).ready(function(){
		$('#multiImg').on('change', function(){ //on file input change
			if (window.File && window.FileReader && window.FileList && window.Blob) //check File API supported browser
			{
				var data = $(this)[0].files; //this file data
				
				$.each(data, function(index, file){ //loop though each file
					if(/(\.|\/)(gif|jpe?g|png|webp)$/i.test(file.type)){ //check supported file type
						var fRead = new FileReader(); //new filereader
						fRead.onload = (function(file){ //trigger function on successful read
						return function(e) {
							var img = $('<img/>').addClass('thumb').attr('src', e.target.result) .width(100)
						.height(80); //create image element 
							$('#preview_img').append(img); //append image to output element
						};
						})(file);
						fRead.readAsDataURL(file); //URL representing the file's data.
					}
				});
				
			}else{
				alert("Your browser doesn't support File API!"); //if File API is absent
			}
		});
		});
		
		</script>

		<!-- load all subcategory related to category -->
		<script type="text/javascript">
  		
  		$(document).ready(function(){
  			$('select[name="category_id"]').on('change', function(){
  				var category_id = $(this).val();
  				if (category_id) {
  					$.ajax({
  						url: "{{ url('/subcategory/ajax') }}/"+category_id,
  						type: "GET",
  						dataType:"json",
  						success:function(data){
  							$('select[name="subcategory_id"]').html('');
  							var d =$('select[name="subcategory_id"]').empty();
  							$.each(data, function(key, value){
  								$('select[name="subcategory_id"]').append('<option value="'+ value.id + '">' + value.subcategory_name + '</option>');
  							});
  						},

  					});
  				} else {
  					alert('danger');
  				}
  			});
  		});

  </script>

@endsection