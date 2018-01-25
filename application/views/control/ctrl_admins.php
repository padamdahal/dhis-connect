	<div id="page-wrapper">
            <div class="container-fluid">
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Contents</h1>
                    </div>
                </div><!-- /.row -->
				<?php if($this->superadmin){?>
				<div class="row">
                    <div class="col-lg-12">
                        <form role="form" id="addeditform" method="post" action="<?php echo $this->url;?>">
							<input type="hidden" id="a_id" name="a_id" value="">
                            <input type="text" id="a_name" style="width:250px;padding:5px" name="a_name" placeholder="Admin Name" value="">
                            <input type="text" id="a_username" style="width:250px;padding:5px" name="a_username" placeholder="Admin Username" value="">
							<input type="text" id="a_email" style="width:250px;padding:5px" name="a_email" placeholder="Email" value="">
                            <button type="submit" class="btn btn-default">Add new admin</button>
                        </form>
                    </div>
				</div><!-- /.row -->
				<?php }?>
                <div class="row">
                    <div class="col-lg-12">
						<h4>&nbsp;</h4>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>Admin Name</th>
                                        <th>Username</th>
                                        <th>Email</th>
										<th>Created Date</th>
										<th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
									<?php echo $this->admins;?>
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