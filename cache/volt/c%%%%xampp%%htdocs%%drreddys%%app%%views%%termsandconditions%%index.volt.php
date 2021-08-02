<?php $gmnlog = $this->session->loginauthspuserfront; ?>
<?php //echo"<pre>";print_r($gmnlog);exit; ?> 
<!-- Main content -->
<!-- ########################################## PageContent Start ########################################## --> 
<div class="right_col" role="main">
    <div class="*row">
        <div class="content">
            <!--    Total Number of Contracts Ends-->
            <!-- My messages -->
            <div class="mainelementfom">
                <div class="container">
                    <div id="delmod" class="modal fade" role="dialog">
                        <div class="modal-dialog">
                            <!-- Modal content-->
                            <div class="modal-content">
                                <!-- <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">
                                          &times;</button>
                                    </div> -->
                                <div class="modal-body">
                                    <input type="hidden" id="deleteid" value="" name="">
                                    <h5 style="text-align: center;">Are You Sure To Delete This Document?</h5>
                                </div>
                                <div class="modal-footer t-center">
                                    <button type="button" class="btn btn-danger" id="delterms" tempid="">Delete</button> 
                                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <h1 class="h1_heading">Resources</h1>
                <div class="table-responsive table_wraper table_form">
                    <table class="table table-inverse mytable" id="datablerushi" typage="reqview">
                        <thead>
                            <tr>
                                <th>Sr no</th>
                                <th>Resource Name </th>
                                <th>File</th>
                                <th>Upload Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="modtable" appendrow='1'></tbody>
                    </table>                    
                </div>
                <?php if($gmnlog['user_group_id']==2){ ?>
                <div class="trading-resources">
                    <form action="termsandconditions/uploadtradingfile" id="termsandconditions" method="post" enctype="multipart/form-data">
                        <h5>Resource Name  </h5>
                        <input type="text" name="filetitle" id="title" class="form-controll" value="">
                        <h5>Please Upload Your File</h5>
                        <input type="file" name="fileToUpload" id="fileToUpload">
                        <input  type="submit" class="btn btn-primary"  value="Upload" id="subfile" tempid="" style="float:right;">
                    </form>
                </div>
                <?php } ?>
            </div>
            <!----------------------MODAL BOX FOR EDIT RELATIONSHIP FINISH------------------------------------------>
        </div>
    </div>
</div>
<!-- </div> -->
<!-- ########################################## PageContent End ########################################## -->