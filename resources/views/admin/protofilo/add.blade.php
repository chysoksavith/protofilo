@extends('admin.dashboard')
@section('admin_content')
    <div class="row">
        <div class="col-xl-9">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Add Project</h5>
                    <a href="{{ url('admin/project/list') }}" class="btn btn-primary">Back</a>
                </div>
                <div class="card-body">
                    <form id="project-form" action="{{ url('admin/project/add') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <!-- Other form fields -->
                        <div class="form-floating form-floating-outline mb-4">
                            <input type="text" class="form-control" placeholder="Name" name="name" id="name" />
                            <label for="name">Name Project</label>
                        </div>
                        <span style="color: red; font-size: 13px;">{{ $errors->first('name') }}</span>

                        <div class="form-floating form-floating-outline mb-4">
                            <input type="text" class="form-control" placeholder="project list" name="project_list"
                                id="project_list" />
                            <label for="project_list">project list </label>
                        </div>
                        <span style="color: red; font-size: 13px;">{{ $errors->first('project_list') }}</span>

                        <div class="form-floating form-floating-outline mb-4">
                            <input type="text" class="form-control" placeholder="project url" name="url_project"
                                id="url_project" />
                            <label for="url_project">project url </label>
                        </div>
                        <span style="color: red; font-size: 13px;">{{ $errors->first('url_project') }}</span>

                        <div class="form-floating form-floating-outline mb-4">
                            <textarea class="form-control h-px-100" name="description" placeholder="Comments here..." id="description"></textarea>
                            <label for="description">Description Project</label>
                        </div>
                        <span style="color: red; font-size: 13px;">{{ $errors->first('description') }}</span>

                        <div class="form-floating form-floating-outline mb-4">
                            <input type="number" class="form-control" placeholder="Year project" name="year"
                                id="year" />
                            <label for="year">Year Project</label>
                        </div>
                        <span style="color: red; font-size: 13px;">{{ $errors->first('year') }}</span>

                        <div class="form-floating form-floating-outline mb-4">
                            <input type="text" class="form-control" placeholder="Agency project" name="agency"
                                id="agency" />
                            <label for="agency">Agency Project</label>
                        </div>
                        <span style="color: red; font-size: 13px;">{{ $errors->first('agency') }}</span>

                        <div class="form-floating form-floating-outline mb-4">
                            <input type="text" class="form-control" placeholder="Role project" name="role"
                                id="role" />
                            <label for="role">Role Project</label>
                        </div>
                        <span style="color: red; font-size: 13px;">{{ $errors->first('role') }}</span>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>

                    <div id="message"></div>

                </div>
            </div>
        </div>

    </div>
@endsection
