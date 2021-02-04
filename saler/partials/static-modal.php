<!-- The Modal -->
<div class="modal fade" id="register-user">
  <div class="modal-dialog">
    <div class="modal-content">
      <div id="userwaiting"></div>
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Add User</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <form id="registeruser-form" method="POST" action="../route/web.php">
            <input hidden name="addUser" value="1" type="text">
            <div class="form-group">
                <label for="name">Full Name:</label>
                <input type="text" name="name" class="form-control" placeholder="Enter user full name" id="name" required>
            </div>
            <div class="form-group">
                <label for="code">Phone:</label>
                <input type="text" name="phone" class="form-control" placeholder="Enter phone number" id="phone" required>
            </div>
            
            <div class="form-group">
                  <label for="sel1">Select Gender:</label>
                  <select name="gender" class="form-control" id="sel1" required>
                    <option value="">...select...</option>
                    <option>Male</option>
                    <option>Female</option>
                  </select>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-7">
                         <label for="name">Username</label>
                         <input type="text" name="username" class="form-control" placeholder="Enter username" id="username" required>
                    </div>
                    <div class="col-md-5">
                        <label for="sel1">Select Role:</label>
                        <select name="role" class="form-control" id="sel1" required>
                            <option>Saler</option>
                            <option>Manager</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="code">Password:</label>
                <input type="password" name="password" minlength="5" class="form-control" placeholder="Enter password" id="password" required>
            </div>
            <div class="form-group">
                <label for="code">Confirm Password:</label>
                <input type="password" name="cpassword" minlength="5" class="form-control" placeholder="Re-enter password" id="pass" required>
            </div>
            <div class="row" id="usermessage"></div>
            <button type="submit" class="btn btn-primary">Save</button>
        </form> 
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>

<?php  foreach ($user->fetchUser() as  $value) {?>
  <div class="modal fade" id="edit-user<?php echo $value['id'] ?>">
    <div class="modal-dialog">
      <div class="modal-content">
        <div id="updateUserWainting<?php echo $value['id'] ?>"></div>
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Edit User</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <form id="update-user-form<?php echo $value['id'] ?>" method="POST" action="../route/web.php">
              <input hidden name="updateUser" value="1" type="text">
              <input hidden name="id" value="<?php echo $value['id'] ?>" type="text">
              <div class="form-group">
                  <label for="name">Full Name:</label>
                  <input type="text" name="name" value="<?php echo $value['name'] ?>" class="form-control" placeholder="Enter user full name" id="name" required>
              </div>
              <div class="form-group">
                  <label for="code">Phone:</label>
                  <input type="text" name="phone" value="<?php echo $value['phone'] ?>" class="form-control" placeholder="Enter phone number" id="phone" required>
              </div>
              
              <div class="form-group">
                    <label for="sel1">Select Gender:</label>
                    <select name="gender" class="form-control" id="sel1" required>
                      <option><?php echo $value['gender'] ?></option>
                      <option>Male</option>
                      <option>Female</option>
                    </select>
              </div>
              <div class="form-group">
                  <div class="row">
                      <div class="col-md-7">
                          <label for="name">Username</label>
                          <input type="text"  name="username" value="<?php echo $value['username'] ?>" class="form-control" placeholder="Enter username" id="username" required>
                      </div>
                      <div class="col-md-5">
                          <label for="sel1">Select Role:</label>
                          <select name="role" class="form-control" id="sel1" required>
                              <option><?php echo $value['role'] ?></option>
                              <option>Saler</option>
                              <option>Manager</option>
                          </select>
                      </div>
                  </div>
              </div>
              
              <div class="row" id="updateUserMessage<?php echo $value['id'] ?>"></div>
              <button type="submit" userId = "<?php echo $value['id'] ?>" class="btn btn-primary update-user-btn">Save Changes</button>
          </form> 
        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>

      </div>
    </div>
  </div>
<?php } ?>