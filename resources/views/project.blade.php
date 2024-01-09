@extends('layout.main')

@section('title', 'data')
@section('content')


    <h4>PROJECT</h4>
    <br>
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <b>Filter</b> &nbsp;
                Project Name
                <input type="text" name="name" class="type">&nbsp; &nbsp;
                Client <select class="select">
                    <option value="1">All</option>
                    <option value="2">NEC</option>
                    <option value="3">TAM</option>
                    <option value="4">TUA</option>
                </select>&nbsp; &nbsp;
                Status <select class="select">
                    <option value="1">All</option>
                    <option value="2">OPEN</option>
                    <option value="3">DOING</option>
                    <option value="4">DONE</option>
                </select>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                <form method="get" action="/search">
                    <button type="submit" class="btn gray btn-secondary">Search</button>
                </form>
                {{-- <button type="button" class="btn gray btn-secondary">Search</button>&nbsp; &nbsp; --}}
                <button type="button" class="btn gray btn-outline-dark">Clear</button>
            </div>
        </div>
    </div>
    <br>

    <a href="/tambah" class="btn btn-primary">New</a> <form action="/delete/" method="post">
        @method('delete')
        @csrf
        <button type="submit" class="btn btn-outline-danger" id="deletedata">Hapus</button>
    </form>

    {{-- <a href="/delete" class="btn btn-danger" id="deletedata">Hapus</a> --}}

    {{-- add & modal delete --}}
    {{-- @foreach ($project as $list) --}}
    {{-- <a href="/tambah" class="btn btn-primary">New</a> <div class="modal fade" id="ModalDelete{{ $list->project_id }}" tabindex="-1" role="dialog"
        aria-hidden="true"> --}}
    {{-- <div class="modal-dialog" role="document">
            <div class="modal-content"> 
                <div class="modal-header">
                    <h4 class="modal-title">{{ ('Data Delete') }}</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Anda Yakin Ingin Menghapus Data <b>{{ $list->project_name }}</b>?</p>
                </div>
                <div class="modal-footer">
                    <form action="/delete/ {{ $list->project_id }}" method="post">
                        @method('delete')
                        @csrf
                        <button type="submit"
                            class="btn btn-outline-danger">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <button type="submit" data-bs-toggle="modal" data-bs-target="#ModalDelete{{ $list->project_id }}" id="hapusdata" class="small btn btn-danger btn-sm">Hapus</button>
    @endforeach --}}
    {{-- end --}}

    <br>
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <td width ="1%"><input type="checkbox" name="" id="select_all"></td>
                <td>Action</td>
                <td>Project Name</td>
                <td>Client</td>
                <td>Project Start</td>
                <td>Project End</td>
                <td>Status</td>
            </tr>
        </thead>

        <tbody>

            @foreach ($project as $list)
                <tr id="project_id{{ $list->project_id }}">
                    <td><input type="checkbox" name="select" class="checkbox_id" value="{{ $list->project_id }}"></td>
                    <td><a href="/edit/ {{ $list->project_id }}">Edit</a></td> 
                    <td> {{ $list->project_name }}</td>
                    {{-- <td>client</td> --}}
                    <td>{{ $list->client->client_name }}</td>
                    <td> {{ $list->project_start }}</td>
                    <td> {{ $list->project_end }}</td>
                    <td> {{ $list->project_status }}</td>
                </tr>
            @endforeach

        </tbody>
    </table>

    <script>
        $(function(e) {
            $("select_all").click(function() {
                $('.checkbox_id').prop('checked', $(this).prop('checked'));
            });

            $('hapusdata').click(function(e) {
                e.prevenDefault();
                var all_id = [];
                $('input:checkbox[name=id]:checked').each(function() {
                    all_id.push($(this).val());
                });

                $.ajax({
                    url: "{{ route('deletedata') }}",
                    type: "DELETE",
                    data: {
                        id: all_id,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(respone) {
                        $.each(all_id, function(key, val) {
                            $('#project_id' + val).remove();
                        });
                    }
                });
            });
        });
    </script>
@endsection
