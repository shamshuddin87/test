<?php
ini_set("max_execution_time", '900');
ini_set('memory_limit', '1024M');
require_once 'phpexcelimpexpo/PHPExcel.php';
require_once 'phpexcelimpexpo/PHPExcel/IOFactory.php';

Class Phpimportexpogen extends Phalcon\Mvc\User\Component {
    
    
    public function insertcmpmodule($getuserid,$user_group_id,$excelfilenamepath)
    {
        //print_r($getuserid);exit;
        $connection = $this->dbtrd;
        $time= time();
        $flag=0;
       
        
        $objPHPExcel = PHPExcel_IOFactory::load($excelfilenamepath);
        $objPHPExcel->setActiveSheetIndex(0);
        $worksheet = $objPHPExcel->getActiveSheet(0);
         

        try
        {
            foreach ($objPHPExcel->getWorksheetIterator() as $worksheet)
            {
                $highestRow = $worksheet->getHighestRow();

                for ($row=2; $row<=$highestRow;$row++)
                {
                    $cmpname = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                    $cmpname = trim($cmpname);
                    //echo $cmpname; exit;
                    
                    $sqlquery="SELECT * FROM listedcmpmodule WHERE `company_name`='".$cmpname."' AND added_by='".$getuserid."'";
                    $exeqry = $connection->query($sqlquery);
                    $getnum = trim($exeqry->numRows());
                    if($getnum==0)
                    {
                        $sql="INSERT INTO listedcmpmodule (company_name,access,added_by) 
                            VALUES ('".$cmpname."','1','".$getuserid."') ";
                        $exeml = $connection->query($sql);
                        if($exeml)
                        {
                            $flag=1;
                        }
                    }                  
                }
            }
            
            return $flag;
        }
        catch (Exception $e)
        {
            return false;
        }
    }
    
    public function insertreconcilation($getuserid,$user_group_id,$excelfilenamepath,$stmnttill,$uniqueid)
    {
        
        $connection = $this->dbtrd;
        $time= time();
        $objPHPExcel = PHPExcel_IOFactory::load($excelfilenamepath);
        $objPHPExcel->setActiveSheetIndex(0);
        $worksheet = $objPHPExcel->getActiveSheet(0);

        try
        {
            foreach ($objPHPExcel->getWorksheetIterator() as $worksheet)
            {
                $highestRow = $worksheet->getHighestRow();
                 for ($row=2; $row<=$highestRow;$row++)
                 {
                    $panno  = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                    $cmpname  = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                    $rtaholding  = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                     //echo $rtaholding;exit;
                    $reconciArray = array('panno'=>$panno,'company'=>$cmpname,'holding'=>$rtaholding);
                  
                    $getstatus = $this->reconcilationcommon->insertreconcilation($getuserid,$user_group_id,$reconciArray,$stmnttill,$uniqueid);
                }
                
            }
           return true;
        }
        catch (Exception $e)
        {
            return false;
            $connection->close();
        }
    }
    
    /*************   insert into ESOP start *************/
    public function insertesop($getuserid,$user_group_id,$excelfilenamepath,$uniqueid)
    {
        
        $connection = $this->dbtrd;
        $time= time();
        $objPHPExcel = PHPExcel_IOFactory::load($excelfilenamepath);
        $objPHPExcel->setActiveSheetIndex(0);
        $worksheet = $objPHPExcel->getActiveSheet(0);

        try
        {
            foreach ($objPHPExcel->getWorksheetIterator() as $worksheet)
            {
                $highestRow = $worksheet->getHighestRow();
                //echo '<pre>'; print_r($highestRow);exit;
                 for ($row=2; $row<=$highestRow;$row++)
                 {
                    $emp_name  = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                    $emp_pan  = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                    $emp_shares  = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                    $emp_almtdate  = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                    $emp_almtdate  = PHPExcel_Style_NumberFormat::toFormattedString($emp_almtdate, "DD-MM-YYYY");
                    //$emp_cmpnme  = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                    $esopdata = array('empname'=>$emp_name,'emppan'=>$emp_pan,'empshares'=>$emp_shares,'almtdte'=>$emp_almtdate);
                  
                    $getstatus = $this->esopcommon->insertesop($getuserid,$user_group_id,$esopdata,$uniqueid);
                    
                }
                
            }
            if($getstatus)
            {
                return true;
            }
            else
            {
                return false;
            }
           
        }
        catch (Exception $e)
        {
            return false;
            $connection->close();
        }
    }
    /*************   insert into ESOP end *************/
    public function fetchallupsiexportexcel($getuserid,$user_group_id,$processdata)
    {

        //echo '<pre>'; print_r($processdata);exit;
        $connection = $this->db;
        $time = time();
        
        $excelfilenamepath = 'samplefile/MIS/upsitypeclassify.xlsx';
        $newfilepath = 'img/mis/upsitypeclassify'.'_'.$time.'.xlsx';
        $j=1;
        foreach($processdata as $tblrow)
        {
          
          
            $nwexcl[] = array('0' => $tblrow['upsitype'],
                            '1' => $tblrow['projstartdate'],
                            '2'=> $tblrow['enddate'],
                            '3' => $tblrow[11],
                            '4' => $tblrow['fullname'],
                            '5' => $tblrow['emp_status']
                           
                            //'4' => $tblrow['designation']
                           
                        );
            $j++;
        }

        
       
        $objPHPExcel = PHPExcel_IOFactory::load($excelfilenamepath);
        
        $objPHPExcel->setActiveSheetIndex(0);
        $worksheet = $objPHPExcel->getActiveSheet();
        $highestColumn = $worksheet->getHighestColumn();
        $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
        $highestRow = $worksheet->getHighestRow();
        $worksheet = $objPHPExcel->getActiveSheet();
               //echo "yo";exit;  
            //echo '<pre>';print_r($nwexcl);exit;
            if(count($nwexcl)>0)
            {
                $row = 2; // 1-based index

                foreach($nwexcl as $rowdata)
                {
                    $col = 0;
                    foreach($rowdata as $key=>$value) 
                    {
                        //echo $col." ".$row." ".$value.'<br>';
                        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value);
                        $col++;
                    }                    
                    $row++;
                }

                $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
                //echo '<pre>';print_r($newfilepath);exit;
                $objWriter->save($newfilepath);
                //echo $newfilepath;exit;

                $genfile = $newfilepath;
            }
            else
            {
                $genfile = '';
            }

        //echo '<pre>';print_r($genfile);exit;
        return $genfile;

    }
    
    public function fetchSharedInfoexcel($getuserid,$user_group_id,$upsidata)
    {

         //echo '<pre>'; print_r($upsidata);exit;
        $connection = $this->db;
        $time = time();
        
        $excelfilenamepath = 'samplefile/MIS/upsisharing.xlsx';
        $newfilepath = 'img/mis/upsisharing'.'_'.$time.'.xlsx';
        $j=1;
        foreach($upsidata as $tblrow)
        {
          //print_r($tblrow);exit;
            $category = $tblrow['category_name'];
            if($tblrow['category'] == 16)
            {
                $category = $tblrow['othercategory'];
            }
             else if(empty($tblrow['category_name']))
            {
              $category = 'Employee';
            }
            $nwexcl[] = array('0' => $tblrow['name'],
                            '1' => $category,
                            '2'=> $tblrow['sharingdate'],
                            '3' => $tblrow['sharingtime'],
                            '4' => $tblrow['enddate'],
                            '5' => $tblrow['datashared'],
//                          
                            '6' => $tblrow['fullname'],
                             '7' => $tblrow['email'],
                            '8' => $tblrow['pan'],
                            '9'=> $tblrow['legal_identifier'],
                            '10' => $tblrow['legal_identification_no'],
                            '11' => $tblrow['aadhar'],
                            '12' => $tblrow['dob'],
                            '13' => $tblrow['sex'],
                            '14' => $tblrow['education'],
                            '15' => $tblrow['institute'],
                            '16' => $tblrow['address'],
                            '17' => $tblrow['mobileno'],
                            '18' => $tblrow['sharehldng'],
                            '19' => $tblrow['adrshldng']
                        );
            $j++;
        }
        //echo '<pre>';print_r($nwexcl);exit;
       
        $objPHPExcel = PHPExcel_IOFactory::load($excelfilenamepath);
        
        $objPHPExcel->setActiveSheetIndex(0);
        $worksheet = $objPHPExcel->getActiveSheet();
        $highestColumn = $worksheet->getHighestColumn();
        $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
        $highestRow = $worksheet->getHighestRow();
        $worksheet = $objPHPExcel->getActiveSheet();
               //echo "yo";exit;  
            //echo '<pre>';print_r($nwexcl);exit;
            if(count($nwexcl)>0)
            {
                $row = 2; // 1-based index

                foreach($nwexcl as $rowdata)
                {
                    $col = 0;
                    foreach($rowdata as $key=>$value) 
                    {
                        //echo $col." ".$row." ".$value.'<br>';
                        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value);
                        $col++;
                    }                    
                    $row++;
                }

                $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
                //echo '<pre>';print_r($newfilepath);exit;
                $objWriter->save($newfilepath);
                //echo $newfilepath;exit;

                $genfile = $newfilepath;
            }
            else
            {
                $genfile = '';
            }

        //echo '<pre>';print_r($genfile);exit;
        return $genfile;

    }
    
    public function fetchArchiveSharedInfoexcel($getuserid,$user_group_id,$archiveupsidata)
    {

         //echo '<pre>'; print_r($processdata);exit;
        $connection = $this->db;
        $time = time();
        
        $excelfilenamepath = 'samplefile/MIS/upsisharing.xlsx';
        $newfilepath = 'img/mis/upsisharing'.'_'.$time.'.xlsx';
        $j=1;
        foreach($archiveupsidata as $tblrow)
        {
          //print_r($tblrow);exit;
            $category = $tblrow['category_name'];
            if($tblrow['category'] == 16)
            {
                $category = $tblrow['othercategory'];
            }
            $nwexcl[] = array('0' => $tblrow['name'],
                            '1' => $category,
                            '2'=> $tblrow['sharingdate'],
                            '3' => $tblrow['sharingtime'],
                            '4' => $tblrow['enddate'],
                            '5' => $tblrow['datashared'],
//                            '6' => $tblrow['purpose'],
                            '6' => $tblrow['fullname']
                        );
            $j++;
        }
        //echo '<pre>';print_r($nwexcl);exit;
       
        $objPHPExcel = PHPExcel_IOFactory::load($excelfilenamepath);
        
        $objPHPExcel->setActiveSheetIndex(0);
        $worksheet = $objPHPExcel->getActiveSheet();
        $highestColumn = $worksheet->getHighestColumn();
        $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
        $highestRow = $worksheet->getHighestRow();
        $worksheet = $objPHPExcel->getActiveSheet();
               //echo "yo";exit;  
            //echo '<pre>';print_r($nwexcl);exit;
            if(count($nwexcl)>0)
            {
                $row = 2; // 1-based index

                foreach($nwexcl as $rowdata)
                {
                    $col = 0;
                    foreach($rowdata as $key=>$value) 
                    {
                        //echo $col." ".$row." ".$value.'<br>';
                        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value);
                        $col++;
                    }                    
                    $row++;
                }

                $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
                //echo '<pre>';print_r($newfilepath);exit;
                $objWriter->save($newfilepath);
                //echo $newfilepath;exit;

                $genfile = $newfilepath;
            }
            else
            {
                $genfile = '';
            }

        //echo '<pre>';print_r($genfile);exit;
        return $genfile;

    }
    
    public function FetchconnectedDP($getuserid,$user_group_id,$excelfilenamepath)
    {
        
        $connection = $this->dbtrd;
        $username = array();
        $emailid = array();
        $time= time();
        $objPHPExcel = PHPExcel_IOFactory::load($excelfilenamepath);
        $objPHPExcel->setActiveSheetIndex(0);
        $worksheet = $objPHPExcel->getActiveSheet(0);

        try
        {
            
            foreach ($objPHPExcel->getWorksheetIterator() as $worksheet)
            {
                $highestRow = $worksheet->getHighestRow();
                 for ($row=2; $row<=$highestRow;$row++)
                 {
                    $name  = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                    $email  = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                     
                    if(!empty($name) && !empty($email))
                    {

                         $username[] = $name;
                         $emailid[] = $email;
                         
                         $ConnctdDpArray = array('username'=>$username,'emailid'=>$emailid);
                         
                        
                    }
                
              }   
              //print_r($username);exit;
              $getres = $this->upsicommon->Fetchusersid($getuserid,$user_group_id,$ConnctdDpArray);
              $final = array('ConnctdDpArray'=> $ConnctdDpArray,'getres'=>$getres);
                //print_r($getres);echo "hello";exit;
                        if(!$getres)
                        {
                            //print_r('dasd');exit;
                            return false;
                        }
                     }
                 
                
            
        }
        catch (Exception $e)
        {
            $final = array();
            $connection->close();
        }
       // print_r($getres);exit;
        return $final;
    }

    public function insertholding($getuserid,$user_group_id,$excelfilenamepath,$dtofhldng,$uniqueid,$typeofhldng)
    {
        
        $connection = $this->dbtrd;
        $time= time();
        $objPHPExcel = PHPExcel_IOFactory::load($excelfilenamepath);
        $objPHPExcel->setActiveSheetIndex(0);
        $worksheet = $objPHPExcel->getActiveSheet(0);

        try
        {
            foreach ($objPHPExcel->getWorksheetIterator() as $worksheet)
            {
                $highestRow = $worksheet->getHighestRow();
                 for ($row=2; $row<=$highestRow;$row++)
                 {
                    $panno  = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                    $rtaholding  = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                     //echo $rtaholding;exit;
                    $holdingArray = array('panno'=>$panno,'holding'=>$rtaholding);
                  
                    $getstatus = $this->uploadholdingcommon->insertholding($getuserid,$user_group_id,$holdingArray,$dtofhldng,$uniqueid,$typeofhldng);

                    $update_personalinfo = $this->uploadholdingcommon->updatePersnlinfo($panno,$rtaholding,$typeofhldng);
                }
                
            }
           return true;
        }
        catch (Exception $e)
        {
            return false;
            $connection->close();
        }
    }

    public function exportAnnualDisclsr($getuserid,$user_group_id,$processdata,$annualyr)
    {
        //echo '<pre>'; print_r($processdata);exit;
        $connection = $this->db;
        $time = time();
        
        $excelfilenamepath = 'samplefile/MIS/annualdiscloser.xlsx';
        $newfilepath = 'img/mis/annualdiscloser'.'_'.$time.'.xlsx';
        $j=1;
        foreach($processdata as $tblrow)
        {
            if($annualyr == $tblrow['annualyear'])
            {
                $sentdate = $tblrow['sent_date'];
            }
            else
            {
                $sentdate = '';
            }

            if($tblrow['emp_status'] == '1')
            {
                $emp_status = 'Active';
            }
            elseif($tblrow['emp_status'] == '2')
            {
                $emp_status = 'Resigned';
            }
            elseif($tblrow['emp_status'] == '3')
            {
                $emp_status = 'Not a DP';
            }
            
            $nwexcl[] = array('0' => $j,
                            '1' => $tblrow['fullname'],
                            '2' => $emp_status,
                            '3' => $tblrow['email'],
                            '4'=> $annualyr,
                            '5' => $sentdate,
                        );
            $j++;
        }
        //echo '<pre>';print_r($nwexcl);exit;
       
        $objPHPExcel = PHPExcel_IOFactory::load($excelfilenamepath);
        
        $objPHPExcel->setActiveSheetIndex(0);
        $worksheet = $objPHPExcel->getActiveSheet();
        $highestColumn = $worksheet->getHighestColumn();
        $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
        $highestRow = $worksheet->getHighestRow();
        $worksheet = $objPHPExcel->getActiveSheet();
               //echo "yo";exit;  
            //echo '<pre>';print_r($nwexcl);exit;
            if(count($nwexcl)>0)
            {
                $row = 2; // 1-based index

                foreach($nwexcl as $rowdata)
                {
                    $col = 0;
                    foreach($rowdata as $key=>$value) 
                    {
                        //echo $col." ".$row." ".$value.'<br>';
                        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value);
                        $col++;
                    }                    
                    $row++;
                }

                $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
                //echo '<pre>';print_r($newfilepath);exit;
                $objWriter->save($newfilepath);
                //echo $newfilepath;exit;

                $genfile = $newfilepath;
            }
            else
            {
                $genfile = '';
            }

        //echo '<pre>';print_r($genfile);exit;
        return $genfile;
    }
    
     public function exportformc($getuserid,$user_group_id,$processdata)
    {
       // echo '<pre>'; print_r($processdata);exit;
         $connection = $this->db;
        $time = time();
        
        $excelfilenamepath = 'samplefile/SEBI/formc.xlsx';
        $newfilepath = 'img/sebi/formc'.'_'.$time.'.xlsx';
        $j=1;
       
        foreach($processdata as $tblrow)
        {
           
           $firstfield=$tblrow[6].",".$tblrow[9].",".$tblrow[10].",".$tblrow[16].",".$tblrow[11];
           $third = $tblrow[12].",".$tblrow[30];
           $nine = $tblrow[13].",".$tblrow[31];

          
            $nwexcl[] = array(  '0' => $firstfield,
                                '1' => $tblrow[17],
                                '2'=>$tblrow[0],
                                '3' =>$third,
                                '4' =>$tblrow[0],
                                '5' =>$tblrow[14],
                                '6' =>$tblrow[15],
                                '7' =>strip_tags($tblrow[5]),
                                '8' =>$tblrow[1],
                                '9' =>$nine,
                                '10' =>$tblrow[20],
                                '11' =>$tblrow[21],
                                '12' =>$tblrow[22],
                                '13' =>$tblrow[23],
                                '14' =>$tblrow[3],
                                '15' =>$tblrow[2],
                                '16' =>$tblrow[24],
                                '17' =>$tblrow[25],
                                '18' =>$tblrow[26],
                                '19' =>$tblrow[27],
                                '20' =>$tblrow[28]
                              

                        );
            $j++;
        }
        //echo '<pre>';print_r($nwexcl);exit;
       
        $objPHPExcel = PHPExcel_IOFactory::load($excelfilenamepath);
        
        $objPHPExcel->setActiveSheetIndex(0);
        $worksheet = $objPHPExcel->getActiveSheet();
        $highestColumn = $worksheet->getHighestColumn();
        $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
        $highestRow = $worksheet->getHighestRow();
        $worksheet = $objPHPExcel->getActiveSheet();
               //echo "yo";exit;  
            //echo '<pre>';print_r($nwexcl);exit;
            if(count($nwexcl)>0)
            {
                $row = 2; // 1-based index

                foreach($nwexcl as $rowdata)
                {
                    $col = 0;
                    foreach($rowdata as $key=>$value) 
                    {
                        //echo $col." ".$row." ".$value.'<br>';
                        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value);
                        $col++;
                    }                    
                    $row++;
                }

                $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
                //echo '<pre>';print_r($newfilepath);exit;
                $objWriter->save($newfilepath);
                //echo $newfilepath;exit;

                $genfile = $newfilepath;
            }
            else
            {
                $genfile = '';
            }

        //echo '<pre>';print_r($genfile);exit;
        return $genfile;

    }

      public function exportesop($getuserid,$user_group_id,$processdata)
    {
        //echo '<pre>'; print_r($processdata);exit;
        $connection = $this->db;
        $time = time();
        
        $excelfilenamepath = 'samplefile/ESOP/esop_nondp.xlsx';
        $newfilepath = 'img/esop/esop_nondp'.'_'.$time.'.xlsx';
        $j=1;
        foreach($processdata as $tblrow)
        {
            
            
            $nwexcl[] = array('0' => $tblrow['emp_name'],
                            '1' => $tblrow['emp_pan'],
                            '2' => $tblrow['emp_shares'],
                            '3' => $tblrow['altmntdate']
                           
                        );
            $j++;
        }
        //echo '<pre>';print_r($nwexcl);exit;
       
        $objPHPExcel = PHPExcel_IOFactory::load($excelfilenamepath);
        
        $objPHPExcel->setActiveSheetIndex(0);
        $worksheet = $objPHPExcel->getActiveSheet();
        $highestColumn = $worksheet->getHighestColumn();
        $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
        $highestRow = $worksheet->getHighestRow();
        $worksheet = $objPHPExcel->getActiveSheet();
               //echo "yo";exit;  
            //echo '<pre>';print_r($nwexcl);exit;
            if(count($nwexcl)>0)
            {
                $row = 2; // 1-based index

                foreach($nwexcl as $rowdata)
                {
                    $col = 0;
                    foreach($rowdata as $key=>$value) 
                    {
                        //echo $col." ".$row." ".$value.'<br>';
                        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value);
                        $col++;
                    }                    
                    $row++;
                }

                $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
                //echo '<pre>';print_r($newfilepath);exit;
                $objWriter->save($newfilepath);
                //echo $newfilepath;exit;

                $genfile = $newfilepath;
            }
            else
            {
                $genfile = '';
            }

        //echo '<pre>';print_r($genfile);exit;
        return $genfile;
    }

    public function exportContDisclsr($getuserid,$user_group_id,$processdata)
    {
        //echo '<pre>'; print_r($processdata);exit;
        $connection = $this->db;
        $time = time();
        
        $excelfilenamepath = 'samplefile/MIS/continuousdiscloser.xlsx';
        $newfilepath = 'img/mis/continuousdiscloser'.'_'.$time.'.xlsx';
        $j=1;
        foreach($processdata as $tblrow)
        {
            if($tblrow['emp_status'] == '1')
            {
                $emp_status = 'Active';
            }
            elseif($tblrow['emp_status'] == '2')
            {
                $emp_status = 'Resigned';
            }
            elseif($tblrow['emp_status'] == '3')
            {
                $emp_status = 'Not a DP';
            }

            $formated_date = date('d-m-Y',strtotime($tblrow['date_added']));
            $nwexcl[] = array('0' => $j,
                            '1' => $tblrow['fullname'],
                            '2' => $emp_status,
                            '3'=> $formated_date
                        );
            $j++;
        }
        //echo '<pre>';print_r($nwexcl);exit;
       
        $objPHPExcel = PHPExcel_IOFactory::load($excelfilenamepath);
        
        $objPHPExcel->setActiveSheetIndex(0);
        $worksheet = $objPHPExcel->getActiveSheet();
        $highestColumn = $worksheet->getHighestColumn();
        $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
        $highestRow = $worksheet->getHighestRow();
        $worksheet = $objPHPExcel->getActiveSheet();
               //echo "yo";exit;  
            //echo '<pre>';print_r($nwexcl);exit;
            if(count($nwexcl)>0)
            {
                $row = 2; // 1-based index

                foreach($nwexcl as $rowdata)
                {
                    $col = 0;
                    foreach($rowdata as $key=>$value) 
                    {
                        //echo $col." ".$row." ".$value.'<br>';
                        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value);
                        $col++;
                    }                    
                    $row++;
                }

                $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
                //echo '<pre>';print_r($newfilepath);exit;
                $objWriter->save($newfilepath);
                //echo $newfilepath;exit;

                $genfile = $newfilepath;
            }
            else
            {
                $genfile = '';
            }

        //echo '<pre>';print_r($genfile);exit;
        return $genfile;
    }

    public function updateEmpStatusViaExcel($getuserid,$user_group_id,$cin,$excelfilenamepath)
    {
        $connection = $this->dbtrd;
        $time= time();

         /**  Advise the Reader of which WorkSheets we want to load  **/
         $objPHPExcel = PHPExcel_IOFactory::load($excelfilenamepath);
         $objPHPExcel->setActiveSheetIndex(0);
         $worksheet = $objPHPExcel->getActiveSheet(0);

        try
        {
                $objPHPExcel->setActiveSheetIndex(0);
                $worksheet = $objPHPExcel->getActiveSheet();
                $highestRow = $worksheet->getHighestRow();
                //echo $highestRow;exit;
                $limit = $highestRow;
                $useremail = $this->fetchUserEmail($getuserid,$user_group_id);
                //echo"<pre>";print_r($limit);die;
                for ($row = 2; $row <= $limit ; $row++ )
                {
                    $email  = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                    $emp_status  = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                    $resignordeletiondate  = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                    if(!empty($resignordeletiondate))
                    {
                        $resignordeletiondate =  PHPExcel_Style_NumberFormat::toFormattedString($resignordeletiondate, "DD-MM-YYYY");
                    }
                    
                    

                    if($emp_status == 'Active')
                    {
                        $emp_status = 1;
                    }
                    else if($emp_status == 'Resigned')
                    {
                        $emp_status = 2;
                    }
                    else if($emp_status == 'Not a DP')
                    {
                        $emp_status = 3;
                    }

                    if (in_array($email, $useremail)) 
                    {
                        $this->updateEmployeeStatus($email,$emp_status,$resignordeletiondate);
                    } 
                }
                return true;
        }
        catch (Exception $e)
        {
            return false;
            $connection->close();
        }
    }


    public function fetchUserEmail($getuserid,$user_group_id)
    {
        $connection = $this->dbtrd;
        $grpusrs = $this->insidercommon->getGroupUsers($getuserid,$user_group_id);
        $querysql = "SELECT `email` FROM `it_memberlist` 
                     WHERE `wr_id` IN (".$grpusrs['ulstring'].") AND `status`='1'";
        //echo $querysql;exit;
        try
        {
            $exesql = $connection->query($querysql);
            $getnum = trim($exesql->numRows());
            if($getnum>0)
            {
                while($row = $exesql->fetch())
                {
                    $getlist[] = $row['email'];
                }
            }
            else{
                $getlist = array();
            }
        }
        catch (Exception $e) {
            $getlist = array();
            $connection->close();
        }        
       //echo '<pre> lib';print_r($getlist);exit;
        return $getlist;
    }

    public function updateEmployeeStatus($email,$emp_status,$resignordeletiondate)
    {
        $connection = $this->dbtrd;

        $queryupdate = "UPDATE `it_memberlist` SET
                        `emp_status`= '".$emp_status."',
                        `resignordeletiondate`= '".$resignordeletiondate."',
                        `date_modified`=NOW() 
                        WHERE `email`='".$email."'";
         //print_r($queryupdate);
        try
        {
            $exeprev = $connection->query($queryupdate);
            return true;
        }
        catch (Exception $e) 
        {
            return false;
        }
    }

}
