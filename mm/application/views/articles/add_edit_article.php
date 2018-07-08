<div class="container-fluid">
  <div class="col-xs-12">
    <?php 
    if(!empty($success_msg)){
      echo '<div class="alert alert-success">'.$success_msg.'</div>';
    }elseif(!empty($error_msg)){
      echo '<div class="alert alert-danger">'.$error_msg.'</div>';
    }
    ?>
  </div>
  <div class="row">
    <div class="col-xs-12">
      <div class="panel panel-default">
        <div class="panel-heading"><?php echo $action; ?> Articles <a href="<?php echo site_url('Articles/'); ?>" class="glyphicon glyphicon-arrow-left pull-right"></a></div>
        <div class="panel-body">
          <form method="post" action="" class="form" enctype="multipart/form-data">
            <div class="form-group">
              <label for="title">Title</label>
              <input type="text" class="form-control" name="title" placeholder="Enter title" value="<?php echo !empty($article['title'])?$article['title']:''; ?>">
              <?php echo form_error('title','<p class="help-block text-danger">','</p>'); ?>
            </div>
            <div class="form-group">
              <label for="content">Content</label>
              <textarea name="content" class="form-control" placeholder="Enter article content" rows="20"><?php echo !empty($article['content'])?$article['content']:''; ?></textarea>
              <?php echo form_error('content','<p class="text-danger">','</p>'); ?>
            </div>
            <div class="form-group">
              <label for="summary">Summary</label>
              <textarea name="summary" class="form-control" placeholder="Enter article summary" rows="5"><?php echo !empty($article['summary'])?$article['summary']:''; ?></textarea>
              <?php echo form_error('summary','<p class="text-danger">','</p>'); ?>
            </div>
            <div class="form-group">
              <label for="ctg">Category : </label>
              <select name="ctg" placeholder="Select Category" value="<?php echo !empty($article['ctg'])?$article['ctg']:''; ?>">
                <option><?php echo $article['ctg']; ?></option>
                <option value="Interview">Interview</option>
                <option value="Forum">Forum</option>
                <option value="Ask a Question">Ask a Question</option>
                <option value="Featured">Featured</option>
                <option value="Pool Analysis">Pool Analysis</option>
              </select>
              <?php echo form_error('Category','<p class="help-block text-danger">','</p>'); ?>

              &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp

              <label for="reptr_name">Writer Name : </label>
              <select name="reptr_name" placeholder="Select Reporter" value="<?php echo !empty($article['reptr_name'])?$article['reptr_name']:''; ?>">
                <option><?php echo $article['reptr_name']; ?></option>
                <option value="A">A</option>
                <option value="B">B</option>
                <option value="C">C</option>
                <option value="D">D</option>
              </select>
              <?php echo form_error('Reporter Name','<p class="help-block text-danger">','</p>'); ?>

            </div>
            <div class="form-group">
              <label>Picture</label>
              <input class="form-control" type="file" name="picture" value="<?php echo $article['img']; ?>"> 
              <div>
                <br>
                <img src="<?php echo base_url('assets/img/uploads/') ?><?php echo $article['img']; ?>">
              </div>
            </div>
            <div>
              <input type="submit" name="submit" class="btn btn-primary" value="Submit">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
