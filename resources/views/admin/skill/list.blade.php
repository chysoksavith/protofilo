@extends('admin.dashboard')
@section('admin_content')
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Tables /</span> Skill Tables</h4>
    <!-- Basic Bootstrap Table -->
    <div class="card">
        <div class="card-body d-flex align-items-center justify-content-between">
            <h5 class="card-header">Table Skill</h5>
            <a href="{{ url('admin/skill/add') }}" class="btn btn-primary">Add Skill</a>
        </div>
        @include('_message')
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($getRecord as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->cate }}</td>
                            <td>
                                @if ($item->status == 1)
                                    <span>active</span>
                                    @else
                                    <span>inactive</span>
                                @endif
                            </td>

                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown">
                                        <i class="mdi mdi-dots-vertical"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{ url('admin/skill/edit/' . $item->id) }}"><i
                                                class="mdi mdi-pencil-outline me-1"></i> Edit</a>

                                        <form id="delete-form-{{ $item->id }}"
                                            action="{{ route('skill.destroy', $item->id) }}" method="POST"
                                            style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>

                                        <!-- Delete Link with Confirmation -->
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
