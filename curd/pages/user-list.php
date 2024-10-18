<?php include_once ( 'inc/header.php' ); ?>
<?php include_once ( 'config/config.php' ); ?>

<style>
  p {
    color: #b3b3b3;
    font-weight: 300;
  }

  a {
    -webkit-transition: .3s all ease;
    -o-transition: .3s all ease;
    transition: .3s all ease;
  }

  a,
  a:hover {
    text-decoration: none !important;
  }

  .content {
    padding: 7rem 0;
  }

  h2 {
    font-size: 20px;
    color: #fff;
  }

  .custom-table {
    min-width: 900px;
    border: 20px;
  }

  .custom-table thead tr,
  .custom-table thead th {
    border-top: none;
    border-bottom: none !important;
  }

  .custom-table tbody th,
  .custom-table tbody td {
    color: #777;
    font-weight: 400;
    padding-bottom: 20px;
    padding-top: 20px;
    font-weight: 300;
  }

  .custom-table tbody th small,
  .custom-table tbody td small {
    color: #b3b3b3;
    font-weight: 300;
  }

  .custom-table tbody tr:not(.spacer) {
    border-radius: 7px;
    overflow: hidden;
    -webkit-transition: .3s all ease;
    -o-transition: .3s all ease;
    transition: .3s all ease;
  }

  .custom-table tbody tr:not(.spacer):hover {
    -webkit-box-shadow: 0 2px 10px -5px rgba(0, 0, 0, 0.1);
    box-shadow: 0 2px 10px -5px rgba(0, 0, 0, 0.1);
  }

  .custom-table tbody tr th,
  .custom-table tbody tr td {
    background: #25252b;
    border: none;
    -webkit-transition: .3s all ease;
    -o-transition: .3s all ease;
    transition: .3s all ease;
  }

  .custom-table tbody tr th a,
  .custom-table tbody tr td a {
    color: #b3b3b3;
  }

  .custom-table tbody tr td .dropdown a {
    color: #000;
  }

  .custom-table tbody tr th:first-child,
  .custom-table tbody tr td:first-child {
    border-top-left-radius: 0px;
    border-bottom-left-radius: 0px;
  }

  .custom-table tbody tr th:last-child,
  .custom-table tbody tr td:last-child {
    border-top-right-radius: 0px;
    border-bottom-right-radius: 0px;
  }

  .custom-table tbody tr.spacer td {
    padding: 0 !important;
    height: 3px;
    border-radius: 0 !important;
    background: transparent !important;
  }

  .custom-table tbody tr.active th,
  .custom-table tbody tr.active td,
  .custom-table tbody tr:hover th,
  .custom-table tbody tr:hover td {
    color: #fff;
    background: #2e2e36;
  }

  .custom-table tbody tr.active th a,
  .custom-table tbody tr.active td a,
  .control {
    display: block;
    position: relative;
    cursor: pointer;
    font-size: 18px;
  }

  .control input {
    position: absolute;
    z-index: -1;
    opacity: 0;
  }

  .control__indicator {
    position: absolute;
    top: 2px;
    left: 0;
    height: 20px;
    width: 20px;
    border-radius: 4px;
    border: 2px solid #3f3f47;
    background: transparent;
  }

  .control--radio .control__indicator {
    border-radius: 50%;
  }

  .control:hover input~.control__indicator,
  .control input:focus~.control__indicator {
    border: 2px solid #007bff;
  }

  .control input:checked~.control__indicator {
    border: 2px solid #007bff;
    background: #007bff;
  }

  .control input:disabled~.control__indicator {
    background: #e6e6e6;
    opacity: 0.6;
    pointer-events: none;
    border: 2px solid #ccc;
  }

  .control input~.control__indicator+i {
    visibility: hidden;
  }

  .control input:checked~.control__indicator+i {
    color: #fff;
    z-index: 9999;
    position: relative;
    visibility: visible;
  }

  .control--checkbox .control__indicator:after {
    top: 50%;
    left: 50%;
    -webkit-transform: translate(-50%, -52%);
    -ms-transform: translate(-50%, -52%);
    transform: translate(-50%, -52%);
  }

  .control--checkbox input:disabled~.control__indicator:after {
    border-color: #7b7b7b;

  }

  .control--checkbox input:disabled:checked~.control__indicator {
    background-color: #007bff;
    opacity: .2;
    border: 2px solid #007bff;
  }

  label {
    color: #000;
  }
</style>
<div class="conatainer-fluid">
  <div class="container mt-4">
    <h3 class="text-center text-white">All Users</h3>
    <div class="mt-4 mb-2">
      <a href="new-user.php" class="btn btn-info">Add New User Subscription</a>
      <a href="add-user-access.php" class="btn btn-warning ms-4">Add New User Access</a>
      <button class="btn btn-secondary ms-4" id="send-bulk-subscription"><span
          class="spinner-border spinner-border-sm me-2 d-none" role="status" aria-hidden="true"></span>Send Bulk
        Subscription</button>
      <a href="logout.php" class="btn btn-danger mb-2" style="float: right;">Logout</a>
    </div>
    <div class="custom-table-responsive">

      <table class="table custom-table">
        <thead>
          <tr>

            <th scope="col">
              <label class="control control--checkbox" id="select-all-subscription">
                <input type="checkbox" />
                <div class="control__indicator"></div>
                <i class="fa-solid fa-check"></i>
              </label>
            </th>

            <th>Sno
              <?php $sno = '1'; ?>
            </th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email Address</th>
            <th>phone Number</th>
            <th>End Of Subscription</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>

          <?php
          $get_all_users = "SELECT * FROM user";
          $conn          = connection ();
          $res           = mysqli_query ( $conn, $get_all_users );
          if ( mysqli_num_rows ( $res ) > 0 )
          {
            $i = 1;
            while ( $rs = mysqli_fetch_assoc ( $res ) )
            {
              ?>
              <tr scope="row">
                <th scope="row">
                  <label class="control control--checkbox">
                    <input type="checkbox" class="select-subscription" value="<?php echo $rs[ 'email_address' ]; ?>" />
                    <div class="control__indicator"></div>
                    <i class="fa-solid fa-check"></i>
                  </label>
                </th>
                <td>
                  <?php echo $i++ ?>
                </td>
                <td>
                  <?php echo $rs[ 'first_name' ]; ?>
                </td>
                <td>
                  <?php echo $rs[ 'last_name' ]; ?>
                </td>
                <td>
                  <?php echo $rs[ 'email_address' ]; ?>
                </td>
                <td>
                  <?php echo $rs[ 'phone_number' ]; ?>
                </td>
                <td>
                  <?php echo $rs[ 'end_of_subscription' ]; ?>
                </td>
                <td>
                  <div class="dropdown">
                    <button class="btn btn-link dropdown-toggle" type="button" data-bs-toggle="dropdown"
                      aria-expanded="false">
                      Action
                    </button>
                    <ul class="dropdown-menu">
                      <li><a class="dropdown-item updateUser" type="button" data-id="<?= $rs[ 'id' ] ?>">Edit</a></li>
                      <li><a class="dropdown-item deleteUser" type="button" data-id="<?= $rs[ 'id' ] ?>">Delete</a></li>
                      <li><a class="dropdown-item updateEoSUser" type="button" data-id="<?= $rs[ 'id' ] ?>">Set End Of
                          Subscription</a></li>
                      <li><a class="dropdown-item reminder" type="button" data-id="<?= $rs[ 'id' ] ?>"
                          data-email="<?= $rs[ 'email_address' ] ?>">Send Reminder</a></li>
                    </ul>
                  </div>
                </td>
              </tr>
              <?php
            }

          }
          else
          {
            ?>
            <tr>
              <td colspan="8" style="text-align: center;">No Data Found</td>
            </tr>
            <?php
          }
          ?>

        </tbody>
      </table>
    </div>

    <div class="modal modal-lg" id="updateUserData" tabindex="-1" aria-labelledby="staticBackdropLabel"
      aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit User Information</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form id="updateUserDataForm">
            <div class="modal-body">
              <div class="row">
                <div class="col-lg-12 mx-auto">
                  <div class="card mt-2 mx-auto p-4 bg-light">
                    <div class="card-body bg-light">
                      <div class="container">
                        <form id="contact-form" role="form">
                          <div class="controls">
                            <div class="row">
                              <div class="col-md-6">
                                <div class="form-group">
                                  <input type="hidden" name="user_id">
                                  <label for="form_name">Firstname *</label>
                                  <input id="form_name" type="text" name="first_name" class="form-control mt-1"
                                    placeholder="Please enter your firstname *" required="required"
                                    data-error="Firstname is required." />
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="form_lastname">Lastname *</label>
                                  <input id="form_lastname" type="text" name="last_name" class="form-control mt-1"
                                    placeholder="Please enter your lastname *" required="required"
                                    data-error="Lastname is required." />
                                </div>
                              </div>
                            </div>
                            <div class="row mt-3">
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="form_email">Email *</label>
                                  <input id="form_email" type="email" name="email" class="form-control mt-1"
                                    placeholder="Please enter your email *" required="required"
                                    data-error="Valid email is required." />
                                </div>
                              </div>

                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="phone_number">Phone Number *</label>
                                  <input id="phone_number" type="phone" name="phone_number" class="form-control mt-1"
                                    placeholder="Please enter your Phone Number *" required="required"
                                    data-error="Valid Phone Number is required." />
                                </div>
                              </div>

                            </div>
                            <div class="row mt-4">
                              <div class="col-md-12">
                                <div class="form-group">
                                  <label for="datepicker">End Of Subscription:</label>
                                  <input type="text" name="date" class="form-control mt-1" id="datepicker"
                                    placeholder="Enter End Of Subscription" />
                                </div>
                              </div>
                            </div>
                        </form>
                      </div>
                    </div>
                  </div>
                  <!-- /.8 -->
                </div>
                <!-- /.row-->
              </div>

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary" id="updateUser">Update</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="endOfSubscription" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Update End Of Subscription</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12 mx-auto" id="myform">
              <div class="form-group">
                <label>End Of Subscription:</label>
                <input type="hidden" name="user_id">
                <input type="text" name="date" class="form-control" id="datepicker2"
                  placeholder="Enter End Of Subscription">
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="updateEoSUser">Update</button>
          </div>
      </form>
    </div>
  </div>
</div>
</div>

<div class="modal fade" id="sendReminder" tabindex="-1" aria-hidden="true" data-bs-toggle="modal"
  data-bs-target="#staticBackdrop">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        Sending Reminder...
      </div>
    </div>
  </div>
</div>

<script>
  $(document).ready(function () {

    $('.updateUser').click(function () {
      $('input[name="user_id"]').val($(this).data('id'))
      $('#updateUserData').modal('show')

      $.ajax({
        url: 'post/getUserDetails.php',
        type: 'POST',
        contentType: 'application/json',
        data: JSON.stringify({ uid: $('input[name="user_id"]').val() }),
        success: function (response) {
          // Handle the response data here
          // console.log(response['0'])
          if (response.type == 'success') {
            $('input[name="first_name"]').val(response['0']['first_name'])
            $('input[name="last_name"]').val(response['0']['last_name'])
            $('input[name="email"]').val(response['0']['email_address'])
            $('input[name="phone_number"]').val(response['0']['phone_number'])
            $('#datepicker').val(response['0']['end_of_subscription'])
          } else {
            Swal.fire({
              text: "Something Want Wrong",
              icon: "error"
            })
          }
        },
        error: function (xhr, status, error) {
          // Handle errors
          console.error('Error:', error);
        }
      });

    })

    $('.updateEoSUser').click(function () {
      $('input[name="user_id"]').val($(this).data('id'))
      $('#endOfSubscription').modal('show')
    })

    $('#updateUser').click(function () {
      const data = new FormData(document.querySelector('#updateUserDataForm'))
      let json = {}
      data.forEach((value, key) => {
        json[key] = value;
      });

      $.ajax({
        url: 'post/updateUser.php',
        type: 'POST',
        contentType: 'application/json',
        data: JSON.stringify(json),
        success: function (response) {
          console.log(response)
          // Handle the response data here
          if (response.success == true) {
            window.location.reload()
          } else {
            Swal.fire({
              text: "Something Want Wrong",
              icon: "error"
            })
          }
        },
        error: function (xhr, status, error) {
          // Handle errors
          console.error('Error:', error);
        }
      });

    })

    $('#updateEoSUser').click(function () {

      $.ajax({
        url: 'post/updateEoSUser.php',
        type: 'POST',
        contentType: 'application/json',
        data: JSON.stringify({ uid: $('input[name="user_id"]').val(), eos: $('#datepicker2').val() }),
        success: function (response) {
          // Handle the response data here
          if (response.type == 'success') {
            window.location.reload()
          } else {
            Swal.fire({
              text: "Something Want Wrong",
              icon: "error"
            })
          }
        },
        error: function (xhr, status, error) {
          // Handle errors
          console.error('Error:', error);
        }
      });

    })

    $('.deleteUser').click(function () {
      Swal.fire({
        title: "Alert!",
        text: "Do You Want to Delete User?",
        icon: "warning"
      }).then((result) => {

        if (result.isConfirmed) {
          $.ajax({
            url: 'post/deleteUser.php',
            type: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({ uid: $(this).data('id') }),
            success: function (response) {
              // Handle the response data here
              if (response.type == 'success') {
                window.location.reload()
              } else {
                Swal.fire({
                  text: "Something Want Wrong",
                  icon: "error"
                })
              }
            },
            error: function (xhr, status, error) {
              // Handle errors
              console.error('Error:', error);
            }
          });
        }
      });
    })

    $('.reminder').click(function () {
      $('#sendReminder').modal('show')
      $.ajax({
        url: 'post/sendReminder.php',
        type: 'POST',
        contentType: 'application/json',
        data: JSON.stringify({ email: $(this).data('email') }),
        success: function (response) {
          $('#sendReminder').modal('hide')

          // Handle the response data here
          if (response.success == true) {
            Swal.fire({
              text: "Reminder Send to Email.",
              icon: "success", timer: 2000
            })
          } else {
            Swal.fire({
              text: "Something Want Wrong",
              icon: "error",
              timer: 2000
            })
          }
        },
        error: function (xhr, status, error) {
          // Handle errors
          $('#sendReminder').modal('hide')
          Swal.fire({
            text: "Something Want Wrong",
            icon: "error",
            timer: 2000
          })
        }
      });
    })
  })

  $('#datepicker').datetimepicker({
    format: 'Y/m/d H:i:s',
  });

  $('#datepicker2').datetimepicker({
    format: 'Y/m/d H:i:s',
  });

  document.querySelector("#select-all-subscription").addEventListener("change", (event) => {
    document.querySelectorAll(".select-subscription").forEach(element => {
      if (event.target.checked) {
        element.checked = true
      } else {
        element.checked = false
      }
    })
  })

  let selectedSubscription = 0;

  document.querySelectorAll(".select-subscription").forEach((element) => {
    element.addEventListener("click", (event) => {
      document.querySelector("#select-all-subscription").children[0].checked = true
    })
  })

  document.querySelector("#send-bulk-subscription").addEventListener("click", (event) => {
    // document.querySelector().
    const getEmailAddress = [];
    document.querySelectorAll(".select-subscription").forEach(element => {
      if (element.checked && element.value != "") {
        getEmailAddress.push(element.value)

      }
    })

    getEmailAddress.forEach((email, index) => {
      event.target.children[0].classList.remove("d-none")
      $.ajax({
        url: 'post/sendReminder.php',
        type: 'POST',
        contentType: 'application/json',
        data: JSON.stringify({ email: email }),
        success: function (response) {
          if (getEmailAddress.length - 1 == index) {
            event.target.children[0].classList.add("d-none")
          }

          $('#sendReminder').modal('hide')

          // Handle the response data here
          if (response.success == true) {
            Swal.fire({
              text: "Reminder Send to Email.",
              icon: "success", timer: 2000
            })
          } else {
            Swal.fire({
              text: "Something Want Wrong",
              icon: "error",
              timer: 2000
            })
          }
        },
        error: function (xhr, status, error) {
          if (getEmailAddress.length - 1 == index) {
            event.target.children[0].classList.add("d-none")
          }
          // Handle errors
          $('#sendReminder').modal('hide')
          Swal.fire({
            text: "Something Want Wrong",
            icon: "error",
            timer: 2000
          })
        }
      });
    })
  })
</script>