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
            </div>
        </div>
    </div>
</div>