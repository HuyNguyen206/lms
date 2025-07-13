<div class="tab-pane fade show active" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab"
     tabindex="0">
    <div class="add_course_content">
        <div class="add_course_content_btn_area d-flex flex-wrap justify-content-between">
            <x-modal-crud
                type="button" class="common_btn"
                routeView="{{route('instructor.view-modal', \App\Http\Controllers\Frontend\InstructorController::CHAPTER_CREATE)}}"
                routeSubmit="{{route('instructor.courses.chapters.store', request()->course)}}"
                idButton="showModalCreateCourse"
                >
                Add New Chapter
            </x-modal-crud>

            {{--            <a class="common_btn" href="#">Add New Chapter</a>--}}
            <a class="common_btn" href="#">Short Chapter</a>
        </div>
        <div class="accordion" id="accordionExample">
            @forelse($course->chapters as $chapter)
                <x-modal-popup idButton="showModalCreateLesson_{{$chapter->id}}" style="max-width: 800px"></x-modal-popup>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#chapter_{{$chapter->id}}" aria-expanded="true"
                                aria-controls="collapseOne">
                            <span>{{$chapter->title}}</span>
                        </button>
                        <div class="add_course_content_action_btn">
                            <div class="dropdown">
                                <div class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                     aria-expanded="false">
                                    <i class="far fa-plus" aria-hidden="true"></i>
                                </div>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <x-modal-crud
                                            class="dropdown-item" href="#"
                                            routeView="{{route('instructor.view-modal', \App\Http\Controllers\Frontend\InstructorController::LESSON_CREATE)}}"
                                            routeSubmit="{{route('instructor.chapters.lessons.store', $chapter->id)}}"
                                            idButton="showModalCreateLesson_{{$chapter->id}}"
                                            :isMerged="false">
                                            Add Lesson
                                        </x-modal-crud>
                                    </li>
                                    <li><a class="dropdown-item" href="#">Add Document</a>
                                    </li>
                                    <li><a class="dropdown-item" href="#">Add Quiz</a></li>
                                </ul>
                            </div>
                            <a class="edit" href="#"><i class="far fa-edit" aria-hidden="true"></i></a>
                            <a class="del" href="#"><i class="fas fa-trash-alt" aria-hidden="true"></i></a>
                        </div>
                    </h2>
                    <div id="chapter_{{$chapter->id}}" class="accordion-collapse collapse"
                         data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <ul class="item_list">
                                @foreach($chapter->lessons as $lesson)
                                    <x-modal-popup idButton="showModalEditLesson_{{$lesson->id}}" style="max-width: 800px"></x-modal-popup>

                                    <li>
                                        <span>{{$lesson->title}}</span>
                                        <div class="add_course_content_action_btn">
                                            <x-modal-crud
                                                class="dropdown-item" href="#"
                                                routeView="{{route('instructor.view-modal', \App\Http\Controllers\Frontend\InstructorController::LESSON_EDIT)}}"
                                                routeSubmit="{{route('instructor.chapters.lessons.update', [$chapter->id, $lesson->id])}}"
                                                extraParams="{!! http_build_query(['chapter' => $chapter->id, 'lesson' => $lesson->id]) !!}"
                                                idButton="showModalEditLesson_{{$lesson->id}}"
                                                :isMerged="false">
                                                <i class="far fa-edit" aria-hidden="true"></i>
                                            </x-modal-crud>
                                            <form action="{{route('instructor.chapters.lessons.destroy', [$chapter, $lesson])}}" method="post" id="deleteLesson">
                                                @method('delete')
                                                @csrf
                                            </form>
                                            <a class="del" href="#" onclick="event.preventDefault(); if(confirm('Are you sure to delete?')) {document.getElementById('deleteLesson').submit()}"><i class="fas fa-trash-alt" aria-hidden="true"></i></a>
                                            <a class="arrow" href="#"><i class="fas fa-arrows-alt"
                                                                         aria-hidden="true"></i></a>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @empty

            @endforelse
        </div>
    </div>
</div>
@section('js-init-upload')
    @include('frontend/instructor/partial/init-upload')
@endsection


{{--<!-- Modal -->--}}
{{--<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">--}}
{{--    <div class="modal-dialog modal-dialog-centered">--}}
{{--        <div class="modal-content">--}}
{{--            <div class="modal-header">--}}
{{--                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>--}}
{{--                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>--}}
{{--            </div>--}}
{{--            <div class="modal-body">--}}
{{--                ...--}}
{{--            </div>--}}
{{--            <div class="modal-footer">--}}
{{--                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>--}}
{{--                <button type="button" class="btn btn-primary">Save changes</button>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}

{{--@section('js')--}}
{{--    <script>--}}
{{--        $(document).ready(function () {--}}
{{--            $('[data-bs-toggle="modal"]').on('click', function (e) {--}}
{{--                e.preventDefault(); // prevent default anchor behavior--}}

{{--                var modalContent = $('#exampleModal .modal-content');--}}

{{--                // Show loading indicator--}}
{{--                modalContent.html('<div class="text-center p-4">Loading...</div>');--}}

{{--                // Send AJAX request to fetch content--}}
{{--                $.ajax({--}}
{{--                    url: '/get-content',--}}
{{--                    type: 'GET',--}}
{{--                    success: function (response) {--}}
{{--                        modalContent.html(response); // Replace content with response HTML--}}
{{--                    },--}}
{{--                    error: function (xhr, status, error) {--}}
{{--                        modalContent.html('<div class="text-danger p-4">An error occurred while loading content.</div>');--}}
{{--                    }--}}
{{--                });--}}
{{--            });--}}
{{--        });--}}
{{--    </script>--}}
{{--@endsection--}}
