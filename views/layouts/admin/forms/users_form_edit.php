      <div class="page-holder w-100 d-flex flex-wrap">
        <div class="container-fluid px-xl-5">

          <h2 class="mt-4 mb-4">Edit User</h2>
          <?php 
            foreach ( $params['post_list'] as $item ) {
          ?>
          <form method="post" action="?controller=admin&action=handleEdit&params[0]=users&params[1]=<?=$item['id'] ?>">
            <div class="form-group">
              <label for="fullname">Fullname:</label>
              <input type="text" class="form-control" id="fullname" value="<?=$item['fullname'] ?>" name="fullname">
            </div>
            <div class="form-group">
              <label for="email">Email:</label>
              <input type="email" class="form-control" id="email" value="<?=$item['email'] ?>" name="email">
            </div>
            <div class="form-group">
              <label for="username">Username:</label>
              <input type="text" class="form-control" id="username" value="<?=$item['username'] ?>" name="username">
            </div>
            <div class="form-group">
              <label for="password">Password:</label>
              <input type="password" class="form-control" id="password" value="<?=$item['password'] ?>" name="password">
            </div>
            <div class="form-group">
              <label for="phone">Phone:</label>
              <input type="text" class="form-control" id="phone" value="<?=$item['phone'] ?>" name="phone">
            </div>
            <div class="form-group">
              <img src="./assets/uploads/<?=$item['avatar'] ?>" alt="avatar-user" width="150px" height="150px">
            </div>
            <div class="form-group">
              <label for="avatar">Choose file to upload:</label>
              <input type="file" id="avatar" name="avatar" form-control>
              <p class="text-danger">Please upload image to media source before choose it!</p>
            </div>
            <button type="submit" class="btn btn-primary" name="btnSubmit">Submit</button>
          </form>
          <?php
            }
            
            if ( isset($_SESSION['message']) ) { echo $_SESSION['message']; } unset( $_SESSION['message'] );
          ?>
        </div>