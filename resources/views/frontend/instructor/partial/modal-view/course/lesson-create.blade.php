<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Create lesson</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <form action="{{$routeSubmit}}" method="post">
        @csrf
        <div class="row">
            <div class="col-xl-12">
                <div class="add_course_basic_info_imput">
                    <label for="#">Title *</label>
                    <input type="text" placeholder="Title" name="title">
                    <li style="color: red; display: none" id="title_error"></li>
                </div>
            </div>
            <div class="col-xl-12">
                <div class="add_course_basic_info_imput">
                    <label for="#">Description *</label>
                    <input type="text" placeholder="Title" name="description">
                    <li style="color: red; display: none" id="title_error"></li>
                </div>
            </div>
            <div class="col-xl-12">
                <div class="add_course_basic_info_imput">
                    <label for="#">Source *</label>
                    <select name="storage" id="select_source" class="select_2 select2-hidden-accessible" data-select2-id="select2-data-1-q4dl" tabindex="-1" aria-hidden="true">
                        <option value="" data-select2-id="select2-data-3-8buh"> Please Select </option>

                    @foreach(\App\Enums\VideoStorageType::labels() as $type => $name)
                            <option value="{{$type}}">{{$name}}</option>
                        @endforeach
                    </select>
                    <li style="color: red; display: none" id="title_error"></li>
                </div>
            </div>
            <div class="col-xl-12">
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

                <input type="text" name="demo_video_url" id="source_path">
            </div>
            <div class="col-xl-12">
                <div class="add_course_basic_info_imput">
                    <label for="#">File type *</label>
                    <select name="file_type" class="select_2 select2-hidden-accessible" data-select2-id="select2-data-1-q4dl2" tabindex="-1" aria-hidden="true">
                        <option value="" data-select2-id="select2-data-3-8buh"> Please Select </option>
                    @foreach(\App\Enums\FileType::labels() as $type => $name)
                            <option value="{{$type}}">{{$name}}</option>
                        @endforeach
                    </select>
                    <li style="color: red; display: none" id="title_error"></li>
                </div>
            </div>
            <div class="col-xl-12">
                <div class="add_course_basic_info_imput">
                    <label for="#">Lesson type *</label>
                    <select name="lesson_type" class="select_2 select2-hidden-accessible" data-select2-id="select2-data-1-q4dl3" tabindex="-1" aria-hidden="true">
                        <option value="" data-select2-id="select2-data-3-8buh"> Please Select </option>

                    @foreach(\App\Enums\LessonType::labels() as $type => $name)
                            <option value="{{$type}}">{{$name}}</option>
                        @endforeach
                    </select>
                    <li style="color: red; display: none" id="title_error"></li>
                </div>
            </div>
            <div class="col-xl-12">
                <div class="add_course_basic_info_imput">
                    <label for="#">Order</label>
                    <input type="number" placeholder="Seo description" name="order">
                    <li style="color: red; display: none" id="order_error"></li>
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
    $(document).ready(function () {
{{--        @include('frontend/instructor/partial/init-upload')--}}
        $('.select_2').select2(); // Basic init
        handleSourceSelection()
        $('form').on('submit', function (e) {
            e.preventDefault();
            // Hide previous errors
            $('#title_error').hide().text('');
            $('#order_error').hide().text('');

            let title = $('input[name="title"]').val();
            let order = $('input[name="order"]').val();
            let token = $('input[name="_token"]').val();

            $.ajax({
                url: '{{$routeSubmit}}',
                method: 'POST',
                data: {
                    title: title,
                    order: order,
                    _token: token
                },
                success: function (response) {

                    // Handle success (e.g. close modal or show success message)
                    var modal = bootstrap.Modal.getInstance(document.getElementById('exampleModal'));
                    if (modal) modal.hide();
                    alert('Post submitted successfully!');
                    $('#title_error').hide().text('');
                    $('#order_error').hide().text('');

                    console.log(myModal)
                },
                error: function (xhr) {
                    if (xhr.status === 422) {
                        console.log(xhr)
                        let errors = xhr.responseJSON.errors;

                        if (errors.title) {
                            $('#title_error').text(errors.title[0]).show();
                        }

                        if (errors.order) {
                            $('#order_error').text(errors.order[0]).show();
                        }
                    } else {
                        alert(xhr.responseJSON.message);
                    }
                }
            });
        });
    });
</script>
