<?php
    $user_group_id = trim($this->session->loginauthspuserfront['user_group_id']);
    $condeptsess = $this->session->contractdepartment;
    ?>
<!-- Main content -->
<!-- ########################################## PageContent Start ########################################## --> 
<div class="right_col" role="main">
<div class="*row">
<div class="mainelementfom content">
<div>
    <h1 class="h1_heading"> Trading Days</h1>
</div>
<!--    Total Number of Contracts Ends-->
<!-- My messages -->
<div class="">
    <!--            <h1 class="h1_heading">Executed Contracts List</h1> -->
    <!--            Total Number of Contracts Starts-->
    <div class="containergrid">
        <!--table start-->
        <div class="containergrid">
            <div class="panel panel-primary">
                <div class="padding_side">
                    <div class="entries">
                    </div>
                </div>
                <table class="table table-inverse table_wraper" id="datablekk">
                    <thead>
                        <tr>
                            <th>Sr No</th>
                            <th>Date added</th>
                            <!--  <th>Expected Trading date</th> -->
                            <th>No of days</th>
                            <!-- <th>Access</th> -->
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="appendroww" appendrow='1'></tbody>
                </table>
            </div>
        </div>
    </div>
    <!--table end-->
    <div class="clearelement"></div>
    <!-- ExcelUpload start --> 
    <div class="lstc">
        <section class="col col-md-12">
            <label class="control-label">Trading Days *</label>
            <div class="input">
                <input type="text" id="tdays" name="tdays" required="required" class="form_fields form-control col-md-7 col-xs-12">
                <button type="button" id="tradingsub" class="btn btn-success p-btn">Submit</button>
            </div>
        </section>
    </div>
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
                        <h5 class="delete-title">Are You Sure To Delete ?</h5>
                    </div>
                    <div class="modal-footer t-center">
                        <button type="button" class="btn btn-danger" id="delterms" tempid="">Delete</button> 
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div id="editmodal" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Please enter default trading window</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <label class="control-label">Trading Days *</label>
                            <div class="input">
                                <input type="hidden" id="updateid" value="">
                                <input type="text" id="mdtdays" name="mdtdays" required="required" class="form_fields form-control col-md-7 col-xs-12">
                                <button type="button" id="mduptradedays" class="btn btn-success" >Update</button>
                            </div>
                            <div class="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="clearelement"></div>
                <div class="preloder_wraper">
                    <a href="javascript:;" class="preloder"></a>
                </div>
                <div class="clearelement"></div>
            </div>
            <!-- /main content -->
        </div>
    </div>
</div>
<!-- ########################################## PageContent End ########################################## -->