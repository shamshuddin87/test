<?php
include_once('../simple_html_dom.php');
$post= $_POST;
//set POST variables
$url = 'http://www.mca.gov.in/mcafoportal/viewSignatoryDetailsAction.do';
/*$fields = array(
            //post parameters to be sent to the other website
            'companyID'=>urlencode($_POST['companyID']), 
            'userEnteredCaptcha'=>urlencode($_POST['userEnteredCaptcha']),
            //the post request you send to this  script from your domain.
        );*/
$postdata = http_build_query(
    array(
        'companyName'=>urlencode(''),
        'companyID'=>urlencode('U74900MH2015PTC265881'), 
        'userEnteredCaptcha'=>urlencode('buring'),
        'submitBtn'=>urlencode('Submit'),
        'displayCaptcha'=>urlencode(true)
    )
);

$opts = array('http' =>
    array(
        'method'  => 'POST',
        'header'  => 'Content-type: application/x-www-form-urlencoded',
        'content' => $postdata
    )
);

$context  = stream_context_create($opts);

$result = file_get_contents($url, false, $context);
echo $result;exit;
file_put_contents("textfile.txt", $result);
$result = file_get_html('textfile.txt');
//echo $result;exit;
$table = $result->find('table');

    // initialize empty array to store the data array from each row
    
    $tbldata = '';
    // loop over rows
    $countrow = '';
    $cuntg = count($result->find('table.result-forms'));
    //echo $cuntg;exit;
    foreach($result->find('table.result-forms') as $rowtbl) {
        $theData = '';
        foreach($rowtbl->find('tbody tr') as $row) {
            // initialize array to store the cell data from each row
            //echo '<pre>'; print_r($row->find('td'));exit;
            $rowData = '';
            $countrow = count($row->find('td'));
            //echo $countrow.'<br>';
            if($countrow!=0)
            {
                foreach($row->find('td') as $cell) {
                    //echo '<pre>';print_r($cell->plaintext);exit;
                    //if($cell->plaintext!='')
                    //{
                    // push the cell's text to the array
                    //echo $cell->plaintext;exit;
                    $rowData[] = trim($cell->plaintext); // get with hyperlinkinnertext
                    //}    
                }
                $theData[]= $rowData;
            }
            // push the row's data array to the 'big' array
        }
        $tbldata[] = $theData;
        
    }

echo '<pre>';print_r($tbldata);
exit;


//echo $result;exit;

function getcontent($url , $fields)
{
        //url-ify the data for the POST
        $fields_string = '';
        foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
        rtrim($fields_string,'&');

        //open connection
        $ch = curl_init();

        //set the url, number of POST vars, POST data
        
        //curl_setopt($ch,CURLOPT_URL,$url);
        //curl_setopt($ch,CURLOPT_POST,count($fields));
        //curl_setopt($ch,CURLOPT_POSTFIELDS,$fields_string);
        //curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
        //execute post
        //curl_exec($ch); 
        //curl_getinfo($ch);

        //echo $html;exit;
        //curl_close($ch);
    //return $html;
}
//$html = str_get_html(getcontent($url , $fields));
//$html = str_get_html($htmlmn);
//echo $html.'hlooeoeoe';exit;


//echo $result;exit;
//close connection


//exit;

?>
