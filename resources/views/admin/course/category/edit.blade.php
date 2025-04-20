<x-admin.app-layout>
    @section('content')
        <div class="page-body">
            <div style="padding: 0 15px">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Category</h3>
                        <div class="card-actions">
                            <a href="{{route('admin.courses.categories.index')}}" class="btn btn-primary">
                                <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M12 5l0 14"></path><path d="M5 12l14 0"></path></svg>
                                Back
                            </a>
                        </div>
                    </div>
                    <div class="table-responsive mt-4" style="overflow: visible !important;">
                        <div class="container">
                            <form action="{{route('admin.courses.categories.update', $category->id)}}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('patch')
                                <div class="mb-3">
                                    <label class="form-label">Name</label>
                                    <input type="text" class="form-control" name="name" placeholder="Language name" value="{{old('name', $category->name)}}">
                                    <x-input-error :messages="$errors->get('name')" class="mt-2" style="color: red"/>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Icon</label>
                                    <input type="file" class="form-control" name="icon">
                                    <x-input-error :messages="$errors->get('icon')" class="mt-2"/>
                                    @if($icon = $category->getImage('icon'))
                                        <img src="{{$icon}}" alt="" style="width: 200px">
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Image</label>
                                    <input type="file" class="form-control" name="image">
                                    <x-input-error :messages="$errors->get('image')" class="mt-2"/>
                                    @if($image = $category->getImage('image'))
                                        <img src="{{$image}}" alt="" style="width: 200px">
                                    @endif

                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Parent category</label>
                                    <select name="parent_id" id="">
                                        <option value="">Select parent category</option>
                                        @foreach($categories as $categoryOption)
                                            <option @selected(old('parent_id', $category->parentCategory?->id) === $categoryOption->id) value="{{$categoryOption->id}}">{{$categoryOption->name}}</option>
                                        @endforeach
                                    </select>
                                    <x-input-error :messages="$errors->get('parent_id')" class="mt-2"/>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Show at trending</label>
                                    <input type="checkbox" name="is_show_at_trending" @checked(old('is_show_at_trending', $category->is_show_at_trending)) placeholder="Language name">
                                    <x-input-error :messages="$errors->get('is_show_at_trending')" class="mt-2" style="color: red"/>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Is enable</label>
                                    <input type="checkbox" name="is_enable" @checked(old('is_enable')) placeholder="Language name">
                                    <x-input-error :messages="$errors->get('is_enable')" class="mt-2" style="color: red"/>
                                </div>
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary ms-auto">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
</x-admin.app-layout>
