<?php
    $pagetitle="";
    $noticount="0";
    $cartcount="0";
    $notlink="javascript:void(0)";
    $cartlink="javascript:void(0)";
    
    switch($currentcontact){
        case "usersindex":
            $pagetitle="Dashboard";
            break;
        case "usersdocuments":
            $pagetitle="Documents";
            break;
        case "usersnotifications":
            $pagetitle="Notifications";
            break;
        case "usersorderhistory":
            $pagetitle="Order History";
            break;
        case "usercommunication":
            $pagetitle="Comminication";
            break;
        default:
            break;
    }
?>
<div class="col-md-6 commonpadding">
        <h2><?=$pagetitle?></h2>
</div>
<div class="col-md-6 righthead_icon">
        <ul>
                <!--<li><a href=""><img src="img/logout_icon.png" class="right_heicon"></a></li>-->
                <li><?php echo $this->Html->link($this->Html->image('logout_icon.png',array('class'=>'right_heicon')),array('controller'=>'users','action'=>'logout'),array('escape'=>false));?></li>
                <li class="nftcount">
                        <a href="<?=$notlink?>">
                        <!--<img src="img/notification.png" class="right_heicon">-->
                        
                                <?php
                                echo $this->Html->image('notification.png',array('class'=>'right_heicon'));
                                    if($noticount>0){
                                       ?>
                                        <div class="nft">
                                            <?=$noticount?>
                                        </div>
                                       <?php 
                                    }
                                ?>
                        </a>
                </li>
                <li class="nftcount">
                        <a href="<?=$cartlink?>">
                        <!--<img src="img/cart.png" class="right_heicon">-->
                                <?php
                                echo $this->Html->image('cart.png',array('class'=>'right_heicon'));
                                    if($cartcount>0){
                                       ?>
                                        <div class="nft">
                                            <?=$cartcount?>
                                        </div>
                                       <?php 
                                    }
                                ?>
                        </a>
                </li>
                <div class="clr"></div>
        </ul>
        <div class="appdiv">
                <p>Available on 
                                <span><a href="javascript:void(0)">
                                <!--<img src="img/google_play.png" class="right_heicon2">-->
                                <?php echo $this->Html->image('google_play.png',array('class'=>'right_heicon2'));?>
                                </a></span> 
                        Download Now!!</p>
        </div>
</div>