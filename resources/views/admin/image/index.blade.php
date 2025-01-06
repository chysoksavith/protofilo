@extends('admin.dashboard')
@section('admin_content')
    <div class="row">
        <div class="col-xl-9">
            <div class="card mb-4">
                @include('_message')
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Add Project Image</h5>
                    <a href="{{ url('admin/project/list') }}" class="btn btn-primary">Back</a>
                </div>
                <div class="card-body">
                    <div class="mb-4">
                        <h6 class="mb-0">Project Name : {{ $project->name }}</h6>
                    </div>
                    <hr>
                    <form id="project-form" action="{{ url('admin/project/' . $project->id . '/upload') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <!-- Other form fields -->
                        <div class="form-floating form-floating-outline mb-4">
                            <input type="file" class="form-control" name="image[]" multiple accept="image/*" />
                            <label for="name">Add Multi Images</label>
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>

                    <div id="message"></div>

                </div>
            </div>
        </div>
        <div class="col-xl-9 mt-6">
            @foreach ($productImage as $images)
                <img src="{{ asset('storage/images/' . $images->image) }}" style="width: 150px; height: 150px;"
                    alt="">
                <a href="{{ url('admin/project/' . $images->id . '/delete') }}" class="btn btn-danger">Delete image</a>
            @endforeach
        </div>
    </div>
@endsection
