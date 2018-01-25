<div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Contents</h1>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-12">
						<h4 style="margin-bottom:20px;font-size:14px;">							
							<a href="<?php echo base_url().'admin/contents/addform';?>" style="margin-right:15px;" id="add_content" title="Adds new content.">
								<span class="glyphicon glyphicon-home"></span> <img height="10" src="<?php echo images_url('plus.png');?>"/> Add New Content</a>
							<a href="<?php echo base_url().'admin/contents/clean';?>" style="margin-right:15px;" id="clean_contents" title="Clean the voided contents.">
								<img height="10" src="<?php echo images_url('trash.png');?>"/> Clean Contents</a>
						</h4>
                        <div class="table-responsive" id="contents">
                            <table class="table table-bordered table-hover table-striped datatable" style="clear:both;">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Content</th>
                                    </tr>
                                </thead>
                                <tbody class="list">
									<?php echo $this->contents;?>
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