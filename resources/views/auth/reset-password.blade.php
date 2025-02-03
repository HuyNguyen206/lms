{{--<x-guest-layout>--}}
{{--    <form method="POST" action="{{ route('password.store') }}">--}}
{{--        @csrf--}}

{{--        <!-- Password Reset Token -->--}}
{{--        <input type="hidden" name="token" value="{{ $request->route('token') }}">--}}

{{--        <!-- Email Address -->--}}
{{--        <div>--}}
{{--            <x-input-label for="email" :value="__('Email')" />--}}
{{--            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />--}}
{{--            <x-input-error :messages="$errors->get('email')" class="mt-2" />--}}
{{--        </div>--}}

{{--        <!-- Password -->--}}
{{--        <div class="mt-4">--}}
{{--            <x-input-label for="password" :value="__('Password')" />--}}
{{--            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />--}}
{{--            <x-input-error :messages="$errors->get('password')" class="mt-2" />--}}
{{--        </div>--}}

{{--        <!-- Confirm Password -->--}}
{{--        <div class="mt-4">--}}
{{--            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />--}}

{{--            <x-text-input id="password_confirmation" class="block mt-1 w-full"--}}
{{--                                type="password"--}}
{{--                                name="password_confirmation" required autocomplete="new-password" />--}}

{{--            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />--}}
{{--        </div>--}}

{{--        <div class="flex items-center justify-end mt-4">--}}
{{--            <x-primary-button>--}}
{{--                {{ __('Reset Password') }}--}}
{{--            </x-primary-button>--}}
{{--        </div>--}}
{{--    </form>--}}
{{--</x-guest-layout>--}}

@extends('frontend.layouts.app')
@section('content')

    <!--===========================
    SIGN IN START
============================-->
    <section class="wsus__sign_in">
        <div class="row align-items-center">
            <div class="col-xxl-5 col-xl-6 col-lg-6 wow fadeInLeft">
                <div class="wsus__sign_img">
                    <img src="{{asset('assets/images/login_img_1.jpg')}}" alt="login" class="img-fluid">
                    <a href="index.html">
                        <img src="{{asset('assets/images/logo.png')}}" alt="EduCore" class="img-fluid">
                    </a>
                </div>
            </div>
            <div class="col-xxl-4 col-xl-5 col-lg-6 col-md-9 m-auto wow fadeInRight">
                <div class="wsus__sign_form_area">
                    <div class="" id="pills-home" role="tabpanel"
                         aria-labelledby="pills-home-tab" tabindex="0">
                        @dump($errors->all())
                        <form action="{{route('password.store')}}" method="post">
                            @csrf
                            <input type="hidden" name="token" value="{{ $request->route('token') }}">
                            <h2>Reset password<span>!</span></h2>
                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="wsus__login_form_input">
                                        <label>Email</label>
                                        <input type="email" name="email" value="{{old('email', $request->email)}}" required autofocus autocomplete="email">
                                        <x-input-error :messages="$errors->get('email')" class="mt-2" style="color: red"/>
                                    </div>
                                </div>
                                <div class="col-xl-12">
                                    <div class="wsus__login_form_input">
                                        <label>Password</label>
                                        <input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password">
                                        <x-input-error :messages="$errors->get('password')" class="mt-2" style="color: red"/>
                                    </div>
                                </div>
                                <div class="col-xl-12">
                                    <div class="wsus__login_form_input">
                                        <label>Confirm Password</label>
                                        <input class="block mt-1 w-full" id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"/>
                                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" style="color: red"/>
                                        </div>
                                    </div>
                                    <div class="col-xl-12">
                                        <div class="wsus__login_form_input">
                                            <button type="submit" class="common_btn">Reset Password</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <a class="back_btn" href="index.html">Back to Home</a>
        </section>
        <!--===========================
            SIGN IN END
        ============================-->

    @endsection

