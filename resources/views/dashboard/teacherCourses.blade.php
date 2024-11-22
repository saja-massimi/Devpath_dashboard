@extends('dashboard.index')

@section('content')


<div class="content-body">
    <div class="container-fluid">
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
                                        <td>{{ $course->course_description}}</td>
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