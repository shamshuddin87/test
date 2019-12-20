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
        $mail->Port = 465;
        $mail->SMTPSecure = 'tls';
        $mail->SMTPAuth = true;
        $mail->Username = $this->hosemail;
        $mail->Password = $this->pwdemail;
        $mail->setFrom($this->hosemail, 'Volody');
        $mail->addReplyTo('simply@consultlane.com', 'Volody Password');
        $mail->addBCC("sd7@consultlane.com","Rushikesh Salunke");
        $mail->addAddress($to, $name);
        $mail->Subject = $subject;
        $mail->msgHTML($body);
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
        $mail->addBCC("sd7@consultlane.com","Rushikesh Salunke ");
        $mail->addAddress($to, $name);
        $mail->Subject = $subject;
        //Read an HTML message body from an external file, convert referenced images to embedded,
        //convert HTML into a basic plain-text alternative body
        //$mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));
        //Replace the plain text body with one created manually
        $comment = 'Notification';
        $mail->msgHTML($body);
        //$mail->Body ="Event Triggered now - ".$department." Eventid- ".$eventid;
        //echo '<pre>'; print_r($mail); exit;
        
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
        /*//Set who the message is to be sent from
        $mail->setFrom($this->fromemaili, $this->frometitle);
        //Set an alternative reply-to address
        $mail->addReplyTo($this->fromemailii, $this->frometitle_contact);
        $mail->addBCC("","");
        //Set who the message is to be sent to
        $mail->addAddress($to, $name);
        //Set the subject line
        $mail->Subject = $subject;
        //Read an HTML message body from an external file, convert referenced images to embedded,
        $mail->msgHTML($body);
        //Replace the plain text body with one created manually
        $mail->AltBody = 'To view the message, please use an HTML compatible email viewer!';*/

       //$mail = new PHPMailer;
        //Tell PHPMailer to use SMTP
        $mail->isSMTP();
        //Enable SMTP debugging
        // 0 = off (for production use)
        // 1 = client messages
        // 2 = client and server messages
        $mail->SMTPDebug = 2;
        //Ask for HTML-friendly debug output
        $mail->Debugoutput = 'html';
        //Set the hostname of the mail server
        $mail->Host = 'smtp.gmail.com';
        // use
        // $mail->Host = gethostbyname('smtp.gmail.com');
        // if your network does not support SMTP over IPv6
        //Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
        $mail->Port = 587;
        //Set the encryption system to use - ssl (deprecated) or tls
        $mail->SMTPSecure = 'tls';
        //Whether to use SMTP authentication
        $mail->SMTPAuth = true;
        //Username to use for SMTP authentication - use full email address for gmail
        $mail->Username = "simply@consultlane.com";
        //Password to use for SMTP authentication
        $mail->Password = "Revenue!@#";
        //Set who the message is to be sent from
        $mail->setFrom('simply@consultlane.com', 'Volody');
        //Set an alternative reply-to address
        $mail->addReplyTo('simply@consultlane.com', 'Volody');
        //add cc
        //$mail->addCC('sd7@consultlane.com','Rushikesh Salunke');
        //Set who the message is to be sent to
        $mail->addAddress($to, $name);
        //Set the subject line
        $mail->Subject = 'Welcome to Volody';
        //Read an HTML message body from an external file, convert referenced images to embedded,
        //convert HTML into a basic plain-text alternative body
        $mail->msgHTML($gethtml);
        //Replace the plain text body with one created manually

        //Attach an image file
        //$mail->addAttachment('images/phpmailer_mini.png');
        //send the message, check for errors

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
        //echo "reached";print_r($summdoc);exit;

        $subject = 'Received Contract For Approval';
        $to =$mailids;
       // $to="mitkarinaresh25@gmail.com";
        $gethtml = $this->htmlelements->sendforapproval($subject,$userids,$emailcontent);
        //echo $gethtml; exit;
        //Create a new PHPMailer instance
        $mail = new PHPMailer();
        
        $mail->isSMTP();
        
        $mail->SMTPDebug = 2;
        //Ask for HTML-friendly debug output
        $mail->Debugoutput = 'html';
        //Set the hostname of the mail server
        $mail->Host = 'smtp.gmail.com';
        
        $mail->Port = 587;
        //Set the encryption system to use - ssl (deprecated) or tls
        $mail->SMTPSecure = 'tls';
        //Whether to use SMTP authentication
        $mail->SMTPAuth = true;
        //Username to use for SMTP authentication - use full email address for gmail
        $mail->Username = "simply@consultlane.com";
        //Password to use for SMTP authentication
        $mail->Password = "Revenue!@#";
        //Set who the message is to be sent from
        $mail->setFrom('simply@consultlane.com', 'Volody');
        //Set an alternative reply-to address
        $mail->addReplyTo('simply@consultlane.com', 'Volody');
        //add cc
        //$mail->addCC('sd7@consultlane.com','Rushikesh Salunke');
        //Set who the message is to be sent to
        $mail->addAddress($to, 'Volody');
        //Set the subject line
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

        //$mail->ClearAddresses();
        //$mail->ClearAttachments();
        //echo '<pre>'; print_r($get); exit;
        return $get;
    }
    
    
       public function sendrequestapprovallegal($mailids,$userids,$filepath,$emailcontent)
    {
        //echo "reached";print_r($summdoc);exit;

        $subject = 'Received Contract For Approval';
        $to =$mailids;
       // $to="mitkarinaresh25@gmail.com";
        $gethtml = $this->htmlelements->sendforapprovallegal($subject,$userids,$emailcontent);
        //echo $gethtml; exit;
        //Create a new PHPMailer instance
        $mail = new PHPMailer();
        
        $mail->isSMTP();
        
        $mail->SMTPDebug = 2;
        //Ask for HTML-friendly debug output
        $mail->Debugoutput = 'html';
        //Set the hostname of the mail server
        $mail->Host = 'smtp.gmail.com';
        
        $mail->Port = 587;
        //Set the encryption system to use - ssl (deprecated) or tls
        $mail->SMTPSecure = 'tls';
        //Whether to use SMTP authentication
        $mail->SMTPAuth = true;
        //Username to use for SMTP authentication - use full email address for gmail
        $mail->Username = "simply@consultlane.com";
        //Password to use for SMTP authentication
        $mail->Password = "Revenue!@#";
        //Set who the message is to be sent from
        $mail->setFrom('simply@consultlane.com', 'Volody');
        //Set an alternative reply-to address
        $mail->addReplyTo('simply@consultlane.com', 'Volody');
        //add cc
        //$mail->addCC('sd7@consultlane.com','Rushikesh Salunke');
        //Set who the message is to be sent to
        $mail->addAddress($to, 'Volody');
        //Set the subject line
        $mail->Subject = $subject;
        
        $mail->msgHTML($gethtml);
        $mail->addAttachment(''.$filepath.'');
//         $mail->addAttachment(''.$summdoc.'');
        // $mail->addAttachment(''.$summdoc.'');
        //send the message, check for errors

        if ($mail->Send()) {
            $get = array('logged'=>true);
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
    public function sendrequestlegal($mailids,$emailcontent)
    {
        //echo "reached";print_r($mailids);exit;

        $subject = 'Received New Contract Request';
        $to =$mailids;
       // $to="mitkarinaresh25@gmail.com";
        $gethtml = $this->htmlelements->sendforlegalapproval($subject,$emailcontent);
        //echo $gethtml; exit;
        //Create a new PHPMailer instance
        $mail = new PHPMailer();
        
        $mail->isSMTP();
        
        $mail->SMTPDebug = 2;
        //Ask for HTML-friendly debug output
        $mail->Debugoutput = 'html';
        //Set the hostname of the mail server
        $mail->Host = 'smtp.gmail.com';
        
        $mail->Port = 587;
        //Set the encryption system to use - ssl (deprecated) or tls
        $mail->SMTPSecure = 'tls';
        //Whether to use SMTP authentication
        $mail->SMTPAuth = true;
        //Username to use for SMTP authentication - use full email address for gmail
        $mail->Username = "simply@consultlane.com";
        //Password to use for SMTP authentication
        $mail->Password = "Revenue!@#";
        //Set who the message is to be sent from
        $mail->setFrom('simply@consultlane.com', 'Volody');
        //Set an alternative reply-to address
        $mail->addReplyTo('simply@consultlane.com', 'Volody');
        //add cc
        //$mail->addCC('sd7@consultlane.com','Rushikesh Salunke');
        //Set who the message is to be sent to
        $mail->addAddress($to, 'Volody');
        //Set the subject line
        $mail->Subject = $subject;
        
        $mail->msgHTML($gethtml);
        //$mail->addAttachment(''.$filepath.'');
         //$mail->addAttachment(''.$summdoc.'');
        // $mail->addAttachment(''.$summdoc.'');
        //send the message, check for errors

        if ($mail->Send()) {
            $get = array('logged'=>true,'message'=>'mails sent successfully');
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
    public function sendmsgwithmail($mailids,$agreementname,$messagenote,$requestername)
    {
        //echo "reached";print_r($mailids);exit;
        $subject = 'You Received a New Message';
        $to =$mailids;
       // $to="mitkarinaresh25@gmail.com";
        $gethtml = $this->htmlelements->sendmsgwithmail($subject,$agreementname,$messagenote,$requestername);
        //echo $gethtml; exit;
        //Create a new PHPMailer instance
        $mail = new PHPMailer();
        
        $mail->isSMTP();
        
        $mail->SMTPDebug = 2;
        //Ask for HTML-friendly debug output
        $mail->Debugoutput = 'html';
        //Set the hostname of the mail server
        $mail->Host = 'smtp.gmail.com';
        
        $mail->Port = 587;
        //Set the encryption system to use - ssl (deprecated) or tls
        $mail->SMTPSecure = 'tls';
        //Whether to use SMTP authentication
        $mail->SMTPAuth = true;
        //Username to use for SMTP authentication - use full email address for gmail
        $mail->Username = "simply@consultlane.com";
        //Password to use for SMTP authentication
        $mail->Password = "Revenue!@#";
        //Set who the message is to be sent from
        $mail->setFrom('simply@consultlane.com', 'Volody');
        //Set an alternative reply-to address
        $mail->addReplyTo('simply@consultlane.com', 'Volody');
        //add cc
        //$mail->addCC('sd7@consultlane.com','Rushikesh Salunke');
        //Set who the message is to be sent to
        $mail->addAddress($to, 'Volody');
        //Set the subject line
        $mail->Subject = $subject;
        
        $mail->msgHTML($gethtml);
        //$mail->addAttachment(''.$filepath.'');
         //$mail->addAttachment(''.$summdoc.'');
        // $mail->addAttachment(''.$summdoc.'');
        //send the message, check for errors

        if ($mail->Send()) {
            $get = array('logged'=>true,'message'=>'mails sent successfully');
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
    
    
    
    //##########################  for company restriction data ##############################
    public function mailcomprestriction($emailid,$username,$getcompdata,$periodfrom,$periodto)
    { 
        //print_r($getcompdata);exit;
        $gethtml = $this->htmlelements->mailcomprestriction($username,$getcompdata,$periodfrom,$periodto);
        //print_r($gethtml);exit;
        $mail = new PHPMailer();
        /*//Set who the message is to be sent from
        $mail->setFrom($this->fromemaili, $this->frometitle);
        //Set an alternative reply-to address
        $mail->addReplyTo($this->fromemailii, $this->frometitle_contact);
        $mail->addBCC("","");
        //Set who the message is to be sent to
        $mail->addAddress($to, $name);
        //Set the subject line
        $mail->Subject = $subject;
        //Read an HTML message body from an external file, convert referenced images to embedded,
        $mail->msgHTML($body);
        //Replace the plain text body with one created manually
        $mail->AltBody = 'To view the message, please use an HTML compatible email viewer!';*/

       //$mail = new PHPMailer;
        //Tell PHPMailer to use SMTP
        $mail->isSMTP();
        //Enable SMTP debugging
        // 0 = off (for production use)
        // 1 = client messages
        // 2 = client and server messages
        $mail->SMTPDebug = 2;
        //Ask for HTML-friendly debug output
        $mail->Debugoutput = 'html';
        //Set the hostname of the mail server
        $mail->Host = 'smtp.gmail.com';
        // use
        // $mail->Host = gethostbyname('smtp.gmail.com');
        // if your network does not support SMTP over IPv6
        //Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
        $mail->Port = 587;
        //Set the encryption system to use - ssl (deprecated) or tls
        $mail->SMTPSecure = 'tls';
        //Whether to use SMTP authentication
        $mail->SMTPAuth = true;
        //Username to use for SMTP authentication - use full email address for gmail
        $mail->Username = "simply@consultlane.com";
        //Password to use for SMTP authentication
        $mail->Password = "Revenue!@#";
        //Set who the message is to be sent from
        $mail->setFrom('simply@consultlane.com', 'Volody');
        //Set an alternative reply-to address
        $mail->addReplyTo('simply@consultlane.com', 'Volody');
        //add cc
       // $mail->addCC('sd7@consultlane.com','Rushikesh Salunke');
        //Set who the message is to be sent to
        $mail->addAddress($emailid, 'Volody');
        //Set the subject line
        $mail->Subject = 'Restricted Company';
        //Read an HTML message body from an external file, convert referenced images to embedded,
        //convert HTML into a basic plain-text alternative body
    
        $mail->msgHTML($gethtml);
        //Replace the plain text body with one created manually

        //Attach an image file
        //$mail->addAttachment('images/phpmailer_mini.png');
        //send the message, check for errors

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
    
    //##########################  for employee restriction data ##############################
    public function mailemprestriction($emailid,$username,$getcompdata,$periodfrom,$periodto)
    { 
        //print_r($periodfrom);exit;
        $gethtml = $this->htmlelements->mailemprestriction($username,$getcompdata,$periodfrom,$periodto);
        //print_r($gethtml);exit;
        $mail = new PHPMailer();
        /*//Set who the message is to be sent from
        $mail->setFrom($this->fromemaili, $this->frometitle);
        //Set an alternative reply-to address
        $mail->addReplyTo($this->fromemailii, $this->frometitle_contact);
        $mail->addBCC("","");
        //Set who the message is to be sent to
        $mail->addAddress($to, $name);
        //Set the subject line
        $mail->Subject = $subject;
        //Read an HTML message body from an external file, convert referenced images to embedded,
        $mail->msgHTML($body);
        //Replace the plain text body with one created manually
        $mail->AltBody = 'To view the message, please use an HTML compatible email viewer!';*/

       //$mail = new PHPMailer;
        //Tell PHPMailer to use SMTP
        $mail->isSMTP();
        //Enable SMTP debugging
        // 0 = off (for production use)
        // 1 = client messages
        // 2 = client and server messages
        $mail->SMTPDebug = 2;
        //Ask for HTML-friendly debug output
        $mail->Debugoutput = 'html';
        //Set the hostname of the mail server
        $mail->Host = 'smtp.gmail.com';
        // use
        // $mail->Host = gethostbyname('smtp.gmail.com');
        // if your network does not support SMTP over IPv6
        //Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
        $mail->Port = 587;
        //Set the encryption system to use - ssl (deprecated) or tls
        $mail->SMTPSecure = 'tls';
        //Whether to use SMTP authentication
        $mail->SMTPAuth = true;
        //Username to use for SMTP authentication - use full email address for gmail
        $mail->Username = "simply@consultlane.com";
        //Password to use for SMTP authentication
        $mail->Password = "Revenue!@#";
        //Set who the message is to be sent from
        $mail->setFrom('simply@consultlane.com', 'Volody');
        //Set an alternative reply-to address
        $mail->addReplyTo('simply@consultlane.com', 'Volody');
        //add cc
       // $mail->addCC('sd7@consultlane.com','Rushikesh Salunke');
        //Set who the message is to be sent to
        $mail->addAddress($emailid, 'Volody');
        //Set the subject line
        $mail->Subject = 'Employee Restriction';
        //Read an HTML message body from an external file, convert referenced images to embedded,
        //convert HTML into a basic plain-text alternative body
    
        $mail->msgHTML($gethtml);
        //Replace the plain text body with one created manually

        //Attach an image file
        //$mail->addAttachment('images/phpmailer_mini.png');
        //send the message, check for errors

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
    
    /******** send mail to approver start ********/
    public function sendmailrqstapprvl($emaildata,$mailid)
    {
        $subject = 'Received Request For Approval';
        $to =$mailid;
        $gethtml = $this->htmlelements->sendmailrqstapprvl($subject,$emaildata);
        //Create a new PHPMailer instance
        $mail = new PHPMailer();
        
        $mail->isSMTP();
        
        $mail->SMTPDebug = 2;
        //Ask for HTML-friendly debug output
        $mail->Debugoutput = 'html';
        //Set the hostname of the mail server
        $mail->Host = 'smtp.gmail.com';
        
        $mail->Port = 587;
        //Set the encryption system to use - ssl (deprecated) or tls
        $mail->SMTPSecure = 'tls';
        //Whether to use SMTP authentication
        $mail->SMTPAuth = true;
        //Username to use for SMTP authentication - use full email address for gmail
        $mail->Username = "simply@consultlane.com";
        //Password to use for SMTP authentication
        $mail->Password = "Revenue!@#";
        //Set who the message is to be sent from
        $mail->setFrom('simply@consultlane.com', 'Volody');
        //Set an alternative reply-to address
        $mail->addReplyTo('simply@consultlane.com', 'Volody');
        //add cc
        //$mail->addCC('sd7@consultlane.com','Rushikesh Salunke');
        //Set who the message is to be sent to
        $mail->addAddress($to, 'Volody');
        //Set the subject line
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
        //Ask for HTML-friendly debug output
        $mail->Debugoutput = 'html';
        //Set the hostname of the mail server
        $mail->Host = 'smtp.gmail.com';
        
        $mail->Port = 587;
        //Set the encryption system to use - ssl (deprecated) or tls
        $mail->SMTPSecure = 'tls';
        //Whether to use SMTP authentication
        $mail->SMTPAuth = true;
        //Username to use for SMTP authentication - use full email address for gmail
        $mail->Username = "simply@consultlane.com";
        //Password to use for SMTP authentication
        $mail->Password = "Revenue!@#";
        //Set who the message is to be sent from
        $mail->setFrom('simply@consultlane.com', 'Volody');
        //Set an alternative reply-to address
        $mail->addReplyTo('simply@consultlane.com', 'Volody');
        //add cc
        //$mail->addCC('sd7@consultlane.com','Rushikesh Salunke');
        //Set who the message is to be sent to
        $mail->addAddress($to, 'Volody');
        //Set the subject line
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
    public function sendmailexcbrqstapprvl($emaildata,$mailid)
    {
        $subject = 'Received Exception Request For Approval';
        $to =$mailid;
        $gethtml = $this->htmlelements->sendmailexcbrqstapprvl($subject,$emaildata);
        //Create a new PHPMailer instance
        $mail = new PHPMailer();
        
        $mail->isSMTP();
        
        $mail->SMTPDebug = 2;
        //Ask for HTML-friendly debug output
        $mail->Debugoutput = 'html';
        //Set the hostname of the mail server
        $mail->Host = 'smtp.gmail.com';
        
        $mail->Port = 587;
        //Set the encryption system to use - ssl (deprecated) or tls
        $mail->SMTPSecure = 'tls';
        //Whether to use SMTP authentication
        $mail->SMTPAuth = true;
        //Username to use for SMTP authentication - use full email address for gmail
        $mail->Username = "simply@consultlane.com";
        //Password to use for SMTP authentication
        $mail->Password = "Revenue!@#";
        //Set who the message is to be sent from
        $mail->setFrom('simply@consultlane.com', 'Volody');
        //Set an alternative reply-to address
        $mail->addReplyTo('simply@consultlane.com', 'Volody');
        //add cc
        //$mail->addCC('sd7@consultlane.com','Rushikesh Salunke');
        //Set who the message is to be sent to
        $mail->addAddress($to, 'Volody');
        //Set the subject line
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
        //Ask for HTML-friendly debug output
        $mail->Debugoutput = 'html';
        //Set the hostname of the mail server
        $mail->Host = 'smtp.gmail.com';
        
        $mail->Port = 587;
        //Set the encryption system to use - ssl (deprecated) or tls
        $mail->SMTPSecure = 'tls';
        //Whether to use SMTP authentication
        $mail->SMTPAuth = true;
        //Username to use for SMTP authentication - use full email address for gmail
        $mail->Username = "simply@consultlane.com";
        //Password to use for SMTP authentication
        $mail->Password = "Revenue!@#";
        //Set who the message is to be sent from
        $mail->setFrom('simply@consultlane.com', 'Volody');
        //Set an alternative reply-to address
        $mail->addReplyTo('simply@consultlane.com', 'Volody');
        //add cc
        //$mail->addCC('sd7@consultlane.com','Rushikesh Salunke');
        //Set who the message is to be sent to
        $mail->addAddress($to, 'Volody');
        //Set the subject line
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
        //Ask for HTML-friendly debug output
        $mail->Debugoutput = 'html';
        //Set the hostname of the mail server
        $mail->Host = 'smtp.gmail.com';
        
        $mail->Port = 587;
        //Set the encryption system to use - ssl (deprecated) or tls
        $mail->SMTPSecure = 'tls';
        //Whether to use SMTP authentication
        $mail->SMTPAuth = true;
        //Username to use for SMTP authentication - use full email address for gmail
        $mail->Username = "simply@consultlane.com";
        //Password to use for SMTP authentication
        $mail->Password = "Revenue!@#";
        //Set who the message is to be sent from
        $mail->setFrom('simply@consultlane.com', 'Volody');
        //Set an alternative reply-to address
        $mail->addReplyTo('simply@consultlane.com', 'Volody');
        //add cc
        //$mail->addCC('sd7@consultlane.com','Rushikesh Salunke');
        //Set who the message is to be sent to
        $mail->addAddress($to, 'Volody');
        //Set the subject line
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
        //Ask for HTML-friendly debug output
        $mail->Debugoutput = 'html';
        //Set the hostname of the mail server
        $mail->Host = 'smtp.gmail.com';
        
        $mail->Port = 587;
        //Set the encryption system to use - ssl (deprecated) or tls
        $mail->SMTPSecure = 'tls';
        //Whether to use SMTP authentication
        $mail->SMTPAuth = true;
        //Username to use for SMTP authentication - use full email address for gmail
        $mail->Username = "simply@consultlane.com";
        //Password to use for SMTP authentication
        $mail->Password = "Revenue!@#";
        //Set who the message is to be sent from
        $mail->setFrom('simply@consultlane.com', 'Volody');
        //Set an alternative reply-to address
        $mail->addReplyTo('simply@consultlane.com', 'Volody');
        //add cc
        //$mail->addCC('sd7@consultlane.com','Rushikesh Salunke');
        //Set who the message is to be sent to
        $mail->addAddress($to, 'Volody');
        //Set the subject line
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
        //Ask for HTML-friendly debug output
        $mail->Debugoutput = 'html';
        //Set the hostname of the mail server
        $mail->Host = 'smtp.gmail.com';
        
        $mail->Port = 587;
        //Set the encryption system to use - ssl (deprecated) or tls
        $mail->SMTPSecure = 'tls';
        //Whether to use SMTP authentication
        $mail->SMTPAuth = true;
        //Username to use for SMTP authentication - use full email address for gmail
        $mail->Username = "simply@consultlane.com";
        //Password to use for SMTP authentication
        $mail->Password = "Revenue!@#";
        //Set who the message is to be sent from
        $mail->setFrom('simply@consultlane.com', 'Volody');
        //Set an alternative reply-to address
        $mail->addReplyTo('simply@consultlane.com', 'Volody');
        //add cc
        //$mail->addCC('sd7@consultlane.com','Rushikesh Salunke');
        //Set who the message is to be sent to
        $mail->addAddress($to, 'Volody');
        //Set the subject line
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
        //Ask for HTML-friendly debug output
        $mail->Debugoutput = 'html';
        //Set the hostname of the mail server
        $mail->Host = 'smtp.gmail.com';
        
        $mail->Port = 587;
        //Set the encryption system to use - ssl (deprecated) or tls
        $mail->SMTPSecure = 'tls';
        //Whether to use SMTP authentication
        $mail->SMTPAuth = true;
        //Username to use for SMTP authentication - use full email address for gmail
        $mail->Username = "simply@consultlane.com";
        //Password to use for SMTP authentication
        $mail->Password = "Revenue!@#";
        //Set who the message is to be sent from
        $mail->setFrom('simply@consultlane.com', 'Volody');
        //Set an alternative reply-to address
        $mail->addReplyTo('simply@consultlane.com', 'Volody');
        //add cc
        //$mail->addCC('sd7@consultlane.com','Rushikesh Salunke');
        //Set who the message is to be sent to
        $mail->addAddress($to, 'Volody');
        //Set the subject line
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
        //Ask for HTML-friendly debug output
        $mail->Debugoutput = 'html';
        //Set the hostname of the mail server
        $mail->Host = 'smtp.gmail.com';
        
        $mail->Port = 587;
        //Set the encryption system to use - ssl (deprecated) or tls
        $mail->SMTPSecure = 'tls';
        //Whether to use SMTP authentication
        $mail->SMTPAuth = true;
        //Username to use for SMTP authentication - use full email address for gmail
        $mail->Username = "simply@consultlane.com";
        //Password to use for SMTP authentication
        $mail->Password = "Revenue!@#";
        //Set who the message is to be sent from
        $mail->setFrom('simply@consultlane.com', 'Volody');
        //Set an alternative reply-to address
        $mail->addReplyTo('simply@consultlane.com', 'Volody');
        //add cc
        //$mail->addCC('sd7@consultlane.com','Rushikesh Salunke');
        //Set who the message is to be sent to
        $mail->addAddress($to, 'Volody');
        //Set the subject line
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
//        echo $to;exit;
        $gethtml = $this->htmlelements->mailtonotdonetrdrqst($data);
        //print_r($gethtml);exit;
        //Create a new PHPMailer instance
        $mail = new PHPMailer();
        
        $mail->isSMTP();
        
        $mail->SMTPDebug = 2;
        //Ask for HTML-friendly debug output
        $mail->Debugoutput = 'html';
        //Set the hostname of the mail server
        $mail->Host = 'smtp.gmail.com';
        
        $mail->Port = 587;
        //Set the encryption system to use - ssl (deprecated) or tls
        $mail->SMTPSecure = 'tls';
        //Whether to use SMTP authentication
        $mail->SMTPAuth = true;
        //Username to use for SMTP authentication - use full email address for gmail
        $mail->Username = "simply@consultlane.com";
        //Password to use for SMTP authentication
        $mail->Password = "Revenue!@#";
        //Set who the message is to be sent from
        $mail->setFrom('simply@consultlane.com', 'Volody');
        //Set an alternative reply-to address
        $mail->addReplyTo('simply@consultlane.com', 'Volody');
        //add cc
        //$mail->addCC('sd7@consultlane.com','Rushikesh Salunke');
        //Set who the message is to be sent to
        $mail->addAddress($to, 'Volody');
        //Set the subject line
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
        //echo $to;exit;
        $gethtml = $this->htmlelements->mailformbapprvlrqst($subject,$emaildata);
        //Create a new PHPMailer instance
        $mail = new PHPMailer();
        
        $mail->isSMTP();
        
        $mail->SMTPDebug = 2;
        //Ask for HTML-friendly debug output
        $mail->Debugoutput = 'html';
        //Set the hostname of the mail server
        $mail->Host = 'smtp.gmail.com';
        
        $mail->Port = 587;
        //Set the encryption system to use - ssl (deprecated) or tls
        $mail->SMTPSecure = 'tls';
        //Whether to use SMTP authentication
        $mail->SMTPAuth = true;
        //Username to use for SMTP authentication - use full email address for gmail
        $mail->Username = "simply@consultlane.com";
        //Password to use for SMTP authentication
        $mail->Password = "Revenue!@#";
        //Set who the message is to be sent from
        $mail->setFrom('simply@consultlane.com', 'Volody');
        //Set an alternative reply-to address
        $mail->addReplyTo('simply@consultlane.com', 'Volody');
        //add cc
        //$mail->addCC('sd7@consultlane.com','Rushikesh Salunke');
        //Set who the message is to be sent to
        $mail->addAddress($to, 'Volody');
        //Set the subject line
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
        //Ask for HTML-friendly debug output
        $mail->Debugoutput = 'html';
        //Set the hostname of the mail server
        $mail->Host = 'smtp.gmail.com';
        
        $mail->Port = 587;
        //Set the encryption system to use - ssl (deprecated) or tls
        $mail->SMTPSecure = 'tls';
        //Whether to use SMTP authentication
        $mail->SMTPAuth = true;
        //Username to use for SMTP authentication - use full email address for gmail
        $mail->Username = "simply@consultlane.com";
        //Password to use for SMTP authentication
        $mail->Password = "Revenue!@#";
        //Set who the message is to be sent from
        $mail->setFrom('simply@consultlane.com', 'Volody');
        //Set an alternative reply-to address
        $mail->addReplyTo('simply@consultlane.com', 'Volody');
        //add cc
        //$mail->addCC('sd7@consultlane.com','Rushikesh Salunke');
        //Set who the message is to be sent to
        $mail->addAddress($to, 'Volody');
        //Set the subject line
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
        $subject = 'Received Form C Request For Approval';
        $to =$email;
        //echo $to;exit;
        $gethtml = $this->htmlelements->mailformcapprvlrqst($subject,$emaildata);
        //Create a new PHPMailer instance
        $mail = new PHPMailer();
        
        $mail->isSMTP();
        
        $mail->SMTPDebug = 2;
        //Ask for HTML-friendly debug output
        $mail->Debugoutput = 'html';
        //Set the hostname of the mail server
        $mail->Host = 'smtp.gmail.com';
        
        $mail->Port = 587;
        //Set the encryption system to use - ssl (deprecated) or tls
        $mail->SMTPSecure = 'tls';
        //Whether to use SMTP authentication
        $mail->SMTPAuth = true;
        //Username to use for SMTP authentication - use full email address for gmail
        $mail->Username = "simply@consultlane.com";
        //Password to use for SMTP authentication
        $mail->Password = "Revenue!@#";
        //Set who the message is to be sent from
        $mail->setFrom('simply@consultlane.com', 'Volody');
        //Set an alternative reply-to address
        $mail->addReplyTo('simply@consultlane.com', 'Volody');
        //add cc
        //$mail->addCC('sd7@consultlane.com','Rushikesh Salunke');
        //Set who the message is to be sent to
        $mail->addAddress($to, 'Volody');
        //Set the subject line
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
        //Ask for HTML-friendly debug output
        $mail->Debugoutput = 'html';
        //Set the hostname of the mail server
        $mail->Host = 'smtp.gmail.com';
        
        $mail->Port = 587;
        //Set the encryption system to use - ssl (deprecated) or tls
        $mail->SMTPSecure = 'tls';
        //Whether to use SMTP authentication
        $mail->SMTPAuth = true;
        //Username to use for SMTP authentication - use full email address for gmail
        $mail->Username = "simply@consultlane.com";
        //Password to use for SMTP authentication
        $mail->Password = "Revenue!@#";
        //Set who the message is to be sent from
        $mail->setFrom('simply@consultlane.com', 'Volody');
        //Set an alternative reply-to address
        $mail->addReplyTo('simply@consultlane.com', 'Volody');
        //add cc
        //$mail->addCC('sd7@consultlane.com','Rushikesh Salunke');
        //Set who the message is to be sent to
        $mail->addAddress($to, 'Volody');
        //Set the subject line
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
        //Ask for HTML-friendly debug output
        $mail->Debugoutput = 'html';
        //Set the hostname of the mail server
        $mail->Host = 'smtp.gmail.com';
        
        $mail->Port = 587;
        //Set the encryption system to use - ssl (deprecated) or tls
        $mail->SMTPSecure = 'tls';
        //Whether to use SMTP authentication
        $mail->SMTPAuth = true;
        //Username to use for SMTP authentication - use full email address for gmail
        $mail->Username = "simply@consultlane.com";
        //Password to use for SMTP authentication
        $mail->Password = "Revenue!@#";
        //Set who the message is to be sent from
        $mail->setFrom('simply@consultlane.com', 'Volody');
        //Set an alternative reply-to address
        $mail->addReplyTo('simply@consultlane.com', 'Volody');
        //add cc
        //$mail->addCC('sd7@consultlane.com','Rushikesh Salunke');
        //Set who the message is to be sent to
        $mail->addAddress($to, 'Volody');
        //Set the subject line
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
        //echo $to;exit;
        $gethtml = $this->htmlelements->mailformdackrqst($subject,$emaildata);
        //Create a new PHPMailer instance
        $mail = new PHPMailer();
        
        $mail->isSMTP();
        
        $mail->SMTPDebug = 2;
        //Ask for HTML-friendly debug output
        $mail->Debugoutput = 'html';
        //Set the hostname of the mail server
        $mail->Host = 'smtp.gmail.com';
        
        $mail->Port = 587;
        //Set the encryption system to use - ssl (deprecated) or tls
        $mail->SMTPSecure = 'tls';
        //Whether to use SMTP authentication
        $mail->SMTPAuth = true;
        //Username to use for SMTP authentication - use full email address for gmail
        $mail->Username = "simply@consultlane.com";
        //Password to use for SMTP authentication
        $mail->Password = "Revenue!@#";
        //Set who the message is to be sent from
        $mail->setFrom('simply@consultlane.com', 'Volody');
        //Set an alternative reply-to address
        $mail->addReplyTo('simply@consultlane.com', 'Volody');
        //add cc
        //$mail->addCC('sd7@consultlane.com','Rushikesh Salunke');
        //Set who the message is to be sent to
        $mail->addAddress($to, 'Volody');
        //Set the subject line
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
        //echo $to;exit;
        //$gethtml = $this->htmlelements->mailformdackrqst($subject,$emaildata);
        $gethtml = $emailcontent;
        //Create a new PHPMailer instance
        $mail = new PHPMailer();
        
        $mail->isSMTP();
        
        $mail->SMTPDebug = 2;
        //Ask for HTML-friendly debug output
        $mail->Debugoutput = 'html';
        //Set the hostname of the mail server
        $mail->Host = 'smtp.gmail.com';
        
        $mail->Port = 587;
        //Set the encryption system to use - ssl (deprecated) or tls
        $mail->SMTPSecure = 'tls';
        //Whether to use SMTP authentication
        $mail->SMTPAuth = true;
        //Username to use for SMTP authentication - use full email address for gmail
        $mail->Username = "simply@consultlane.com";
        //Password to use for SMTP authentication
        $mail->Password = "Revenue!@#";
        //Set who the message is to be sent from
        $mail->setFrom('simply@consultlane.com', 'Volody');
        //Set an alternative reply-to address
        $mail->addReplyTo('simply@consultlane.com', 'Volody');
        //add cc
        //$mail->addCC('sd7@consultlane.com','Rushikesh Salunke');
        //Set who the message is to be sent to
        $mail->addAddress($to, 'Volody');
        //Set the subject line
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
       // $to="mitkarinaresh25@gmail.com";
        $gethtml = $this->htmlelements->sendmailforpersinfo($subject,$fullname);
        //echo $gethtml; exit;
        //Create a new PHPMailer instance
        $mail = new PHPMailer();
        
        $mail->isSMTP();
        
        $mail->SMTPDebug = 2;
        //Ask for HTML-friendly debug output
        $mail->Debugoutput = 'html';
        //Set the hostname of the mail server
        $mail->Host = 'smtp.gmail.com';
        
        $mail->Port = 587;
        //Set the encryption system to use - ssl (deprecated) or tls
        $mail->SMTPSecure = 'tls';
        //Whether to use SMTP authentication
        $mail->SMTPAuth = true;
        //Username to use for SMTP authentication - use full email address for gmail
        $mail->Username = "simply@consultlane.com";
        //Password to use for SMTP authentication
        $mail->Password = "Revenue!@#";
        //Set who the message is to be sent from
        $mail->setFrom('simply@consultlane.com', 'Volody');
        //Set an alternative reply-to address
        $mail->addReplyTo('simply@consultlane.com', 'Volody');
        //add cc
        //$mail->addCC('sd7@consultlane.com','Rushikesh Salunke');
        //Set who the message is to be sent to
        $mail->addAddress($to, 'Volody');
        //Set the subject line
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
       // $to="mitkarinaresh25@gmail.com";
        $gethtml = $this->htmlelements->automailtouser($myarry);
        //echo $gethtml; exit;
        //Create a new PHPMailer instance
        $mail = new PHPMailer();
        
        $mail->isSMTP();
        
        $mail->SMTPDebug = 2;
        //Ask for HTML-friendly debug output
        $mail->Debugoutput = 'html';
        //Set the hostname of the mail server
        $mail->Host = 'smtp.gmail.com';
        
        $mail->Port = 587;
        //Set the encryption system to use - ssl (deprecated) or tls
        $mail->SMTPSecure = 'tls';
        //Whether to use SMTP authentication
        $mail->SMTPAuth = true;
        //Username to use for SMTP authentication - use full email address for gmail
        $mail->Username = "simply@consultlane.com";
        //Password to use for SMTP authentication
        $mail->Password = "Revenue!@#";
        //Set who the message is to be sent from
        $mail->setFrom('simply@consultlane.com', 'Volody');
        //Set an alternative reply-to address
        $mail->addReplyTo('simply@consultlane.com', 'Volody');
        //add cc
        $mail->addCC('sd3@consultlane.com','Naresh Mitkari');
        //Set who the message is to be sent to
        $mail->addAddress($to, 'Volody');
        //Set the subject line
        $mail->Subject = $subject;
        
        $mail->msgHTML($gethtml);
        // $mail->addAttachment(''.$filepath.'');
        //  $mail->addAttachment(''.$summdoc.'');
        // $mail->addAttachment(''.$summdoc.'');
        //send the message, check for errors

        if ($mail->Send()) {
            $get = array('logged'=>true);
        }
        else {
            //echo $mail->ErrorInfo; exit;
            $get = array('logged'=>false);
        }

        //$mail->ClearAddresses();
        //$mail->ClearAttachments();
        //echo '<pre>'; print_r($get); exit;
        return $get;
    }
    

      public function sendautomailtoapprover($mailid,$myarry)
    {
        //echo "reached";print_r($summdoc);exit;
      
        $subject = 'You Have Recived Reminder For Pending Trading Request';
        $to =$mailid;
       // $to="mitkarinaresh25@gmail.com";
        $gethtml = $this->htmlelements->automailtoapprover($myarry);
        //echo $gethtml; exit;
        //Create a new PHPMailer instance
        $mail = new PHPMailer();
        
        $mail->isSMTP();
        
        $mail->SMTPDebug = 2;
        //Ask for HTML-friendly debug output
        $mail->Debugoutput = 'html';
        //Set the hostname of the mail server
        $mail->Host = 'smtp.gmail.com';
        
        $mail->Port = 587;
        //Set the encryption system to use - ssl (deprecated) or tls
        $mail->SMTPSecure = 'tls';
        //Whether to use SMTP authentication
        $mail->SMTPAuth = true;
        //Username to use for SMTP authentication - use full email address for gmail
        $mail->Username = "simply@consultlane.com";
        //Password to use for SMTP authentication
        $mail->Password = "Revenue!@#";
        //Set who the message is to be sent from
        $mail->setFrom('simply@consultlane.com', 'Volody');
        //Set an alternative reply-to address
        $mail->addReplyTo('simply@consultlane.com', 'Volody');
        //add cc
        $mail->addCC('sd3@consultlane.com','Naresh Mitkari');
        //Set who the message is to be sent to
        $mail->addAddress($to, 'Volody');
        //Set the subject line
        $mail->Subject = $subject;
        
        $mail->msgHTML($gethtml);
        // $mail->addAttachment(''.$filepath.'');
        //  $mail->addAttachment(''.$summdoc.'');
        // $mail->addAttachment(''.$summdoc.'');
        //send the message, check for errors

        if ($mail->Send()) {
            $get = array('logged'=>true);
        }
        else {
            //echo $mail->ErrorInfo; exit;
            $get = array('logged'=>false);
        }

        //$mail->ClearAddresses();
        //$mail->ClearAttachments();
        //echo '<pre>'; print_r($get); exit;
        return $get;
    }


     public function sendpdfmailappr($mailids,$getfile,$getname)
    {
         // echo "reached";print_r($mailids);exit;
        $subject = 'Initial Declaration';
        $to =$mailids;
        $gethtml = $this->htmlelements->initialdeclaration($getname);
        
        // echo $gethtml; exit;
        //Create a new PHPMailer instance
        $mail = new PHPMailer();
        
        $mail->isSMTP();
        
        $mail->SMTPDebug = 2;
        //Ask for HTML-friendly debug output
        $mail->Debugoutput = 'html';
        //Set the hostname of the mail server
        $mail->Host = 'smtp.gmail.com';
        
        $mail->Port = 587;
        //Set the encryption system to use - ssl (deprecated) or tls
        $mail->SMTPSecure = 'tls';
        //Whether to use SMTP authentication
        $mail->SMTPAuth = true;
        //Username to use for SMTP authentication - use full email address for gmail
        $mail->Username = "simply@consultlane.com";
        //Password to use for SMTP authentication
        $mail->Password = "Revenue!@#";
        //Set who the message is to be sent from
        $mail->setFrom('simply@consultlane.com', 'Volody');
        //Set an alternative reply-to address
        $mail->addReplyTo('simply@consultlane.com', 'Volody');
        //add cc
        //$mail->addCC('sd7@consultlane.com','Rushikesh Salunke');
        //Set who the message is to be sent to
        $mail->addAddress($to, 'Volody');
        //Set the subject line
        $mail->Subject = $subject;
        
        $mail->msgHTML($gethtml);
        $mail->addAttachment($getfile[0]['pdfpath']);
        
        // $mail->addAttachment(''.$summdoc.'');
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


       public function sendpdfmailapprannual($mailids,$getfile,$getname)
    {
         // echo "reached";print_r($mailids);exit;
        $subject = 'Annual Declaration';
        $to =$mailids;
        $gethtml = $this->htmlelements->initialdeclarationannual($getname);
        
        // echo $gethtml; exit;
        //Create a new PHPMailer instance
        $mail = new PHPMailer();
        
        $mail->isSMTP();
        
        $mail->SMTPDebug = 2;
        //Ask for HTML-friendly debug output
        $mail->Debugoutput = 'html';
        //Set the hostname of the mail server
        $mail->Host = 'smtp.gmail.com';
        
        $mail->Port = 587;
        //Set the encryption system to use - ssl (deprecated) or tls
        $mail->SMTPSecure = 'tls';
        //Whether to use SMTP authentication
        $mail->SMTPAuth = true;
        //Username to use for SMTP authentication - use full email address for gmail
        $mail->Username = "simply@consultlane.com";
        //Password to use for SMTP authentication
        $mail->Password = "Revenue!@#";
        //Set who the message is to be sent from
        $mail->setFrom('simply@consultlane.com', 'Volody');
        //Set an alternative reply-to address
        $mail->addReplyTo('simply@consultlane.com', 'Volody');
        //add cc
        //$mail->addCC('sd7@consultlane.com','Rushikesh Salunke');
        //Set who the message is to be sent to
        $mail->addAddress($to, 'Volody');
        //Set the subject line
        $mail->Subject = $subject;
        
        $mail->msgHTML($gethtml);
        $mail->addAttachment($getfile[0]['pdfpath']);
        
        // $mail->addAttachment(''.$summdoc.'');
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
    
}
