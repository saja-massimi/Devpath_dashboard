@extends('dashboard.index')

@section('content')

<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>All Teachers</h4>
                    <p class="mb-0">DevPath dashboard</p>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item "><a href="javascript:void(0)">Teachers</a></li>



                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Teachers</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="display" style="min-width: 845px">
                                <thead>
                                    <tr>
                                        <th>Teacher Name</th>
                                        <th>Teacher Email</th>
                                        <th>Teacher Phone Number</th>
                                        <th>Teacher Experience</th>
                                        <th>Teacher Course</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($teachers as $teacher)
                                    <tr>
                                        <td>
                                            <form method="POST" action="{{ route('teacher.update', $teacher->teacher_id) }}" id="user-form-{{ $teacher->teacher_id }}">
                                                @csrf
                                                @method('PATCH')
                                                <input type="text" name="name" class="form-control" value="{{ $teacher->name }}" disabled>
                                            </form>
                                        </td>

                                        <td>
                                            <form method="POST" action="{{ route('teacher.update', $teacher->teacher_id) }}" id="email-form-{{ $teacher->teacher_id }}">
                                                @csrf
                                                @method('PATCH')
                                                <input type="text" name="email" class="form-control" value="{{ $teacher->email }}" disabled>
                                            </form>
                                        </td>

                                        <td>
                                            <form method="POST" action="{{ route('teacher.update', $teacher->teacher_id) }}" id="phone-form-{{ $teacher->teacher_id }}">
                                                @csrf
                                                @method('PATCH')
                                                <input type="text" name="phone" class="form-control" value="{{ $teacher->phone }}" disabled>
                                            </form>
                                        </td>

                                        <td>
                                            <form method="POST" action="{{ route('teacher.update', $teacher->teacher_id) }}" id="experiene-form-{{ $teacher->teacher_id }}">
                                                @csrf
                                                @method('PATCH')

                                                
                                                <textarea name="experiene" class="form-control" disabled>{{ $teacher->experiene }}</textarea>
                                            </form>
                                        </td>

                                        <td>
                                            <a class="btn btn-primary" href="{{ route('teacher.teacher_courses', $teacher->teacher_id) }}">Courses</a>
                                        </td>

                                        <td>
                                            <button class="btn btn-primary edit-btn" data-user-id="{{ $teacher->teacher_id }}">Edit</button>
                                            <button class="btn btn-success update-btn d-none" data-user-id="{{ $teacher->teacher_id }}">Update</button>
                                            <button class="btn btn-danger cancel-btn d-none" data-user-id="{{ $teacher->teacher_id }}">Cancel</button>
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
        const editButtons = document.querySelectorAll('.edit-btn');
        const cancelButtons = document.querySelectorAll('.cancel-btn');
        const updateButtons = document.querySelectorAll('.update-btn');

        editButtons.forEach(button => {
            button.addEventListener('click', function() {
                const userId = button.getAttribute('data-user-id');

                const forms = document.querySelectorAll(`form[id^="user-form-${userId}"], form[id^="email-form-${userId}"], form[id^="phone-form-${userId}"], form[id^="experiene-form-${userId}"]`);
                forms.forEach(form => {
                    const inputs = form.querySelectorAll('input, select');
                    inputs.forEach(input => input.removeAttribute('disabled'));
                });

                button.classList.add('d-none');
                document.querySelector(`.update-btn[data-user-id="${userId}"]`).classList.remove('d-none');
                document.querySelector(`.cancel-btn[data-user-id="${userId}"]`).classList.remove('d-none');
            });
        });

        cancelButtons.forEach(button => {
            button.addEventListener('click', function() {
                const userId = button.getAttribute('data-user-id');

                const forms = document.querySelectorAll(`form[id^="user-form-${userId}"], form[id^="email-form-${userId}"], form[id^="phone-form-${userId}"], form[id^="experiene-form-${userId}"]`);
                forms.forEach(form => {
                    const inputs = form.querySelectorAll('input, select');
                    inputs.forEach(input => {
                        input.setAttribute('disabled', true);
                        input.value = input.defaultValue;
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

                const forms = document.querySelectorAll(`form[id^="user-form-${userId}"], form[id^="email-form-${userId}"], form[id^="phone-form-${userId}"], form[id^="experiene-form-${userId}"]`);
                const formData = new FormData();

                forms.forEach(form => {
                    const inputs = form.querySelectorAll('input, select');
                    inputs.forEach(input => {
                        formData.append(input.name, input.value);
                    });
                });

                fetch(`/dashboard/teacher/update/${userId}`, {
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
                            alert('Failed to update user.');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('An error occurred while updating user details.');
                    });
            });
        });
    });
</script>


@endsection