<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
        <div id="page-wrapper">
            <div class="container-fluid">
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Site Settings</h1>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-12">
                        <form id="settingform" role="form" action="<?php echo base_url().'control/settings/update';?>" method="post">
                            <div class="form-group">
                                <label>Site Title</label>
                                <input type="text" name="site_title" class="form-control" value="<?php echo $this->site_title;?>">
                            </div>
							<div class="form-group">
                                <label>Site Main Message</label>
                                <input type="text" name="site_main_message" class="form-control" value="<?php echo $this->site_main_message;?>">
                            </div>
							<div class="form-group">
                                <label>Site Tagline</label>
                                <input type="text" name="site_tagline" class="form-control" value="<?php echo $this->site_tagline;?>">
                            </div>
							<div class="form-group">
                                <label>Admin Email</label>
                                <input type="text" name="sendmail_from" class="form-control" value="<?php echo $this->sendmail_from;?>">
                            </div>
							<div class="form-group">
                                <label>SMTP Server</label>
                                <input type="text" name="smtp_server" class="form-control" value="<?php echo $this->smtp_server;?>">
                            </div>
							<div class="form-group">
                                <label>SMTP Server Port</label>
                                <input type="text" name="smtp_server_port" class="form-control" value="<?php echo $this->smtp_server_port;?>">
                            </div>
                            <button type="submit" class="btn btn-default">Save Changes</button>
                        </form>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->