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
                <div class="panel-heading">Users</div>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th width="5%">ID</th>
                            <th width="20%">User Name</th>
                            <th width="15%">Admin Access</th>
                            <th width="15%">Author Access</th>
                            <th width="15%">Poll Vote Given</th>
                            <th width="15%">Admin/Author Options</th>
                            <th width="15%">Delete User</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($users)): foreach($users as $user): ?>
                            <tr>
                                <td><?php echo '#'.$user['id']; ?></td>
                                <td><?php echo $user['username']; ?></td>
                                <td><?php 

                                if ($user['privilege']=='1'){
                                    echo 'Yes' ;
                                } else{
                                    echo 'No' ;
                                }

                                ?></td>

                                <td><?php 

                                if ($user['privilege']=='0'){
                                    echo 'No' ;
                                } else{
                                    echo 'Yes' ;
                                }

                                ?></td>

                                <td><?php 

                                if ($user['vote']){
                                    echo 'Yes' ;
                                } else{
                                    echo 'No' ;
                                }

                                ?></td>

                                <td>
                                    <?php 

                                    if (!$user['privilege']){
                                        ?>

                                        <a href="<?php echo site_url('admin_panel/admin/'.$user['id']); ?>" class="glyphicon glyphicon-king" onclick="return confirm('Make Admin?')"></a>
                                        <a href="<?php echo site_url('admin_panel/author/'.$user['id']); ?>" class="glyphicon glyphicon-pencil" onclick="return confirm('Make Author?')"></a>

                                        <?php
                                    } else{

                                        ?>

                                        <a href="<?php echo site_url('admin_panel/non_admin/'.$user['id']); ?>" class="glyphicon glyphicon-pawn" onclick="return confirm('Remove Admin?')"></a>

                                        <?php
                                    }

                                    ?>
                                </td>
                                <td>
                                    <a href="<?php echo site_url('admin_panel/delete_user/'.$user['id']); ?>" class="glyphicon glyphicon-trash" onclick="return confirm('Are you sure to delete?')"></a>
                                </td>
                            </tr>
                        <?php endforeach; else: ?>
                        <tr><td colspan="4">User(s) not found......</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>