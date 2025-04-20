<x-admin.app-layout>
    @section('content')
        <div class="page-body">
            <div style="padding: 0 15px">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Levels</h3>
                        <div class="card-actions">
                            <a href="{{route('admin.courses.levels.index')}}" class="btn btn-primary">
                                <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M12 5l0 14"></path><path d="M5 12l14 0"></path></svg>
                                Back
                            </a>
                        </div>
                    </div>
                    <div class="table-responsive mt-4" style="overflow: visible !important;">
                        <div class="container">
                            <form action="{{route('admin.courses.levels.update', $level)}}" method="post">
                                @csrf
                                @method('put')
                                <div class="mb-3">
                                    <label class="form-label">Name</label>
                                    <input type="text" class="form-control" name="name" placeholder="Language name" value="{{old('name', $level->name)}}">
                                    <x-input-error :messages="$errors->get('name')" class="mt-2" style="color: red"/>
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
