<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
        <div id="page-wrapper">
            <div class="container-fluid">
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Change Password</h1>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-12">
                        <form id="settingform" role="form" action="<?php echo $this->url;?>" method="post">
                            <div class="form-group">
                                <label>Old password</label>
                                <input type="password" name="old_password" class="form-control" value="" required>
                            </div>
							<div class="form-group">
                                <label>New Password</label>
                                <input type="password" name="new_password" class="form-control" value="" required>
                            </div>
							<div class="form-group">
                                <label>Confirm Password</label>
                                <input type="password" name="confirm_password" class="form-control" value="" required>
                            </div>
                            <button type="submit" class="btn btn-default">Submit</button>
                        </form>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->