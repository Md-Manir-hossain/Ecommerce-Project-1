@extends('backend.master')

@section('content')
    <!--begin::App Content Header-->
    <div class="app-content-header">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Edit Sub-Category</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#"> Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Sub-Category</li>
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
                            <div class="card-title"> Edit Input Sub-Category </div>
                        </div>
                        <!--end::Header-->
                        <!--begin::Form-->
                        <form action="{{url('/admin/sub-category/create/update/'.$subCategory->id)}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <!--begin::Body-->
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Edit Sub-Category Name*</label>
                                    <input type="text" class="form-control" name="name" id="name" value="{{$subCategory->name}}" required />
                                </div>
                               <div class="mb-3">
                                    <label for="cat_id" class="form-label"> Select Category </label>
                                    <select class="form-control" name="cat_id" id="cat_id">
                                        <option selected disabled> Select Category </option>
                                        @foreach ($categories as $category)
                                        <option value="{{$category->id}}" @if ($subCategory->cat_id == $category->id)
                                            selected                                           
                                        @endif> {{$category->name}} </option> 
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!--end::Body-->
                            <!--begin::Footer-->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Update</button>
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
