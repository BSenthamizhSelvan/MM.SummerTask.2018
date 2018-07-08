<div class="container-fluid">
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">Post Details <a href="<?php echo site_url('articles/'); ?>" class="glyphicon glyphicon-arrow-left pull-right"></a></div>
            <div class="panel-body">
                <div class="form-group">
                    <label>Title:</label>
                    <p><?php echo !empty($article['title'])?$article['title']:''; ?></p>
                </div>
                <div class="form-group">
                    <label>Content:</label>
                    <p><?php echo !empty($article['content'])?$article['content']:''; ?></p>
                </div>
                <div class="form-group">
                    <label>Summary:</label>
                    <p><?php echo !empty($article['summary'])?$article['summary']:''; ?></p>
                </div>
                <div class="form-group">
                    <label>Category:</label>
                    <p><?php echo !empty($article['ctg'])?$article['ctg']:''; ?></p>
                    <label>Writer name:</label>
                    <p><?php echo !empty($article['reptr_name'])?$article['reptr_name']:''; ?></p>
                    <label>Last Modified:</label>
                    <p><?php echo !empty($article['modified'])?$article['modified']:''; ?></p>
                </div>
                <div class="form-group">
                    <label>Image:</label>
                    <p><img src="<?php echo base_url('assets/img/uploads/') ?><?php echo $article['img']; ?>"></p>
                </div>
            </div>
        </div>
    </div>
</div>
