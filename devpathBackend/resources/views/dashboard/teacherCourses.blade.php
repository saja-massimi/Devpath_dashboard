@extends('dashboard.index')

@section('content')


<div class="content-body">
    <div class="container-fluid">

        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Teacher's Courses</h4>
                    <p class="mb-0">DevPath dashboard</p>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item "><a href="{{ route('teacher.index')}}">Teachers</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)"> Teachers Courses</a></li>



                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{ $user->name }}'s Courses</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="display" style="min-width: 845px">
                                <thead>
                                    <tr>
                                        <th>Course Name</th>
                                        <th>Description</th>
                                        <th>Price</th>
                                        <th>Duration</th>
                                        <th>Image</th>
                                        <th>Difficulty Level</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($courses as $course)


                                    <tr>
                                        <td>{{ $course->course_title }}</td>
                                        <td>{{ $course->course_description }}</td>
                                        <td>{{ $course->course_price}}</td>
                                        <td>{{ $course->course_duration}} hours</td>
                                        <td><img src="{{ asset('dashboard_assets/images/product/'.$course->course_image) }}" alt="image" style="width: 100px; height: 100px;"></td>
                                        <td> {{$course->diffculty_leve}} </td>

                                    </tr>

                                    @endforeach
                                </tbody>
                            </table>
                            @if($courses->isEmpty())
                            <p>No courses enrolled yet.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection