
<!-- page content -->
<div class="right_col" role="main">

    <div class="mncontent">
       
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="newpassword">New Password <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="password" id="newpassword" name="newpassword" required="required" class="form-control col-md-7 col-xs-12" >
            </div>
            <div class="clearelement"></div>
            <div id="newpassword_validate"></div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="confirmpassword">Confirm Password <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="password" id="confirmpassword" name="confirmpassword" required="required" class="form-control col-md-7 col-xs-12" >
            </div>
            <div class="clearelement"></div>
            <div id="confirmpassword_validate"></div>
        </div>
        

        <div class="ln_solid"></div>
        <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">                
                <div class="btn btn-success change_password">Change Password</div>
            </div>
            <div class="clearelement"></div>
        </div>
        <div class="clearelement"></div>
       

    </div>


</div>

    <div id="newpasswordmodal" class="modal fade" role="dialog">
          <div class="modal-dialog">
             Modal content
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Please Enter your New Password</h4>
              </div>

              <div class="modal-footer">                  
                <button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
              </div>
            </div>

          </div>
        </div>
<div id="confirmpasswordmodal" class="modal fade" role="dialog">
          <div class="modal-dialog">
             Modal content
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Please Enter your Confirm Password</h4>
              </div>

              <div class="modal-footer">
                  
                <button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
              </div>
            </div>

          </div>
        </div>
<div id="newconfirmpasswordmodal" class="modal fade" role="dialog">
          <div class="modal-dialog">
             Modal content
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">New Password and Confirm Password has to be match</h4>
              </div>

              <div class="modal-footer">
                 
                <button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
              </div>
            </div>

          </div>
        </div>
<div id="passwordlengthmodal" class="modal fade" role="dialog">
          <div class="modal-dialog">
             Modal content
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">New Password and Confirm Password more than 6 Character</h4>
              </div>

              <div class="modal-footer">                  
                <button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
              </div>
            </div>

          </div>
        </div>

<!-- /page content -->
