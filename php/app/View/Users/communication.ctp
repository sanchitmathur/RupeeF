<div class="communication">
    <div>
        <?php
            if(isset($communications) && is_array($communications) && count($communications)>0){
                $baseurl = FULL_BASE_URL.$this->base;
                foreach($communications as $communication){
                    $is_user_post = $communication['Communication']['is_user_post'];
                    $message =$communication['Communication']['message'];
                    $datetime = $communication['Communication']['create_date'];
                    if($is_user_post=='1'){
                        //user details
                        $userimage =(isset($communication['User']['image']) && $communication['User']['image']!='')?$communication['User']['image']:'';
                        
                        if($userimage!=''){
                            $userimage=$baseurl."/userimages/".$userimage;
                        }
                        else{
                            $userimage=$baseurl."/img/userPic.png";
                        }
                        ?>
                        <div class="chatwindow1">
                                <div class="col-md-2">
                                </div>
                                <div class="col-md-9 col-xs-9">
                                        <div class="userspick userspick2">
                                                <p>
                                                    <?=$message?>
                                                    <span><?=$datetime?></span>
                                                </p>
                                        </div>
                                </div>
                                <div class="col-md-1 col-xs-1 userpicture userpicture2">
                                        <img src="<?=$userimage?>" class="userIMG">
                                </div>
                                <div class="clr"></div>
                        </div>
                        <?php
                    }
                    else{
                        ?>
                        <div class="chatwindow1">
                                <div class="col-md-1 col-xs-1 userpicture">
                                        <!--<img src="img/userPic.png" class="userIMG">-->
                                        <?php echo $this->Html->image('ricon.png',array('class'=>'userIMG2'));?>
                                </div>
                                <div class="col-md-9 col-xs-9">
                                        <div class="userspick">
                                                <p>
                                                    <?=$message?>
                                                    <span><?=$datetime?></span>
                                                </p>
                                        </div>
                                </div>
                                <div class="col-md-2">
                                </div>
                                <div class="clr"></div>
                        </div>
                        <?php
                    }
                }
            }
            else{
                ?>
                <div class="chatwindow1 extradiv">
                        <div class="col-md-1 col-xs-1 userpicture">
                                <?php echo $this->Html->image('userPic.png',array('class'=>'userIMG'));?>
                        </div>
                        <div class="col-md-9 col-xs-9">
                                <div class="userspick">
                                        <p>
                                            Welcome, We are here to heal you.
                                        </p>
                                </div>
                        </div>
                        <div class="col-md-2">
                        </div>
                        <div class="clr"></div>
                </div>
                <?php
            }
        ?>
    </div>
</div>

<div class="typeChat">
    <?php
        echo $this->Form->create('User',array('action'=>'postmessage','id'=>'msgfrm'));
    ?>
    <div class="col-md-11 col-xs-11" style="padding:0;">
            <input class="chatinput" id="messagetext" name="messagetext" value="" placeholder="Type your question here..." type="text">
    </div>
    <div class="col-md-1 col-xs-1 send_text">
            <input type="submit" value="" class="imgClass" id="postmessage" />
    </div>
   <?php echo "</form>"; ?>
</div>

<!-- script setions-->
<script type="text/javascript">
    $(document).ready(function(){
        $("#postmessage").bind('click',postthemessage);
    });
    function postthemessage(e) {
        e.preventDefault();
        var message=$("#messagetext").val();
        if (message!='') {
            //
            
            $("#msgfrm").submit();
        }
        else{
            alert("Please type your message");
        }
    }
</script>