@extends('layouts.app')

@section('cardtitle', 'Manajemen Menu')
@section('cardicons', 'fas fa-bars')

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
                <th>Menu ID</th>
                <th>Title</th>
                <th>URL</th>
                <th>Icon</th>
                <th>Parent ID</th>
                <th>Role</th>
                <th>Header</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($menus as $data)
                <tr>
                    <td>{{ $data->id }}</td>
                    <td>{{ $data->title }}</td>
                    <td>{{ $data->url }}</td>
                    <td>{{ $data->icon }}</td>
                    <td>{{ $data->parent_id }}</td>
                    <td>{{ $data->role }}</td>
                    <td>{{ $data->header }}</td>
                    <td>
                        <a href="{{ route('menu.edit', $data->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                        <a href="#" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalHapus" data-action="{{ route('menu.destroy', $data->id) }}">
                            <i class="fas fa-trash"></i>
                        </a>
                    </td>
                </tr>
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
            <form action="{{ route('menu.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTambahDataLabel">Tambah Data Baru</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" name="title" class="form-control" value="{{ old('title') }}">
                        @error('title') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="url">URL</label>
                        <input type="text" name="url" class="form-control" value="{{ old('url') }}">
                        @error('url') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="icon">Icon</label>
                        <input type="text" name="icon" class="form-control" value="{{ old('icon') }}">
                        @error('icon') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="parent_id">Parent ID</label>
                        <input type="number" name="parent_id" class="form-control" value="{{ old('parent_id') }}">
                        @error('parent_id') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="role">Role</label>
                        <input type="text" name="role" class="form-control" value="{{ old('role') }}">
                        @error('role') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="header">Header</label>
                        <input type="text" name="header" class="form-control" value="{{ old('header') }}">
                        @error('header') <span class="text-danger">{{ $message }}</span> @enderror
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