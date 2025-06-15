<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>

<script>
    // Function to handle the display logic
    function handleSourceSelection() {
        // Get references to the elements
        var selectSource = document.getElementById('select_source');
        var sourceFile = document.getElementById('source_file');
        var sourcePath = document.getElementById('source_path');

        if(!selectSource) {
            return;
        }

        const selectedValue = parseInt(selectSource.value);
        // console.log(selectedValue)
        if (selectedValue && selectedValue === {{\App\Enums\VideoStorageType::UPLOAD->value}}) {
            // Show file input, hide text input
            sourceFile.style.display = 'block';
            sourcePath.style.display = 'none';

            // Clear the text input when switching to upload
            sourcePath.value = '';
        } else if (selectedValue === {{\App\Enums\VideoStorageType::YOUTUBE->value}}
            || selectedValue === {{\App\Enums\VideoStorageType::VIMEO->value}}
            || selectedValue === {{\App\Enums\VideoStorageType::EXTERNAL_LINK->value}}
        ) {
            // Show text input, hide file input
            sourceFile.style.display = 'none';
            sourcePath.style.display = 'block';

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

    // Wait for DOM to be fully loaded
    $(document).ready(function (){
        // Initialize Select2 if not already initialized
        if (typeof $ !== 'undefined' && $.fn.select2) {
            $('#select_source').select2();
        }
        // // Get references to the elements
        // const selectSource = document.getElementById('select_source');
        // const sourceFile = document.getElementById('source_file');
        // const sourcePath = document.getElementById('source_path');
        //
        // // Check if elements exist
        // if (!selectSource || !sourceFile || !sourcePath) {
        //     console.error('Required elements not found');
        //     return;
        // }

        // Initialize the display state
        handleSourceSelection();

        $(document).on('change', '#select_source', function () {
            // Add event listener for Select2 change event
            if (typeof $ !== 'undefined') {
                 handleSourceSelection();
                var route_prefix = "/instructor/filemanager";
                $('#lfm').filemanager('file', {prefix: route_prefix});

            } else {
                // Fallback to vanilla JavaScript event listener
                selectSource.addEventListener('change', handleSourceSelection);
            }
        })
    })

   {{-- document.addEventListener('DOMContentLoaded', function () {--}}
   {{--     @include('frontend/instructor/partial/init-upload')--}}
   {{--})--}}
</script>
