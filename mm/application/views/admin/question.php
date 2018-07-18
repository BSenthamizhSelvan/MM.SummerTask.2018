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
                <div class="panel-heading">Ask a Question</div>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th width="40%">Question</th>
                            <th width="40%">Authority</th>
                            <th width="20%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($question)): foreach($question as $question): ?>
                            <tr>
                                <td><?php echo $question['question']; ?></td>
                                <td><?php echo $question['person']; ?></td>
                                <td>
                                    <a href="<?php echo site_url('admin_panel/approve_question/'.$question['id']); ?>" class="glyphicon glyphicon-ok" onclick="return confirm('Approve Question?')"></a>
                                    <a href="<?php echo site_url('admin_panel/delete_question/'.$question['id']); ?>" class="glyphicon glyphicon-remove" onclick="return confirm('Remove Question?')"></a>
                                </td>

                            </tr>
                        <?php endforeach; else: ?>
                        <tr><td colspan="4">Question(s) not found......</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>