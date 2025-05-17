<div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab" tabindex="0">
    <div class="add_course_basic_info">
        <form method="post" action="{{route('instructor.courses.store', \App\Models\Course::BASIC_INFO)}}" enctype="multipart/form-data">
            @csrf
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
                            <img src="{{$thumbnail}}" alt="" style="width: 200px">
                        @endif
                        <x-input-error :messages="$errors->get('thumbnail')" class="mt-2" style="color: red"/>

                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="add_course_basic_info_imput">
                        <label for="#">Demo Video Storage <b>(optional)</b></label>
                        <select class="select_js">
                            <option value=""> Please Select </option>
                            <option value="">Red</option>
                            <option value="">Black</option>
                            <option value="">Orange</option>
                            <option value="">Rose Gold</option>
                            <option value="">Pink</option>
                        </select><div class="nice-select select_js" tabindex="0"><span class="current"> Please Select </span><ul class="list"><li data-value="" class="option selected"> Please Select </li><li data-value="" class="option">Red</li><li data-value="" class="option">Black</li><li data-value="" class="option">Orange</li><li data-value="" class="option">Rose Gold</li><li data-value="" class="option">Pink</li></ul></div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="add_course_basic_info_imput">
                        <label for="#">Path</label>
                        <input type="file" name="demo_video_storage">
                        <x-input-error :messages="$errors->get('demo_video_storage')" class="mt-2" style="color: red"/>

                    </div>
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
