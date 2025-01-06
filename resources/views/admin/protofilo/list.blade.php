@extends('admin.dashboard')
@section('admin_content')
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Tables /</span> Project Tables</h4>
    <!-- Basic Bootstrap Table -->
    <div class="card">
        <div class="card-body d-flex align-items-center justify-content-between">
            <h5 class="card-header">Table Basic</h5>
            <a href="{{ url('admin/project/add') }}" class="btn btn-primary">Add Project</a>
        </div>
        @include('_message')
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name Project</th>
                        <th>Description</th>
                        <th>Year</th>
                        <th>Agency</th>
                        <th>Image</th>

                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($getRecord as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->description }}</td>
                            <td>{{ $item->year }}</td>
                            <td>{{ $item->agency }}</td>
                            <td>
                                <a href="{{ url('admin/project/' . $item->id . '/upload') }}" class="btn btn-info">Add
                                    Images</a>
                            </td>

                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown">
                                        <i class="mdi mdi-dots-vertical"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="javascript:void(0);"><i
                                                class="mdi mdi-pencil-outline me-1"></i> Edit</a>
                                        <form id="delete-form-{{ $item->id }}"
                                            action="{{ route('project.destroy', $item->id) }}" method="POST"
                                            style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>

                                        <a class="dropdown-item" href="#"
                                            onclick="event.preventDefault(); if(confirm('Are you sure you want to delete this item?')) document.getElementById('delete-form-{{ $item->id }}').submit();">
                                            <i class="mdi mdi-trash-can-outline me-1"></i> Delete
                                        </a>

                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
