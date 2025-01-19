@extends('frontend.layouts.app')
@section('content')
    @include('frontend.pages.home.sections.hero')

    @include('frontend.pages.home.sections.category')
    @include('frontend.pages.home.sections.about')

    @include('frontend.pages.home.sections.course')
    @include('frontend.pages.home.sections.offer')
    @include('frontend.pages.home.sections.instructor')
    @include('frontend.pages.home.sections.video')
    @include('frontend.pages.home.sections.brand')
    @include('frontend.pages.home.sections.quality-course')
    @include('frontend.pages.home.sections.testimony')
    @include('frontend.pages.home.sections.blog')
    @include('frontend.partials.footer')
@endsection
