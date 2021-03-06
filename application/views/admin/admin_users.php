<?php
/**
 * Created by PhpStorm.
 * User: John
 * Date: 1/13/15
 * Time: 22:38
 */
$this->load->helper('comm');
defined('BASEPATH') OR exit('No direct script access allowed');
?><!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            用户列表
            <small>User List</small>
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <p> <a class="btn btn-success btn-sm" href="<?php echo site_url('admin/user_add'); ?>">添加</a> </p>
                    <div class="box">
                        <div class="box-body table-responsive no-padding">
                            <table id="userTable" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>UID</th>
                                        <th>用户名</th>
                                        <th>电子邮件</th>
                                        <th>SS 密码</th>
                                        <th>上次连接时间</th>
                                        <th>上传量</th>
                                        <th>下载量</th>
                                        <th>套餐</th>
                                        <th>总量</th>
                                        <th>端口</th>
                                        <th>上次签到</th>
                                        <th>注册时间</th>
                                        <th>操作</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php if ($users) { foreach ($users as $user) : ?>
                                    <tr>
                                        <td><span class="label label-<?php if ($user->enable) { echo 'success'; } else { echo 'danger'; } ?>">#<?php echo $user->uid; ?></span></td>
                                        <td><?php echo $user->user_name; ?></td>
                                        <td><?php echo $user->email; ?></td>
                                        <td><?php echo $user->passwd; ?></td>
                                        <td><?php echo date("m-j G:i", $user->t); ?></td>
                                        <td><?php echo human_file_size($user->u); ?></td>
                                        <td><?php echo human_file_size($user->d); ?></td>
                                        <td><?php echo $user->plan; ?></td>
                                        <td><?php echo human_file_size($user->transfer_enable); ?></td>
                                        <td><?php echo $user->port; ?></td>
                                        <td><?php echo date("m-j G:i", $user->last_check_in_time); ?></td>
                                        <td><?php echo $user->reg_date; ?></td>
                                        <td>
                                            <a class="btn btn-info btn-sm" href="<?php echo site_url( "admin/user_edit/$user->uid"); ?>">编辑</a>
                                            <button class="btn btn-danger btn-sm" onclick="del_user(<?php echo $user->uid; ?>)">删除</button>
                                        </td>
                                    </tr>
                                <?php endforeach; } ?>
                                </tbody>
                            </table>
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div>
            </div>
    </section><!-- /.content -->
</aside><!-- /.right-side -->
<script type="text/javascript">
    function del_user($uid)
    {
        var dialog = new BootstrapDialog({
            size: BootstrapDialog.SIZE_LARGE,
            type: BootstrapDialog.TYPE_DANGER,
            title: '删除用户',
            message: '确认删除 UID 为：'.concat($uid,' 的用户？该操作无法恢复！'),
            closable: false,
            buttons: [{
                label: '确认',
                cssClass: 'btn-danger',
                action: function (dialogRef) {
                    dialogRef.close();
                    do_del_user($uid);
                }},
                {
                    label: '取消',
                    action: function (dialogRef) {
                        dialogRef.close();
                    }
                }
            ]
        });
        dialog.realize();
        dialog.getModalBody().css('color', '#000');
        dialog.open();
    }

    function do_del_user($uid)
    {
        var xmlhttp;
        if (window.XMLHttpRequest)
        {// code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp=new XMLHttpRequest();
        }
        else
        {// code for IE6, IE5
            xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange=function()
        {
            if (xmlhttp.readyState==4 && xmlhttp.status==200)
            {
                alert(xmlhttp.responseText);
                window.location.href = "<?php echo site_url('admin/users'); ?>";
            }
        }
        xmlhttp.open("GET","<?php echo base_url( "admin/user_del"); ?>".concat("/",$uid),true);
        xmlhttp.send();
    }
</script>

