@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <div class="content">

        <!-- Start Content-->
        <div class="container-xxl">
            <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                <div class="flex-grow-1">
                    <h4 class="fs-18 fw-semibold m-0">Add Clarify</h4>
                </div>

            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <div class="card-body">

                            <div class="tab-content text-muted bg-white">
                                 <div class="tab-pane active pt-4" id="profile_setting" role="tabpanel">
                                    <div class="row">

                                            <div class="row">
                                                    <div class="col-lg-6 col-xl-6">
                                                        <form action="{{ route('clarifies.store') }}" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                            <div class="card border mb-0">
                                                                <div class="card-body">
                                                                    <div class="form-group mb-3 row">
                                                                        <label class="form-label" for="title">Title</label>
                                                                        <div class="col-lg-12 col-xl-12">
                                                                            <input class="form-control  @error('title') is-invalid @enderror" type="text" name="title" id="title" value="{{ old('title') }}">
                                                                            @error('title')
                                                                                <small class="text-danger">{{ $message }}</small>
                                                                            @enderror
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group mb-3 row">
                                                                        <label class="form-label" for="description">Description</label>
                                                                        <div class="col-lg-12 col-xl-12">
                                                                            <textarea class="form-control" id="description" name="description">{{ old('description') }}</textarea>
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group mb-3 row">
                                                                        <label class="form-label" for="photo">Image</label>
                                                                        <div class="col-lg-12 col-xl-12">
                                                                            <input class="form-control" type="file" id="image" name="image">
                                                                        </div>
                                                                    </div>


                                                                    <div class="form-group mb-3 row">
                                                                        <label class="form-label"></label>
                                                                        <div class="col-lg-12 col-xl-12">
                                                                            <img id="showImage" src="{{ url('upload/no_image.jpg') }}" class="rounded-circle avatar-xxl img-thumbnail float-start" alt="image profile">
                                                                        </div>
                                                                    </div>

                                                                    <button type="submit" class="btn btn-primary">Save</button>
                                                                </div><!--end card-body-->
                                                            </div>
                                                        </form>
                                                    </div>
                                            </div>
                                        </form>
                                    </div>
                                </div> <!-- end education -->

                            </div> <!-- Tab panes -->
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- container-fluid -->
    </div>
    <!-- content -->

<script type="text/javascript">
    $(document).ready(function() {
        $('#image').change(function(e) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#showImage').attr('src', e.target.result)
            }
            reader.readAsDataURL(e.target.files[0]);
        })
    })
</script>
@endsection