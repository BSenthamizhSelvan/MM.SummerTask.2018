<div class="container-fluid">
    <?php if(!empty($success_msg)){ ?>
    <div class="col-xs-12">
        <div class="alert alert-success"><?php echo $success_msg; ?></div>
    </div>
    <?php }elseif(!empty($error_msg)){ ?>
    <div class="col-xs-12">
        <div class="alert alert-danger"><?php echo $error_msg; ?></div>
    </div>
    <?php } ?>
    <div class="row">
        <div class="col-xs-12">
            <div class="panel panel-default ">
                <div class="panel-heading">Articles <a href="<?php echo site_url('articles/add/'); ?>" class="glyphicon glyphicon-plus pull-right" ></a></div>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th width="5%">ID</th>
                            <th width="30%">Title</th>
                            <th width="50%">Content</th>
                            <th width="15%">Action</th>
                        </tr>
                    </thead>
                    <tbody id="userData">
                        <?php if(!empty($article)): foreach($article as $article): ?>
                        <tr>
                            <td><?php echo '#'.$article['id']; ?></td>
                            <td><?php echo $article['title']; ?></td>
                            <td><?php echo (strlen($article['content'])>150)?substr($article['content'],0,150).'...':$article['content']; ?></td>
                            <td>
                                <a href="<?php echo site_url('articles/view/'.$article['id']); ?>" class="glyphicon glyphicon-eye-open"></a>
                                <a href="<?php echo site_url('articles/edit/'.$article['id']); ?>" class="glyphicon glyphicon-edit"></a>
                                <a href="<?php echo site_url('articles/delete/'.$article['id']); ?>" class="glyphicon glyphicon-trash" onclick="return confirm('Are you sure to delete?')"></a>
                            </td>
                        </tr>
                        <?php endforeach; else: ?>
                        <tr><td colspan="4">Article(s) not found......</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
