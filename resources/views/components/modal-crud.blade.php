<div>
    <a href="#" {{ $attributes }} data-bs-toggle="modal" data-bs-target="#exampleModal_{{$idButton}}" id="{{$idButton}}">
        {{ $slot }}
    </a>
    @if($isMerged)
        <x-modal-popup :idButton="$idButton"></x-modal-popup>
    @endif
{{--    <!-- Modal -->--}}
{{--    <div class="modal fade" id="exampleModal_{{$idButton}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">--}}
{{--        <div class="modal-dialog modal-dialog-centered">--}}
{{--            <div class="modal-content">--}}

{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
</div>

@push('js_extend')
    <script>
        $(document).ready(function () {
            $('#{{$idButton}}').on('click', function (e) {
                e.preventDefault(); // prevent default anchor behavior
                var modalContent = $('#exampleModal_{{$idButton}} .modal-content');

                // Show loading indicator
                modalContent.html('<div class="text-center p-4">Loading...</div>');
                // Send AJAX request to fetch content
                $.ajax({
                    url: '{{$routeView}}?route-submit={{$routeSubmit}}',
                    type: 'GET',
                    success: function (response) {
                        modalContent.html(response); // Replace content with response HTML
                    },
                    error: function (xhr, status, error) {
                        modalContent.html('<div class="text-danger p-4">An error occurred while loading content.</div>');
                    }
                });
            });
        });
    </script>
@endpush

@push('css_extend')
    <style>
        span.select2-container--open {
            z-index: 9999999;
        }
    </style>
@endpush
