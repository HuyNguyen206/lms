<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Create chapter</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <form action="{{$routeSubmit}}" method="post">
        @csrf
        <div class="row">
            <div class="col-xl-12">
                <div class="add_course_basic_info_imput">
                    <label for="#">Title *</label>
                    <input type="text" placeholder="Title" name="title">
                    <li style="color: red; display: none" id="title_error"></li>
                </div>
            </div>
            <div class="col-xl-12">
                <div class="add_course_basic_info_imput">
                    <label for="#">Order</label>
                    <input type="number" placeholder="Seo description" name="order">
                    <li style="color: red; display: none" id="order_error"></li>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
    </form>

</div>

<script>
    $(document).ready(function () {
        $('form').on('submit', function (e) {
            e.preventDefault();
            // Hide previous errors
            $('#title_error').hide().text('');
            $('#order_error').hide().text('');

            let title = $('input[name="title"]').val();
            let order = $('input[name="order"]').val();
            let token = $('input[name="_token"]').val();

            $.ajax({
                url: '{{$routeSubmit}}',
                method: 'POST',
                data: {
                    title: title,
                    order: order,
                    _token: token
                },
                success: function (response) {

                    // Handle success (e.g. close modal or show success message)
                    var modal = bootstrap.Modal.getInstance(document.getElementById('exampleModal'));
                    if (modal) modal.hide();
                    alert('Post submitted successfully!');
                    $('#title_error').hide().text('');
                    $('#order_error').hide().text('');

                    console.log(myModal)
                },
                error: function (xhr) {
                    if (xhr.status === 422) {
                        console.log(xhr)
                        let errors = xhr.responseJSON.errors;

                        if (errors.title) {
                            $('#title_error').text(errors.title[0]).show();
                        }

                        if (errors.order) {
                            $('#order_error').text(errors.order[0]).show();
                        }
                    } else {
                        alert(xhr.responseJSON.message);
                    }
                }
            });
        });
    });
</script>
