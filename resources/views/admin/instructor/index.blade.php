<x-admin.app-layout>
    @section('content')
        <div class="page-body">
            <div style="padding: 0 15px">
                <div class="card">
                    <div class="table-responsive" style="overflow: visible !important;">
                        <table class="table table-vcenter table-mobile-md card-table">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Document</th>
                                <th>Status</th>
                                <th class="w-1">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($instructors as $instructor)
                                <tr>
                                    <td data-label="Name">
                                        <div class="d-flex py-1 align-items-center">
                                            <div class="flex-fill">
                                                <div class="font-weight-medium">{{$instructor->name}}</div>
                                                <div class="text-secondary"><a href="#"
                                                                               class="text-reset">{{$instructor->email}}</a>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-secondary" data-label="Role">
                                        @if($instructor->document)
                                            <a href="{{route('admin.instructor.download-document', $instructor)}}">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                     viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                     stroke-linecap="round" stroke-linejoin="round"
                                                     class="icon icon-tabler icons-tabler-outline icon-tabler-download">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                    <path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2"/>
                                                    <path d="M7 11l5 5l5 -5"/>
                                                    <path d="M12 4l0 12"/>
                                                </svg>
                                            </a>

                                            {{$instructor->document}}
                                    </td>
                                    @endif
                                    <td class="text-secondary" data-label="Role">
                                        @php
                                            $status = $instructor->approve_instructor_status;
                                        @endphp
                                        <span class="badge
                                        @if($status === \App\Enums\ApproveStatus::APPROVED)  bg-green text-green-fg
                                        @elseif($status === \App\Enums\ApproveStatus::PENDING)  bg-yellow text-yellow-fg
                                        @else bg-red text-red-fg @endif me-1">
                                              {{$status->label()}}
                                        </span>

                                    </td>
                                    <td>
                                        <div class="btn-list flex-nowrap">
                                            <a href="#" class="btn">
                                                Edit
                                            </a>
                                            <div class="dropdown">
                                                <form id="status-form" action="">
                                                    <select data-instructor-id='{{$instructor->id}}' name="status" class="btn dropdown-toggle align-text-top status-instructor"
                                                            style="">
                                                        @foreach(\App\Enums\ApproveStatus::cases() as $status)
                                                            <option @selected($instructor->approve_instructor_status->value === $status->value) value="{{$status->value}}" class="dropdown-item"
                                                                    href="#">
                                                                {{$status->label()}}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </form>
                                            </div>
                                        </div>
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
    @section('js')
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                const selectElements = document.querySelectorAll(".status-instructor");

                selectElements.forEach(selectElement => {

                    selectElement.addEventListener("change", function () {
                        const selectedValue = this.value;
                        const instructorId = this.getAttribute("data-instructor-id");

                        fetch(`{{route('admin.instructor.update-status')}}/${instructorId}`, {
                            method: "PATCH",
                            headers: {
                                "Content-Type": "application/json",
                                "X-Requested-With": "XMLHttpRequest"
                            },
                            body: JSON.stringify({status: selectedValue, _token: '{{csrf_token()}}'})
                        })
                            .then(response => {
                                if (!response.ok) {
                                    throw new Error(`HTTP error! Status: ${response.status}`);
                                }
                                return response.json();
                            })
                            .then(data => {
                                console.log("Success:", data);
                            })
                            .catch(error => {
                                console.error("Error:", error);
                            });
                    });
                })

            });
        </script>
    @endsection
</x-admin.app-layout>
