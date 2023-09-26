@extends('layouts.admin')
@section('title','update-settings')
@push('css')
@endpush
@section('contents')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Update Profile & Settings</h4>
                <ul class="nav nav-tabs mb-3" role="tablist">
                    <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#profile8"><span><i
                                    class="ti-user"></i> update profile</span></a>
                    </li>
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#messages8"><span>
                                <i class="ti-user"></i> Update Password</span></a>
                    </li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content tabcontent-border">
                    <div class="tab-pane fade active show" id="profile8" role="tabpanel">
                        <div class="p-t-15">
                            <div class="card">
                                <div class="card-body">
                                    <div class="basic-form">
                                        <form method="post" action="{{url('admin/settings/update')}}"
                                            enctype="multipart/form-data">
                                            @method('put')
                                            @csrf
                                            <div class="form-group">
                                                <label for="name" class="mb-0">Name :</label>
                                                <input type="text" class="form-control border-bottom" name="name"
                                                    value="{{Auth::user()->name}}">

                                                @if ($errors->has('name'))
                                                <span class="invalid-feedback mb-0" role="alert">
                                                    <strong>{{ $errors->first('name') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <label for="email" class="mb-0">Email Address :</label>
                                                <input type="email" class="form-control border-bottom" name="email"
                                                    value="{{Auth::user()->email}}">
                                                @if ($errors->has('email'))
                                                <span class="invalid-feedback mb-0" role="alert">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                            <div class="form-group" class="mb-0">
                                                <label for="email">Profile Picture :</label>
                                                <input type="file" class="form-control border-bottom" name="profile">
                                                @if ($errors->has('profile'))
                                                <span class="invalid-feedback mb-0" role="alert">
                                                    <strong>{{ $errors->first('profile') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                            <div class="form-group" class="mb-0">
                                                <label for="email">About :</label>
                                                <textarea class="form-control border-bottom" name="about"></textarea>
                                                @if ($errors->has('about'))
                                                <span class="invalid-feedback mb-0" role="alert">
                                                    <strong>{{ $errors->first('about') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                            <button type="submit" class="btn btn-primary mt-3">Update Now</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="messages8" role="tabpanel">
                        <div class="p-t-15">
                            <div class="card">
                                <div class="card-body">
                                    <div class="basic-form">
                                        <form method="post" action="{{url('admin/password/update')}}">
                                            @method('put')
                                            @csrf
                                            <div class="form-group position-relative">
                                                <label for="password" class="mb-0">Old Password :</label>
                                                <input type="password" id="togglePassword"
                                                    class="form-control border-bottom" name="oldPassword">
                                                <div class="show-icon" onclick="myFunction()">
                                                    <i class="fa-regular fa-eye" id="showIcon"></i>
                                                    <i class="fa-regular fa-eye-slash" id="hideIcon"></i>
                                                </div>
                                                @if ($errors->has('oldPassword'))
                                                <span class="invalid-feedback mb-0" role="alert">
                                                    <strong>{{ $errors->first('oldPassword') }}</strong>
                                                </span>
                                                @endif
                                            </div>

                                            <div class="form-group position-relative">
                                                <label for="password" class="mb-0">New Password :</label>
                                                <input type="password" id="togglePassword2"
                                                    class="form-control border-bottom" name="password">
                                                <div class="show-icon" onclick="myFunction2()">
                                                    <i class="fa-regular fa-eye" id="showIcon2"></i>
                                                    <i class="fa-regular fa-eye-slash" id="hideIcon2"></i>
                                                </div>
                                                @if ($errors->has('password'))
                                                <span class="invalid-feedback mb-0" role="alert">
                                                    <strong>{{ $errors->first('password') }}</strong>
                                                </span>
                                                @endif
                                            </div>

                                            <div class="form-group position-relative">
                                                <label for="password" class="mb-0">Confirm Password :</label>
                                                <input type="password" id="togglePassword3"
                                                    class="form-control border-bottom" name="password_confirmation">
                                                <div class="show-icon" onclick="myFunction3()">
                                                    <i class="fa-regular fa-eye" id="showIcon3"></i>
                                                    <i class="fa-regular fa-eye-slash" id="hideIcon3"></i>
                                                </div>
                                                @if ($errors->has('password_confirmation'))
                                                <span class="invalid-feedback mb-0" role="alert">
                                                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                                                </span>
                                                @endif
                                            </div>

                                            <button type="submit" class="btn btn-primary mt-3">Update Now</button>
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

@push('js')
<script>
    const showIcon = document.getElementById("showIcon");
    const hideIcon = document.getElementById("hideIcon");
    const togglePassword = document.getElementById("togglePassword");
    hideIcon.style.display = "none";

    function myFunction() {
        if (togglePassword.type === "password") {
            togglePassword.type = "text";
            showIcon.style.display = "none";
            hideIcon.style.display = "inline-block";
            hideIcon.style.marginRight = "-1px";

        } else {
            togglePassword.type = "password";
            showIcon.style.display = "inline-block";
            hideIcon.style.display = "none";

        }
    }

    
    const showIcon2 = document.getElementById("showIcon2");
    const hideIcon2 = document.getElementById("hideIcon2");
    const togglePassword2 = document.getElementById("togglePassword2");
    hideIcon2.style.display = "none";

    function myFunction2() {
        if (togglePassword2.type === "password") {
            togglePassword2.type = "text";
            showIcon2.style.display = "none";
            hideIcon2.style.display = "inline-block";
            hideIcon2.style.marginRight = "-1px";

        } else {
            togglePassword2.type = "password";
            showIcon2.style.display = "inline-block";
            hideIcon2.style.display = "none";

        }
    }

    const showIcon3 = document.getElementById("showIcon3");
    const hideIcon3 = document.getElementById("hideIcon3");
    const togglePassword3 = document.getElementById("togglePassword3");
    hideIcon3.style.display = "none";

    function myFunction3() {
        if (togglePassword3.type === "password") {
            togglePassword3.type = "text";
            showIcon3.style.display = "none";
            hideIcon3.style.display = "inline-block";
            hideIcon3.style.marginRight = "-1px";

        } else {
            togglePassword3.type = "password";
            showIcon3.style.display = "inline-block";
            hideIcon3.style.display = "none";

        }
    }
</script>
@endpush
@endsection
