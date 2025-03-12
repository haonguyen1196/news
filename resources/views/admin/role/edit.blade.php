@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('admin.Role and permission') }}</h1>
        </div>

        <div class="card card-primary">
            <div class="card-header">
                <h4>{{ __('admin.Edit role') }}</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.role.update', $role->id) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="">{{ __('admin.Role name') }}</label>
                        <input type="text" value="{{ $role->name }}" class="form-control" name="role">
                        @error('role')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <hr>
                    @foreach ($permissions as $groupName => $permission)
                        <div class="form-group">
                            <h6 class="text-primary">{{ $groupName }}</h6>
                            <div class="row">
                                @foreach ($permission as $item)
                                    <div class="col-md-2">
                                        <label class="custom-switch mt-2">
                                            <input @checked(in_array($item->name, $rolePermission)) value="{{ $item->name }}" type="checkbox"
                                                name="permission[]" class="custom-switch-input">
                                            <span class="custom-switch-indicator"></span>
                                            <span class="custom-switch-description">{{ $item->name }}</span>
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <hr>
                    @endforeach
                    <button class="btn btn-primary" type="submit">{{ __('admin.Update') }}</button>
                </form>
            </div>
        </div>
    </section>
@endsection
