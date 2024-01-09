@extends('layout.main')

@section('title', 'edit')

@section('content')
<div class="col-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $item)
                            <li>{{ $item }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <h4>Edit Data</h4>
            <hr>
            <form class="forms-sample" method="POST" action="/edit-save/{{ $project->project_id }}">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="project_id">Project ID</label>
                    <input type="text" class="form-control" id="project_id" value="{{ $project->project_id }}"
                        name="project_id" required>
                </div>
                <br>
                <div class="form-group">
                    <label for="project_name">Project Name</label>
                    <input type="text" class="form-control" value="{{ $project->project_name }}" id="project_name"
                        name="project_name" required>
                </div>
                <br>
                <div class="form-group">
                    <label for="client_id">Clietn ID</label>
                    <select name="client_id" id="client_id" class="form-control" require>
                        <option value="{{ $project->client->client_id}}">{{ $project->client->client_name}}</option>
                        @foreach ($client as $list )
                            <option value="{{ $list->client_id }}">{{ $list->client_name }}</option>
                        @endforeach
                    </select>
                    </div>
                    <br>
                <div class="form-group">
                    <label for="project_start">Project Start</label>
                    <input type="date" class="form-control" id="project_start" value="{{ $project->project_start }}"  name="project_start"
                        required>
                </div>
                <br>
                <div class="form-group">
                    <label for="project_end">Project End</label>
                    <input type="date" class="form-control" id="project_end" value="{{ $project->project_end }}" name="project_end"
                        required>
                </div>
                <br>
                <div class="form-goup">
                    <label for="project_status">Project Status</label>
                        <select name="project_status" id="project_status" class="form-control" require>
                            <option value="{{ $project->project_status }}">{{ $project->peoject_status }}</option>
                        </select>
                    </select>
                    </div>
                    <br>
                <button type="submit" class="btn btn-primary me-2">Edit</button>
                <a href="/project" class="btn btn-light">Kembali</a>
            </form>
        </div>
    </div>
</div>
@endsection
