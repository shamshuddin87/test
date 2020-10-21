<?php 
$getuserid = $this->session->loginauthspuserfront['id'];
?> 

<!-- Main content -->
<!-- ########################################## PageContent Start ########################################## --> 
<div class="right_col" role="main">
<div class="row">
<div class="content">
<input type="hidden" name="excrqst" id="excrqst" value="<?php echo $exerqst;?>">
<input type="hidden" name="vote" id="vote" value="<?php echo $vote; ?>">
<input type="hidden" name="rqstid" id="rqstid" value="<?php echo $rqstid; ?>">
<!-- My messages -->
<div class="mainelementfom">
<div class="forreject" style="display:none;">
<h1 class="cssheading">Welcome </h1>
    <div class="csssubheading">(Please comment below for Request.)</div>

    <form action="randomexception/updateexcrqst" autocomplete="off" id="updateexcrqst" method="post" enctype="multipart/form-data">
    
        <div class="csssectionone">
            <input type="hidden" name="rqst" id="rqst" value="<?php echo $exerqst; ?>">
            <input type="hidden" name="vote" id="vote" value="<?php echo $vote; ?>">
            
            
            <section class="col col-md-12 col-xs-12 cssfield">
                <label class="control-label">Comment</label>
                <div class="input">
                    <textarea type="text" name="comment" id="comment" class="form-control" value="" placeholder="Comment"></textarea>
                </div>    
            </section>
            <div class="clearelement"></div>
            
            <section class="col col-md-6 cssfield">
                <input type="submit" value="Submit" class="btn btn-primary btncntrctup">
            </section>
            
        </div>
        <div class="clearelement"></div>

        <div class="csssectiontwo">
            
        </div>  
        
    </form>
    </div>
   <div class="cssouter">
    <div class="thank">
        <div class="apprvrqst" id="apprvrqst"></div>
        <div class="rejctmsg" id="rejctmsg"></div>
       </div>
    </div>
</div>
<!-- /main content -->
 
</div>
</div>
</div>
<!-- ########################################## PageContent End ########################################## --> 
 



