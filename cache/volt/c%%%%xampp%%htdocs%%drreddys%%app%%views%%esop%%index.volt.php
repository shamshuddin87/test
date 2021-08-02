<?php
    $user_group_id = trim($this->session->loginauthspuserfront['user_group_id']);
    $gtselctedcmp = $this->session->cmpconmemberdoc;
    $condeptsess = $this->session->contractdepartment;
    //echo "company is ";print_r($user_group_id);exit;
    ?>
<!-- Main content -->
<!-- ########################################## PageContent Start ########################################## --> 
<div class="right_col" role="main">
    <div class="*row">
        <div class="content">
            <!-- My messages -->
            <div class="mainelementfom">
                <h1 class="h1_heading">ESOP</h1>
                <div class="containergrid">
                    <div class="*formcss">
                        <div class="typography form_pad">
                            <div class="formelementmain">
                                <form id="insertesop" action="esop/insertesop" method="post" enctype="multipart/form-data" autocomplete="off" >
                                    <section class="col col-md-6 col-xs-6">
                                        <div class="input">
                                            <label class="control-label">Upload File</label>
                                            <div class="choose_files">
                                                <input type="file" name="esopfile" id="esopfile" >
                                            </div>
                                            <div class="updatefile">
                                                <div class="sample_down floatleft">
                                                    <a href="samplefile\ESOP\ESOP.xlsx" download>
                                                        <p class="sample">
                                                            Download Sample Excel <i class="fa fa-file-excel-o" aria-hidden="true"></i>
                                                        </p>
                                                    </a>
                                                </div>
                                                <div class="clearelement"></div>
                                            </div>
                                        </div>
                                    </section>
                                    <div class="col-md-6 submit_b">
                                        <input type="submit" value="Submit" class="btn btn-primary insrtesop">
                                    </div>
                                    <div class="clearelement"></div>
                                </form>
                            </div>
                            <div class="clearelement"></div>
                        </div>
                    </div>
                </div>
                <div class="table-responsive table_wraper">
                    <div class="cssnumrws">
                        <span>Show</span>
                        <select id="noofrows" name="noofrows" class="noofrows">
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                        <span>Entries</span>
                    </div>
                    <table class="table datatable-responsive" class="templatetbl" id="datableabhi" dtausi = "">
                        <thead>
                            <tr>
                                <th>Date Of Upload</th>
                                <th>Time</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="appendrow" appendrow='1'>
                        </tbody>
                    </table>
                    <div class="">
                        <div class="paginationmn"></div>
                        <input type="hidden" id="pagenum" name="pagenum" class="pagechnum" value="1">
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
<div id="myModalyesno" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Would you like to go ahead?</h4>
            </div>
            <div class="modal-body show_shadow">
                <div class="text-center modal_heading">
                    NOTE
                    <div class="clearelement"></div>
                    Are You Sure You Want To Delete This Record.
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary mar_0 yesconfirm" tempid="">Yes</button>
                <button type="button" class="btn btn-default btn-default-one" data-dismiss="modal">No</button>
            </div>
        </div>
    </div>
</div>