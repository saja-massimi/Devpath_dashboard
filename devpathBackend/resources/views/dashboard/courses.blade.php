@extends('dashboard.index')

@section('content')


<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>All Courses</h4>
                    <p class="mb-0">DevPath dashboard</p>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Courses</a></li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">All Courses</h4>
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
                                        <th>Actions</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($courses as $course)
                                    <tr>

                                        <td>
                                            <form method="POST" action="{{ route('courses.update', $course->course_id) }}" id="course-form-{{ $course->course_id }}">
                                                @csrf
                                                @method('PATCH')
                                                <input type="text" name="course_title" class="form-control" value="{{ $course->course_title }}" disabled>
                                            </form>
                                        </td>

                                        <td>
                                            <form method="POST" action="{{ route('courses.update',$course->course_id)}}" id="description-form-{{ $course->course_id }}">
                                                @csrf
                                                @method('PATCH')
                                                <textarea class="form-control" name="course_description" disabled>{{ $course->course_description }}</textarea>

                                            </form>
                                        </td>

                                        <td>
                                            <form method="POST" action="{{ route('courses.update',$course->course_id)}}" id="price-form-{{ $course->course_id }}">
                                                @csrf
                                                @method('PATCH')
                                                <input type="text" name="course_price" class="form-control" value="{{ $course->course_price }}" disabled>
                                            </form>
                                        </td>

                                        <td>
                                            <form method="POST" action="{{ route('courses.update',$course->course_id)}}" id="duration-form-{{ $course->course_id }}">
                                                @csrf
                                                @method('PATCH')
                                                <input type="text" name="course_duration" class="form-control" value="{{ $course->course_duration }}" disabled>
                                            </form>
                                        </td>

                                        <td>
                                            <form method="POST" action="{{ route('courses.update', $course->course_id) }}" id="course-form-{{ $course->course_id }}" enctype="multipart/form-data">
                                                @csrf
                                                @method('PATCH')


                                                <img src="{{ asset('dashboard_assets/images/product/'.$course->course_image) }}"
                                                    alt="image"
                                                    style="width: 100px; height: 100px; cursor: pointer;"
                                                    id="image-preview-{{ $course->course_id }}">


                                                <input type="file"
                                                    name="course_image"
                                                    class="form-control d-none"
                                                    id="image-upload-{{ $course->course_id }}">
                                            </form>
                                        </td>



                                        <td>
                                            <form method="POST" action="{{ route('courses.update', $course->course_id) }}" id="difficulty-form-{{ $course->course_id }}">
                                                @csrf
                                                @method('PATCH')
                                                <select name="diffculty_leve" class="form-control" disabled>
                                                    <option value="beginner" {{ $course->diffculty_leve == 'beginner' ? 'selected' : '' }}>Beginner</option>
                                                    <option value="intermediate" {{ $course->diffculty_leve == 'intermediate' ? 'selected' : '' }}>Intermediate</option>
                                                    <option value="advanced" {{ $course->diffculty_leve == 'advanced' ? 'selected' : '' }}>Advanced</option>

                                                </select>
                                            </form>
                                        </td>


                                        <td>
                                            <button class="btn btn-primary edit-btn" data-user-id="{{ $course->course_id }}">Edit</button>

                                            <button class="btn btn-success update-btn d-none" data-user-id="{{ $course->course_id }}">Update</button>
                                            <button class="btn btn-danger cancel-btn d-none" data-user-id="{{ $course->course_id }}">Cancel</button>
                                        </td>

                                        <td>
                                            <form method="POST" action="{{ route('courses.destroy', $course->course_id) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger delete-btn" data-user-id="{{ $course->course_id }}">Delete</button>
                                            </form>

                                        </td>
                                    </tr>

                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const deleteButtons = document.querySelectorAll('.delete-btn');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function(event) {
                event.preventDefault();

                const userId = button.getAttribute('data-user-id');

                fetch(`/dashboard/courses/${userId}`, {
                        method: 'DELETE',
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        },
                    })
                    .then(response => {
                        console.log(response);
                        return response.json();
                    })
                    .then(data => {
                        console.log(data);
                        if (data.success) {
                            alert(data.message);
                            location.reload();
                        } else {
                            alert('Failed to delete course: ' + data.message);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('An error occurred while deleting the course.');
                    });
            });
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        const editButtons = document.querySelectorAll('.edit-btn');
        const cancelButtons = document.querySelectorAll('.cancel-btn');
        const updateButtons = document.querySelectorAll('.update-btn');

        // Track edit mode
        const isEditMode = {};

        editButtons.forEach(button => {
            button.addEventListener('click', function() {
                const userId = button.getAttribute('data-user-id');
                isEditMode[userId] = true; // Mark edit mode for this course

                const forms = document.querySelectorAll(`form[id^="course-form-${userId}"], 
            form[id^="description-form-${userId}"], form[id^="price-form-${userId}"],  
            form[id^="duration-form-${userId}"], 
            form[id^="image-form-${userId}"], form[id^="difficulty-form-${userId}"]`);

                forms.forEach(form => {
                    const inputs = form.querySelectorAll('input, select, textarea');
                    inputs.forEach(input => {
                        input.disabled = false;
                    });
                });

                button.classList.add('d-none');
                document.querySelector(`.update-btn[data-user-id="${userId}"]`).classList.remove('d-none');
                document.querySelector(`.cancel-btn[data-user-id="${userId}"]`).classList.remove('d-none');
            });
        });

        cancelButtons.forEach(button => {
            button.addEventListener('click', function() {
                const userId = button.getAttribute('data-user-id');
                isEditMode[userId] = false; // Exit edit mode

                const forms = document.querySelectorAll(`form[id^="course-form-${userId}"], 
            form[id^="description-form-${userId}"], form[id^="price-form-${userId}"],  
            form[id^="duration-form-${userId}"], 
            form[id^="image-form-${userId}"], form[id^="difficulty-form-${userId}"]`);

                forms.forEach(form => {
                    const inputs = form.querySelectorAll('input, select, textarea');
                    inputs.forEach(input => {
                        input.disabled = true;

                        if (input.tagName === 'INPUT' || input.tagName === 'TEXTAREA') {
                            input.value = input.defaultValue;
                        }

                        if (input.tagName === 'SELECT') {
                            input.value = Array.from(input.options).find(option => option.defaultSelected).value;
                        }
                    });
                });

                document.querySelector(`.edit-btn[data-user-id="${userId}"]`).classList.remove('d-none');
                button.classList.add('d-none');
                document.querySelector(`.update-btn[data-user-id="${userId}"]`).classList.add('d-none');
            });
        });

        updateButtons.forEach(button => {
            button.addEventListener('click', function() {
                const userId = button.getAttribute('data-user-id');
                isEditMode[userId] = false; // Exit edit mode

                const forms = document.querySelectorAll(`form[id^="course-form-${userId}"], 
            form[id^="description-form-${userId}"], form[id^="price-form-${userId}"],  
            form[id^="duration-form-${userId}"], 
            form[id^="image-form-${userId}"], form[id^="difficulty-form-${userId}"]`);

                const formData = new FormData();

                forms.forEach(form => {
                    const inputs = form.querySelectorAll('input, select, textarea');
                    inputs.forEach(input => {
                        if (input.type === 'file' && input.files.length > 0) {
                            formData.append(input.name, input.files[0]);
                        } else {
                            formData.append(input.name, input.value);
                        }
                    });
                });

                fetch(`/dashboard/courses/update/${userId}`, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        },
                    })
                    .then(response => response.json())
                    .then(data => {
                        console.log(data);
                        if (data.success) {
                            location.reload();
                        } else {
                            alert('Failed to update course.');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('An error occurred while updating user details.');
                    });
            });
        });

        // Image click logic
        const imagePreviews = document.querySelectorAll('img[id^="image-preview-"]');

        imagePreviews.forEach(preview => {
            preview.addEventListener('click', function() {
                const courseId = this.id.split('-').pop();
                if (isEditMode[courseId]) { // Only trigger if in edit mode
                    const fileInput = document.querySelector(`#image-upload-${courseId}`);
                    fileInput.click(); // Trigger the hidden file input
                }
            });
        });

        const fileInputs = document.querySelectorAll('input[type="file"][id^="image-upload-"]');

        fileInputs.forEach(fileInput => {
            fileInput.addEventListener('change', function() {
                const courseId = this.id.split('-').pop();
                const preview = document.querySelector(`#image-preview-${courseId}`);

                if (this.files && this.files[0]) {
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        preview.src = e.target.result; // Update image preview
                    };

                    reader.readAsDataURL(this.files[0]);
                }
            });
        });
    });
</script>
@endsection