<div>
    <a href="#" {{ $attributes }} data-bs-toggle="modal" data-bs-target="#exampleModal_{{$idButton}}" id="{{$idButton}}">
        {{ $slot }}
    </a>
    @if($isMerged)
        <x-modal-popup :idButton="$idButton"></x-modal-popup>
    @endif

</div>

@push('js_extend')
    <script>
        $(document).ready(function () {
            $('#{{$idButton}}').on('click', function (e) {
                e.preventDefault(); // prevent default anchor behavior
                var modalContent = $('#exampleModal_{{$idButton}} .modal-content');
                var routeUrl = '{{$routeView}}?route-submit={{$routeSubmit}}';

                @if($extraParams)
                    routeUrl += '&{!!  $extraParams !!}';
                @endif

                // Show loading indicator
                modalContent.html('<div class="text-center p-4">Loading...</div>');
                // Send AJAX request to fetch content
                $.ajax({
                    url: routeUrl,
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
