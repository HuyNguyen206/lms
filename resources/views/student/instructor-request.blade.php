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
                            <h1>Student</h1>
                            <ul>
                                <li><a href="#">Home</a></li>
                                <li>Become instructor</li>
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
                @include('student.instructor-info')
                <div class="col-xl-9 col-md-8">
                    <div class="row">
                    <div class="card">
                    <div class="card-header">
                        Become instructor
                    </div>
                        <div class="card-body">
                            <form action="" enctype="multipart/form-data" method="post">
                                    <div class="wsus__login_form_input">
                                        <label class="form-label">Document (Instructor)</label>
                                        <input type="file" class="form-control" name="document">
                                        <x-input-error :messages="$errors->get('document')" class="mt-2"/>

                                    </div>
                                <button type="submit" class="common_btn mt-4">Submit</button>
                            </form>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--===========================
        DASHBOARD OVERVIEW END
    ============================-->
@endsection
