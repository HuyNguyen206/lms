<div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab" tabindex="0">
    <div class="add_course_basic_info">
        <form method="post" action="{{route('instructor.courses.update', [$course, \App\Models\Course::BASIC_INFO])}}" enctype="multipart/form-data">
            @csrf
            @method('patch')
            <div class="row">
                <div class="col-xl-12">
                    <div class="add_course_basic_info_imput">
                        <label for="#">Title *</label>
                        <input type="text" placeholder="Title" name="name" value="{{old('name', $course->name)}}">
                        <x-input-error :messages="$errors->get('name')" class="mt-2" style="color: red"/>

                    </div>
                </div>
                <div class="col-xl-12">
                    <div class="add_course_basic_info_imput">
                        <label for="#">Seo description</label>
                        <input type="text" placeholder="Seo description" name="seo_description" value="{{old('seo_description', $course->seo_description)}}">
                        <x-input-error :messages="$errors->get('seo_description')" class="mt-2" style="color: red"/>

                    </div>
                </div>
                <div class="col-xl-12">
                    <div class="add_course_basic_info_imput">
                        <label for="#">Thumbnail *</label>
                        <input type="file" name="thumbnail">
                        @if($thumbnail = $course->getThumbnail())
                            <img src="{{$thumbnail}}" alt="" style="width: 200px !important;">
                        @endif
                        <x-input-error :messages="$errors->get('thumbnail')" class="mt-2" style="color: red"/>

                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="add_course_basic_info_imput">
                        <label for="#">Video source <b>(optional)</b></label>
                        <select class="select_2" id="select_source" name="demo_video_storage">
                            <option value=""> Please Select</option>
                            <option
                                @selected(old('demo_video_storage', $course->demo_video_storage) == \App\Enums\VideoStorageType::UPLOAD->value) value="{{\App\Enums\VideoStorageType::UPLOAD->value}}">
                                Upload
                            </option>
                            <option
                                @selected(old('demo_video_storage', $course->demo_video_storage) == \App\Enums\VideoStorageType::YOUTUBE->value) value="{{\App\Enums\VideoStorageType::YOUTUBE->value}}">
                                Youtube
                            </option>
                            <option
                                @selected(old('demo_video_storage', $course->demo_video_storage) == \App\Enums\VideoStorageType::VIMEO->value) value="{{\App\Enums\VideoStorageType::VIMEO->value}}">
                                Vimeo
                            </option>
                            <option
                                @selected(old('demo_video_storage', $course->demo_video_storage) == \App\Enums\VideoStorageType::EXTERNAL_LINK->value) value="{{\App\Enums\VideoStorageType::EXTERNAL_LINK->value}}">
                                External link
                            </option>
                        </select>
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
                                <input id="thumbnail" class="form-control" type="text" name="filepath" style="width: 200px" value="{{old('demo_video_url', $course->demo_video_url)}}">
                            </div>
                            <div id="holder" style="margin-top:15px;max-height:100px; width: 100px">
                            </div>

                        </div>
                    </div>

                    <input type="text" name="demo_video_url" id="source_path">
                    <x-input-error :messages="$errors->get('demo_video_url')" class="mt-2" style="color: red"/>

                </div>

                <div class="col-xl-6">
                    <div class="add_course_basic_info_imput">
                        <label for="#">Price *</label>
                        <input type="text" placeholder="Price" name="price" value="{{old('price', $course->price)}}" >
                        <x-input-error :messages="$errors->get('price')" class="mt-2" style="color: red"/>
                        <p>Put 0 for free</p>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="add_course_basic_info_imput">
                        <label for="#">Discount Price</label>
                        <input type="text" placeholder="Price" name="discount_price" value="{{old('discount_price', $course->discount_price)}}">
                        <x-input-error :messages="$errors->get('discount_price')" class="mt-2" style="color: red"/>

                    </div>
                </div>
                <div class="col-xl-12">
                    <div class="add_course_basic_info_imput mb-0">
                        <label for="#">Description</label>
                        <textarea rows="8" placeholder="Description" name="description">{{old('description', $course->description)}}</textarea>
                        <x-input-error :messages="$errors->get('description')" class="mt-2" style="color: red"/>
                        <button type="submit" class="common_btn mt_20">Save</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@section('js-init-upload')
    @include('frontend/instructor/partial/init-upload')
@endsection
