      <div class="page-holder w-100 d-flex flex-wrap">
        <div class="container-fluid px-xl-5">

          <h2 class="mt-4 mb-4">Add New User</h2>
          <form method="post" action="?controller=admin&action=handleAdd&params[0]=users" enctype="multipart/form-data">
            <div class="form-group">
              <label for="fullname">Full name:</label>
              <input type="text" class="form-control" id="fullname" placeholder="Enter fullname" name="fullname">
            </div>
            <div class="form-group">
              <label for="username">Username:</label>
              <input type="text" class="form-control" id="username" placeholder="Enter username" name="username">
            </div>
            <div class="form-group">
              <label for="password">Password:</label>
              <input type="password" class="form-control" id="password" placeholder="Enter password" name="password">
            </div>
            <div class="form-group">
              <label for="email">Email:</label>
              <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
            </div>
            <div class="form-group">
              <label for="phone">Phone:</label>
              <input type="text" class="form-control" id="phone" placeholder="Enter phone" name="phone">
            </div>
            <div class="form-group">
              <label for="avatar">Upload avatar:</label>
              <input type="file" id="avatar" name="avatar" form-control>
            </div>
            <button type="submit" class="btn btn-primary" name="btnSubmit">Submit</button>
          </form>

          <?php if ( isset($_SESSION['message']) ) { echo $_SESSION['message']; } unset( $_SESSION['message'] ); ?>

        </div>