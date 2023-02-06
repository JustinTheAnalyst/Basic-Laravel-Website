@extends('admin.admin_master')
@section('admin')

<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Profile</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                            <li class="breadcrumb-item active">Profile</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div style="padding-top:50px;">
                        <center>
                            <img class="rounded-circle avatar-xl"
                                src="{{ !empty($adminData->profile_image) ? url('upload/admin_images/'.$adminData->profile_image) : url('upload/no_image.jpg') }}"
                                alt="Card image cap">
                        </center>
                    </div>
                    <div class="card-body">
                        <h4 class="card-title">Name : {{ $adminData->name }}</h4>
                        <hr>
                        <h4 class="card-title">User Email : {{ $adminData->email }}</h4>
                        <hr>
                        <h4 class="card-title">Username : {{ $adminData->username }}</h4>
                        <hr>
                        <a href="{{ route('edit.profile') }}"
                            class="btn btn-info btn-rounded waves-effect waves-light">Edit
                            Profile</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection