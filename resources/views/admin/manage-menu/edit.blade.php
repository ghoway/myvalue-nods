@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Menu</h1>
        <form action="{{ route('menu.update', $menu->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" class="form-control" value="{{ old('title', $menu->title) }}">
                @error('title') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="url">URL</label>
                <input type="text" name="url" class="form-control" value="{{ old('url', $menu->url) }}">
                @error('url') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="icon">Icon</label>
                <input type="text" name="icon" class="form-control" value="{{ old('icon', $menu->icon) }}">
                @error('icon') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="parent_id">Parent ID</label>
                <input type="number" name="parent_id" class="form-control" value="{{ old('parent_id', $menu->parent_id) }}">
                @error('parent_id') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="role">Role</label>
                <input type="text" name="role" class="form-control" value="{{ old('role', $menu->role) }}">
                @error('role') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="header">Header</label>
                <input type="text" name="header" class="form-control" value="{{ old('header', $menu->header) }}">
                @error('header') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection