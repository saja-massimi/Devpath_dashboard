@extends('dashboard.index')

@section('content')

<div class="content-body">
    <div class="container-fluid">


        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Add Categories</h4>
                    <p class="mb-0">DevPath dashboard</p>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item "><a href="{{route('categories.index')}}">Categories</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Add Categories</a></li>

                </ol>
            </div>
        </div>



        <div class="row">
            <div class="col-12">
                <div class="card">



                    <div class="card-header">
                        <h4 class="card-title">Create Category</h4>
                    </div>
                    <div class="card-body">
                        <div class="basic-form">
                            <form method="POST" action="{{ route('categories.store') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="category_name" class="form-label">Category Name</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ti-tag"></i></span>
                                        </div>
                                        <input type="text" id="category_name" name="category_name" placeholder="Enter category name" class="form-control" required>
                                    </div>
                                </div>
                                <div class="form-group text-end mt-3">
                                    <button type="submit" class="btn btn-primary">Create</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection