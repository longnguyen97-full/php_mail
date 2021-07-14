      <div class="page-holder w-100 d-flex flex-wrap">
        <div class="container-fluid px-xl-5">

          <h2 class="mt-4 mb-4">Add New Blog</h2>
          <form method="post" action="?controller=admin&action=handleAdd&params[0]=blogs" enctype="multipart/form-data">
            <div class="form-group">
              <label for="published">Published</label>
              <input type="checkbox" class="lg form-check-input ml-4" checked id="published" name="published">
            </div>
            <div class="form-group">
              <label for="title">Title:</label>
              <input type="text" class="form-control" id="title" placeholder="Enter title" name="title">
            </div>
            <div class="form-group">
              <label for="summary">Summary:</label>
              <input type="text" class="form-control" id="summary" placeholder="Enter summary" name="summary">
            </div>
            <div class="form-group">
              <label for="content">Content:</label>
              <textarea class="form-control" id="content" name="content" placeholder="Enter content" cols="30" rows="10"></textarea>
            </div>
            <div class="form-group">
              <label for="thumbnail">Upload thumbnail:</label>
              <input type="file" id="thumbnail" name="thumbnail" form-control>
            </div>
            <button type="submit" class="btn btn-primary" name="btnSubmit">Submit</button>
          </form>

          <?php if ( isset($_SESSION['message']) ) { echo $_SESSION['message']; } unset( $_SESSION['message'] ); ?>

        </div>