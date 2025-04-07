<x-admin.app-layout>
    @section('content')
        <div class="page-body">
            <div style="padding: 0 15px">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Languages</h3>
                        <div class="card-actions">
                            <a href="{{route('admin.courses.languages.create')}}" class="btn btn-primary">
                                <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M12 5l0 14"></path><path d="M5 12l14 0"></path></svg>
                                Add new
                            </a>
                        </div>
                    </div>
                    <div class="table-responsive" style="overflow: visible !important;">
                        <table class="table table-vcenter table-mobile-md card-table">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th class="w-1">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($languages as $language)
                                <tr>
                                    <td data-label="Name">
                                        <div class="d-flex py-1 align-items-center">
                                            <div class="flex-fill">
                                                <div class="font-weight-medium">{{$language->name}}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-secondary" data-label="Role">
                                        <a href="{{route('admin.courses.languages.edit', $language->id)}}">Edit</a>
                                        <form method="POST" action="{{ route('admin.courses.languages.destroy', $language->id) }}">
                                            @method('delete')
                                            @csrf

                                            <x-responsive-nav-link class="dropdown-item" :href="route('admin.courses.languages.destroy', $language->id)"
                                                                   onclick="event.preventDefault();
                                                                   if(!confirm('Are you sure?')) return;
                                                this.closest('form').submit();">
                                                {{ __('Delete') }}
                                            </x-responsive-nav-link>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4">
                                        No data
                                    </td>
                                </tr>
                            @endforelse

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endsection
</x-admin.app-layout>
