@extends('dashboard.index')

@section('content')


<div class="content-body">
    <div class="container-fluid">

        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>All Transactions</h4>
                    <p class="mb-0">DevPath dashboard</p>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item "><a href="javascript:void(0)">Transactions</a></li>



                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">All Transactions</h4>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-end mb-3">
                            <a href="{{ route('transactions.create') }}" class="btn btn-primary">Add Transaction</a>
                        </div>

                        <div class="table-responsive">
                            <table id="example" class="display" style="min-width: 845px">
                                <thead>
                                    <tr>
                                        <th>User Name</th>
                                        <th>Course Name</th>
                                        <th>Transaction Type</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                        <th>Transaction Date</th>
                                        <th>Actions</th>
                                        <th>Delete</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($transactions as $transaction)
                                    <tr>

                                        <td>
                                            <form method="POST" action="{{ route('transactions.update', $transaction->transaction_id) }}" id="user-form-{{$transaction->transaction_id }}">
                                                @csrf
                                                @method('PATCH')
                                                <input type="text" name="user_name" class="form-control" value="{{$transaction->user_name }}" disabled>
                                            </form>
                                        </td>

                                        <td>
                                            <form method="POST" action="{{ route('transactions.update', $transaction->transaction_id) }}" id="course-form-{{$transaction->transaction_id }}">
                                                @csrf
                                                @method('PATCH')
                                                <input type="text" name="course_title" class="form-control" value="{{ $transaction->course_name }}" disabled>

                                            </form>
                                        </td>

                                        <td>
                                            <form method="POST" action="{{ route('transactions.update', $transaction->transaction_id) }}" id="type-form-{{$transaction->transaction_id }}">
                                                @csrf
                                                @method('PATCH')
                                                <input type="text" name="type" class="form-control" value="{{$transaction->type }}" disabled>
                                            </form>
                                        </td>

                                        <td>
                                            <form method="POST" action="{{ route('transactions.update', $transaction->transaction_id) }}" id="amount-form-{{$transaction->transaction_id }}">
                                                @csrf
                                                @method('PATCH')
                                                <input type="text" name="amount" class="form-control" value="{{ $transaction->amount }}" disabled>
                                            </form>
                                        </td>

                                        <td>
                                            <form method="POST" action="{{ route('transactions.update', $transaction->transaction_id) }}" id="status-form-{{$transaction->transaction_id }}">
                                                @csrf
                                                @method('PATCH')
                                                <input type="text" name="payment_status" class="form-control" value="{{ $transaction->payment_status }}" disabled>
                                            </form>
                                        </td>

                                        <td>
                                            <form method="POST" action="{{ route('transactions.update', $transaction->transaction_id) }}" id="date-form-{{$transaction->transaction_id }}">
                                                @csrf
                                                @method('PATCH')
                                                <input type="date" name="date" class="form-control"
                                                    value="{{ \Carbon\Carbon::parse($transaction->created_at)->format('Y-m-d') }}" disabled>
                                            </form>
                                        </td>


                                        <td>
                                            <button class="btn btn-primary edit-btn" data-user-id="{{ $transaction->transaction_id }}">Edit</button>

                                            <button class="btn btn-success update-btn d-none" data-user-id="{{ $transaction->transaction_id }}">Update</button>
                                            <button class="btn btn-danger cancel-btn d-none" data-user-id="{{ $transaction->transaction_id}}">Cancel</button>
                                        </td>

                                        <td>
                                            <form method="POST" action="{{ route('transactions.destroy', $transaction->transaction_id) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger delete-btn" data-user-id="{{$transaction->transaction_id}}">Delete</button>
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
                    text: 'This transaction will be deleted',
                    showCancelButton: true,
                    confirmButtonText: 'Ok',
                    cancelButtonText: 'Cancel'
                }).then((result) => {

                    if (result.value) {
                        fetch(`/dashboard/transactions/${userId}`, {
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
                                    Swal.fire('Error!', 'Failed to delete transaction: ' + data.message, 'error');
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                Swal.fire('Error!', 'An error occurred while deleting the transaction.', 'error');
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

                const forms = document.querySelectorAll(
                    `form[id^="user-form-${userId}"], 
            form[id^="course-form-${userId}"], 
            form[id^="type-form-${userId}"],  
            form[id^="amount-form-${userId}"], 
            form[id^="status-form-${userId}"],
             form[id^="date-form-${userId}"]`);

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
                isEditMode[userId] = false;

                const forms = document.querySelectorAll(
                    `form[id^="user-form-${userId}"], 
            form[id^="course-form-${userId}"], 
            form[id^="type-form-${userId}"],  
            form[id^="amount-form-${userId}"], 
            form[id^="status-form-${userId}"],
             form[id^="date-form-${userId}"]`);

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
                isEditMode[userId] = false;

                const forms = document.querySelectorAll(
                    `form[id^="user-form-${userId}"], 
            form[id^="course-form-${userId}"], 
            form[id^="type-form-${userId}"],  
            form[id^="amount-form-${userId}"], 
            form[id^="status-form-${userId}"],
             form[id^="date-form-${userId}"]`);


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

                fetch(`/dashboard/transactions/update/${userId}`, {
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
                            alert('Failed to update transaction.');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('An error occurred while updating transaction.');
                    });
            });
        });

    });
</script>
@endsection