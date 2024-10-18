<?php include_once ( './inc/header.php' ); ?>
<?php include_once ( './config/config.php' );

if ( validateSession () == false )
{
    header ( "Location:index.php" );
}
?>
<link href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.min.css"
    rel="stylesheet">
<style>
    body {
        background-color: #dee9ff;
    }

    .registration-form {
        padding: 50px 0;
    }

    .registration-form form {
        background-color: #fff;
        max-width: 600px;
        margin: auto;
        padding: 50px 70px;
        border-top-left-radius: 30px;
        border-top-right-radius: 30px;
        box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.075);
    }

    .registration-form .form-icon {
        text-align: center;
        background-color: #5891ff;
        border-radius: 50%;
        font-size: 40px;
        color: white;
        width: 100px;
        height: 100px;
        margin: auto;
        margin-bottom: 50px;
        line-height: 100px;
    }

    .registration-form .item {
        border-radius: 20px;
        padding: 10px 20px;
    }

    .registration-form .create-account {
        border-radius: 30px;
        padding: 10px 20px;
        font-size: 18px;
        font-weight: bold;
        background-color: #5791ff;
        border: none;
        color: white;
        margin-top: 20px;
    }

    .registration-form .social-media {
        max-width: 600px;
        background-color: #fff;
        margin: auto;
        padding: 35px 0;
        text-align: center;
        border-bottom-left-radius: 30px;
        border-bottom-right-radius: 30px;
        color: #9fadca;
        border-top: 1px solid #dee9ff;
        box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.075);
    }

    .registration-form .social-icons {
        margin-top: 30px;
        margin-bottom: 16px;
    }

    .registration-form .social-icons a {
        font-size: 23px;
        margin: 0 3px;
        color: #5691ff;
        border: 1px solid;
        border-radius: 50%;
        width: 45px;
        display: inline-block;
        height: 45px;
        text-align: center;
        background-color: #fff;
        line-height: 45px;
    }

    .registration-form .social-icons a:hover {
        text-decoration: none;
        opacity: 0.6;
    }

    @media (max-width: 576px) {
        .registration-form form {
            padding: 50px 20px;
        }

        .registration-form .form-icon {
            width: 70px;
            height: 70px;
            font-size: 30px;
            line-height: 70px;
        }
    }
</style>
<div class="container-fluid" id="mycontainer">
    <div class="container">
        <div class="registration-form">
            <form class="requires-validation" method="POST" enctype="multipart/form-data">
                <div class="form-icon">
                    <span><i class="icon icon-user"></i></span>
                </div>
                <h2>Add New Login</h2>
                <div class="form-group">
                    <input type="text" class="form-control item" name="username" placeholder="Username" required>
                    <div class="valid-feedback">Username field is valid!</div>
                    <div class="invalid-feedback">Username field cannot be blank!</div>
                </div>
                <div class="form-group mt-4">
                    <input type="password" class="form-control item" name="password" placeholder="Password" required
                        minlength="8">
                    <div class="valid-feedback">Password field is valid!</div>
                    <div class="invalid-feedback">Password field cannot be blank!</div>
                </div>
                <div class="form-group">
                    <button class="btn btn-block create-account" id="login" type="button" name="submit"><span
                            class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                        <span class="sr-only">Add New Login User</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include_once ( './inc/footer.php' ); ?>

<script>
    document.querySelector('#login').addEventListener("click", function () {
        const formData = new FormData(document.querySelector('form'))
        if (formData.get("username") === '') {
            Swal.fire({
                text: "Please Enter Username",
                icon: "error",
            })
            return;
        }
        if (formData.get("username").length < 8) {
            Swal.fire({
                text: "Please Enter Username With 8 length",
                icon: "error",
            })
            return;

        }

        if (formData.get("password") === '') {
            Swal.fire({
                text: "Please Enter Password",
                icon: "error",
            })
            return;
        }
        if (formData.get("password").length < 8) {
            Swal.fire({
                text: "Please Enter Password With 8 length",
                icon: "error",
            })
            return;

        }
        document.querySelector("#login span").classList.remove("d-none")
        document.querySelector("#login").disabled = true
        $.ajax({
            url: 'post/newLogin.php',
            type: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({ username: formData.get('username'), password: formData.get('password') }),
            success: function (response) {
                if (response.success == true) {
                    if (response.username) {
                        Swal.fire({
                            text: "Successfully Created!!!",
                            icon: "success",
                            timer: 2000,
                            showConfirmButton: false,
                            didDestroy: () => {
                                window.location.href = 'index.php'
                            }
                        })
                    } else {
                        Swal.fire({
                            text: "Username Already Exist",
                            icon: "error",
                            timer: 2000,
                            showConfirmButton: false,
                        });
                        document.querySelector("#login span").classList.add("d-none")
                        document.querySelector("#login").disabled = false
                    }
                } else {
                    Swal.fire({
                        text: "Something Want Wrong",
                        icon: "error",
                        timer: 2000,
                        showConfirmButton: false,
                    })
                    document.querySelector("#login span").classList.add("d-none")
                    document.querySelector("#login").disabled = false
                }
            },
            error: function (xhr, status, error) {
                document.querySelector("#login span").classList.add("d-none")
                document.querySelector("#login").disabled = false
            }
        });
    })


</script>