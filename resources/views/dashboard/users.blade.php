@extends('dashboard.index')
@section('content')

<div class="content-body">
    <div class="container-fluid">

        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>All Users</h4>
                    <p class="mb-0">DevPath dashboard</p>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item "><a href="javascript:void(0)">Users</a></li>




                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Users' Details</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="display" style="min-width: 845px">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Address</th>
                                        <th>Enrolled Courses</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                    <tr>
                                        <td>
                                            <form method="POST" action="{{ route('customer.update', $user->id) }}" id="user-form-{{ $user->id }}">
                                                @csrf
                                                @method('PATCH')
                                                <input type="text" name="name" class="form-control" value="{{ $user->name }}" disabled>
                                            </form>
                                        </td>
                                        <td>
                                            <form method="POST" action="{{ route('customer.update', $user->id) }}" id="email-form-{{ $user->id }}">
                                                @csrf
                                                @method('PATCH')
                                                <input type="email" name="email" class="form-control" value="{{ $user->email }}" disabled>
                                            </form>
                                        </td>


                                        <td>
                                            <form method="POST" action="{{ route('customer.update', $user->id) }}" id="role-form-{{ $user->id }}">
                                                @csrf
                                                @method('PATCH')
                                                <select name="role" class="form-control" disabled>
                                                    <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                                                    <option value="student" {{ $user->role === 'student' ? 'selected' : '' }}>Student</option>
                                                </select>
                                            </form>
                                        </td>
                                        <td>
                                            <form method="POST" action="{{ route('customer.update', $user->id) }}" id="address-form-{{ $user->id }}">
                                                @csrf
                                                @method('PATCH')
                                                <input type="text" name="address" class="form-control" value="{{ $user->address }}" disabled>
                                            </form>
                                        </td>
                                        <td>
                                            <a class="btn btn-primary" href="{{route('customer.user_courses', $user->id )}}">Courses</a>

                                        </td>
                                        <td>
                                            <button class="btn btn-primary edit-btn" data-user-id="{{ $user->id }}">Edit</button>
                                            <button class="btn btn-success update-btn d-none" data-user-id="{{ $user->id }}">Update</button>
                                            <button class="btn btn-danger cancel-btn d-none" data-user-id="{{ $user->id }}">Cancel</button>
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

                const forms = document.querySelectorAll(`form[id^="user-form-${userId}"], form[id^="email-form-${userId}"], form[id^="role-form-${userId}"], form[id^="address-form-${userId}"]`);
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

                const forms = document.querySelectorAll(`form[id^="user-form-${userId}"], form[id^="email-form-${userId}"], form[id^="role-form-${userId}"], form[id^="address-form-${userId}"]`);
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

                const forms = document.querySelectorAll(`form[id^="user-form-${userId}"], form[id^="email-form-${userId}"], form[id^="role-form-${userId}"], form[id^="address-form-${userId}"]`);
                const formData = new FormData();

                forms.forEach(form => {
                    const inputs = form.querySelectorAll('input, select');
                    inputs.forEach(input => {
                        formData.append(input.name, input.value);
                    });
                });

                fetch(`/dashboard/customer/update/${userId}`, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        },
                    })
                    .then(response => response.json())
                    .then(data => {
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