@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Edit Image</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Edit Image</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title">Details</h4>

                        <form method="post" action="{{ route('update.multi.image') }}" enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" name="id" value="{{ $multiImages->id }}" />

                            <div class="row mb-3">
                                <label for="multi-image" class="col-sm-2 col-form-label">Edit Image</label>
                                <div class="col-sm-10">
                                    <input name="multi_image" class="form-control" type="file" id="image" multiple="">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="profile-image" class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                    <img id="showImage" class="rounded avatar-lg"
                                        src="{{ asset($multiImages->multi_image) }}" alt="Card image cap">
                                </div>
                            </div>

                            <input type="submit" class="btn btn-info btn-rounded waves-effect waves-light"
                                value="Update Image" />
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
$(document).ready(function() {
    $('#image').change(function(e) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#showImage').attr('src', e.target.result);
        }
        reader.readAsDataURL(e.target.files['0']);
    });
});
</script>

@endsection