@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Edit Home Slide</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Edit Home Slide</li>
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

                        <form method="post" action="{{ route('store.profile') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="row mb-3">
                                <label for="title-input" class="col-sm-2 col-form-label">Title</label>
                                <div class="col-sm-10">
                                    <input name="title" class="form-control" type="text" value="{{ $homeslide->title }}"
                                        id="title">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="short-title-input" class="col-sm-2 col-form-label">Short Title</label>
                                <div class="col-sm-10">
                                    <input name="short_title" class="form-control" type="text"
                                        value="{{ $homeslide->short_title }}" id="short_title">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="video-url-input" class="col-sm-2 col-form-label">Video URL</label>
                                <div class="col-sm-10">
                                    <input name="video_url" class="form-control" type="text"
                                        value="{{ $homeslide->video_url }}" id="video_url">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="slider-image" class="col-sm-2 col-form-label">Slider Image</label>
                                <div class="col-sm-10">
                                    <input name="home_slide" class="form-control" type="file" id="image">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="profile-image" class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                    <img id="showImage" class="rounded avatar-lg"
                                        src="{{ !empty($homeslide->home_slide) ? url('upload/home_slide/'.$homeslide->home_slide) : url('upload/no_image.jpg') }}"
                                        alt="Card image cap">
                                </div>
                            </div>

                            <input type="submit" class="btn btn-info btn-rounded waves-effect waves-light"
                                value="Update Slide" />
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