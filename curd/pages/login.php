<?php include_once ( 'inc/header.php' ); ?>
<?php include_once ( 'config/config.php' );

?>

<style>
    .form-holder {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
        min-height: 100vh;
    }

    .form-content .form-items {
        background-color: #152733d4;
        border: 3px solid #fff;
        padding: 40px;
        display: inline-block;
        width: 100%;
        min-width: 540px;
        -webkit-border-radius: 10px;
        -moz-border-radius: 10px;
        border-radius: 10px;
        text-align: left;
        -webkit-transition: all 0.4s ease;
        transition: all 0.4s ease;
    }

    .form-content h3 {
        color: #fff;
        text-align: left;
        font-size: 28px;
        font-weight: 600;
        margin-bottom: 5px;
    }

    .form-content h3.form-title {
        margin-bottom: 30px;
    }

    .form-content p {
        color: #fff;
        text-align: left;
        font-size: 17px;
        font-weight: 300;
        line-height: 20px;
        margin-bottom: 30px;
    }


    .form-content label,
    .was-validated .form-check-input:invalid~.form-check-label,
    .was-validated .form-check-input:valid~.form-check-label {
        color: #fff;
    }

    .form-content input[type=text],
    .form-content input[type=password],
    .form-content input[type=email],
    .form-content select {
        width: 100%;
        padding: 9px 20px;
        text-align: left;
        border: 0;
        outline: 0;
        border-radius: 6px;
        background-color: #fff;
        font-size: 15px;
        font-weight: 300;
        color: #8D8D8D;
        -webkit-transition: all 0.3s ease;
        transition: all 0.3s ease;
        margin-top: 16px;
    }

    .form-content textarea {
        position: static !important;
        width: 100%;
        padding: 8px 20px;
        border-radius: 6px;
        text-align: left;
        background-color: #fff;
        border: 0;
        font-size: 15px;
        font-weight: 300;
        color: #8D8D8D;
        outline: none;
        resize: none;
        height: 120px;
        -webkit-transition: none;
        transition: none;
        margin-bottom: 14px;
    }

    .form-content textarea:hover,
    .form-content textarea:focus {
        border: 0;
        background-color: #ebeff8;
        color: #8D8D8D;
    }

    .mv-up {
        margin-top: -9px !important;
        margin-bottom: 8px !important;
    }

    .invalid-feedback {
        color: #ff606e;
    }

    .valid-feedback {
        color: #2acc80;
    }
</style>
<div class="form-body">
    <div class="row">
        <div class="form-holder">
            <div class="form-content">
                <div class="form-items">
                    <h3>Login</h3>
                    <form class="requires-validation" novalidate>
                        <div class="col-md-12">
                            <input class="form-control" type="text" name="username" placeholder="Username" required>
                            <div class="valid-feedback">Username field is valid!</div>
                            <div class="invalid-feedback">Username field cannot be blank!</div>
                        </div>

                        <div class="col-md-12">
                            <input class="form-control" type="password" name="password" placeholder="Password" required>
                            <div class="valid-feedback">Password field is valid!</div>
                            <div class="invalid-feedback">Password field cannot be blank!</div>
                        </div>


                        <div class="form-button mt-3">
                            <button id="submit" type="submit" class="btn btn-primary"><span
                                    class="spinner-border spinner-border-sm d-none" role="status"
                                    aria-hidden="true"></span>
                                <span class="sr-only">Login</span>Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

    (function () {
        'use strict'
        const forms = document.querySelectorAll('.requires-validation')
        Array.from(forms)
            .forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    event.preventDefault()
                    if (!form.checkValidity()) {
                        event.stopPropagation()
                    } else {
                        document.querySelector("#submit span").classList.remove("d-none")
                        document.querySelector("#submit").disabled = true
                        const formData = new FormData(document.querySelector('form'))
                        $.ajax({
                            url: 'post/userLogin.php',
                            type: 'POST',
                            contentType: 'application/json',
                            data: JSON.stringify({ username: formData.get('username'), password: formData.get('password') }),
                            success: function (response) {
                                if (response.success == true) {
                                    Swal.fire({
                                        text: "Successfully Login!!!",
                                        icon: "success",
                                        timer: 2000,
                                        showConfirmButton: false,
                                        didDestroy: () => {
                                            window.location.href = `index.php`
                                        }
                                    })
                                } else {
                                    Swal.fire({
                                        text: "Something Want Wrong",
                                        icon: "error",
                                        timer: 2000,
                                        showConfirmButton: false,
                                    })
                                    document.querySelector("#submit span").classList.add("d-none")
                                    document.querySelector("#submit").disabled = false
                                }
                            },
                            error: function (xhr, status, error) {
                                document.querySelector("#submit span").classList.add("d-none")
                                document.querySelector("#submit").disabled = false
                            }
                        });
                    }
                    form.classList.add('was-validated')
                }, false)
            })
    })()

</script>