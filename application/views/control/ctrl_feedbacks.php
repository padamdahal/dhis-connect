<div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Feedbacks</h1>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-12">
						<h4 style="margin-bottom:20px;font-size:14px;">							
							<a href="<?php echo base_url().'control/feedback/all';?>" style="margin-right:15px;" id="all_feedbacks" title="Display All.">
								<img height="10" src="<?php echo images_url('eye.png');?>"/> Show all</a>
							<a href="<?php echo base_url().'control/feedback/unread';?>" style="margin-right:15px;" title="Show Unread.">
								<img height="10" src="<?php echo images_url('eye.png');?>"/> Show Unread</a>
							<a href="<?php echo base_url().'control/feedback/read';?>" style="margin-right:15px;" title="Show Read.">
								<img height="10" src="<?php echo images_url('eye.png');?>"/> Show Read</a>
						</h4>
                        <div class="table-responsive" id="contents">
                            <table class="table table-bordered table-hover table-striped datatable" style="clear:both;">
                                <thead>
                                    <tr>
                                        <th>Sender Name/Date</th>
                                        <th>Message</th>
                                    </tr>
                                </thead>
                                <tbody class="list">
									<?php echo $this->feedbacks;?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->