@extends('layouts.app')

@section('cardtitle', 'Manajemen Users')
@section('cardicons', 'fas fa-users')

@section('content')
<!-- Main content -->
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
                <th>Nama</th>
                <th>Email</th>
                <th>Level</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $data)
            <tr>
                <td>{{ $data->name }}</td>
                <td>{{ $data->email }}</td>
                <td>
                    @foreach ($data->roles as $role)
                    @if ($role->name == 'Administrator')
                    <span class="badge badge-success">Administrator</span>
                    @elseif ($role->name == 'Operator')
                    <span class="badge badge-primary">{{ $role->name }}</span>
                    @else
                    <span class="badge badge-info">{{ $role->name }}</span>
                    @endif
                    @endforeach
                </td>
                <td>
                    <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modalEdit_{{ $data->id }}"><i class="fas fa-edit"></i></button>
                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalHapus" data-action="{{ route('admin.users.destroy', $data->id) }}"><i class="fas fa-trash"></i></button>                    
                </td>
            </tr>                
            <!-- Modal Edit User -->
            <div class="modal fade" id="modalEdit_{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="modalEditUserLabel_{{ $data->id }}" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form action="{{ route('admin.users.update', $data->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalEditUserLabel_{{ $data->id }}">Edit User</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="edit_name_{{ $data->id }}">Nama</label>
                                    <input type="text" class="form-control" id="edit_name_{{ $data->id }}" name="name" value="{{ $data->name }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="edit_email_{{ $data->id }}">Email</label>
                                    <input type="email" class="form-control" id="edit_email_{{ $data->id }}" name="email" value="{{ $data->email }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="edit_password_{{ $data->id }}">Password</label>
                                    <input type="password" class="form-control" id="edit_password_{{ $data->id }}" name="password">
                                </div>
                                <div class="form-group">
                                    <label for="edit_roles_{{ $data->id }}">Level</label>
                                    <select class="form-control" id="edit_roles_{{ $data->id }}" name="roles[]" required>
                                        <option value="Administrator" {{ $data->hasRole('Administrator') ? 'selected' : '' }}>Administrator</option>
                                        <option value="Operator" {{ $data->hasRole('Operator') ? 'selected' : '' }}>Operator</option>
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /Modal Edit User -->
            @endforeach
        </tbody>
    </table>
</div>
<!-- /.card-body -->
<!-- Modal Hapus User -->
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
                    Apakah Anda yakin ingin menghapus pengguna ini?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /Modal Hapus User -->
<!-- Modal Tambah User -->
<div class="modal fade" id="modalTambahData" tabindex="-1" role="dialog" aria-labelledby="modalTambahDataLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('admin.users.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTambahDataLabel">Tambah User Baru</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="new_name">Nama</label>
                        <input type="text" class="form-control" id="new_name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="new_email">Email</label>
                        <input type="email" class="form-control" id="new_email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="new_password">Password</label>
                        <input type="password" class="form-control" id="new_password" name="password" required>
                    </div>
                    <div class="form-group">
                        <label for="new_roles">Level</label>
                        <select class="form-control" id="new_roles" name="roles[]" required>
                            @foreach ($roles as $role)
                            <option value="{{ $role->name }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
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
<!-- /Modal Tambah User -->
@endsection

@push('js')
<script>
$(function () {
    $("#example1").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "buttons": ["copy", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
});

$(document).ready(function () {
    $('#modalHapus').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Tombol yang diklik untuk memicu modal
        var actionUrl = button.data('action'); // Ambil URL dari data-action
        var modal = $(this);
        modal.find('#deleteForm').attr('action', actionUrl); // Setel action form ke URL
    });
});
</script>
@endpush
