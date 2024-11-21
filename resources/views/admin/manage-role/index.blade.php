@extends('layouts.app')

@section('cardtitle', 'Manajemen Role')
@section('cardicons', 'fas fa-shield-alt')

@section('content')
<!-- Main Content -->
<div class="card-body">
    @if (session('success'))
    <div class="alert alert-success alert-dismissible mb-3">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h5><i class="icon fas fa-check"></i> Berhasil!</h5>
        {{ session('success') }}
    </div>
    @endif
    <div class="mb-3">
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalTambahData">Tambah Data</button>
    </div>
    <table id="example1" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Nama Role</th>
                <th>Guard</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($roles as $data)
            <tr>
                <td>{{ $data->name }}</td>
                <td>{{ $data->guard_name }}</td>
                <td>
                    <a href="#" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modalEditData{{ $data->id }}"><i class="fas fa-edit"></i></a>
                    <a href="#" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalHapus" data-action="{{ route('role.destroy', $data->id) }}">
                        <i class="fas fa-trash"></i>
                    </a>
                </td>
            </tr>
            <!-- Modal Edit Data -->
<div class="modal fade" id="modalEditData{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="modalEditDataLabel{{ $data->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form action="{{ route('role.update', $data->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditDataLabel{{ $data->id }}">Edit Role: {{ $data->name }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Nama Role</label>
                        <input type="text" name="name" class="form-control" value="{{ $data->name }}">
                        @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="guard">Guard</label>
                        <select name="guard" id="guard" class="form-control">
                            <option value="web" {{ $data->guard_name == 'web' ? 'selected' : '' }}>Web</option>
                        </select>
                        @error('guard') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="permission">Permissions</label>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="checkAllEdit{{ $data->id }}">
                            <label class="form-check-label" for="checkAllEdit{{ $data->id }}"><b>Check All</b></label>
                        </div>
                        <div class="row">
                            @foreach ($permissions as $permission)
                            <div class="col-sm-3">
                                <div class="form-check">
                                    <input class="form-check-input permission" type="checkbox" name="permissions[]" id="permissionEdit{{ $data->id }}{{ $permission->id }}" value="{{ $permission->name }}"
                                        {{ $data->permissions->contains($permission) ? 'checked' : '' }}>
                                    <label class="form-check-label {{ strtok($permission->name, ' ') == 'delete' ? 'text-danger':'' }}" for="permissionEdit{{ $data->id }}{{ $permission->id }}">
                                        {{ $permission->name }}
                                    </label>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /Modal Edit Data -->
            @endforeach
        </tbody>
    </table>
</div>
<!-- Modal Hapus Data -->
<div class="modal fade" id="modalHapus" tabindex="-1" role="dialog" aria-labelledby="modalHapusLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="deleteForm" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-header">
                    <h5 class="modal-title" id="modalHapusLabel">Konfirmasi Hapus</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus data ini?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /Modal Hapus Data -->
<!-- Modal Tambah Data -->
<div class="modal fade" id="modalTambahData" tabindex="-1" role="dialog" aria-labelledby="modalTambahDataLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form action="{{ route('role.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTambahDataLabel">Tambah Data Baru</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Nama Role</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                        @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="guard">Guard</label>
                        <select name="guard" id="guard" class="form-control">
                            <option value="web" selected>Web</option>
                        </select>
                        @error('guard') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="permission">Permissions</label>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="checkAll">
                            <label class="form-check-label" for="checkAll"><b>Check All</b></label>
                        </div>
                        <div class="row">
                            @foreach ($permissions as $permission)
                            <div class="col-sm-3">
                                <div class="form-check">
                                    <input class="form-check-input permission" type="checkbox" name="permissions[]" id="permission{{ $permission->id }}" value="{{ $permission->name }}">
                                    <label class="form-check-label {{ strtok($permission->name, ' ') == 'delete' ? 'text-danger':'' }}" for="permission{{ $permission->id }}">
                                        {{ $permission->name }}
                                    </label>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /Modal Tambah Data -->

@endsection

@push('js')
<script>
$(function() {
    $("#example1").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
});

$(document).ready(function () {
    $('#modalHapus').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var actionUrl = button.data('action');
        var modal = $(this);
        modal.find('#deleteForm').attr('action', actionUrl);
    });

    // Check All permissions
    $('#checkAll').click(function() {
        $('.permission').prop('checked', this.checked);
    });
    $('.permission').change(function() {
        if ($('.permission:checked').length == $('.permission').length) {
            $('#checkAll').prop('checked', true);
        } else {
            $('#checkAll').prop('checked', false);
        }
    });

    // Check All permissions for edit modals
    $('[id^=checkAllEdit]').each(function() {
        var id = $(this).attr('id').replace('checkAllEdit', '');
        $(this).click(function() {
            $('[id^=permissionEdit' + id + ']').prop('checked', this.checked);
        });
        $('[id^=permissionEdit' + id + ']').change(function() {
            if ($('[id^=permissionEdit' + id + ']:checked').length == $('[id^=permissionEdit' + id + ']').length) {
                $('#checkAllEdit' + id).prop('checked', true);
            } else {
                $('#checkAllEdit' + id).prop('checked', false);
            }
        });
    });
});
</script>
@endpush
