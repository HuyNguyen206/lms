<div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab" tabindex="0">
    <div class="add_course_basic_info">
        <form method="post" action="{{route('instructor.courses.store', \App\Models\Course::BASIC_INFO)}}" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-xl-12">
                    <div class="add_course_basic_info_imput">
                        <label for="#">Title *</label>
                        <input type="text" placeholder="Title" name="name" value="{{old('name')}}">
                        <x-input-error :messages="$errors->get('name')" class="mt-2" style="color: red"/>

                    </div>
                </div>
                <div class="col-xl-12">
                    <div class="add_course_basic_info_imput">
                        <label for="#">Seo description</label>
                        <input type="text" placeholder="Seo description" name="seo_description" value="{{old('seo_description')}}">
                        <x-input-error :messages="$errors->get('seo_description')" class="mt-2" style="color: red"/>

                    </div>
                </div>
                <div class="col-xl-12">
                    <div class="add_course_basic_info_imput">
                        <label for="#">Thumbnail *</label>
                        <input type="file" name="thumbnail">
                        <x-input-error :messages="$errors->get('thumbnail')" class="mt-2" style="color: red"/>

                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="add_course_basic_info_imput">
                        <label for="#">Video source <b>(optional)</b></label>
                        <select class="select_2" id="select_source" name="demo_video_storage">
                            <option value=""> Please Select </option>
                            <option @selected(old('demo_video_storage') === \App\Enums\VideoStorageType::UPLOAD->value) value="{{\App\Enums\VideoStorageType::UPLOAD->value}}">Upload</option>
                            <option @selected(old('demo_video_storage') === \App\Enums\VideoStorageType::YOUTUBE->value) value="{{\App\Enums\VideoStorageType::YOUTUBE->value}}">Youtube</option>
                            <option @selected(old('demo_video_storage') === \App\Enums\VideoStorageType::VIMEO->value) value="{{\App\Enums\VideoStorageType::VIMEO->value}}">Vimeo</option>
                            <option @selected(old('demo_video_storage') === \App\Enums\VideoStorageType::EXTERNAL_LINK->value) value="{{\App\Enums\VideoStorageType::EXTERNAL_LINK->value}}">External link</option>
                        </select>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="add_course_basic_info_imput">
                        <label for="#">Video file/url</label>
                        <input type="file" name="demo_video_url" id="source_file">
                        <input type="text" name="demo_video_url" id="source_path">
                        <x-input-error :messages="$errors->get('demo_video_url')" class="mt-2" style="color: red"/>

                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="add_course_basic_info_imput">
                        <label for="#">Price *</label>
                        <input type="text" placeholder="Price" name="price" value="{{old('price')}}">
                        <x-input-error :messages="$errors->get('price')" class="mt-2" style="color: red"/>
                        <p>Put 0 for free</p>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="add_course_basic_info_imput">
                        <label for="#">Discount Price</label>
                        <input type="text" placeholder="Price" name="discount_price" value="{{old('discount_price')}}">
                        <x-input-error :messages="$errors->get('discount_price')" class="mt-2" style="color: red"/>

                    </div>
                </div>
                <div class="col-xl-12">
                    <div class="add_course_basic_info_imput mb-0">
                        <label for="#">Description</label>
                        <textarea rows="8" placeholder="Description" name="description">{{old('description')}}</textarea>
                        <x-input-error :messages="$errors->get('description')" class="mt-2" style="color: red"/>
                        <button type="submit" class="common_btn mt_20">Save</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@section('js')
    <script>
        // Wait for DOM to be fully loaded
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize Select2 if not already initialized
            if (typeof $ !== 'undefined' && $.fn.select2) {
                $('#select_source').select2();
            }

            // Get references to the elements
            const selectSource = document.getElementById('select_source');
            const sourceFile = document.getElementById('source_file');
            const sourcePath = document.getElementById('source_path');

            // Check if elements exist
            if (!selectSource || !sourceFile || !sourcePath) {
                console.error('Required elements not found');
                return;
            }

            // Function to handle the display logic
            function handleSourceSelection() {
                const selectedValue = parseInt(selectSource.value) ;
                console.log(selectedValue)
                if (selectedValue === {{\App\Enums\VideoStorageType::UPLOAD->value}}) {
                    // Show file input, hide text input
                    sourceFile.style.display = 'inline-block';
                    sourcePath.style.display = 'none';

                    // Clear the text input when switching to upload
                    sourcePath.value = '';
                } else if (selectedValue === {{\App\Enums\VideoStorageType::YOUTUBE->value}}
                    || selectedValue === {{\App\Enums\VideoStorageType::VIMEO->value}}
                    || selectedValue === {{\App\Enums\VideoStorageType::EXTERNAL_LINK->value}}
                ) {
                    // Show text input, hide file input
                    sourceFile.style.display = 'none';
                    sourcePath.style.display = 'inline-block';

                    // Clear the file input when switching to text
                    sourceFile.value = '';
                } else {
                    // If no option is selected or "Please Select" is chosen
                    // Hide both inputs
                    sourceFile.style.display = 'none';
                    sourcePath.style.display = 'none';

                    // Clear both inputs
                    sourceFile.value = '';
                    sourcePath.value = '';
                }
            }

            // Add event listener for Select2 change event
            if (typeof $ !== 'undefined') {
                // Using jQuery/Select2 event listener
                $('#select_source').on('change', function() {
                    handleSourceSelection();
                });
            } else {

                // Fallback to vanilla JavaScript event listener
                selectSource.addEventListener('change', handleSourceSelection);
            }

            // Initialize the display state
            handleSourceSelection();
        });    </script>
@endsection
