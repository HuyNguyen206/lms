<div class="tab-pane fade show active" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab" tabindex="0">
    <div class="add_course_more_info">
        <form action="{{route('instructor.courses.store', \App\Models\Course::MORE_INFO)}}" method="post">
            @csrf
            <div class="row">
                <div class="col-xl-6">
                    <div class="add_course_more_info_input">
                        <label for="#">Capacity</label>
                        <input type="text" placeholder="Capacity" name="capacity" value="{{old('capacity', $course->capacity)}}">
                        <x-input-error :messages="$errors->get('capacity')" class="mt-2" style="color: red"/>
                        <p>leave blank for unlimited</p>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="add_course_more_info_input">
                        <label for="#">Course Duration (Minutes)*</label>
                        <input type="text" placeholder="300"  name="duration" value="{{old('duration', $course->duration)}}">
                        <x-input-error :messages="$errors->get('duration')" class="mt-2" style="color: red"/>

                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="add_course_more_info_checkbox">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="flexCheckDefault" name="qna" @checked(old('qna', $course->qna))>
                            <label class="form-check-label" for="flexCheckDefault">Q&amp;A</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox"  id="flexCheckDefault2"  name="has_certificate" @checked(old('has_certificate', $course->has_certificate))>
                            <label class="form-check-label" for="flexCheckDefault2">Completion Certificate</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault3">
                            <label class="form-check-label" for="flexCheckDefault3">Patner
                                instructor</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault4">
                            <label class="form-check-label" for="flexCheckDefault4">Others</label>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4">
                    <div class="add_course_more_info_radio_box">
                        <label for="#">Category *</label>
                        <select class="select_2 select2-hidden-accessible" data-select2-id="select2-data-1-q4dl" tabindex="-1" aria-hidden="true">
                            <option value="" data-select2-id="select2-data-3-8buh"> Please Select </option>
                            @foreach($parentCategories as $parentCategory)
                                <optgroup label="{{$parentCategory->name}}">
                                    @foreach($parentCategory->categories as $category)
                                    <option @selected($category->id === old('category_id', $course->category_id)) value="{{$category->id}}" name="category_id">{{$category->name}}</option>
                                    @endforeach
                                </optgroup>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('category_id')" class="mt-2" style="color: red"/>

                    </div>
                </div>
                <div class="col-xl-4">
                    <div class="add_course_more_info_radio_box">
                        <label for="#">Level *</label>
                        <select class="select_2 select2-hidden-accessible" data-select2-id="select2-data-1-q4dl2" tabindex="-1" aria-hidden="true"  name="level_id">
                            <option value="" data-select2-id="select2-data-3-8buh"> Please Select </option>
                            @foreach($levels as $level)
                                <option @selected($level->id === old('level_id', $course->level_id)) value="{{$level->id}}">{{$level->name}}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('level_id')" class="mt-2" style="color: red"/>

                    </div>
                </div>
                <div class="col-xl-4">
                    <div class="add_course_more_info_radio_box">
                        <label for="#">Language *</label>
                        <select class="select_2 select2-hidden-accessible" data-select2-id="select2-data-1-q4dl3" tabindex="-1" aria-hidden="true">
                            <option value="" data-select2-id="select2-data-3-8buh"> Please Select </option>
                            @foreach($languages as $language)
                                <option @selected($language->id === old('language_id', $course->language_id)) value="{{$language->id}}" name="language_id">{{$language->name}}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('language_id')" class="mt-2" style="color: red"/>
                    </div>
                </div>
                <div class="col-xl-12">
                    <button type="submit" class="common_btn">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>
