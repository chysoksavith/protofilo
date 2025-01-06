@extends('admin.dashboard')
@section('admin_content')
    <div class="row">
        <div class="col-xl-9">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Edit Infomation</h5>
                    <a href="{{ url('admin/certificate/list') }}" class="btn btn-primary">Back</a>
                </div>
                <div class="card-body">
                    <form id="project-form" action="{{ url('admin/certificate/edit/' . $getSingle->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <!-- Other form fields -->
                        <div class="form-floating form-floating-outline mb-4">
                            <input type="text" class="form-control" placeholder="Name" name="name" id="name"
                                value="{{ $getSingle->name }}" />
                            <label for="name">Name </label>
                        </div>
                        <span style="color: red; font-size: 13px;">{{ $errors->first('name') }}</span>




                        <div class="form-floating form-floating-outline mb-4">
                            <input type="file" class="form-control" name="image" id="image" />
                            <label for="image">Image</label>
                        </div>
                        <span style="color: red; font-size: 13px;">{{ $errors->first('name') }}</span>
                        <div class="mb-4">
                            <img src="{{ asset('storage/'. $getSingle->image) }}" style="width: 150px; height: 150px" alt="">
                        </div>
                        <div class="form-floating form-floating-outline mb-4">
                            <select class="form-select" name="status" aria-label="Default select example">
                                <option value="" selected>Select status</option>
                                <option value="1" {{ $getSingle->status == 1 ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ $getSingle->status == 0 ? 'selected' : '' }}>Inactive</option>
                            </select>
                            <label for="status">Status</label>
                        </div>
                        <span style="color: red; font-size: 13px;">{{ $errors->first('status') }}</span>

                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>

                    <div id="message"></div>

                </div>
            </div>
        </div>

    </div>
@endsection
