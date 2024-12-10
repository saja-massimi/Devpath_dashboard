@extends('dashboard.index')

@section('content')


<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>All Categories</h4>
                    <p class="mb-0">DevPath dashboard</p>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Categories</a></li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">All Categories</h4>
                    </div>
                    <div class="card-body">

                        <div class="d-flex justify-content-end mb-3">
                            <a href="{{ route('categories.create') }}" class="btn btn-primary">Add Category</a>
                        </div>
                        <div class="table-responsive">
                            <table id="example" class="display" style="min-width: 845px">
                                <thead>
                                    <tr>
                                        <th>Category Name</th>
                                        <th>Creation Date</th>
                                        <th>Actions</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $category)
                                    <tr>

                                        <td>
                                            <form method="POST" action="{{ route('categories.update', $category->category_id) }}" id="category-form-{{  $category->category_id }}">
                                                @csrf
                                                @method('PATCH')
                                                <input type="text" name="category_name" class="form-control" value="{{  $category->category_name }}" disabled>
                                            </form>
                                        </td>

                                        <td>
                                            <form method="POST" action="{{ route('categories.update', $category->category_id) }}" id="date-form-{{ $category->category_id }}">
                                                @csrf
                                                @method('PATCH')
                                                <input type="date" class="form-control" name="created_at" value="{{ $category->created_at->format('Y-m-d') }}" disabled>
                                            </form>
                                        </td>


                                        <td>
                                            <button class="btn btn-primary edit-btn" data-user-id="{{  $category->category_id }}">Edit</button>

                                            <button class="btn btn-primary update-btn d-none" data-user-id="{{  $category->category_id }}">Update</button>
                                            <button class="btn btn-danger cancel-btn d-none" data-user-id="{{ $category->category_id }}">
                                                <span class="ti-close"></span>
                                            </button>
                                        </td>

                                        <td>
                                            <form method="POST" action="{{ route('categories.destroy',  $category->category_id) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger delete-btn" data-user-id="{{  $category->category_id }}">Delete</button>
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
                const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
                console.log("hi");
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'This category will be deleted',
                    showCancelButton: true,
                    confirmButtonText: 'Ok',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    console.log(result.isConfirmed);

                    if (result.value) {
                        fetch(`/dashboard/categories/${userId}`, {
                                method: 'DELETE',
                                headers: {
                                    'X-Requested-With': 'XMLHttpRequest',
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                                },
                            })
                            .then(response => response.json())
                            .then(data => {
                                console.log(data);
                                if (data.success) {
                                    Swal.fire('Deleted!', data.message, 'success', 2000);
                                    setTimeout(() => {
                                        location.reload();
                                    }, 2000);
                                } else {
                                    Swal.fire('Error!', 'Failed to delete category: ' + data.message, 'error');
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                Swal.fire('Error!', 'An error occurred while deleting the category.', 'error');
                            });
                    }
                });
            });
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        const editButtons = document.querySelectorAll('.edit-btn');
        const cancelButtons = document.querySelectorAll('.cancel-btn');
        const updateButtons = document.querySelectorAll('.update-btn');

        const isEditMode = {};

        editButtons.forEach(button => {
            button.addEventListener('click', function() {
                const userId = button.getAttribute('data-user-id');
                isEditMode[userId] = true;

                const forms = document.querySelectorAll(`form[id^="category-form-${userId}"]
           `);


                forms.forEach(form => {
                    const inputs = form.querySelectorAll('input');
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
                isEditMode[userId] = false;

                const forms = document.querySelectorAll(`form[id^="category-form-${userId}"], 
            form[id^="date-form-${userId}"]`);

                forms.forEach(form => {
                    const inputs = form.querySelectorAll('input, select, textarea');
                    inputs.forEach(input => {
                        input.disabled = true;

                        if (input.tagName === 'INPUT' || input.tagName === 'TEXTAREA') {
                            input.value = input.defaultValue;
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
                isEditMode[userId] = false;
                const forms = document.querySelectorAll(`form[id^="category-form-${userId}"], 
            form[id^="date-form-${userId}"]`);


                const formData = new FormData();

                forms.forEach(form => {
                    const inputs = form.querySelectorAll('input');
                    inputs.forEach(input => {
                        formData.append(input.name, input.value);

                    });
                });

                fetch(`/dashboard/categories/update/${userId}`, {
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
                            alert('Failed to update category.');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('An error occurred while updating category.');
                    });
            });
        });


    });
</script>
@endsection