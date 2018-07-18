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
            <div class="panel panel-default ">
                <div class="panel-heading">Article Comments</div>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th width="15%">Username</th>
                            <th width="35%">Article Title</th>
                            <th width="35%">Comment</th>
                            <th width="15%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($comments)): foreach($comments as $comment): ?>
                            <tr>
                                <td><?php echo $user[$comment['user_id'] - '1']['username'] ?></td>
                                <td><?php echo $article[$comment['article_id'] - '1']['title'] ?></td>
                                <td><?php echo $comment['content']; ?></td>
                                <td>
                                    <a href="<?php echo site_url('admin_panel/approve_article_comment/'.$comment['id']); ?>" class="glyphicon glyphicon-ok" onclick="return confirm('Approve Comment?')"></a>
                                    <a href="<?php echo site_url('admin_panel/article_comment_delete/'.$comment['id']); ?>" class="glyphicon glyphicon-remove" onclick="return confirm('Remove Comment?')"></a>
                                </td>

                            </tr>
                        <?php endforeach; else: ?>
                        <tr><td colspan="4">Comment(s) not found......</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>