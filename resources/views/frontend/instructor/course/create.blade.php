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
                                <li>Course</li>
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
                <div class="col-xl-9 col-md-8">
                    <div class="wsus__dashboard_contant">
                        <div class="wsus__dashboard_contant_top">
                            <div class="wsus__dashboard_heading relative">
                                <h5>Add Courses</h5>
                                <p>Manage your courses and its update like live, draft and insight.</p>
                            </div>
                        </div>

                        <div class="dashboard_add_courses">
                            <ul class="nav nav-pills" id="pills-tab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a href="{{route('instructor.courses.create', \App\Models\Course::BASIC_INFO)}}" class="nav-link @if($stage === \App\Models\Course::BASIC_INFO) active @endif" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Basic Infos</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a href="{{route('instructor.courses.create', \App\Models\Course::MORE_INFO)}}" class="nav-link @if($stage === \App\Models\Course::MORE_INFO) active @endif" type="button" role="tab" aria-controls="pills-profile" aria-selected="false" tabindex="-1">More Infos</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a href="{{route('instructor.courses.create', \App\Models\Course::COURSE_CONTENT)}}" class="nav-link @if($stage === \App\Models\Course::COURSE_CONTENT) active @endif" type="button" role="tab" aria-controls="pills-contact" aria-selected="false" tabindex="-1">Course Contents</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a href="{{route('instructor.courses.create', \App\Models\Course::FINISH)}}" class="nav-link @if($stage === \App\Models\Course::FINISH) active @endif" type="button" role="tab" aria-controls="pills-contact2" aria-selected="false" tabindex="-1">Finish</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="pills-tabContent">
                                @include("frontend.instructor.course.stages.$stage")
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
