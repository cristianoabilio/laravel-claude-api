@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <div class="content">

        <!-- Start Content-->
        <div class="container-xxl">
            <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                <div class="flex-grow-1">
                    <h4 class="fs-18 fw-semibold m-0">Blog Categories</h4>
                </div>

                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#standard-modal">
                    Add Blog Category
                </button>
            </div>

        <div class="row">
            <div class="col-12">
                <div class="card">

                    <div class="card-body">
                        <div id="datatable_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                            <div class="row"><div class="col-sm-12 col-md-6">
                                <div class="dataTables_length" id="datatable_length">
                                    <label class="form-label">Show <select name="datatable_length" aria-controls="datatable" class="form-select form-select-sm">
                                        <option value="10">10</option><option value="25">25</option><option value="50">50</option>
                                        <option value="100">100</option></select> entries</label></div></div><div class="col-sm-12 col-md-6">
                                            <div id="datatable_filter" class="dataTables_filter">
                                                <label>Search:<input type="search" class="form-control form-control-sm" placeholder="" aria-controls="datatable"></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row"><div class="col-sm-12">
                                        <table id="datatable" class="table table-bordered dt-responsive table-responsive nowrap dataTable no-footer dtr-inline collapsed" aria-describedby="datatable_info" style="width: 1263px;">
                                            <thead>
                                            <tr>
                                                <th class="sorting sorting_asc" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 195px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">Sl</th>
                                                <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 345px;" aria-label="Position: activate to sort column ascending">Name</th>
                                                <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 170px;" aria-label="Office: activate to sort column ascending">Slug</th>
                                                <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 102px;" aria-label="Salary: activate to sort column ascending">Actions</th></tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($categories as $item)
                                                    <tr class="odd">
                                                        <td class="">{{ $item->id }}</td>
                                                        <td>{{ $item->name }}</td>
                                                        <td>{{ $item->slug }}</td>
                                                        <td>
                                                            <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#category-modal" id="{{  $item->id }}" onclick="categoryEdit({{ $item->id }})">
                                                                Edit
                                                            </button>
                                                            <a href="{{ route('review.delete', $item->id) }}" id="delete" class="btn btn-danger">Delete</a>
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
    </div>

<!-- Default Modal -->
<div class="modal fade" id="standard-modal" tabindex="-1" aria-labelledby="standard-modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="standard-modalLabel">Blog Category</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('blog-category.store') }}" method="POST">
                    @csrf
                    <div class="form-group col-md-12">
                        <label for="input1" class="form-label">Blog Category Name</label>
                        <input type="text" name="name" id="input1" class="form-control">
                    </div>
                                    <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
                </div>
                </form>
        </div>
    </div>
</div>


<!-- Category Modal -->
<div class="modal fade" id="category-modal" tabindex="-1" aria-labelledby="category-modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="category-modalLabel">Edit Blog Category</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('blog-category.update') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" id="id" value="">
                    <div class="form-group col-md-12">
                        <label for="category_name" class="form-label">Blog Category Name</label>
                        <input type="text" name="name" id="category_name" class="form-control">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

    function categoryEdit(id) {
        let url = '/admin/blog-category/edit/' + id;

        $.ajax({
            type: 'GET',
            url: url,
            dataType: 'json',

            success: function(data) {
                // console.log(data);
                $('#id').val(data.id);
                $('#category_name').val(data.name);
            }
        })
    }
</script>


@endsection