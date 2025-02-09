@extends('frontend.layouts.app')
@section('content')
    <!--===========================
        SIGN UP START
    ============================-->
    <section class="wsus__sign_in sign_up">
        <div class="row align-items-center">
            <div class="col-xxl-5 col-xl-6 col-lg-6 wow fadeInLeft">
                <div class="wsus__sign_img">
                    <img src="images/login_img_2.jpg" alt="login" class="img-fluid">
                    <a href="index.html">
                        <img src="images/logo.png" alt="EduCore" class="img-fluid">
                    </a>
                </div>
            </div>
            <div class="col-xxl-4 col-xl-5 col-lg-6 col-md-9 m-auto wow fadeInRight">
                <div class="wsus__sign_form_area">
                    aria-labelledby="pills-home-tab" tabindex="0">
                    <form action="{{route('register')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <h2>Sign Up<span>!</span></h2>
                        <p class="new_user">Already have an account? <a href="sign_in.html">Sign In</a></p>
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="wsus__login_form_input">
                                    <label>You are?</label>
                                    <div style="display: flex">
                                        <label class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="type" value="{{\App\Enums\Role::STUDENT->value}}"
                                                   checked="">
                                            <span class="form-check-label">Student</span>
                                        </label>
                                        <label class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="type" value="{{\App\Enums\Role::INSTRUCTOR->value}}">
                                            <span class="form-check-label">Instructor</span>
                                        </label>
                                    </div>
                                    <x-input-error :messages="$errors->get('type')" class="mt-2"/>
                                </div>
                            </div>
                            <div class="col-xl-12">
                                <div class="wsus__login_form_input">
                                        <label class="form-label">Document (Instructor)</label>
                                        <input type="file" class="form-control" name="document">
                                        <x-input-error :messages="$errors->get('document')" class="mt-2"/>

                                </div>
                            </div>


                            <div class="col-xl-12">
                                <div class="wsus__login_form_input">
                                    <label>Name</label>
                                    <input type="text" placeholder="First name" name="name" value="{{old('name')}}">
                                    <x-input-error :messages="$errors->get('name')" class="mt-2"/>
                                </div>
                            </div>

                            <div class="col-xl-12">
                                <div class="wsus__login_form_input">
                                    <label>Your email</label>
                                    <input type="email" name="email" value="{{old('email')}}" placeholder="Your email">
                                    <x-input-error :messages="$errors->get('email')" class="mt-2"/>

                                </div>
                            </div>
                            <div class="col-xl-12">
                                <div class="wsus__login_form_input">
                                    <label>Password</label>
                                    <input type="password"
                                           name="password"
                                           required autocomplete="new-password">
                                    <x-input-error :messages="$errors->get('password')" class="mt-2"/>
                                </div>
                            </div>

                            <div class="col-xl-12">
                                <div class="wsus__login_form_input">
                                    <label>Confirm Password</label>
                                    <input type="password"
                                           name="password_confirmation" required autocomplete="new-password">
                                    <x-input-error :messages="$errors->get('password')" class="mt-2"/>
                                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2"/>

                                </div>
                            </div>
                            <div class="col-xl-12">
                                <div class="wsus__login_form_input">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value=""
                                               id="flexCheckDefault">
                                        <label class="form-check-label" for="flexCheckDefault"> By clicking
                                            Create
                                            account, I agree that I have read and accepted the <a href="#">Terms
                                                of
                                                Use</a> and <a href="#">Privacy Policy.</a>
                                        </label>
                                    </div>
                                    <button type="submit" class="common_btn">Sign Up</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <a class="back_btn" href="index.html">Back to Home</a>
    </section>
    <!--===========================
        SIGN UP END
    ============================-->
@endsection
