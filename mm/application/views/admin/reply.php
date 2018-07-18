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
                <div class="panel-heading">Reply Approval</div>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th width="15%">Username</th>
                            <th width="35%">Thread</th>
                            <th width="35%">Reply</th>
                            <th width="15%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($reply)): foreach($reply as $reply): ?>
                            <tr>
                                <td><?php echo $user[$reply['user_id'] - '1']['username']; ?></td>
                                <td><?php echo $thread[$reply['thread_id']-'1']['topic']; ?></td>
                                <td><?php echo $reply['content']; ?></td>
                                <td>
                                    <a href="<?php echo site_url('admin_panel/approve_reply/'.$reply['id']); ?>" class="glyphicon glyphicon-ok" onclick="return confirm('Approve Reply?')"></a>
                                    <a href="<?php echo site_url('admin_panel/delete_reply/'.$reply['id']); ?>" class="glyphicon glyphicon-remove" onclick="return confirm('Remove Reply?')"></a>
                                </td>

                            </tr>
                        <?php endforeach; else: ?>
                        <tr><td colspan="4">Reply not found......</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>