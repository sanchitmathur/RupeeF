<div class="communication">
    <div id="holder">
        <span id="afterdiv"></span>
        <?php
        //pr($communications);
            if(isset($communications) && is_array($communications) && count($communications)>0){
                $baseurl = FULL_BASE_URL.$this->base;
                foreach($communications as $communication){
                    $communication_id=$communication['Communication']['id'];
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
                            $userimage=$baseurl."/img/icon_2.png";
                        }
                        ?>
                        <div class="chatwindow1" comm_id="<?=$communication_id?>">
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
                        <div class="chatwindow1" comm_id="<?=$communication_id?>">
                                <div class="col-md-1 col-xs-1 userpicture">
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
                                            Welcome, We are here to help you.
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
    var pagecall=false;
    var baseurl= "<?=$sitebasepath?>";
    var communication_id = 0;
    $(document).ready(function(){
        $("#postmessage").bind('click',postthemessage);
        //calculate bottom position of the scroll
        calculateBottomPosition();
        $(".communication").scroll(function(){
            var scrlpos = $(".communication").scrollTop();
            console.log("scrol pos  :"+scrlpos);
            if (scrlpos==0){
                //now get new record
                if (pagecall==false) {
                    pagecall=true;
                    morecommunication();
                }
            }
        });
    });
    
    function postthemessage(e) {
        e.preventDefault();
        var message=$("#messagetext").val();
        if (message!='') {
            $("#msgfrm").submit();
        }
        else{
            alert("Please type your message");
        }
    }
    
    function calculateBottomPosition(){
        var holderheight = $("#holder").outerHeight();
        var containerHeight = $(".communication").outerHeight();
        console.log("comm : "+containerHeight+" holder height : "+holderheight);
        var lastpos = holderheight - containerHeight;
        $(".communication").scrollTop(lastpos);
    }
    
    function morecommunication(){
        var funccall="users/getoldmessages";
        
        var fstObj="";
        if ($(".chatwindow1").length>0 && communication_id==0) {
            //fstObj = $(".chatwindow1")[0];
            fstObj = $("#holder div:first");
            
            communication_id = $(fstObj).attr('comm_id');
        }
        fstObj = $("#afterdiv");
        
        //console.log("communication id : "+communication_id);
        
        if (communication_id>0) {
            
            $.ajax({
                url:baseurl+funccall,
                type:'post',
                dataType:'json',
                data:{communication_id:communication_id},
                success:function(response){
                    console.log(response);
                    var colen = response.communications.length;
                    console.log(colen);
                    if (colen>0) {
                        pagecall=false;
                        var htmlcontent='';
                        for (var i=0;i<colen;i++) {
                            var communicationuser = response.communications[i];
                            //console.log(communicationuser);
                            var communication = communicationuser.Communication;
                            var user = communicationuser.User;
                            //console.log(communication);
                            //console.log(user);
                            
                            var comm_id=communication.id;
                            var is_user_post = communication.is_user_post;
                            var message = communication.message;
                            var create_date = communication.create_date;
                            var userimage = "";
                            var obhtml='';
                            if (is_user_post==1){
                                userimage = user.image;
                                if(userimage!=''){
                                    userimage=baseurl+"userimages/"+userimage;
                                }
                                else{
                                    userimage=baseurl+"/img/icon_2.png";
                                }
                                //data formation
                                obhtml='<div class="chatwindow1" comm_id="'+comm_id+'">\
                                             <div class="col-md-2"></div>\<div class="col-md-9 col-xs-9">\
                                             <div class="userspick userspick2">\
                                             <p>'+message+'<span>'+create_date+'</span></p>\
                                             </div></div><div class="col-md-1 col-xs-1 userpicture userpicture2">\
                                             <img src="'+userimage+'" class="userIMG"></div><div class="clr"></div></div>';
                            }
                            else{
                                obhtml='<div class="chatwindow1" comm_id="'+comm_id+'">\
                                             <div class="col-md-1 col-xs-1 userpicture">\
                                             <?php echo $this->Html->image('ricon.png',array('class'=>'userIMG2'));?></div>\
                                             <div class="col-md-9 col-xs-9"><div class="userspick">\
                                             <p>'+message+'<span>'+create_date+'</span></p>\
                                             </div></div><div class="col-md-2"></div><div class="clr"></div></div>';
                            }
                            console.log("comm id : "+comm_id);
                            if (communication_id>comm_id) {
                                communication_id = comm_id;
                            }
                            htmlcontent +=obhtml;
                        }
                        
                        if (fstObj!='') {
                            $(fstObj).prepend(htmlcontent);
                        }
                        else{
                            console.log("fst div not set");
                        }
                        //noe get the count of the total class
                        console.log("total div : "+$(".chatwindow1").length);
                        
                        console.log("nw comm id : "+communication_id);
                    }
                },
                error:function(response){
                    console.log(response);
                }
            }); 
        }
        
    }
    
</script>