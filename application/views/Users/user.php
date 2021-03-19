  


  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">User Management</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- User Management -->
<!-- Modal -->
<div class="container">
  <div class="row">
    <div class="col-md-12 mt-2">
      <!-- Button trigger modal -->
      <button type="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">
          Add User
      </button>
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
        <div class="modal-body">
          <form action="" method="post" id="form">
            <div class="form_group col-md-2 col-form-label">
              <label for="FName">FName</label>
              <input type="fname" name="fname" class="form_control" style="width: 300px" id="fname">
            </div>
            <div class="form_group col-md-2 col-form-label">
              <label for="LName">LName</label>
              <input type="lname" name="lname" class="form_control" style="width: 300px" id="lname">
            </div>
            <div class="form_group col-md-2 col-form-label">
              <label for="Phone">Phone</label>
              <input type="num" name="phone" class="form_control" style="width: 300px" id="phone">
            </div>
            <div class="form_group col-md-2 col-form-label">
              <label for="Name">Email</label>
              <input type="email" name="email" class="form_control" style="width: 300px" id="email">
            </div>
            <div class="form_group col-md-2 col-form-label">
              <label for="Name">Password</label>
              <input type="password" name="password" class="form_control" style="width: 300px" id="pass">
            </div>
            <div class="form_group col-md-2 col-form-label">
              <label for="Name" style="width: 150px">Confirm Password</label>
              <input type="password" name="confirm_password" class="form_control" style="width: 300px" id="confirm_password">
            </div>
            <!-- populate dropdown list with array values in PHP -->
            <select name="role" id="role">
          <option selected="selected">Role</option>
          <?php
        
        // Iterating through the product array
            foreach($roles as $role){
                echo "<option value='$role->id'>$role->name</option>";
            }
            ?>
          </select>
          <!--end populate dropdown list with array values in PHP -->
            <div class="form-check col-md-2 col-form-label">
              <label class="form-check-label" for="male">
                <b>Gender</b>
              <input class="form-check-input" type="radio" name="gender" value="male" id="male">
              <label class="form-check-label" for="male">
                Male
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="gender" value="female" id="female" checked>
              <label class="form-check-label" for="female">
                Female
              </label>
            </div>
          </form>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="add">Add User</button>
      </div>
    </div>
  </div>
    </div>
  
</div>  
  </div>

  <div class="row">
      <div class="col-md-12 mt-4">
        <div class="table-responsive">
          <table class="table" id="records">
          <thead>
            <tr>
              <th>#</th>
              <th>Role</th>
              <th>Fname</th>
              <th>Lname</th>
              <th>Phone</th>
              <th>Mobile</th>
              <th>Email</th>
              <!-- <th>Password</th> -->
              <th>Gender</th>
              <th>Action</th>
            </tr>
          </thead>
          <body></body>
        </table>
        </div>
      </div>
    </div>

</div>
    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
          <div class="row">
        </div>



        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <script src="<?php echo base_url();?>assets/plugins/jquery/jquery.min.js"></script>
  <script>
    
    $(document).on("click", "#add", function(e){
    e.preventDefault();

      var fname = $("#fname").val();
      var lname = $("#lname").val();
      var phone = $("#phone").val();
      var email = $("#email").val();
      var password = $("#pass").val();
      var confirm_password = $("#confirm_password").val();
      var gender = $('input[name=gender]:checked').val();

      var role =$( "#role option:selected" ).val();

        $.ajax({
        url : "<?php echo site_url('user/insert')?>",
        type : "post",
        dataType  : "json",
        data : {
          role_id : role,
          fname : fname,
          lname : lname,
          phone : phone, 
          email : email,
          password : password,
          confirm_password: confirm_password,
          gender : gender
        },
        success: function(data){
          if (data.responce == "success"){
            $("#exampleModal").modal('hide');
            toastr["success"](data.message);
          }else{
            toastr["error"](data.message);
          }
        }
      });
            
       $("#form")[0].reset(); 

    });
    // Fetch Record //
     function fetch()
     {
      $.ajax({
        url : "<?php echo site_url('user/fetch')?>",
        type : "post",
        dataType : "json",
        success : function(data)
        {
           $('#records').DataTable( {
            "data" : data.posts,
              "columns": [
                  { "data": "Role" },
                  { "data": "Fname" },
                  { "data": "Lname" },
                  { "data": "Phone" },
                  { "data": "Mobile" },
                  { "data": "Email" },
                  { "data": "Gender"},
                  { "data": "Action"}
              ]
            } );
          }
      })
     }
  </script>
