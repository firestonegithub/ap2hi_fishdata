    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">My Profile</li>
      </ol>
      <!-- Example DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i>  My Profile </div>
        <div class="card-body">
          


<?php echo form_open_multipart($url_updateForm);  ?>
<input type="hidden" name="id_user" value="<?php echo $userDetail->id_user ; ?>" readonly>
  <div class="form-row">
    <div class="form-group col-md-3">
      <label for="inputEmail4">Email</label>
      <input type="email" name="email" class="form-control" id="input1" placeholder="Email" value="<?php echo $userDetail->email ; ?>" required>
    </div>
    <div class="form-group col-md-3">
      <label for="inputEmail4">User Name</label>
      <input type="text" name="username" class="form-control" id="input2" placeholder="User Name" value="<?php echo $userDetail->username ; ?>" readonly>
    </div>
    <div class="form-group col-md-3">
      <label for="inputEmail4">Name</label>
      <input type="text" name="name" class="form-control" id="input3" placeholder="Name" value="<?php echo $userDetail->name ; ?>" required>
    </div>
    <div class="form-group col-md-3">
      <label for="inputPassword4">Password</label>
      <input type="password" name="password" class="form-control" id="input4" placeholder="Password">
    </div>
  </div>
  <div class="form-group">
    <label for="inputAddress">Address</label>
    <input type="text" name="address" class="form-control" id="input5" placeholder="1234 Main St" value="<?php echo $userDetail->address ; ?>">
  </div>
  <div class="form-group">
    <label for="inputAddress2">Current Address</label>
    <input type="text" name="current_address" class="form-control" id="input6" placeholder="Apartment, studio, or floor" value="<?php echo $userDetail->current_address ; ?>">
  </div>
  <div class="form-row">
    <div class="form-group col-md-3">
      <label for="inputCity">Telp</label>
      <input type="text" name="no_telp" class="form-control" id="input7" value="<?php echo $userDetail->no_telp ; ?>">
    </div>
     <div class="form-group col-md-3">
      <label for="inputCity">Mobile</label>
      <input type="text" name="no_hp" class="form-control" id="input8" value="<?php echo $userDetail->no_hp ; ?>"> 
    </div>
    <div class="form-group col-md-6">
      <label for="inputState">State</label>
      <select id="inputState" name="nationality" class="form-control">
        <option selected>Choose...</option>
        <?php foreach($countryLists->result() as $row){ ?>
                <option value="<?php echo $row->id ; ?>" <?php if($row->id == $userDetail->nationality){ echo 'selected'; } ?>><?php echo $row->country_name ; ?></option>
               <?php  } ?>
      </select>
    </div>

  </div>
 

  <button type="submit" class="btn btn-primary">Sign in</button>
<?php echo form_close(); ?>

          
      </div>
    </div>

  </div>