@extends('layouts.app')

@section('cardtitle', 'Manajemen Permission')
@section('cardicons', 'fas fa-key')

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
                <th>Nama Permissions</th>
                <th>Guard</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($permissions as $data)
            <tr>
                <td>{{ $data->name }}</td>
                <td>{{ $data->guard_name }}</td>
                <td>
                    <a href="#" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modalEditData{{ $data->id }}"><i class="fas fa-edit"></i></a>
                    <a href="#" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalHapus" data-action="{{ route('permission.destroy', $data->id) }}">
                        <i class="fas fa-trash"></i>
                    </a>
                </td>
            </tr>
            <!-- Modal Edit Data -->
            <div class="modal fade" id="modalEditData{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="modalEditDataLabel{{ $data->id }}" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <form action="{{ route('permission.update', $data->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalEditDataLabel{{ $data->id }}">Edit Permission: {{ $data->name }}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="name">Nama Permissions</label>
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
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
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
            <form action="{{ route('permission.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTambahDataLabel">Tambah Data Baru</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="title">Nama Permissions</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                        @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="title">Guard</label>
                        <select name="guard" id="guard" class="form-control">
                            <option value="web" selected>Web</option>
                        </select>
                        @error('guard') <span class="text-danger">{{ $message }}</span> @enderror
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
        var button = $(event.relatedTarget); // Tombol yang diklik untuk memicu modal
        var actionUrl = button.data('action'); // Ambil URL dari data-action
        var modal = $(this);
        modal.find('#deleteForm').attr('action', actionUrl); // Setel action form ke URL
    });
});
</script>
@endpush
