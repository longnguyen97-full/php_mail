      <div class="page-holder w-100 d-flex flex-wrap">
        <div class="container-fluid px-xl-5">

          <h2 class="mt-4 mb-4">Edit Blog</h2>
          <?php 
            foreach ( $params['post_list'] as $item ) {
          ?>
          <form method="post" action="?controller=admin&action=handleEdit&params[0]=blogs&params[1]=<?=$item['id'] ?>">
            <div class="form-group">
              <label for="published">Published</label>
              <input type="checkbox" class="lg form-check-input ml-4" checked id="published" name="published">
            </div>
            <div class="form-group">
              <label for="title">Title:</label>
              <input type="text" class="form-control" id="title" value="<?=$item['title'] ?>" name="title">
            </div>
            <div class="form-group">
              <label for="summary">Summary:</label>
              <input type="text" class="form-control" id="summary" value="<?=$item['summary'] ?>" name="summary">
            </div>
            <div class="form-group">
              <label for="content">Content:</label>
              <textarea class="form-control" id="content" name="content" cols="30" rows="10"><?=$item['content'] ?></textarea>
            </div>
            <div class="form-group">
              <img src="./assets/uploads/<?=$item['thumbnail'] ?>" alt="thumbnail-blog" width="150px" height="150px">
            </div>
            <div class="form-group">
              <label for="thumbnail">Choose file to upload:</label>
              <input type="file" id="thumbnail" name="thumbnail" form-control>
              <p class="text-danger">Please upload image to media source before choose it!</p>
            </div>
            <button type="submit" class="btn btn-primary" name="btnSubmit">Submit</button>
          </form>
          <?php
            }
            
            if ( isset($_SESSION['message']) ) { echo $_SESSION['message']; } unset( $_SESSION['message'] );
          ?>
        </div>