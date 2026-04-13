<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="row">
        <form action="" id="save_employee">
            @csrf
            <table class="table table-responsive">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>State</th>
                        <th>Designation</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="body_append">
                    <tr class="table_row">
                        <td>
                            <input type="text" name="name[]" class="form-control" placeholder="Name">
                            <div class="invalid-feedback"></div>
                        </td>
                        <td>
                            <select name="state[]" class="form-control">
                                <option value="">Select</option>
                                <option value="Delhi">Delhi</option>
                                <option value="Mumbai">Mumbai</option>
                                <option value="Noida">Noida</option>
                                <option value="Jaipur">Jaipur</option>
                            </select>
                            <div class="invalid-feedback"></div>
                        </td>
                        <td>
                            <input type="text" name="designation[]" class="form-control" placeholder="Designation">
                            <div class="invalid-feedback"></div>
                        </td>
                        <td>
                            <button type="button" class="btn delete">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
            <button type="button" id="add-more" class="">Add More</button>
            <button type="submit" id="save" class="">Save</button>
        </form>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script>
        // Add more rows functionality
        $('#add-more').click(function(e) {
            e.preventDefault();
            $('#body_append').append(`
                <tr>
                    <td>
                        <input type="text" name="name[]" class="form-control" placeholder="Name">
                        <div class="invalid-feedback"></div>
                    </td>
                    <td>
                        <select name="state[]" class="form-control">
                            <option value="">Select</option>
                            <option value="Delhi">Delhi</option>
                            <option value="Mumbai">Mumbai</option>
                            <option value="Noida">Noida</option>
                            <option value="Jaipur">Jaipur</option>
                        </select>
                        <div class="invalid-feedback"></div>
                    </td>
                    <td>
                        <input type="text" name="designation[]" class="form-control" placeholder="Designation">
                        <div class="invalid-feedback"></div>
                    </td>
                    <td>
                        <button type="button" class="btn btn- delete">Delete</button>
                    </td>
                </tr>
            `);
        });

        $('#body_append').on('click', '.delete', function() {
            $(this).closest('tr').remove();
        });

        var form = $('#save_employee');
        $('#save_employee').submit(function(e) {
            e.preventDefault();
            isValid = true;
            $('#body_append tr').each(function() {
                $(this).find('input, select').each(function () {
                    if (!$(this).val()) {
                        isValid = false;
                        $(this).addClass('is-invalid');
                        $(this).next('div.invalid-feedback').text('This field is required');
                    } else {
                        $(this).removeClass('is-invalid');
                        $(this).next('div.invalid-feedback').text('');
                    }
                });
                
            });

            /* $.ajax({
        type: "POST",
        url: '/employee_save',
        dataType: "json",
        // async: false,
        data: form.serialize()+'&_token={{ csrf_token() }}',
        // contentType: "application/json; charset=utf-8",
        success: function (data) {
            console.log(data);
            if(data.status){
                errors = data.error;
                for(let key in errors){
                    errors[key].forEach(function(errorGroup, index){
                        form.find(`[name="${key}][]"`).eq('');
                    });
                }

            }
            // Success = true;
        },
        error: function (textStatus, errorThrown) {
            // Success = false;
        }
    }); */
        });
    </script>
</body>
</html>
