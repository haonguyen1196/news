{{-- <x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('frontend.Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('frontend.Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('frontend.Email Password Reset Link') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}

@extends('frontend.layouts.master')

@section('content')
    <!-- forgot password -->

    <section class="wrap__section">

        <div class="container">
            <div class="row">

                <div class="col-md-12">


                    <div class="card mx-auto" style="max-width: 480px; ">
                        <div class="card-body">
                            @if (session()->has('status'))
                                <div class="alert alert-success">{{ session('status') }}</div>
                            @endif
                            <h4 class="card-title mb-4">{{ __('frontend.Sign in') }}</h4>
                            <form action="{{ route('password.email') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <input class="form-control" placeholder="Email" type="text" name="email">
                                    @error('email')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-block">
                                        {{ __('frontend.Email password reset link') }}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- forgot password -->
@endsection
