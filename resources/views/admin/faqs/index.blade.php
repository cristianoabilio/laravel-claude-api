@extends('admin.admin_master')
@section('admin')

    <div class="content">

        <!-- Start Content-->
        <div class="container-xxl">
            <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                <div class="flex-grow-1">
                    <h4 class="fs-18 fw-semibold m-0">FAQs</h4>
                </div>
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
                                                <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 345px;" aria-label="Position: activate to sort column ascending">Title</th>
                                                <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 143px;" aria-label="Start date: activate to sort column ascending">Description</th>
                                                <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 102px;" aria-label="Salary: activate to sort column ascending">Actions</th></tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($faqs as $item)
                                                    <tr class="odd">
                                                        <td class="">{{ $item->id }}</td>
                                                        <td>{{ $item->title }}</td>
                                                        <td>{{ Str::limit($item->description, 50, '...') }}</td>
                                                        <td>
                                                            <a href="{{ route('faqs.edit', $item->id) }}" class="btn btn-success">Edit</a>
                                                            <a href="{{ route('faqs.destroy', $item->id) }}" id="delete" class="btn btn-danger">Delete</a>
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
@endsection