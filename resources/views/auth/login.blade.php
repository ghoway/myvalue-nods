@extends('layouts.guest')

@section('title', 'Login')

@section('content')
    <div class="login-box">
        <div class="login-logo">
            <a href="#"><b>{{ config('app.name') }}</b></a>
        </div>
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Silahkan login terlebih dahulu.</p>

                <!-- Display Validation Errors -->
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible mb-3">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h5><i class="icon fas fa-ban"></i> Error!</h5>
                        @foreach ($errors->all() as $error)
                                {{ $error }}
                            @endforeach
                    </div>
                @endif

                <form action="{{ route('login') }}" method="post">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}" required autofocus>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Password" name="password" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                        <div class="icheck-primary">
                        <input type="checkbox" id="remember">
                        <label for="remember">
                        Remember Me
                        </label>
                        </div>
                        </div>
                        <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                        </div>
                </form>
            </div>
        </div>
        <p class="mt-2 text-center">Jika lupa password silahkan hubungi Administrator.</p>
    </div>
@endsection
@push('js')
<script>
    $(document).ready(function() {
        setTimeout(function() {
            $('.alert').fadeOut('slow');
        }, 5000);
    });
     </script>
@endpush