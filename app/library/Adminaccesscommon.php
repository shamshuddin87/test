<?php
use Phalcon\Mvc\User\Component;

class Adminaccesscommon extends Component
{
  

//-----------------------------------ADMIN MODULE--------------------------------------------------------------------------------------------------
  
  public function updateaaccess($getalldata)
  {


         // print_r($getalldata);exit;
      
          $connection = $this->dbtrd;
          if($getalldata['method']=="updateupsi")
          {
              $queryget =  "UPDATE `adminmodule` SET  `upsi_conn_per_add`='".$getalldata['add_p']."', `upsi_conn_per_view`='".$getalldata['view_p']."',
              `upsi_conn_per_edit`='".$getalldata['edit_p']."' , `upsi_conn_per_delete`='".$getalldata['del_p']."',`upsi_infoshare_view`='".$getalldata['info_view_p']."' ,
              `upsi_infoshare_delete`='".$getalldata['info_del_p']."', `upsi_infoshare_add`='".$getalldata['info_add_p']."' WHERE `user_id`='".$getalldata['userid']."' ";
         }
         else if($getalldata['method']=="updaterescmp")
         {
               $queryget =  "UPDATE `adminmodule` SET  `comp_trad_rest_add`='".$getalldata['cmp_trd_rest_add']."', `comp_trad_rest_view`='".$getalldata['cmp_trd_rest_view']."',
               `comp_trad_rest_edit`='".$getalldata['cmp_trd_rest_edit']."' , `comp_trad_rest_delete`='".$getalldata['cmp_trd_rest_delete']."',
               `emplblock_add`='".$getalldata['emplblock_add']."',`emplblock_view`='".$getalldata['emplblock_view']."' ,`emplblock_edit`='".$getalldata['emplblock_edit']."',`emplblock_delete`='".$getalldata['emplblock_delete']."' WHERE `user_id`='".$getalldata['userid']."'";
         }
         

         try{
                $exeget = $connection->query($queryget);
              
                if($exeget)
                {
                   return true;
                }
                else
                {
                   return false;
                }
             }
             catch(Exception $e)
             {
                return false;
             }
  
  }


//--------------------------------------------------------------------------------------------------------------------------------------------------------


}