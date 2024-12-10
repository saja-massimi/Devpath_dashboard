@extends('dashboard.index')

@section('content')



<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Hi {{Auth::user()->name}}, welcome back!</h4>
                    <p class="mb-0">DevPath dashboard</p>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Profile</a></li>
                </ol>
            </div>
        </div>
        <!-- row -->


        <div class="row">
            <div class="col-lg-12">
                <div class="profile">
                    <div class="profile-head">
                        <div class="photo-content">
                            <div class="cover-photo"></div>
                            <div class="profile-photo">
                                <img src="images/profile/profile.png" class="img-fluid rounded-circle" alt="">
                            </div>
                        </div>
                        <div class="profile-info">
                            <div class="row justify-content-center">
                                <div class="col-xl-12">
                                    <div class="row">
                                        <div class="col-xl-4 col-sm-4 border-right-1 prf-col">
                                            <div class="profile-name">
                                                <h4 class="text-primary">{{Auth::user()->name}}</h4>
                                                <p>{{Auth::user()->email}}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">

            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="profile-tab">
                            <div class="custom-tab-1">
                                <ul class="nav nav-tabs">
                                    <li class="nav-item"><a href="#profile-settings" data-toggle="tab" class="nav-link">Admin Settings</a>
                                    </li>
                                </ul>
                                <div class="tab-content">

                                    <div id="profile-settings">
                                        <div class="pt-3">
                                            <div class="settings-form">
                                                <form method="POST" action="{{ route('profile.update') }}">
                                                    @csrf
                                                    @method('PATCH')
                                                    <div class="form-row">
                                                        <div class="form-group col-md-6">
                                                            <label>Email</label>
                                                            <input type="email" id="email" name="email" disabled placeholder="Email" class="form-control" value="{{ $user->email }}">
                                                        </div>

                                                        <div class="form-group col-md-6">
                                                            <label>Enter Old Password</label>
                                                            <input type="password" name="old_pass" id="old_pass" placeholder="Old Password" class="form-control">

                                                            <label>New Password</label>
                                                            <input type="password" name="new_pass" id="new_pass" placeholder="New Password" class="form-control">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Address</label>
                                                        <input type="text" id="address" name="address" disabled placeholder="1234 Main St" class="form-control" value="{{ $user->address }}">
                                                    </div>

                                                    <button type="button" id="edit-btn" class="btn btn-primary">Edit</button>
                                                    <button type="submit" id="update-btn" class="btn btn-primary" disabled>Update</button>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if(session('success'))
<input type='hidden' id='text' value='{{   session('success') }}' />

<script>
    text = document.getElementById('text').value;

    Swal.fire({
        icon: 'success',
        title: 'Success!',
        text: text,
        confirmButtonText: 'OK'
    });
</script>
@endif

<script>
    document.getElementById('edit-btn').addEventListener('click', function() {
        document.getElementById('email').disabled = false;
        document.getElementById('address').disabled = false;
        document.getElementById('old_pass').disabled = false;
        document.getElementById('new_pass').disabled = false;

        document.getElementById('update-btn').disabled = false;

        this.style.display = 'none';



    });
</script>


@endsection