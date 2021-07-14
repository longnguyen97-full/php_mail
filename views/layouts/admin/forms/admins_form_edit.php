      <div class="page-holder w-100 d-flex flex-wrap">
        <div class="container-fluid px-xl-5">
          
          <h2 class="mt-4 mb-4">Edit Admin</h2>
          <?php 
            foreach ( $params['post_list'] as $item ) {
          ?>
          <form method="post" action="?controller=admin&action=handleEdit&params[0]=admins&params[1]=<?=$item['id'] ?>">
            <div class="form-group">
              <label for="username">Username:</label>
              <input type="text" class="form-control" id="username" value="<?=$item['username'] ?>" name="username">
            </div>
            <div class="form-group">
              <label for="password">Password:</label>
              <input type="password" class="form-control" id="password" value="<?=$item['password'] ?>" name="password">
            </div>
            <div class="form-group">
              <label for="email">Email:</label>
              <input type="email" class="form-control" id="email" value="<?=$item['email'] ?>" name="email">
            </div>
            <div class="form-group">
              <label for="role">Role</label><br>
              <select name="role" id="role" class="browser-default custom-select col-2">
                <option value="administrator" selected>Administrator</option>
                <option value="author">Author</option>
                <option value="moderator">Moderator</option>
              </select>
            </div>
            <button type="submit" class="btn btn-primary" name="btnSubmit">Submit</button>
          </form>
          <?php
            }

            if ( isset($_SESSION['message']) ) { echo $_SESSION['message']; } unset( $_SESSION['message'] );
          ?>
        </div>