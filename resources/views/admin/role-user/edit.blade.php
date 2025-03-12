@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('admin.Role user') }}</h1>
        </div>

        <div class="card card-primary">
            <div class="card-header">
                <h4>{{ __('admin.Update user with role') }}</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.role-user.update', $admin->id) }}" method="POST">
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <label for="">{{ __('admin.User name') }}</label>
                        <input type="text" value="{{ $admin->name }}" class="form-control" name="name">
                        @error('name')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="">{{ __('admin.Email') }}</label>
                        <input type="text" value="{{ $admin->email }}" class="form-control" name="email">
                        @error('email')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="">{{ __('admin.Password') }}</label>
                        <input type="password" value="" class="form-control" name="password">
                        @error('password')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="">{{ __('admin.Confirm password') }}</label>
                        <input type="password" value="" class="form-control" name="password_confirmation">
                        @error('password_confirmation')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="">{{ __('admin.Role') }}</label>
                        <select name="role" id="" class="select2 form-control">
                            <option value="">--{{ __('admin.Select') }}--</option>
                            @foreach ($roles as $role)
                                <option @selected($admin->getRoleNames()->first() === $role->name) value="{{ $role->name }}">{{ $role->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('email')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <button class="btn btn-primary" type="submit">{{ __('admin.Update') }}</button>
                </form>
            </div>
        </div>
    </section>
@endsection
