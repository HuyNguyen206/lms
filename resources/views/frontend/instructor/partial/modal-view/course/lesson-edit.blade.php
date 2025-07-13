<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Edit lesson</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <form action="{{$routeSubmit}}" method="post" id="lessonForm">
        @csrf
        <div class="row">
            <div class="col-xl-12">
                <div class="add_course_basic_info_imput">
                    <label for="#">Title *</label>
                    <input type="text" placeholder="Title" name="title" value="{{old('title', $lesson->title)}}">
                    <li style="color: red; display: none" id="title_error"></li>
                </div>
            </div>
            <div class="col-xl-12">
                <div class="add_course_basic_info_imput">
                    <label for="#">Description *</label>
                    <textarea name="description" id="" cols="30" rows="5">{{old('description', $lesson->description)}}</textarea>
                    <li style="color: red; display: none" id="description_error"></li>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="add_course_basic_info_imput">
                    <label for="#">Source *</label>
                    <select name="storage" id="select_source" class="select_2 select2-hidden-accessible"
                            data-select2-id="select2-data-1-q4dl" tabindex="-1" aria-hidden="true">
                        <option value="" data-select2-id="select2-data-3-8buh"> Please Select</option>

                        @foreach(\App\Enums\VideoStorageType::labels() as $type => $name)
                            <option @selected(old('storage', $lesson->storage) == $type) value="{{$type}}">{{$name}}</option>
                        @endforeach
                    </select>
                    <li style="color: red; display: none" id="storage_error"></li>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="add_course_basic_info_imput" style="margin-bottom: 0">
                    <label for="#">Video file/url</label>
                    <div id="source_file">
                        <div class="input-group">
                               <span class="input-group-btn">
                                 <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                                   <i class="fa fa-picture-o"></i> Choose
                                 </a>
                               </span>
                            <input id="thumbnail" class="form-control" type="text" name="filepath" style="width: 200px">
                        </div>
                        <div id="holder" style="margin-top:15px;max-height:100px; width: 100px">
                        </div>

                    </div>
                </div>

                <input type="text" name="source_path" id="source_path">
                <li style="color: red; display: none" id="video_url_error"></li>
            </div>
            <div class="col-xl-6">
                <div class="add_course_basic_info_imput">
                    <label for="#">File type *</label>
                    <select name="file_type" class="select_2 select2-hidden-accessible"
                            data-select2-id="select2-data-1-q4dl2" tabindex="-1" aria-hidden="true">
                        <option value="" data-select2-id="select2-data-3-8buh"> Please Select</option>
                        @foreach(\App\Enums\FileType::labels() as $type => $name)
                            <option @selected(old('file_type', $lesson->file_type) == $type) value="{{$type}}">{{$name}}</option>
                        @endforeach
                    </select>
                    <li style="color: red; display: none" id="file_type_error"></li>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="add_course_basic_info_imput">
                    <label for="#">Lesson type *</label>
                    <select name="lesson_type" class="select_2 select2-hidden-accessible"
                            data-select2-id="select2-data-1-q4dl3" tabindex="-1" aria-hidden="true">
                        <option value="" data-select2-id="select2-data-3-8buh"> Please Select</option>

                        @foreach(\App\Enums\LessonType::labels() as $type => $name)
                            <option @selected(old('lesson_type', $lesson->lesson_type) == $type) value="{{$type}}">{{$name}}</option>
                        @endforeach
                    </select>
                    <li style="color: red; display: none" id="lesson_type_error"></li>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="add_course_basic_info_imput">
                    <label for="#">Order</label>
                    <input type="number" placeholder="Seo description" name="order" value="{{old('order', $lesson->order)}}">
                    <li style="color: red; display: none" id="order_error"></li>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="form-check form-switch d-flex align-items-center">
                    <input class="form-check-input" style="margin-right: 20px" type="checkbox" name="is_preview" @checked(old('is_preview', $lesson->is_preview) == true)>
                    <label class="form-check-label" for="flexSwitchCheckDefault">Is preview</label>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="form-check form-switch d-flex align-items-center">
                    <input class="form-check-input mr-2" style="margin-right: 20px" type="checkbox" id="flexSwitchCheckDefault" name="is_downloadable"
                        @checked(old('is_downloadable', $lesson->is_downloadable) == true)>
                    <label class="form-check-label" for="flexSwitchCheckDefault">Is downloadable</label>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="add_course_basic_info_imput">
                    <label for="#">Duration</label>
                    <input type="number" placeholder="Seo description" name="duration" value="{{old('duration', $lesson->duration) }}">
                    <li style="color: red; display: none" id="duration_error"></li>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
    </form>

</div>
{{--<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>--}}

<script>
    function clearInput() {
        $('#title_error').hide().text('');
        $('#description_error').hide().text('');
        $('#storage_error').hide().text('');
        $('#file_type_error').hide().text('');
        $('#lesson_type_error').hide().text('');
        $('#order_error').hide().text('');
        $('#duration_error').hide().text('');
    }

    $(document).ready(function () {
        {{--        @include('frontend/instructor/partial/init-upload')--}}
        $('.select_2').select2(); // Basic init
        handleSourceSelection()
        $('#lessonForm').on('submit', function (e) {
            e.preventDefault();
            // Hide previous errors
            clearInput();

            let title = $('input[name="title"]').val();
            let description = $('textarea[name="description"]').val();
            let storage = $('select[name="storage"]').val();
            let file_type = $('select[name="file_type"]').val();
            let duration = $('input[name="duration"]').val();
            let lesson_type = $('select[name="lesson_type"]').val();
            let source_path = $('input[name="source_path"]').val();
            let filepath = $('input[name="filepath"]').val();
            let video_url = source_path || filepath;
            console.log('soruce_path', source_path)
            console.log('file_path', filepath)
            console.log('videourl',video_url)
            let is_downloadable = $('input[name="is_downloadable"]').val();
            let is_preview = $('input[name="is_preview"]').val();
            let order = $('input[name="order"]').val();
            let token = $('input[name="_token"]').val();

            $.ajax({
                url: '{{$routeSubmit}}',
                method: 'PUT',
                data: {
                    title: title,
                    description: description,
                    order: order,
                    storage: storage,
                    file_type: file_type,
                    duration: duration,
                    lesson_type: lesson_type,
                    video_url: video_url,
                    is_preview: is_preview,
                    is_downloadable: is_downloadable,
                    _token: token
                },
                success: function (response) {

                    // Handle success (e.g. close modal or show success message)
                    var modal = bootstrap.Modal.getInstance(document.getElementsByClassName('modal')[0]);
                    if (modal) modal.hide();
                    alert('Lesson update successfully!');
                    clearInput();
                },
                error: function (xhr) {
                    if (xhr.status === 422) {
                        console.log(xhr)
                        let errors = xhr.responseJSON.errors;

                        if (errors.title) {
                            $('#title_error').text(errors.title[0]).show();
                        }

                        if (errors.description) {
                            $('#description_error').text(errors.description[0]).show();
                        }

                        if (errors.storage) {
                            $('#storage_error').text(errors.storage[0]).show();
                        }

                        if (errors.videoUrl) {
                            $('#videoUrl_error').text(errors.videoUrl[0]).show();
                        }

                        if (errors.file_type) {
                            $('#file_type_error').text(errors.file_type[0]).show();
                        }

                        if (errors.lesson_type) {
                            $('#lesson_type_error').text(errors.lesson_type[0]).show();
                        }

                        if (errors.order) {
                            $('#order_error').text(errors.order[0]).show();
                        }

                        if (errors.duration) {
                            $('#duration_error').text(errors.duration[0]).show();
                        }

                    } else {
                        alert(xhr.responseJSON.message);
                    }
                }
            });
        });
    });
</script>
