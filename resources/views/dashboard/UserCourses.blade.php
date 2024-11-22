@extends('dashboard.index')

@section('content')


<div class="content-body">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{ $user->name }}'s Enrolled Courses</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="display" style="min-width: 845px">
                                <thead>
                                    <tr>
                                        <th>Course Name</th>
                                        <th>Description</th>
                                        <th>Price</th>
                                        <th>Enrollment Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($courses as $course)


                                    <tr>
                                        <td>{{ $course->course_title }}</td>
                                        <td>{{ $course->course_description }}</td>
                                        <td>{{ $course->course_price}}</td>
                                        <td>{{ date('Y-m-d', strtotime($course->enrolled_at)) }}</td>

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