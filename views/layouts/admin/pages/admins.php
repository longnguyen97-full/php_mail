      <div class="page-holder w-100 d-flex flex-wrap">
        <div class="container-fluid px-xl-5">

          <h2 class="mt-4 mb-4">Admin Accounts <button class="btn btn-primary"><a href="?controller=admin&action=add&params[0]=admins" class="anchor-link-unset">Add New</a></button></h2>
          <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Username</th>
                <th scope="col">Role</th>
                <th scope="col">Email</th>
                <th scope="col">Edit</th>
                <th scope="col">Delete</th>
              </tr>
            </thead>
            <tbody>
            <?php 
            $i = 0;
            foreach ( $params['post_list'] as $item )
            {
              $i++;
            ?>
              <tr>
                <td><?=$i ?></td>
                <td><?=$item["username"] ?></td>
                <td><?=$item["role"] ?></td>
                <td><?=$item["email"] ?></td>
                <form method="post" action="?controller=admin&action=edit&params[0]=admins&params[1]=<?=$item['id'] ?>">
                <td><button class="btn btn-primary" name='btn-edit' type="submit">Edit</button></td>
                </form>
                <form method="post" action="?controller=admin&action=handleDelete&params[0]=admins&params[1]=<?=$item['id'] ?>">
                <td><button class="btn btn-danger" name='btn-edit' type="submit">Delete</button></td>
                </form>
              </tr>
            <?php
            }

            if ( isset($_SESSION['message']) ) { echo $_SESSION['message']; } unset( $_SESSION['message'] );
            ?>  
            </tbody>
          </table>

        </div>