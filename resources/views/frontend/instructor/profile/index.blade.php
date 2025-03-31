@extends('frontend.layouts.app')
@section('content')
    <!--===========================
        BREADCRUMB START
    ============================-->
    <section class="wsus__breadcrumb" style="background: url(images/breadcrumb_bg.jpg);">
        <div class="wsus__breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12 wow fadeInUp">
                        <div class="wsus__breadcrumb_text">
                            <h1>Instructor</h1>
                            <ul>
                                <li><a href="#">Home</a></li>
                                <li>Overview</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--===========================
        BREADCRUMB END
    ============================-->


    <!--===========================
        DASHBOARD OVERVIEW START
    ============================-->
    <section class="wsus__dashboard mt_90 xs_mt_70 pb_120 xs_pb_100">
        <div class="container">
            <div class="row">
                @include('frontend.partials.sidebar')
                <div class="col-xl-9 col-md-8 wow fadeInRight">
                    <div class="wsus__dashboard_contant">
                        <div class="wsus__dashboard_contant_top d-flex flex-wrap justify-content-between">
                            <div class="wsus__dashboard_heading">
                                <h5>Update Your Information</h5>
                                <p>Manage your courses and its update like live, draft and insight.</p>
                            </div>
                            <div class="wsus__dashboard_profile_delete">
                                <a href="#" class="common_btn">Delete Profile</a>
                            </div>
                        </div>


                        <form action="{{route('profile.update', 'instructor')}}"  enctype="multipart/form-data" method="post" class="wsus__dashboard_profile_update">
                            @csrf
                            @method('patch')
                            <div class="row">
                                <div class="wsus__dashboard_profile wsus__dashboard_profile_avatar">
                                    <div class="img">
                                        <img src="{{asset(auth()->user()->getAvatar())}}" alt="profile" class="img-fluid w-100">
                                        <label for="profile_photo">
                                            <img src="{{asset('assets/images/dash_camera.png')}}" alt="camera" class="img-fluid w-100">
                                        </label>
                                        <input type="file" id="profile_photo" hidden="" name="image">
                                        <x-input-error :messages="$errors->get('image')" class="mt-2"/>
                                    </div>
                                    <div class="text">
                                        <h6>Your avatar</h6>
                                        <p>PNG or JPG no bigger than 400px wide and tall.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xl-6">
                                    <div class="wsus__dashboard_profile_update_info">
                                        <label>First name</label>
                                        <input type="text" placeholder="Enter your first name" name="name" value="{{old('name', auth()->user()->name)}}">
                                        <x-input-error :messages="$errors->get('name')" class="mt-2"/>

                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="wsus__dashboard_profile_update_info">
                                        <label>Email</label>
                                        <input type="email" placeholder="Enter your email" name="email" value="{{old('email', auth()->user()->email)}}">
                                        <x-input-error :messages="$errors->get('email')" class="mt-2"/>

                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="wsus__dashboard_profile_update_info">
                                        <div class="gender" style="display: flex">
                                            <div style="display: flex; margin-right: 20px">
                                                <label for="" style="margin-right: 8px">Male</label>
                                                <input type="radio" name="gender" value="{{\App\Enums\Gender::MALE}}" @checked(old('gender', auth()->user()->gender->value) == App\Enums\Gender::MALE->value)>
                                            </div>
                                            <div style="display: flex">
                                                <label for="" style="margin-right: 8px">Female</label>
                                                <input type="radio" name="gender" value="{{\App\Enums\Gender::FEMALE}}" @checked(old('gender', auth()->user()->gender->value) == App\Enums\Gender::FEMALE->value)>
                                            </div>

                                        </div>
                                        <x-input-error :messages="$errors->get('gender')" class="mt-2"/>

                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="wsus__dashboard_profile_update_info">
                                        <label>Headline</label>
                                        <input type="text" placeholder="Enter your headline" name="headline" value="{{old('headline', auth()->user()->headline)}}">
                                        <x-input-error :messages="$errors->get('headline')" class="mt-2"/>

                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="wsus__dashboard_profile_update_info">
                                        <label>Social media</label>
                                        <input type="url" placeholder="Enter your facebook" name="facebook" value="{{old('facebook', auth()->user()->facebook)}}">
                                        <x-input-error :messages="$errors->get('facebook')" class="mt-2"/>

                                    </div>
                                </div>
                                <div class="col-xl-12">
                                    <div class="wsus__dashboard_profile_update_info">
                                        <label>About Me</label>
                                        <textarea rows="7" placeholder="Your text here" name="bio">{{old('bio', auth()->user()->bio)}}</textarea>
                                        <x-input-error :messages="$errors->get('bio')" class="mt-2"/>

                                    </div>
                                </div>
                                <div class="col-xl-12">
                                    <div class="wsus__dashboard_profile_update_btn">
                                        <button type="submit" class="common_btn">Update Profile</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="wsus__dashboard_contant">
                        <div class="wsus__dashboard_contant_top d-flex flex-wrap justify-content-between">
                            <div class="wsus__dashboard_heading">
                                <h5>Update password</h5>
                            </div>
                        </div>


                        <form action="{{route('profile.password-update', 'instructor')}}" method="post" class="wsus__dashboard_profile_update">
                            @csrf
                            @method('patch')
                            <div class="row">
                                <div class="col-xl-6">
                                    <div class="wsus__dashboard_profile_update_info">
                                        <label>Current password</label>
                                        <input type="password" placeholder="Enter your password" name="current_password">
                                        <x-input-error :messages="$errors->get('current_password')" class="mt-2"/>
                                    </div>
                                </div> <div class="col-xl-6">
                                    <div class="wsus__dashboard_profile_update_info">
                                        <label>Password</label>
                                        <input type="password" placeholder="Enter your password" name="password">
                                        <x-input-error :messages="$errors->get('password')" class="mt-2"/>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="wsus__dashboard_profile_update_info">
                                        <label>Confirmation password</label>
                                        <input type="password" placeholder="Enter your password" name="password_confirmation">
                                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2"/>
                                    </div>
                                </div>
                                <div class="col-xl-12">
                                    <div class="wsus__dashboard_profile_update_btn">
                                        <button type="submit" class="common_btn">Update password</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--===========================
        DASHBOARD OVERVIEW END
    ============================-->
@endsection
