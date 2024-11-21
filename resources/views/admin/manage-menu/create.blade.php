@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Create Menu</h1>
        <form action="{{ route('admin.menu.store') }}" method="POST">
            @csrf
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
            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>
@endsection
