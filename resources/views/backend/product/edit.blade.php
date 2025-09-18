@extends('backend.master')

@section('content')
    <!--begin::App Content Header-->
    <div class="app-content-header">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Edit Product</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#"> Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Product</li>
                    </ol>
                </div>
            </div>
            <!--end::Row-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::App Content Header-->
    <!--begin::App Content-->
    <div class="app-content">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row g-4">
                <!--begin::Col-->
                <div class="col-12">
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-md-12">
                    <!--begin::Quick Example-->
                    <div class="card card-primary card-outline mb-4">
                        <!--begin::Header-->
                        <div class="card-header">
                            <div class="card-title"> Input Product </div>
                        </div>
                        <!--end::Header-->
                        <!--begin::Form-->
                        <form action="{{url('/admin/product/create/update/'.$product->id)}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <!--begin::Body-->
                            <div class="card-body">
                                <div class="row">
                                <div class="col-6 mb-3">
                                    <label for="name" class="form-label">Product Name*</label>
                                    <input type="text" class="form-control" value="{{$product->name}}" name="name" id="name" required />
                                </div>

                                <div class="col-6 mb-3">
                                    <label for="sku_code" class="form-label">Product SKU Code* </label>
                                    <input type="text" class="form-control" value="{{$product->sku_code}}"  name="sku_code" id="sku_code" required />
                                </div>

                                <div class="col-6 mb-3">
                                    <label for="cat_id" class="form-label">Select Category* </label>
                                    <select class="form-control" name="cat_id" id="cat_id">
                                        @foreach ($categories as $category)
                                        <option value="{{$category->id}}" @if ($product->cat_id == $category->id)
                                            selected
                                            
                                        @endif>{{$category->name}} </option>                                            
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-6 mb-3">
                                    <label for="sub_cat_id" class="form-label">Select Sub-Category* </label>
                                    <select class="form-control" name="sub_cat_id" id="sub_cat_id">
                                        @foreach ($subCategories as $subCategory)
                                        <option value="{{$subCategory->id}}" @if ($product->sub_cat_id == $subCategory->id)
                                            selected
                                            
                                        @endif> {{$subCategory->name}} </option>                                            
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-6 mb-3">
                                    <div class="form-group" id="color_fields">
                                        <label for="color_name" class="form-label"> Product Color (Optional) </label>
                                        @foreach ($product->color as $singleColor)
                                            <input type="text" class="form-control" value="{{$singleColor->color_name}}" name="color_name[]" id="color_name"/>                                            
                                        @endforeach
                                    </div>
                                    <button type="button" class="btn btn-primary float-end" id="add_color"> Add More </button>
                                </div>

                                <div class="col-6 mb-3">
                                    <div class="form-group" id="size_fields">
                                        <label for="size_name" class="form-label">Product Size (Optional) </label>
                                         @foreach ($product->size as $singleSize)
                                            <input type="text" class="form-control" value="{{$singleSize->size_name}}" name="size_name[]" id="size_name"/>
                                        @endforeach
                                    </div>
                                    <button type="button" class="btn btn-primary float-end" id="add_size"> Add More </button>
                                </div>

                                <div class="col-6 mb-3">
                                    <label for="qty" class="form-label">Product Quantity* </label>
                                    <input type="number" class="form-control" value="{{$product->qty}}" name="qty" id="qty" required />
                                </div>

                                <div class="col-6 mb-3">
                                    <label for="buying_price" class="form-label">Product Buying Price* </label>
                                    <input type="number" class="form-control" value="{{$product->buying_price}}" name="buying_price" id="buying_price" required />
                                </div>

                                <div class="col-6 mb-3">
                                    <label for="regular_price" class="form-label">Product Regular Price* </label>
                                    <input type="number" class="form-control" value="{{$product->regular_price}}" name="regular_price" id="regular_price" required />
                                </div>

                                <div class="col-6 mb-3">
                                    <label for="discount_price" class="form-label">Product Discount Price (Optional) </label>
                                    <input type="number" class="form-control" value="{{$product->discount_price}}" name="discount_price" id="discount_price"/>
                                </div>

                                <div class="col-12 mb-3">
                                    <label for="product_type" class="form-label">Select Product Type* </label>
                                    <select class="form-control" name="product_type" id="product_type">
                                        <option selected disabled> Select Product Type </option>
                                        <option value="Hot" @if ($product->product_type == "Hot")
                                            selected
                                        @endif>Hot Products </option>
                                        <option value="Regular" @if ($product->product_type == "Regular")
                                            selected
                                        @endif>Regular Products </option>
                                        <option value="New" @if ($product->product_type == "New")
                                            selected
                                        @endif> New Arrival Products </option>
                                        <option value="Discount" @if ($product->product_type == "Discount")
                                            selected
                                        @endif> Discount Products </option>
                                    </select>
                                </div>

                                <div class="col-12 mb-3">
                                    <label for="description" class="form-label"> Product Description* </label>
                                    <textarea class="form-control" name="description" id="summernote" required> {{$product->description}} </textarea>
                                </div>

                                <div class="col-12 mb-3">
                                    <label for="product_policy" class="form-label"> Product Policy (Optional) </label>
                                    <textarea class="form-control" name="product_policy" id="summernote2"> {{$product->product_policy}} </textarea>
                                </div>

                                <div class="input-group mb-3">
                                    <input type="file" class="form-control" accept="image/*" name="image" id="image"/>
                                    <label class="input-group-text" for="inputGroupFile02">Upload Main Image</label>
                                    <img src="{{asset('backend/images/product/'.$product->image)}}" height="80" width="80">
                                </div>
                                
                                <div class="input-group mb-3">
                                    <input type="file" class="form-control" accept="image/*" name="gallery_image[]" id="gallery_image" multiple/>
                                    <label class="input-group-text" for="gallery_image">Upload Gallery Image</label>
                                    @foreach ($product->galleryImage as $singleImage)
                                        <img src="{{asset('backend/images/galleryimage/'.$singleImage->image)}}" height="80" width="80">  
                                    @endforeach
                                </div>

                                </div>
                            </div>
                            <!--end::Body-->
                            <!--begin::Footer-->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary"> Update </button>
                            </div>
                            <!--end::Footer-->
                        </form>
                        <!--end::Form-->
                    </div>
                    <!--end::Quick Example-->
                </div>
            </div>
            <!--end::Row-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::App Content--
@endsection

@push('script')
    {{-- Summernote-1 --}}
    <script>
        $(document).ready(function () {
            $('#summernote').summernote();
        });
    </script>

    {{-- Summernote-2 --}}
    <script>
        $(document).ready(function () {
            $('#summernote2').summernote();
        });
    </script>

    {{-- Add more color --}}
    <script>
        $(document).ready(function () {
            $("#add_color").click(function () {
                $("#color_fields").append(
                    '<input type="text" class="form-control mt-2" name="color_name[]" placeholder="Enter color">'
                );
            });
        });
    </script>

    {{-- Add more size --}}
    <script>
        $(document).ready(function () {
            $("#add_size").click(function () {
                $("#size_fields").append(
                    '<input type="text" class="form-control mt-2" name="size_name[]" placeholder="Enter size">'
                );
            });
        });
    </script>
@endpush

