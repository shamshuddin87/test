<?php
include_once('../simple_html_dom.php');

$html = file_get_html('http://mca.gov.in/MinistryV2/companyformsdownload.html');

// Find all article blocks
/*foreach($html->find('div#skipMain table.whitebg') as $article) {
    foreach ($article->find('div#skipMain table.whitebg', 0) as $articletd)
    {
        echo '<pre>';print_r($articletd);exit;
        $item['title']     = $articletd->find('td', 0)->plaintext;
        $item['formname']     = $articletd->find('td', 1)->plaintext;
        $item['datemodified']     = $articletd->find('td', 3)->plaintext; 
        $articles[] = $item;
    }
    
    //$item['intro']    = $article->find('div.intro', 0)->plaintext;
    //$item['details'] = $article->find('div.details', 0)->plaintext;
    
}*/

$table = $html->find('div#skipMain table.whitebg');

    // initialize empty array to store the data array from each row
    $theData = '';
    // loop over rows
    $countrow = '';
    foreach($html->find('div#skipMain table tbody tr') as $row) {
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
                $rowData[] = $cell->plaintext; // get with hyperlinkinnertext
                //}    
            }
            $theData[] = $rowData;
        }
        
        // push the row's data array to the 'big' array
        
    }

echo '<pre>';print_r($theData);
exit;
?>