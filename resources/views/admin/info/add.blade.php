@extends('admin.dashboard')
@section('admin_content')
    <div class="row">
        <div class="col-xl-9">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Add Infomation</h5>
                    <a href="{{ url('admin/info/list') }}" class="btn btn-primary">Back</a>
                </div>
                <div class="card-body">
                    <form id="project-form" action="{{ url('admin/info/add') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <!-- Other form fields -->
                        <div class="form-floating form-floating-outline mb-4">
                            <input type="text" class="form-control" placeholder="Name" name="name" id="name" />
                            <label for="name">Name </label>
                        </div>
                        <span style="color: red; font-size: 13px;">{{ $errors->first('name') }}</span>

                        <div class="form-floating form-floating-outline mb-4">
                            <textarea class="form-control h-px-100" name="description" placeholder="Comments here..." id="description"></textarea>
                            <label for="description">Description </label>
                        </div>
                        <span style="color: red; font-size: 13px;">{{ $errors->first('description') }}</span>

                        <div class="form-floating form-floating-outline mb-4">
                            <input type="file" class="form-control" name="image" id="image" />
                            <label for="image">Image</label>
                        </div>
                        <span style="color: red; font-size: 13px;">{{ $errors->first('name') }}</span>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>

                    <div id="message"></div>

                </div>
            </div>
        </div>

    </div>
@endsection
