<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Document</title>


    <style>
        .error-msg {
            margin: 10px 0;
            padding: 10px;
            border-radius: 3px 3px 3px 3px;
        }

        .error-msg {
            color: #D8000C;
            background-color: #FFBABA;
        }

        .btn {
            background: #283862;
            color: #fff;
        }

        .btn:hover {
            color: #e0e0e0;
            transition: ease-in-out 0.3s
        }

    </style>
</head>

<body class=" bg-light">
    <div class="pt-5 m-auto w-50">
        <form id="user-form" class="p-4 mt-5 bg-white border shadow-sm rounded-1">
            @csrf
            <div class="text-center fs-4 text-dark ">Login</div>

            <div class="mb-2">
                <label for="email">Email</label>
                <input type="text" id="email" class="form-control" name="email">
                <span id="email-error" class="text-danger"></span>
            </div>
            <div class="mb-3">
                <label for="password">Password</label>
                <input type="text" id="password" class="form-control" name="password">
                <span id="password-error" class="text-danger" class="form-control"></span>
            </div>



            <div class="error-msg" style="display: none">
                <i class="fa fa-times-circle"></i>
                <span id="error-msg"></span>
            </div>

            <div class="text-center">
                <input type="submit" class=" w-100 btn">
            </div>
            @include('dashboard-layouts.inc.loader')

        </form>

    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <script>
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        $("#user-form").on("submit", function(e) {
            $('#loader').removeClass('hidden')

            e.preventDefault();
            $("#email-error").text("");
            $("#password-error").text("");

            email = $("#email").val();
            password = $("#password").val();

            $.ajax({
                url: '{{ route('loginRequest') }}',
                type: "POST",
                data: {
                    email: email,
                    password: password,
                },
                success: function(response) {
                    $('#loader').addClass('hidden')

                    // console.log(response);
                    if (response.status_code == 200) {
                        window.location.href = "/admin";
                    }

                },
                error: function(error) {
                    $('#loader').addClass('hidden')

                    if (error.status == 422) {
                        $("#email-error").text(error.responseJSON.errors.email);
                        $("#password-error").text(error.responseJSON.errors.password);
                    } else if (error.status == 401) {
                        $('.error-msg').css("display", "block")
                        $("#error-msg").text(error.responseJSON.message);
                    } else if (error.status == 500) {
                        $('.error-msg').css("display", "block")
                        $("#error-msg").text("Login will be Pending for five minutes");
                        $("#email").prop('disabled', true);
                        $("#password").prop('disabled', true);

                    }
                },
            });

        });

    </script>

</body>

</html>
