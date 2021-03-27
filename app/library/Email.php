<?php
ini_set("max_execution_time", '1800');
ini_set('memory_limit', '1024M');

require('email/class.phpmailer.php');
require('email/class.smtp.php');

Class Email extends Phalcon\Mvc\User\Component {

    private $Hostname = 'smtp.gmail.com';
    private $hosemail = 'simply@consultlane.com';
    private $pwdemail = 'Revenue!@#';
    /*Define all variable here*/
    
    public function sendmailchpwd($to,$name,$subject,$body) 
    {
        $mail = new PHPMailer;
        //print_r($mail);exit;
        $mail->isSMTP();

        $mail->SMTPDebug = 2;
        $mail->Debugoutput = 'html';
        $mail->Host = $this->Hostname;
        $mail->Port = 587;
        $mail->SMTPSecure = 'tls';
        $mail->SMTPAuth = true;
        $mail->Username = $this->hosemail;
        $mail->Password = $this->pwdemail;
        $mail->setFrom($this->hosemail, 'Volody');
        $mail->addReplyTo($this->hosemail, 'Volody Password');
        //$mail->addBCC("sd7@consultlane.com","Rushikesh Salunke");
        $mail->addAddress($to, $name);
        $mail->Subject = $subject;
        $mail->msgHTML($body);
        //Read an HTML message body from an external file, convert referenced images to embedded,
        //convert HTML into a basic plain-text alternative body
        $mail->AltBody = 'To view the message, please use an HTML compatible email viewer!';

        if ($mail->Send()) {
            return true;
        }
        else {
            //echo $mail->ErrorInfo; exit;
            return false;
        }
        //$mail->ClearAddresses();
        //$mail->ClearAttachments();
    }
    
    public function comempun($to,$name,$subject,$body)
    {  
        $mail = new PHPMailer;     
        $mail->isSMTP();
        $mail->SMTPDebug = 2;
        $mail->Debugoutput = 'html';
        $mail->Host = $this->Hostname;
        $mail->Port = 587;
        $mail->SMTPSecure = 'tls';
        $mail->SMTPAuth = true;
        $mail->Username = $this->hosemail;
        $mail->Password = $this->pwdemail;
        $mail->setFrom($this->hosemail, 'Volody BoardAPP');
        //$mail->addBCC("sd7@consultlane.com","Rushikesh Salunke ");
        $mail->addAddress($to, $name);
        $mail->Subject = $subject;
        //Read an HTML message body from an external file, convert referenced images to embedded,
        //convert HTML into a basic plain-text alternative body
        //$mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));
        //Replace the plain text body with one created manually
        $comment = 'Notification';
        $mail->msgHTML($body);
        // ---------------- Add Attachment Start ----------------
        //$mail->addAttachment($attachment);
        // ---------------- Add Attachment End ----------------
        if($mail->Send()) 
        {   return true;    }
        else 
        {   return false;   }
    }
        
/* --------------------- AllNew Start --------------------- */
    public function sendmailcreatesubuser($to,$name,$pwdemail,$subject,$body)
    {
        $gethtml = $this->htmlelements->createsubuser($name,$to,$pwdemail);
        //echo $gethtml; exit;
        //Create a new PHPMailer instance
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->SMTPDebug = 2;
        $mail->Debugoutput = 'html';
        $mail->Host = $this->Hostname;
        $mail->Port = 587;
        $mail->SMTPSecure = 'tls';
        $mail->SMTPAuth = true;
        $mail->Username = $this->hosemail;
        $mail->Password = $this->pwdemail;
        $mail->setFrom($this->hosemail, 'Volody');
        $mail->addReplyTo($this->hosemail, 'Volody');
        //add cc
        //$mail->addCC('sd7@consultlane.com','Rushikesh Salunke');
        //Set who the message is to be sent to
        $mail->addAddress($to, $name);
        $mail->Subject = 'Welcome to Volody';
        $mail->msgHTML($gethtml);

        if ($mail->Send()) {
            $get = array('logged'=>true,'message'=>'sent');
        }
        else {
            //echo $mail->ErrorInfo; exit;
            $get = array('logged'=>false,'message'=>'nosent');
        }

        //$mail->ClearAddresses();
        //$mail->ClearAttachments();
        //echo '<pre>'; print_r($get); exit;
        return $get;
    }
/* --------------------- AllNew End --------------------- */



/* --------------------- AllNew Start --------------------- */
    public function sendrequestapproval($mailids,$userids,$filepath,$summdoc,$emailcontent)
    {
        $subject = 'Received Contract For Approval';
        $to =$mailids;
        $gethtml = $this->htmlelements->sendforapproval($subject,$userids,$emailcontent);
        //echo $gethtml; exit;
        //Create a new PHPMailer instance
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->SMTPDebug = 2;
        $mail->Debugoutput = 'html';
        $mail->Host = $this->Hostname;
        $mail->Port = 587;
        $mail->SMTPSecure = 'tls';
        $mail->SMTPAuth = true;
        $mail->Username = $this->hosemail;
        $mail->Password = $this->pwdemail;
        $mail->setFrom($this->hosemail, 'Volody');
        $mail->addReplyTo($this->hosemail, 'Volody');
        //add cc
        //$mail->addCC('sd7@consultlane.com','Rushikesh Salunke');
        //Set who the message is to be sent to
        $mail->addAddress($to, 'Volody');
        $mail->Subject = $subject;
        
        $mail->msgHTML($gethtml);
        $mail->addAttachment(''.$filepath.'');
        $mail->addAttachment(''.$summdoc.'');
        // $mail->addAttachment(''.$summdoc.'');
        //send the message, check for errors

        if ($mail->Send()) {
            $get = array('logged'=>true,'message'=>$summdoc);
        }
        else {
            //echo $mail->ErrorInfo; exit;
            $get = array('logged'=>false,'message'=>'nosent');
        }

        //echo '<pre>'; print_r($get); exit;
        return $get;
    }
    
    
    public function sendrequestapprovallegal($mailids,$userids,$filepath,$emailcontent)
    {
        //echo "reached";print_r($summdoc);exit;

        $subject = 'Received Contract For Approval';
        $to =$mailids;
        $gethtml = $this->htmlelements->sendforapprovallegal($subject,$userids,$emailcontent);
        //echo $gethtml; exit;
        //Create a new PHPMailer instance
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->SMTPDebug = 2;
        $mail->Debugoutput = 'html';
        $mail->Host = $this->Hostname;
        $mail->Port = 587;
        $mail->SMTPSecure = 'tls';
        $mail->SMTPAuth = true;
        $mail->Username = $this->hosemail;
        $mail->Password = $this->pwdemail;
        $mail->setFrom($this->hosemail, 'Volody');
        $mail->addReplyTo($this->hosemail, 'Volody');
        //add cc
        //$mail->addCC('sd7@consultlane.com','Rushikesh Salunke');
        //Set who the message is to be sent to
        $mail->addAddress($to, 'Volody');
        $mail->Subject = $subject;
        
        $mail->msgHTML($gethtml);
        $mail->addAttachment(''.$filepath.'');
        //send the message, check for errors

        if ($mail->Send()) {
            $get = array('logged'=>true);
        }
        else {
            //echo $mail->ErrorInfo; exit;
            $get = array('logged'=>false,'message'=>'nosent');
        }
        //echo '<pre>'; print_r($get); exit;
        return $get;
    }
/* --------------------- AllNew End --------------------- */

   
    /* --------------------- AllNew Start --------------------- */
    public function sendrequestlegal($mailids,$emailcontent)
    {
        //echo "reached";print_r($mailids);exit;

        $subject = 'Received New Contract Request';
        $to =$mailids;
        $gethtml = $this->htmlelements->sendforlegalapproval($subject,$emailcontent);
        //echo $gethtml; exit;
        //Create a new PHPMailer instance
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->SMTPDebug = 2;
        $mail->Debugoutput = 'html';
        $mail->Host = $this->Hostname;
        $mail->Port = 587;
        $mail->SMTPSecure = 'tls';
        $mail->SMTPAuth = true;
        $mail->Username = $this->hosemail;
        $mail->Password = $this->pwdemail;
        $mail->setFrom($this->hosemail, 'Volody');
        $mail->addReplyTo($this->hosemail, 'Volody');
        //add cc
        //$mail->addCC('sd7@consultlane.com','Rushikesh Salunke');
        //Set who the message is to be sent to
        $mail->addAddress($to, 'Volody');
        $mail->Subject = $subject;
        
        $mail->msgHTML($gethtml);
        //send the message, check for errors

        if ($mail->Send()) {
            $get = array('logged'=>true,'message'=>'mails sent successfully');
        }
        else {
            //echo $mail->ErrorInfo; exit;
            $get = array('logged'=>false,'message'=>'nosent');
        }
        //echo '<pre>'; print_r($get); exit;
        return $get;
    }
/* --------------------- AllNew End --------------------- */



/* --------------------- AllNew Start --------------------- */
    public function sendmsgwithmail($mailids,$agreementname,$messagenote,$requestername)
    {
        $subject = 'You Received a New Message';
        $to =$mailids;
        $gethtml = $this->htmlelements->sendmsgwithmail($subject,$agreementname,$messagenote,$requestername);
        //echo $gethtml; exit;
        //Create a new PHPMailer instance
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->SMTPDebug = 2;
        $mail->Debugoutput = 'html';
        $mail->Host = $this->Hostname;
        $mail->Port = 587;
        $mail->SMTPSecure = 'tls';
        $mail->SMTPAuth = true;
        $mail->Username = $this->hosemail;
        $mail->Password = $this->pwdemail;
        $mail->setFrom($this->hosemail, 'Volody');
        $mail->addReplyTo($this->hosemail, 'Volody');
        //add cc
        //$mail->addCC('sd7@consultlane.com','Rushikesh Salunke');
        //Set who the message is to be sent to
        $mail->addAddress($to, 'Volody');
        $mail->Subject = $subject;
        
        $mail->msgHTML($gethtml);
        //send the message, check for errors

        if ($mail->Send()) {
            $get = array('logged'=>true,'message'=>'mails sent successfully');
        }
        else {
            //echo $mail->ErrorInfo; exit;
            $get = array('logged'=>false,'message'=>'nosent');
        }
        //echo '<pre>'; print_r($get); exit;
        return $get;
    }
/* --------------------- AllNew End --------------------- */
    
    
    
    //##########################  for company restriction data ##############################
    public function mailcomprestriction($emailid,$username,$getcompdata,$periodfrom,$periodto)
    { 
        //print_r($getcompdata);exit;
        $gethtml = $this->htmlelements->mailcomprestriction($username,$getcompdata,$periodfrom,$periodto);
        //print_r($gethtml);exit;
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->SMTPDebug = 2;
        $mail->Debugoutput = 'html';
        $mail->Host = $this->Hostname;
        $mail->Port = 587;
        $mail->SMTPSecure = 'tls';
        $mail->SMTPAuth = true;
        $mail->Username = $this->hosemail;
        $mail->Password = $this->pwdemail;
        $mail->setFrom($this->hosemail, 'Volody');
        $mail->addReplyTo($this->hosemail, 'Volody');
        //add cc
       // $mail->addCC('sd7@consultlane.com','Rushikesh Salunke');
        //Set who the message is to be sent to
        $mail->addAddress($emailid, 'Volody');
        $mail->Subject = 'Restricted Company';
        $mail->msgHTML($gethtml);

        if ($mail->Send()) {
            $get = array('logged'=>true,'message'=>'sent');
        }
        else {
            //echo $mail->ErrorInfo; exit;
            $get = array('logged'=>false,'message'=>'nosent');
        }
        //echo '<pre>'; print_r($get); exit;
        return $get;
 
       
    }
    
    //##########################  for employee restriction data ##############################
    public function mailemprestriction($emailid,$username,$getcompdata,$periodfrom,$periodto)
    { 
        //print_r($periodfrom);exit;
        $gethtml = $this->htmlelements->mailemprestriction($username,$getcompdata,$periodfrom,$periodto);
        //print_r($gethtml);exit;
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->SMTPDebug = 2;
        $mail->Debugoutput = 'html';
        $mail->Host = $this->Hostname;
        $mail->Port = 587;
        $mail->SMTPSecure = 'tls';
        $mail->SMTPAuth = true;
        $mail->Username = $this->hosemail;
        $mail->Password = $this->pwdemail;
        $mail->setFrom($this->hosemail, 'Volody');
        $mail->addReplyTo($this->hosemail, 'Volody');
        //add cc
       // $mail->addCC('sd7@consultlane.com','Rushikesh Salunke');
        //Set who the message is to be sent to
        $mail->addAddress($emailid, 'Volody');
        $mail->Subject = 'Employee Restriction';
        $mail->msgHTML($gethtml);

        if ($mail->Send()) {
            $get = array('logged'=>true,'message'=>'sent');
        }
        else {
            //echo $mail->ErrorInfo; exit;
            $get = array('logged'=>false,'message'=>'nosent');
        }
        //echo '<pre>'; print_r($get); exit;
        return $get;
 
       
    }
    
    /******** send mail to approver start ********/
    public function sendmailrqstapprvl($emaildata,$mailid)
    {
        $subject = 'Received Request For Approval';
        $to =$mailid;
        $gethtml = $this->htmlelements->sendmailrqstapprvl($subject,$emaildata);
        //print_r($gethtml);
        //Create a new PHPMailer instance
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->SMTPDebug = 2;
        $mail->Debugoutput = 'html';
        $mail->Host = $this->Hostname;
        $mail->Port = 587;
        $mail->SMTPSecure = 'tls';
        $mail->SMTPAuth = true;
        $mail->Username = $this->hosemail;
        $mail->Password = $this->pwdemail;
        $mail->setFrom($this->hosemail, 'Volody');
        $mail->addReplyTo($this->hosemail, 'Volody');
        //add cc
        //$mail->addCC('sd7@consultlane.com','Rushikesh Salunke');
        //Set who the message is to be sent to
        $mail->addAddress($to, 'Volody');
        $mail->Subject = $subject;
        $mail->msgHTML($gethtml);
        $mail->addAttachment(''.$emaildata['pdfpath'].'');

        if ($mail->Send()) {
            $get = array('logged'=>true,'message'=>'sent');
        }
        else {
            //echo $mail->ErrorInfo; exit;
            $get = array('logged'=>false,'message'=>'nosent');
        }

        return $get;
    }
    /******** send mail to approver end ********/
    
    /******** send ack mail to requster start ********/
    public function sendmailackapprvl($emaildata)
    {
        $subject = 'Your request is approved';
        $to =$emaildata['email'];
        //echo $to;exit;
        $gethtml = $this->htmlelements->sendmailackapprvl($subject,$emaildata);
        //Create a new PHPMailer instance
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->SMTPDebug = 2;
        $mail->Debugoutput = 'html';
        $mail->Host = $this->Hostname;
        $mail->Port = 587;
        $mail->SMTPSecure = 'tls';
        $mail->SMTPAuth = true;
        $mail->Username = $this->hosemail;
        $mail->Password = $this->pwdemail;
        $mail->setFrom($this->hosemail, 'Volody');
        $mail->addReplyTo($this->hosemail, 'Volody');
        //add cc
        //$mail->addCC('sd7@consultlane.com','Rushikesh Salunke');
        //Set who the message is to be sent to
        $mail->addAddress($to, 'Volody');
        $mail->Subject = $subject;
        $mail->msgHTML($gethtml);
        // $mail->addAttachment(''.$summdoc.'');
        //send the message, check for errors

        if ($mail->Send()) {
            $get = array('logged'=>true,'message'=>'sent');
        }
        else {
            //echo $mail->ErrorInfo; exit;
            $get = array('logged'=>false,'message'=>'nosent');
        }

        return $get;
    }
    /******** send ack mail to requster end ********/
    
    
    /******** send mail to approver of exception rqst start ********/
    public function sendmailexcbrqstapprvl($emaildata,$mailid,$type,$add_filepath)
    {
        $subject = 'Received Exception Request For Approval';
        $to =$mailid;
        $gethtml = $this->htmlelements->sendmailexcbrqstapprvl($subject,$emaildata);
        //print_r($gethtml);exit;
        //Create a new PHPMailer instance
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->SMTPDebug = 2;
        $mail->Debugoutput = 'html';
        $mail->Host = $this->Hostname;
        $mail->Port = 587;
        $mail->SMTPSecure = 'tls';
        $mail->SMTPAuth = true;
        $mail->Username = $this->hosemail;
        $mail->Password = $this->pwdemail;
        $mail->setFrom($this->hosemail, 'Volody');
        $mail->addReplyTo($this->hosemail, 'Volody');
        //add cc
        //$mail->addCC('sd7@consultlane.com','Rushikesh Salunke');
        //Set who the message is to be sent to
        $mail->addAddress($to, 'Volody');
        $mail->Subject = $subject;
        $mail->msgHTML($gethtml);
        if($type == 'contratrd')
        {
            $mail->addAttachment(''.$emaildata['pdfpath'].'');

            if(!empty($add_filepath))
            {
                foreach($add_filepath as $key => $value)
                { 
                    $mail->addAttachment(''.$value.'');
                }
            }
        }
        
        //send the message, check for errors

        if ($mail->Send()) {
            $get = array('logged'=>true,'message'=>'sent');
        }
        else {
            //echo $mail->ErrorInfo; exit;
            $get = array('logged'=>false,'message'=>'nosent');
        }

        return $get;
    }
    /******** send mail to approver end ********/
    
    /******** send exception ack mail to requster start ********/
    public function sendexcmailackapprvl($emaildata)
    {
        $subject = 'Your exception request is approved';
        $to =$emaildata['email'];
        //echo $to;exit;
        $gethtml = $this->htmlelements->sendexcmailackapprvl($subject,$emaildata);
        //Create a new PHPMailer instance
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->SMTPDebug = 2;
        $mail->Debugoutput = 'html';
        $mail->Host = $this->Hostname;
        $mail->Port = 587;
        $mail->SMTPSecure = 'tls';
        $mail->SMTPAuth = true;
        $mail->Username = $this->hosemail;
        $mail->Password = $this->pwdemail;
        $mail->setFrom($this->hosemail, 'Volody');
        $mail->addReplyTo($this->hosemail, 'Volody');
        //add cc
        //$mail->addCC('sd7@consultlane.com','Rushikesh Salunke');
        //Set who the message is to be sent to
        $mail->addAddress($to, 'Volody');
        $mail->Subject = $subject;
        $mail->msgHTML($gethtml);
        // $mail->addAttachment(''.$summdoc.'');
        //send the message, check for errors

        if ($mail->Send()) {
            $get = array('logged'=>true,'message'=>'sent');
        }
        else {
            //echo $mail->ErrorInfo; exit;
            $get = array('logged'=>false,'message'=>'nosent');
        }

        return $get;
    }
    /******** send exception ack mail to requster end ********/
    
    /******** send final submit start ********/
    public function sendmailaftrfinlsub($emaildata,$email)
    {
        $subject = 'Final Submission Of Request';
        $to =$email;
        //echo $to;exit;
        $gethtml = $this->htmlelements->sendmailaftrfinlsub($subject,$emaildata);
        //Create a new PHPMailer instance
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->SMTPDebug = 2;
        $mail->Debugoutput = 'html';
        $mail->Host = $this->Hostname;
        $mail->Port = 587;
        $mail->SMTPSecure = 'tls';
        $mail->SMTPAuth = true;
        $mail->Username = $this->hosemail;
        $mail->Password = $this->pwdemail;
        $mail->setFrom($this->hosemail, 'Volody');
        $mail->addReplyTo($this->hosemail, 'Volody');
        //add cc
        //$mail->addCC('sd7@consultlane.com','Rushikesh Salunke');
        //Set who the message is to be sent to
        $mail->addAddress($to, 'Volody');
        $mail->Subject = $subject;
        $mail->msgHTML($gethtml);
        // $mail->addAttachment(''.$summdoc.'');
        //send the message, check for errors

        if ($mail->Send()) {
            $get = array('logged'=>true,'message'=>'sent');
        }
        else {
            //echo $mail->ErrorInfo; exit;
            $get = array('logged'=>false,'message'=>'nosent');
        }

        return $get;
    }
    /******** send final submit end ********/
    
    /******** send mail for trade request start ********/
    public function sendmailtrdepln($emaildata,$email)
    {
        $subject = 'Received Trading Plan Request For Approval';
        $to =$email;
        //echo $to;exit;
        $gethtml = $this->htmlelements->sendmailtrdepln($subject,$emaildata);
        //Create a new PHPMailer instance
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->SMTPDebug = 2;
        $mail->Debugoutput = 'html';
        $mail->Host = $this->Hostname;
        $mail->Port = 587;
        $mail->SMTPSecure = 'tls';
        $mail->SMTPAuth = true;
        $mail->Username = $this->hosemail;
        $mail->Password = $this->pwdemail;
        $mail->setFrom($this->hosemail, 'Volody');
        $mail->addReplyTo($this->hosemail, 'Volody');
        //add cc
        //$mail->addCC('sd7@consultlane.com','Rushikesh Salunke');
        //Set who the message is to be sent to
        $mail->addAddress($to, 'Volody');
        $mail->Subject = $subject;
        $mail->msgHTML($gethtml);
        // $mail->addAttachment(''.$summdoc.'');
        //send the message, check for errors

        if ($mail->Send()) {
            $get = array('logged'=>true,'message'=>'sent');
        }
        else {
            //echo $mail->ErrorInfo; exit;
            $get = array('logged'=>false,'message'=>'nosent');
        }

        return $get;
    }
    /******** send mail for trade request end ********/
    
    /******** send ack email to reqstr start ********/
    public function sendtorqstrofack($emaildata)
    {
        $subject = 'Received Acknowlegdement Of Trading Plan Request Approval';
        $to =$emaildata['email'];
        //echo $to;exit;
        $gethtml = $this->htmlelements->sendtorqstrofack($subject,$emaildata);
        //Create a new PHPMailer instance
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->SMTPDebug = 2;
        $mail->Debugoutput = 'html';
        $mail->Host = $this->Hostname;
        $mail->Port = 587;
        $mail->SMTPSecure = 'tls';
        $mail->SMTPAuth = true;
        $mail->Username = $this->hosemail;
        $mail->Password = $this->pwdemail;
        $mail->setFrom($this->hosemail, 'Volody');
        $mail->addReplyTo($this->hosemail, 'Volody');
        //add cc
        //$mail->addCC('sd7@consultlane.com','Rushikesh Salunke');
        //Set who the message is to be sent to
        $mail->addAddress($to, 'Volody');
        $mail->Subject = $subject;
        $mail->msgHTML($gethtml);
        // $mail->addAttachment(''.$summdoc.'');
        //send the message, check for errors

        if ($mail->Send()) {
            $get = array('logged'=>true,'message'=>'sent');
        }
        else {
            //echo $mail->ErrorInfo; exit;
            $get = array('logged'=>false,'message'=>'nosent');
        }

        return $get;
    }
        
    /******** send ack email to reqstr end ********/
    
    /******** sent mail of empty persnl detail strt ********/
    public function mailsenttousr($emailid,$username)
    {
        $subject = 'Please Fill Your Personal Details';
        $to =$emailid;
        //echo $to;exit;
        $gethtml = $this->htmlelements->mailsenttousr($username);
        //Create a new PHPMailer instance
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->SMTPDebug = 2;
        $mail->Debugoutput = 'html';
        $mail->Host = $this->Hostname;
        $mail->Port = 587;
        $mail->SMTPSecure = 'tls';
        $mail->SMTPAuth = true;
        $mail->Username = $this->hosemail;
        $mail->Password = $this->pwdemail;
        $mail->setFrom($this->hosemail, 'Volody');
        $mail->addReplyTo($this->hosemail, 'Volody');
        //add cc
        //$mail->addCC('sd7@consultlane.com','Rushikesh Salunke');
        //Set who the message is to be sent to
        $mail->addAddress($to, 'Volody');
        $mail->Subject = $subject;
        $mail->msgHTML($gethtml);
        // $mail->addAttachment(''.$summdoc.'');
        //send the message, check for errors

        if ($mail->Send()) {
            $get = array('logged'=>true,'message'=>'sent');
        }
        else {
            //echo $mail->ErrorInfo; exit;
            $get = array('logged'=>false,'message'=>'nosent');
        }

        return $get;
    }
    /******** sent mail of empty persnl detail end ********/
    
     /******** sent mail of holding stmnt detail strt ********/
    public function hldngmailsenttousr($emailid,$username)
    {
        $subject = 'Upload Your Holding Statement';
        $to =$emailid;
        //echo $to;exit;
        $gethtml = $this->htmlelements->hldngmailsenttousr($username);
        //Create a new PHPMailer instance
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->SMTPDebug = 2;
        $mail->Debugoutput = 'html';
        $mail->Host = $this->Hostname;
        $mail->Port = 587;
        $mail->SMTPSecure = 'tls';
        $mail->SMTPAuth = true;
        $mail->Username = $this->hosemail;
        $mail->Password = $this->pwdemail;
        $mail->setFrom($this->hosemail, 'Volody');
        $mail->addReplyTo($this->hosemail, 'Volody');
        //add cc
        //$mail->addCC('sd7@consultlane.com','Rushikesh Salunke');
        //Set who the message is to be sent to
        $mail->addAddress($to, 'Volody');
        $mail->Subject = $subject;
        $mail->msgHTML($gethtml);
        // $mail->addAttachment(''.$summdoc.'');
        //send the message, check for errors

        if ($mail->Send()) {
            $get = array('logged'=>true,'message'=>'sent');
        }
        else {
            //echo $mail->ErrorInfo; exit;
            $get = array('logged'=>false,'message'=>'nosent');
        }

        return $get;
    }
    /******** sent mail of empty holding stmnt end ********/
    
    /******** sent mail of holding stmnt detail strt ********/
    public function mailtonotdonetrdrqst($data)
    {
        $subject = 'Transaction Pending to be Completed';
        $to =$data['email'];
        $gethtml = $this->htmlelements->mailtonotdonetrdrqst($data);
        //print_r($gethtml);exit;
        //Create a new PHPMailer instance
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->SMTPDebug = 2;
        $mail->Debugoutput = 'html';
        $mail->Host = $this->Hostname;
        $mail->Port = 587;
        $mail->SMTPSecure = 'tls';
        $mail->SMTPAuth = true;
        $mail->Username = $this->hosemail;
        $mail->Password = $this->pwdemail;
        $mail->setFrom($this->hosemail, 'Volody');
        $mail->addReplyTo($this->hosemail, 'Volody');
        //add cc
        //$mail->addCC('sd7@consultlane.com','Rushikesh Salunke');
        //Set who the message is to be sent to
        $mail->addAddress($to, 'Volody');
        $mail->Subject = $subject;
        $mail->msgHTML($gethtml);
        // $mail->addAttachment(''.$summdoc.'');
        //send the message, check for errors

        if ($mail->Send()) {
            $get = array('logged'=>true,'message'=>'sent');
        }
        else {
            //echo $mail->ErrorInfo; exit;
            $get = array('logged'=>false,'message'=>'nosent');
        }

        return $get;
    }
    /******** sent mail of empty holding stmnt end ********/
    
         /******** send mail for form b start ********/
    public function mailformbapprvlrqst($emaildata,$email)
    {
        $subject = 'Received Form B Request For Approval';
        $to =$email;
        $gethtml = $this->htmlelements->mailformbapprvlrqst($subject,$emaildata);
        //Create a new PHPMailer instance
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->SMTPDebug = 2;
        $mail->Debugoutput = 'html';
        $mail->Host = $this->Hostname;
        $mail->Port = 587;
        $mail->SMTPSecure = 'tls';
        $mail->SMTPAuth = true;
        $mail->Username = $this->hosemail;
        $mail->Password = $this->pwdemail;
        $mail->setFrom($this->hosemail, 'Volody');
        $mail->addReplyTo($this->hosemail, 'Volody');
        //add cc
        //$mail->addCC('sd7@consultlane.com','Rushikesh Salunke');
        //Set who the message is to be sent to
        $mail->addAddress($to, 'Volody');
        $mail->Subject = $subject;
        $mail->msgHTML($gethtml);
        // $mail->addAttachment(''.$summdoc.'');
        //send the message, check for errors

        if ($mail->Send()) {
            $get = array('logged'=>true,'message'=>'sent');
        }
        else {
            //echo $mail->ErrorInfo; exit;
            $get = array('logged'=>false,'message'=>'nosent');
        }

        return $get;
    }
    
    public function mailformbackrqst($emaildata)
    {
        $subject = 'Your request is approved';
        $to =$emaildata['email'];
        //echo $to;exit;
        $gethtml = $this->htmlelements->mailformbackrqst($subject,$emaildata);
        //Create a new PHPMailer instance
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->SMTPDebug = 2;
        $mail->Debugoutput = 'html';
        $mail->Host = $this->Hostname;
        $mail->Port = 587;
        $mail->SMTPSecure = 'tls';
        $mail->SMTPAuth = true;
        $mail->Username = $this->hosemail;
        $mail->Password = $this->pwdemail;
        $mail->setFrom($this->hosemail, 'Volody');
        $mail->addReplyTo($this->hosemail, 'Volody');
        //add cc
        //$mail->addCC('sd7@consultlane.com','Rushikesh Salunke');
        //Set who the message is to be sent to
        $mail->addAddress($to, 'Volody');
        $mail->Subject = $subject;
        $mail->msgHTML($gethtml);
        // $mail->addAttachment(''.$summdoc.'');
        //send the message, check for errors

        if ($mail->Send()) {
            $get = array('logged'=>true,'message'=>'sent');
        }
        else {
            //echo $mail->ErrorInfo; exit;
            $get = array('logged'=>false,'message'=>'nosent');
        }

        return $get;
    }
    /******** send mail for form b end ********/
    
    /******** send mail for form c start ********/
    public function mailformcapprvlrqst($emaildata,$email)
    {
        $subject = 'Received Form C';
        $to =$email;
        //echo $to;exit;
        $gethtml = $this->htmlelements->mailformcapprvlrqst($subject,$emaildata);
        //Create a new PHPMailer instance
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->SMTPDebug = 2;
        $mail->Debugoutput = 'html';
        $mail->Host = $this->Hostname;
        $mail->Port = 587;
        $mail->SMTPSecure = 'tls';
        $mail->SMTPAuth = true;
        $mail->Username = $this->hosemail;
        $mail->Password = $this->pwdemail;
        $mail->setFrom($this->hosemail, 'Volody');
        $mail->addReplyTo($this->hosemail, 'Volody');
        //add cc
        //$mail->addCC('sd7@consultlane.com','Rushikesh Salunke');
        //Set who the message is to be sent to
        $mail->addAddress($to, 'Volody');
        $mail->Subject = $subject;
        $mail->msgHTML($gethtml);
        // $mail->addAttachment(''.$summdoc.'');
        if ($mail->Send()) {
            $get = array('logged'=>true,'message'=>'sent');
        }
        else {
            //echo $mail->ErrorInfo; exit;
            $get = array('logged'=>false,'message'=>'nosent');
        }

        return $get;
    }
    
    public function mailformcackrqst($emaildata)
    {
        $subject = 'Your request is approved';
        $to =$emaildata['email'];
        //echo $to;exit;
        $gethtml = $this->htmlelements->mailformcackrqst($subject,$emaildata);
        //Create a new PHPMailer instance
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->SMTPDebug = 2;
        $mail->Debugoutput = 'html';
        $mail->Host = $this->Hostname;
        $mail->Port = 587;
        $mail->SMTPSecure = 'tls';
        $mail->SMTPAuth = true;
        $mail->Username = $this->hosemail;
        $mail->Password = $this->pwdemail;
        $mail->setFrom($this->hosemail, 'Volody');
        $mail->addReplyTo($this->hosemail, 'Volody');
        //add cc
        //$mail->addCC('sd7@consultlane.com','Rushikesh Salunke');
        //Set who the message is to be sent to
        $mail->addAddress($to, 'Volody');
        $mail->Subject = $subject;
        $mail->msgHTML($gethtml);
        // $mail->addAttachment(''.$summdoc.'');
        //send the message, check for errors

        if ($mail->Send()) {
            $get = array('logged'=>true,'message'=>'sent');
        }
        else {
            //echo $mail->ErrorInfo; exit;
            $get = array('logged'=>false,'message'=>'nosent');
        }

        return $get;
    }
    /******** send mail for form c end ********/
    
    /******** send mail for form d start ********/
    public function mailformdapprvlrqst($emaildata,$email)
    {
        $subject = 'Received Form D Request For Approval';
        $to =$email;
        //echo $to;exit;
        $gethtml = $this->htmlelements->mailformdapprvlrqst($subject,$emaildata);
        //Create a new PHPMailer instance
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->SMTPDebug = 2;
        $mail->Debugoutput = 'html';
        $mail->Host = $this->Hostname;
        $mail->Port = 587;
        $mail->SMTPSecure = 'tls';
        $mail->SMTPAuth = true;
        $mail->Username = $this->hosemail;
        $mail->Password = $this->pwdemail;
        $mail->setFrom($this->hosemail, 'Volody');
        $mail->addReplyTo($this->hosemail, 'Volody');
        //add cc
        //$mail->addCC('sd7@consultlane.com','Rushikesh Salunke');
        //Set who the message is to be sent to
        $mail->addAddress($to, 'Volody');
        $mail->Subject = $subject;
        $mail->msgHTML($gethtml);
        // $mail->addAttachment(''.$summdoc.'');
        //send the message, check for errors

        if ($mail->Send()) {
            $get = array('logged'=>true,'message'=>'sent');
        }
        else {
            //echo $mail->ErrorInfo; exit;
            $get = array('logged'=>false,'message'=>'nosent');
        }

        return $get;
    }
    
    public function mailformdackrqst($emaildata)
    {
        $subject = 'Your request is approved';
        $to =$emaildata['email'];
        $gethtml = $this->htmlelements->mailformdackrqst($subject,$emaildata);
        //Create a new PHPMailer instance
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->SMTPDebug = 2;
        $mail->Debugoutput = 'html';
        $mail->Host = $this->Hostname;
        $mail->Port = 587;
        $mail->SMTPSecure = 'tls';
        $mail->SMTPAuth = true;
        $mail->Username = $this->hosemail;
        $mail->Password = $this->pwdemail;
        $mail->setFrom($this->hosemail, 'Volody');
        $mail->addReplyTo($this->hosemail, 'Volody');
        //add cc
        //$mail->addCC('sd7@consultlane.com','Rushikesh Salunke');
        //Set who the message is to be sent to
        $mail->addAddress($to, 'Volody');
        $mail->Subject = $subject;
        $mail->msgHTML($gethtml);
        // $mail->addAttachment(''.$summdoc.'');
        //send the message, check for errors

        if ($mail->Send()) {
            $get = array('logged'=>true,'message'=>'sent');
        }
        else {
            //echo $mail->ErrorInfo; exit;
            $get = array('logged'=>false,'message'=>'nosent');
        }

        return $get;
    }
    /******** send mail for trading window start ********/
    
    public function mailoftradingwindow($emailcontent,$emailid)
    {
        $subject = 'Trading Window';
        $to =$emailid;
        $gethtml = $this->htmlelements->mailformdackrqst($subject,$emailcontent);
        //$gethtml = $emailcontent;
        //Create a new PHPMailer instance
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->SMTPDebug = 2;
        $mail->Debugoutput = 'html';
        $mail->Host = $this->Hostname;
        $mail->Port = 587;
        $mail->SMTPSecure = 'tls';
        $mail->SMTPAuth = true;
        $mail->Username = $this->hosemail;
        $mail->Password = $this->pwdemail;
        $mail->setFrom($this->hosemail, 'Volody');
        $mail->addReplyTo($this->hosemail, 'Volody');
        //add cc
        //$mail->addCC('sd7@consultlane.com','Rushikesh Salunke');
        //Set who the message is to be sent to
        $mail->addAddress($to, 'Volody');
        $mail->Subject = $subject;
        $mail->msgHTML($gethtml);
        // $mail->addAttachment(''.$summdoc.'');
        //send the message, check for errors

        if ($mail->Send()) {
            $get = array('logged'=>true,'message'=>'sent');
        }
        else {
            //echo $mail->ErrorInfo; exit;
            $get = array('logged'=>false,'message'=>'nosent');
        }

        return $get;
    }
    /******** send mail for trading window end ********/

    public function sendmailforpersinfo($mailids,$fullname)
    {
        //echo "reached";print_r($summdoc);exit;

        $subject = 'Approve personal information';
        $to =$mailids;
        $gethtml = $this->htmlelements->sendmailforpersinfo($subject,$fullname);
        //echo $gethtml; exit;
        //Create a new PHPMailer instance
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->SMTPDebug = 2;
        $mail->Debugoutput = 'html';
        $mail->Host = $this->Hostname;
        $mail->Port = 587;
        $mail->SMTPSecure = 'tls';
        $mail->SMTPAuth = true;
        $mail->Username = $this->hosemail;
        $mail->Password = $this->pwdemail;
        $mail->setFrom($this->hosemail, 'Volody');
        $mail->addReplyTo($this->hosemail, 'Volody');
        //add cc
        //$mail->addCC('sd7@consultlane.com','Rushikesh Salunke');
        //Set who the message is to be sent to
        $mail->addAddress($to, 'Volody');
        $mail->Subject = $subject;
        $mail->msgHTML($gethtml);

        if ($mail->Send()) {
            return true;
        }
        else {
            //echo $mail->ErrorInfo; exit;
           return false;
        }

       
    }

    //--------------------------------------AUTO MAIL TO USER-----------------------------------//
    public function sendautomailtouser($mailid,$myarry)
    {
        //echo "reached";print_r($summdoc);exit;
      
        $subject = 'Received Reminder For Trading Date..';
        $to =$mailid;
        $gethtml = $this->htmlelements->automailtouser($myarry);
        //echo $gethtml; exit;
        //Create a new PHPMailer instance
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->SMTPDebug = 2;
        $mail->Debugoutput = 'html';
        $mail->Host = $this->Hostname;
        $mail->Port = 587;
        $mail->SMTPSecure = 'tls';
        $mail->SMTPAuth = true;
        $mail->Username = $this->hosemail;
        $mail->Password = $this->pwdemail;
        $mail->setFrom($this->hosemail, 'Volody');
        $mail->addReplyTo($this->hosemail, 'Volody');
        //add cc
        //$mail->addCC('sd3@consultlane.com','Naresh Mitkari');
        //Set who the message is to be sent to
        $mail->addAddress($to, 'Volody');
        $mail->Subject = $subject;
        $mail->msgHTML($gethtml);
        //send the message, check for errors

        if ($mail->Send()) {
            $get = array('logged'=>true);
        }
        else {
            //echo $mail->ErrorInfo; exit;
            $get = array('logged'=>false);
        }
        //echo '<pre>'; print_r($get); exit;
        return $get;
    }
    

    public function sendautomailtoapprover($mailid,$myarry)
    {
      
        $subject = 'You Have Recived Reminder For Pending Trading Request';
        $to =$mailid;
        $gethtml = $this->htmlelements->automailtoapprover($myarry);
        //echo $gethtml; exit;
        //Create a new PHPMailer instance
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->SMTPDebug = 2;
        $mail->Debugoutput = 'html';
        $mail->Host = $this->Hostname;
        $mail->Port = 587;
        $mail->SMTPSecure = 'tls';
        $mail->SMTPAuth = true;
        $mail->Username = $this->hosemail;
        $mail->Password = $this->pwdemail;
        $mail->setFrom($this->hosemail, 'Volody');
        $mail->addReplyTo($this->hosemail, 'Volody');
        
        $mail->addAddress($to, 'Volody');
        $mail->Subject = $subject;
        $mail->msgHTML($gethtml);
        //send the message, check for errors

        if ($mail->Send()) {
            $get = array('logged'=>true);
        }
        else {
            //echo $mail->ErrorInfo; exit;
            $get = array('logged'=>false);
        }
        //echo '<pre>'; print_r($get); exit;
        return $get;
    }


    public function sendpendapprovmaileveryday($mailid,$mgrname,$myarry)
    {
      
        $subject = 'Conflict Of Interest declaration is waiting for Approval:'.$myarry['reqno'];
        $to =$mailid;
        $gethtml = $this->htmlelements->sendpendapprovmaileveryday($mgrname,$myarry);
        //echo $gethtml; exit;
        //Create a new PHPMailer instance
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->SMTPDebug = 2;
        $mail->Debugoutput = 'html';
        $mail->Host = $this->Hostname;
        $mail->Port = 587;
        $mail->SMTPSecure = 'tls';
        $mail->SMTPAuth = true;
        $mail->Username = $this->hosemail;
        $mail->Password = $this->pwdemail;
        $mail->setFrom($this->hosemail, 'Volody');
        $mail->addReplyTo($this->hosemail, 'Volody');
        
        $mail->addAddress($to, 'Volody');
        $mail->Subject = $subject;
        $mail->msgHTML($gethtml);
        //send the message, check for errors

        if ($mail->Send()) {
            $get = array('logged'=>true);
        }
        else {
            //echo $mail->ErrorInfo; exit;
            $get = array('logged'=>false);
        }
        //echo '<pre>'; print_r($get); exit;
        return $get;
    }


    public function sendapprmailtoccoandcs($myarry,$emailid)
    {
      
        $subject = 'Request Approved By Initiator.';
        $to =$emailid;
        $gethtml = $this->htmlelements->sendapprmailtoccoandcs($myarry);
        //echo $gethtml; exit;
        //Create a new PHPMailer instance
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->SMTPDebug = 2;
        $mail->Debugoutput = 'html';
        $mail->Host = $this->Hostname;
        $mail->Port = 587;
        $mail->SMTPSecure = 'tls';
        $mail->SMTPAuth = true;
        $mail->Username = $this->hosemail;
        $mail->Password = $this->pwdemail;
        $mail->setFrom($this->hosemail, 'Volody');
        $mail->addReplyTo($this->hosemail, 'Volody');
        
        $mail->addAddress($to, 'Volody');
        $mail->Subject = $subject;
        $mail->msgHTML($gethtml);
        //send the message, check for errors

        if ($mail->Send()) {
            $get = array('logged'=>true);
        }
        else {
            //echo $mail->ErrorInfo; exit;
            $get = array('logged'=>false);
        }
        //echo '<pre>'; print_r($get); exit;
        return $get;
    }


    public function sendaprvmailtomgr($emailto,$myarry)
    {
      
        $subject = 'Conflict Of Interest Approval';
        $gethtml = $this->htmlelements->sendaprvmailtomgr($myarry);
        //echo $gethtml; exit;
        //Create a new PHPMailer instance
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->SMTPDebug = 2;
        $mail->Debugoutput = 'html';
        $mail->Host = $this->Hostname;
        $mail->Port = 587;
        $mail->SMTPSecure = 'tls';
        $mail->SMTPAuth = true;
        $mail->Username = $this->hosemail;
        $mail->Password = $this->pwdemail;
        $mail->setFrom($this->hosemail, 'Volody');
        $mail->addReplyTo($this->hosemail, 'Volody');
        
        $mail->addAddress($emailto, 'Volody');
        $mail->Subject = $subject;
        $mail->msgHTML($gethtml);
        //send the message, check for errors

        if ($mail->Send()) {
            return true;
        }
        else {
            //echo $mail->ErrorInfo; exit;
            return false;
        }
        //echo '<pre>'; print_r($get); exit;
    }


    public function sendpdfmailappr($mailids,$getfile,$getname)
    {
        $subject = 'Initial Declaration';
        $to =$mailids;
        $gethtml = $this->htmlelements->initialdeclaration($getname);
        
        // echo $gethtml; exit;
        //Create a new PHPMailer instance
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->SMTPDebug = 2;
        $mail->Debugoutput = 'html';
        $mail->Host = $this->Hostname;
        $mail->Port = 587;
        $mail->SMTPSecure = 'tls';
        $mail->SMTPAuth = true;
        $mail->Username = $this->hosemail;
        $mail->Password = $this->pwdemail;
        $mail->setFrom($this->hosemail, 'Volody');
        $mail->addReplyTo($this->hosemail, 'Volody');
        //add cc
        //$mail->addCC('sd7@consultlane.com','Rushikesh Salunke');
        //Set who the message is to be sent to
        $mail->addAddress($to, 'Volody');
        $mail->Subject = $subject;
        $mail->msgHTML($gethtml);
        $mail->addAttachment($getfile[0]['pdfpath']);
        //send the message, check for errors

        if ($mail->Send()) {
            // print_r("true");exit;
            return true;
        }
        else {
            //echo $mail->ErrorInfo; exit;
          return false;
        }

    }

    public function sendpdfmailapprannual($mailids,$getfile,$getname,$subject)
    {
        //$subject = 'Annual Declaration';
        $to = $mailids;
        $gethtml = $this->htmlelements->initialdeclarationannual($getname);
        
        //echo $this->hosemail; exit;
        //Create a new PHPMailer instance
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->SMTPDebug = 2;
        $mail->Debugoutput = 'html';
        $mail->Host = $this->Hostname;
        $mail->Port = 587;
        $mail->SMTPSecure = 'tls';
        $mail->SMTPAuth = true;
        $mail->Username = $this->hosemail;
        $mail->Password = $this->pwdemail;
        $mail->setFrom($this->hosemail, 'Volody');
        $mail->addReplyTo($this->hosemail, 'Volody');
        //add cc
        //$mail->addCC('sd7@consultlane.com','Rushikesh Salunke');
        //Set who the message is to be sent to
        $mail->addAddress($to, 'Volody');
        $mail->Subject = $subject;
        $mail->msgHTML($gethtml);
        $mail->addAttachment($getfile);
        //send the message, check for errors
        //print_R($mail);exit;
        if ($mail->Send()) {
            // print_r("true");exit;
            return true;
        }
        else {
            echo $mail->ErrorInfo; exit;
          return false;
        }

       
    }
    

    //##########################  for UPSI trading window data ##############################
    public function mailofupsitradingwindow($emailid,$username,$upsitype,$enddate,$addedby,$pstartdate,$today)
    {
        $gethtml = $this->htmlelements->mailofupsitradingwindow($username,$upsitype,$enddate,$addedby,$pstartdate,$today);
        //print_r($emailid);exit;
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->SMTPDebug = 2;
        $mail->Debugoutput = 'html';
        $mail->Host = $this->Hostname;
        $mail->Port = 587;
        $mail->SMTPSecure = 'tls';
        $mail->SMTPAuth = true;
        $mail->Username = $this->hosemail;
        $mail->Password = $this->pwdemail;
        $mail->setFrom($this->hosemail, 'Volody');
        $mail->addReplyTo($this->hosemail, 'Volody');
        //add cc
        //$mail->addCC('sd7@consultlane.com','Rushikesh Salunke');
        //Set who the message is to be sent to
        $mail->addAddress($emailid, 'Volody');
        $mail->Subject = 'Trading Window Closure';
        $mail->msgHTML($gethtml);
        //Replace the plain text body with one created manually
        //send the message, check for errors

        if ($mail->Send()) {
            $get = array('logged'=>true,'message'=>'sent');
        }
        else {
            //echo $mail->ErrorInfo; exit;
            $get = array('logged'=>false,'message'=>'nosent');
        }
        //echo '<pre>'; print_r($get); exit;
        return $get;
 
       
    }

 public function mailofType1($toemail,$todaydate,$title,$upsiinfo,$dpnames,$greeting)
    {

        $date_added =  explode(" ", $upsiinfo['date_added']);
        $date_timestamp = strtotime($date_added[0]);
        $new_date = date("d-m-Y",  $date_timestamp);

        $gethtml = $this->htmlelements->Type1content($toemail,$todaydate,$title,$new_date,$upsiinfo['fullname'],$dpnames,$greeting);
        //print_r($toemail);exit;
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->SMTPDebug = 2;
        $mail->Debugoutput = 'html';
        $mail->Host = $this->Hostname;
        $mail->Port = 587;
        $mail->SMTPSecure = 'tls';
        $mail->SMTPAuth = true;
        $mail->Username = $this->hosemail;
        $mail->Password = $this->pwdemail;
        $mail->setFrom($this->hosemail, 'Volody');
        $mail->addReplyTo($this->hosemail, 'Volody');
        //add cc
        //$mail->addCC('sd7@consultlane.com','Rushikesh Salunke');
        //Set who the message is to be sent to
        $mail->addAddress($toemail, 'Volody');
        $mail->Subject = 'New DP Added';
        $mail->msgHTML($gethtml);
        //Replace the plain text body with one created manually
        //send the message, check for errors

        if ($mail->Send()) {
         
            return true;
        }
        else {
            //echo $mail->ErrorInfo; exit;
           return false;
        }

        return $get;
 
       
    }


    
 public function mailofType2($toemail,$username,$upsitype,$ownername,$pstartdate,$emaildate,$date_added)
 {

     $date_added =  explode(" ", $date_added);
     $date_timestamp = strtotime($date_added[0]);
     $new_date = date("d-m-Y",  $date_timestamp);

     $gethtml = $this->htmlelements->Type2content($toemail,$username,$upsitype,$ownername,$pstartdate,$emaildate,$date_added[0]);
     //print_r($toemail);exit;
     $mail = new PHPMailer();
     $mail->isSMTP();
     $mail->SMTPDebug = 2;
     $mail->Debugoutput = 'html';
     $mail->Host = $this->Hostname;
     $mail->Port = 587;
     $mail->SMTPSecure = 'tls';
     $mail->SMTPAuth = true;
     $mail->Username = $this->hosemail;
     $mail->Password = $this->pwdemail;
     $mail->setFrom($this->hosemail, 'Volody');
     $mail->addReplyTo($this->hosemail, 'Volody');
     //add cc
     //$mail->addCC('sd7@consultlane.com','Rushikesh Salunke');
     //Set who the message is to be sent to
     $mail->addAddress($toemail, 'Volody');
     $mail->Subject = 'New DP Added';
     $mail->msgHTML($gethtml);
     //Replace the plain text body with one created manually
     //send the message, check for errors

     if ($mail->Send()) {
      
         $get = array('logged'=>true,'message'=>'sent');
     }
     else {
         //echo $mail->ErrorInfo; exit;
        $get = array('logged'=>false,'message'=>'nosent');
     }

     return $get;

    
 }

    public function mailofnewdp($toemail,$tousername,$pstartdate,$enddate,$today,$fromusername,$upsitype)
    {

       // print_r($tousername);exit;
        $gethtml = $this->htmlelements->mailofupdatedp($toemail,$tousername,$pstartdate,$enddate,$today,$fromusername,$upsitype);
            //print_r($gethtml);exit;
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->SMTPDebug = 2;
        $mail->Debugoutput = 'html';
        $mail->Host = $this->Hostname;
        $mail->Port = 587;
        $mail->SMTPSecure = 'tls';
        $mail->SMTPAuth = true;
        $mail->Username = $this->hosemail;
        $mail->Password = $this->pwdemail;
        $mail->setFrom($this->hosemail, 'Volody');
        $mail->addReplyTo($this->hosemail, 'Volody');
        //add cc
        //$mail->addCC('sd7@consultlane.com','Rushikesh Salunke');
        //Set who the message is to be sent to
        $mail->addAddress($toemail, 'Volody');
        $mail->Subject = 'Trading Window Closure';
        $mail->msgHTML($gethtml);
        //Replace the plain text body with one created manually
        //send the message, check for errors

        if ($mail->Send()) {
         
            return true;
        }
        else {
            //echo $mail->ErrorInfo; exit;
           return false;
        }

        return $get;
 
       
    }

    public function mailofnewupsisharing($uniquemail,$sharingdate,$upsiname,$toname,$category,$projctowner)
    {

        //print_r($category);exit;
        if($category == 14)
        {
             $gethtml = $this->htmlelements->internalmember($uniquemail,$sharingdate,$upsiname,$toname,$projctowner);
        }
        else
        {
            $gethtml = $this->htmlelements->externalmember($uniquemail,$sharingdate,$upsiname,$toname,$projctowner);
            //print_r($gethtml);exit;
        }
       
        //print_r($gethtml);exit;
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->SMTPDebug = 2;
        $mail->Debugoutput = 'html';
        $mail->Host = $this->Hostname;
        $mail->Port = 587;
        $mail->SMTPSecure = 'tls';
        $mail->SMTPAuth = true;
        $mail->Username = $this->hosemail;
        $mail->Password = $this->pwdemail;
        $mail->setFrom($this->hosemail, 'Volody');
        $mail->addReplyTo($this->hosemail, 'Volody');
        //add cc
        //$mail->addCC('sd7@consultlane.com','Rushikesh Salunke');
        //Set who the message is to be sent to
        $mail->addAddress($uniquemail, 'Volody');
        $mail->Subject = "You have been added to digital database of Dr. Reddy's Laboratories Ltd";
        $mail->msgHTML($gethtml);
        //Replace the plain text body with one created manually
        //send the message, check for errors

        if ($mail->Send()) {
            $get = array('logged'=>true,'message'=>'sent');
        }
        else {
            //echo $mail->ErrorInfo; exit;
            $get = array('logged'=>false,'message'=>'nosent');
        }
        //echo '<pre>'; print_r($get); exit;
        return $get;
 
       
    }


    public function mailofpersonalinfo($emaildata)
    {

        //print_r($emailid);exit;
        $gethtml = $this->htmlelements->mailofpersonalinfo($emaildata);
        //print_r($gethtml);exit;
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->SMTPDebug = 2;
        $mail->Debugoutput = 'html';
        $mail->Host = $this->Hostname;
        $mail->Port = 587;
        $mail->SMTPSecure = 'tls';
        $mail->SMTPAuth = true;
        $mail->Username = $this->hosemail;
        $mail->Password = $this->pwdemail;
        $mail->setFrom($this->hosemail, 'Volody');
        $mail->addReplyTo($this->hosemail, 'Volody');
        //add cc
        //$mail->addCC('sd7@consultlane.com','Rushikesh Salunke');
        //Set who the message is to be sent to
        $mail->addAddress($emaildata['toemail'], 'Volody');
        $mail->Subject = 'Personal Information';
        $mail->msgHTML($gethtml);
        //Replace the plain text body with one created manually
        //send the message, check for errors

        if ($mail->Send()) {
            
            $get = array('logged'=>true,'message'=>'sent');
        }
        else {
            //echo $mail->ErrorInfo; exit;
            $get = array('logged'=>false,'message'=>'nosent');
        }
        //echo '<pre>'; print_r($get); exit;
        return $get;
 
       
    }


    public function notifyupsi($addedby,$addedbyemail,$data,$todaydate,$dayOfWeek)
    {

        //print_r($emailid);exit;
        $gethtml = $this->htmlelements->notifyupsi($addedby,$addedbyemail,$data['upname'],$data['projdesc'],$todaydate,$dayOfWeek);
        //print_r($addedbyemail);exit;
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->SMTPDebug = 2;
        $mail->Debugoutput = 'html';
        $mail->Host = $this->Hostname;
        $mail->Port = 587;
        $mail->SMTPSecure = 'tls';
        $mail->SMTPAuth = true;
        $mail->Username = $this->hosemail;
        $mail->Password = $this->pwdemail;
        $mail->setFrom($this->hosemail, 'Volody');
        $mail->addReplyTo($this->hosemail, 'Volody');
        //add cc
        //$mail->addCC('sd7@consultlane.com','Rushikesh Salunke');
        //Set who the message is to be sent to
        $mail->addAddress($addedbyemail, 'Volody');
        $mail->Subject = 'New UPSI Created';
        $mail->msgHTML($gethtml);
        //Replace the plain text body with one created manually
        //send the message, check for errors

        if ($mail->Send()) {
            
            $get = array('logged'=>true,'message'=>'sent');
        }
        else {
            //echo $mail->ErrorInfo; exit;
            $get = array('logged'=>false,'message'=>'nosent');
        }
        //echo '<pre>'; print_r($get); exit;
        return $get;
 
       
    }


    public function notifysharing($name,$loggedemail,$upsiname,$todaydate,$dayOfWeek,$nameoflogged)
    {

        //print_r($emailid);exit;
        $gethtml = $this->htmlelements->notifysharing($name,$loggedemail,$upsiname,$todaydate,$dayOfWeek,$nameoflogged);
        //print_r($gethtml);exit;
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->SMTPDebug = 2;
        $mail->Debugoutput = 'html';
        $mail->Host = $this->Hostname;
        $mail->Port = 587;
        $mail->SMTPSecure = 'tls';
        $mail->SMTPAuth = true;
        $mail->Username = $this->hosemail;
        $mail->Password = $this->pwdemail;
        $mail->setFrom($this->hosemail, 'Volody');
        $mail->addReplyTo($this->hosemail, 'Volody');
        //add cc
        //$mail->addCC('sd7@consultlane.com','Rushikesh Salunke');
        //Set who the message is to be sent to
        $mail->addAddress($loggedemail, 'Volody');
        $mail->Subject = 'A new entry was added in UPSI';
        $mail->msgHTML($gethtml);
        //Replace the plain text body with one created manually
        //send the message, check for errors

        if ($mail->Send()) {
            
            $get = array('logged'=>true,'message'=>'sent');
        }
        else {
            //echo $mail->ErrorInfo; exit;
            $get = array('logged'=>false,'message'=>'nosent');
        }
        //echo '<pre>'; print_r($get); exit;
        return $get;
 
       
    }


    /******** send RTA EMAIL start ********/
    public function sendmailRTA($email,$name,$diffrnc)
    {
        $subject = 'Difference in your holdings';
        $to =$email;
        //echo $to;exit;
        $gethtml = $this->htmlelements->sendmailRTA($name,$diffrnc);
        //Create a new PHPMailer instance
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->SMTPDebug = 2;
        $mail->Debugoutput = 'html';
        $mail->Host = $this->Hostname;
        $mail->Port = 587;
        $mail->SMTPSecure = 'tls';
        $mail->SMTPAuth = true;
        $mail->Username = $this->hosemail;
        $mail->Password = $this->pwdemail;
        $mail->setFrom($this->hosemail, 'Volody');
        $mail->addReplyTo($this->hosemail, 'Volody');
        //add cc
        //$mail->addCC('sd7@consultlane.com','Rushikesh Salunke');
        //Set who the message is to be sent to
        $mail->addAddress($to, 'Volody');
        $mail->Subject = $subject;
        $mail->msgHTML($gethtml);
        // $mail->addAttachment(''.$summdoc.'');
        //send the message, check for errors

        if ($mail->Send()) {
           
           return true;
        }
        else {
        echo $mail->ErrorInfo; exit;
          return false;
        }

        return $get;
    }
    /******** send RTA EMAIL end ********/



     /*---- Send Auto Mail to User For Annual Declaration -----*/
    public function mailsenttousrfranualdecl($emailid,$username,$year)
    {
        $subject = 'Annual Declaration Pending For Current Year';
        $to =$emailid;
        $gethtml = $this->htmlelements->mailsenttousrfranualdecl($username,$year);
        //print_r($gethtml);exit;
        //Create a new PHPMailer instance
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->SMTPDebug = 2;
        $mail->Debugoutput = 'html';
        $mail->Host = $this->Hostname;
        $mail->Port = 587;
        $mail->SMTPSecure = 'tls';
        $mail->SMTPAuth = true;
        $mail->Username = $this->hosemail;
        $mail->Password = $this->pwdemail;
        $mail->setFrom($this->hosemail, 'Volody');
        $mail->addReplyTo($this->hosemail, 'Volody');
        //add cc
        //$mail->addCC('sd7@consultlane.com','Rushikesh Salunke');
        //Set who the message is to be sent to
        $mail->addAddress($to, 'Volody');
        $mail->Subject = $subject;
        $mail->msgHTML($gethtml);
        //send the message, check for errors

        if ($mail->Send()) {
            $get = array('logged'=>true,'message'=>'sent');
        }
        else {
            //echo $mail->ErrorInfo; exit;
            $get = array('logged'=>false,'message'=>'nosent');
        }
        
        return $get;
    }
    /*---- Send Auto Mail to User For Annual Declaration -----*/
    
    public function sendAckMailtoReq($emailto,$myarry)
    {
      
        $subject = 'Submission of Conflict of Interest Request ('.$myarry['reqno'].')';
        $gethtml = $this->htmlelements->sendAckMailtoReq($myarry);
        //echo $gethtml; exit;
        //Create a new PHPMailer instance
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->SMTPDebug = 2;
        $mail->Debugoutput = 'html';
        $mail->Host = $this->Hostname;
        $mail->Port = 587;
        $mail->SMTPSecure = 'tls';
        $mail->SMTPAuth = true;
        $mail->Username = $this->hosemail;
        $mail->Password = $this->pwdemail;
        $mail->setFrom($this->hosemail, 'Volody');
        $mail->addReplyTo($this->hosemail, 'Volody');
        
        $mail->addAddress($emailto, 'Volody');
        $mail->Subject = $subject;
        $mail->msgHTML($gethtml);
        //send the message, check for errors

        if ($mail->Send()) {
            return true;
        }
        else {
            //echo $mail->ErrorInfo; exit;
            return false;
        }
        //echo '<pre>'; print_r($get); exit;
    }
    
    public function sendRemindtoReqstr($emailto,$username)
    {
      
        $subject = 'Pending Conflict of Interest Declaration';
        $gethtml = $this->htmlelements->sendRemindtoReqstr($username);
        //echo $gethtml; exit;
        //Create a new PHPMailer instance
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->SMTPDebug = 2;
        $mail->Debugoutput = 'html';
        $mail->Host = $this->Hostname;
        $mail->Port = 587;
        $mail->SMTPSecure = 'tls';
        $mail->SMTPAuth = true;
        $mail->Username = $this->hosemail;
        $mail->Password = $this->pwdemail;
        $mail->setFrom($this->hosemail, 'Volody');
        $mail->addReplyTo($this->hosemail, 'Volody');
        
        $mail->addAddress($emailto, 'Volody');
        $mail->Subject = $subject;
        $mail->msgHTML($gethtml);
        //send the message, check for errors

        if ($mail->Send()) {
            return true;
        }
        else {
            //echo $mail->ErrorInfo; exit;
            return false;
        }
        //echo '<pre>'; print_r($get); exit;
    }

    public function requestapprmailtoccoandcs($myarry,$emailid)
    {
      
        $subject = 'COI Request Submitted By Initiator.';
        $to =$emailid;
        $gethtml = $this->htmlelements->requestapprmailtoccoandcs($myarry);
        //echo $gethtml; exit;
        //Create a new PHPMailer instance
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->SMTPDebug = 2;
        $mail->Debugoutput = 'html';
        $mail->Host = $this->Hostname;
        $mail->Port = 587;
        $mail->SMTPSecure = 'tls';
        $mail->SMTPAuth = true;
        $mail->Username = $this->hosemail;
        $mail->Password = $this->pwdemail;
        $mail->setFrom($this->hosemail, 'Volody');
        $mail->addReplyTo($this->hosemail, 'Volody');
        
        $mail->addAddress($to, 'Volody');
        $mail->Subject = $subject;
        $mail->msgHTML($gethtml);
        //send the message, check for errors

        if ($mail->Send()) {
            $get = array('logged'=>true);
        }
        else {
            //echo $mail->ErrorInfo; exit;
            $get = array('logged'=>false);
        }
        //echo '<pre>'; print_r($get); exit;
        return $get;
    }


    public function rejectmailtoccoandcs($myarry,$emailid)
    {
      
        $subject = 'COI Request Rejected By Manager/Hr.';
        $to =$emailid;
        $gethtml = $this->htmlelements->rejectmailtoccoandcs($myarry);
        //echo $gethtml; exit;
        //Create a new PHPMailer instance
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->SMTPDebug = 2;
        $mail->Debugoutput = 'html';
        $mail->Host = $this->Hostname;
        $mail->Port = 587;
        $mail->SMTPSecure = 'tls';
        $mail->SMTPAuth = true;
        $mail->Username = $this->hosemail;
        $mail->Password = $this->pwdemail;
        $mail->setFrom($this->hosemail, 'Volody');
        $mail->addReplyTo($this->hosemail, 'Volody');
        
        $mail->addAddress($to, 'Volody');
        $mail->Subject = $subject;
        $mail->msgHTML($gethtml);
        //send the message, check for errors

        if ($mail->Send()) {
            $get = array('logged'=>true);
        }
        else {
            //echo $mail->ErrorInfo; exit;
            $get = array('logged'=>false);
        }
        //echo '<pre>'; print_r($get); exit;
        return $get;
    }
    
    public function returnMailToRequestor($myarry,$emailid)
    {
      
        $subject = 'Conflict Of Interest declaration request is returned : '.$myarry['reqno'];
        $to =$emailid;
        $gethtml = $this->htmlelements->returnMailToRequestor($myarry);
        //echo $gethtml; exit;
        //Create a new PHPMailer instance
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->SMTPDebug = 2;
        $mail->Debugoutput = 'html';
        $mail->Host = $this->Hostname;
        $mail->Port = 587;
        $mail->SMTPSecure = 'tls';
        $mail->SMTPAuth = true;
        $mail->Username = $this->hosemail;
        $mail->Password = $this->pwdemail;
        $mail->setFrom($this->hosemail, 'Volody');
        $mail->addReplyTo($this->hosemail, 'Volody');
        
        $mail->addAddress($to, 'Volody');
        $mail->Subject = $subject;
        $mail->msgHTML($gethtml);
        //send the message, check for errors

        if ($mail->Send()) {
            $get = array('logged'=>true);
        }
        else {
            //echo $mail->ErrorInfo; exit;
            $get = array('logged'=>false);
        }
        //echo '<pre>'; print_r($get); exit;
        return $get;
    }

    public function approvalMailToRequestor($myarry,$emailid)
    {
      
        $subject = 'Conflict Of Interest declaration request has been approved.';
        $to =$emailid;
        $gethtml = $this->htmlelements->approvalMailToRequestor($myarry);
        //echo $gethtml; exit;
        //Create a new PHPMailer instance
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->SMTPDebug = 2;
        $mail->Debugoutput = 'html';
        $mail->Host = $this->Hostname;
        $mail->Port = 587;
        $mail->SMTPSecure = 'tls';
        $mail->SMTPAuth = true;
        $mail->Username = $this->hosemail;
        $mail->Password = $this->pwdemail;
        $mail->setFrom($this->hosemail, 'Volody');
        $mail->addReplyTo($this->hosemail, 'Volody');
        
        $mail->addAddress($to, 'Volody');
        $mail->Subject = $subject;
        $mail->msgHTML($gethtml);
        //send the message, check for errors

        if ($mail->Send()) {
            $get = array('logged'=>true);
        }
        else {
            //echo $mail->ErrorInfo; exit;
            $get = array('logged'=>false);
        }
        //echo '<pre>'; print_r($get); exit;
        return $get;
    }

    public function rejectMailToRequestor($myarry,$emailid)
    {
      
        $subject = 'Conflict Of Interest declaration request has been rejected.';
        $to =$emailid;
        $gethtml = $this->htmlelements->rejectMailToRequestor($myarry);
        //echo $gethtml; exit;
        //Create a new PHPMailer instance
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->SMTPDebug = 2;
        $mail->Debugoutput = 'html';
        $mail->Host = $this->Hostname;
        $mail->Port = 587;
        $mail->SMTPSecure = 'tls';
        $mail->SMTPAuth = true;
        $mail->Username = $this->hosemail;
        $mail->Password = $this->pwdemail;
        $mail->setFrom($this->hosemail, 'Volody');
        $mail->addReplyTo($this->hosemail, 'Volody');
        
        $mail->addAddress($to, 'Volody');
        $mail->Subject = $subject;
        $mail->msgHTML($gethtml);
        //send the message, check for errors

        if ($mail->Send()) {
            $get = array('logged'=>true);
        }
        else {
            //echo $mail->ErrorInfo; exit;
            $get = array('logged'=>false);
        }
        //echo '<pre>'; print_r($get); exit;
        return $get;
    }
    
}
