<?php
use Phalcon\Mvc\User\Component;
use Phalcon\Filter;
use Phalcon\Validation;
use Phalcon\Validation\Validator\Email;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\ValidatorInterface;
use Phalcon\Validation\Validator\Regex;
use Phalcon\Validation\Message;

class Searchcommon extends Component
{
    public function getsearch($keyword)
    {
        //echo "ur keyword";
        //echo $keyword;exit;
        $connection     = $this->dbtrd;
        $exegetgeo      = "SELECT `category_name`,`category_desc`,`icon` FROM `web_type_category` WHERE `id` IN (SELECT `parent_id` FROM `web_tags` WHERE `tagname` LIKE '%".$keyword."%') OR category_desc LIKE '%".$keyword."%'  ORDER BY `category_name` ASC ";
        try 
        {
            $bhimrao    = $connection->query($exegetgeo);
            $getnum     = trim($bhimrao->numRows());
            if($getnum!=0)
            {
                while($row = $bhimrao->fetch())
                {
                    $getlist[] = $row;
                }
                //echo '<pre>';print_r($getlist);exit;
                $exearray = array('logged'=>true,'data'=>$getlist);
                return $exearray;
            }
            else{
                $exearray = array('logged'=>false,'data'=>'notfound');
                return $exearray;
            }
            $connection->close();
        }
        catch (Exception $e) {
            $exearray = array('logged'=>false,'data'=>'error');
            return $exearray;
            $connection->close();
        }
    }

    public function getcountry()
    {
        $connection = $this->dbtrd;
        $ingeo = "SELECT * FROM `web_geo_countries`";
        try {
                $bhimrao = $connection->query($ingeo);
                $getnum  = trim($bhimrao->numRows());
                //echo "<pre>";print_r($returnval);exit;
                if($getnum > 0)
                {
                    while($row = $bhimrao->fetch())
                        {
                            $getvalues[$row['id']] = $row['name'];
                        }
                        //echo "<pre>";print_r($getvalues);exit;
                    return $getvalues;
                }
                else
                {
                    return false;
                }
                $connection->close();
            }
        catch (Exception $e) {
            return false;
            $connection->close();
        }
    }

    public function getallstates($countryid)
    {
        $connection = $this->dbtrd;
        $ingeo = "SELECT * FROM `web_geo_states` WHERE `country_id` = '".$countryid."'";
        try {
                $bhimrao = $connection->query($ingeo);
                $getnum  = trim($bhimrao->numRows());
                //echo "<pre>";print_r($returnval);exit;
                if($getnum > 0)
                {
                    while($row = $bhimrao->fetch())
                        {
                            $getvalues[] = $row;
                        }
                        //echo "<pre>";print_r($getvalues);exit;
                    return $getvalues;
                }
                else
                {
                    return false;
                }
                $connection->close();
            }
        catch (Exception $e) {
            return false;
            $connection->close();
        }
    }

    public function getpgoptions()
    {
        $connection = $this->dbtrd;
        $ingeo = "SELECT `id`,`name`,`description` FROM `web_payment_gateway` WHERE `status` = '1'";
        try {
                $bhimrao = $connection->query($ingeo);
                $getnum  = trim($bhimrao->numRows());
                //echo "<pre>";print_r($returnval);exit;
                if($getnum > 0)
                {
                    while($row = $bhimrao->fetch())
                        {
                            $getvalues[] = $row;
                        }
                        //echo "<pre>";print_r($getvalues);exit;
                    return $getvalues;
                }
                else
                {
                    return false;
                }
                $connection->close();
            }
        catch (Exception $e) {
            return false;
            $connection->close();
        }
    }
}
?>

