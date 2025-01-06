@extends('admin.dashboard')
@section('admin_content')
    <div class="row">
        <div class="col-xl-9">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Add Footer</h5>
                    <a href="{{ url('admin/footer/list') }}" class="btn btn-primary">Back</a>
                </div>
                <div class="card-body">
                    <form action="{{ url('admin/footer/add') }}" method="POST">
                        @csrf
                        <!-- Other form fields -->
                        <div class="form-floating form-floating-outline mb-4">
                            <input type="text" class="form-control" placeholder="Name" name="name" id="name" />
                            <label for="name">Name</label>
                        </div>
                        <span style="color: red; font-size: 13px;">{{ $errors->first('name') }}</span>

                        <div class="form-floating form-floating-outline mb-4">
                            <input type="text" class="form-control" placeholder="URL" name="url" id="url" />
                            <label for="url">URL</label>
                        </div>
                        <span style="color: red; font-size: 13px;">{{ $errors->first('url') }}</span>

                        <div class="form-floating form-floating-outline mb-4">
                            <select class="form-select" name="status" aria-label="Default select example">
                                <option value="" selected>Select status</option>
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                            <label for="status">Status</label>
                        </div>
                        <span style="color: red; font-size: 13px;">{{ $errors->first('status') }}</span>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>

                    <div id="message"></div>
                </div>

            </div>
        </div>

    </div>
@endsection
