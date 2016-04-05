<?php
    $dashcls="";
    $doccls="";
    $notcls="";
    $ordhiscla="";
    $askcls="";
    $commucls='';
    switch($currentcontact){
        case "usersindex":
            $dashcls="active";
            break;
        case "usersdocuments":
            $doccls="active";
            break;
        case "usersnotifications":
            $notcls="active";
            break;
        case "usersorderhistory":
            $ordhiscla="active";
            break;
        case "usersaskexpert":
            $askcls="active";
            break;
        case "userscommunication":
            $commucls="active";
            break;
        case "usersdocumentupload":
            //$doccls="active";
            break;
        default:
            break;
    }
    
?>

<div class="left_beforelogin">
    <div class="before_logo">
            
            <?php echo $this->Html->link($this->Html->image('beforelogo.png',array('class'=>'beforelogo')),array('controller'=>'MainServices','action'=>'services'),array('escape'=>false));?>
    </div>
    <div class="before_Menunav">
            <ul>
                    
                    <li><?php echo $this->Html->link('Dashboard',array('controller'=>'users','action'=>'index'),array('class'=>$dashcls));?></li>
                    <li><?php echo $this->Html->link('Documents',array('controller'=>'users','action'=>'documents'),array('class'=>$doccls));?></li>
                    <li><?php echo $this->Html->link('Notifications',array('controller'=>'users','action'=>'notifications'),array('class'=>$notcls));?></li>
                    <li><?php echo $this->Html->link('Order History',array('controller'=>'users','action'=>'orderhistory'),array('class'=>$ordhiscla));?></li>
                    <li><?php echo $this->Html->link('Communication',array('controller'=>'users','action'=>'communication'),array('class'=>$commucls));?></li>
            </ul>
    </div>
    <div class="ask_expert">
            
            <?php echo $this->Html->link($this->Html->image('ask.png',array('class'=>'expert')),array('controller'=>'users','action'=>'askexpert'),array('class'=>$askcls,'escape'=>false));?>
    </div>
</div>