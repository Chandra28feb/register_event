<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    @include('layout.header')
    <title>Register user</title>
</head>
<body>
<div class="container text-center">
    @include('layout.navbar')
    <div class="form mt-5">
        @if (session('message'))
        <div class="alert alert-{{ session('status') }}">
            {{ session('message') }}
        </div>
        @endif
        <form  id="register_user_form">
            <ul class="errors">

            </ul>
            <div id="responseMessage" class="alert alert-danger d-none"></div>
            <div class="col-md-4 offset-4 p-5">
            <div class="form-group p-2">
                <input type="text" class="form-control" id="name" name="name" placeholder="Name">
            </div>
            <div class="form-group p-2">
                <input type="text" class="form-control" id="email" name="email" placeholder="Email">
            </div>
            <div class="form-group p-2">
                <input type="number" class="form-control" id="age" name="age" placeholder="Age">
            </div>
            <div class="form-group p-2">
                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
            </div>
            <div class="form-group p-2">
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Password Confirm">
            </div>
        <button type="submit"  class="btn btn-success mt-5">Register</button>
        </div>
        </form>
    </div>
</div>
<script>
$(document).on('submit','#register_user_form',function(event){
    event.preventDefault();
    var formData = new FormData(this);
    $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url:"/user/store",
            type:"POST",
            processData: false,
            contentType: false,
            cache: false,
            data:formData,
            success:function(response){
                $('#responseMessage').removeClass('d-none');
                $('#responseMessage').text(response.message);
                $("input").val(null);
                setTimeout(() => {
                    location.reload();
                    $('#responseMessage').addClass('d-none');
                }, 2000);
            },
            error: function(xhr) {
                    var errors = xhr.responseJSON.error;
                    $.each(errors, function(i, item) {
                        $(".errors").append("<li class='alert alert-danger'>"+item+"</li>")
                    });
                    setTimeout(() => {
                        $('.errors').empty();
                    }, 3000);
        }
    });
});
</script>
</body>
</html>