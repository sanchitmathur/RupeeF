<!-- script setions-->
<script type="text/javascript">
    var baseurl = "<?=$sitebasepath?>";
    $(document).ready(function(){
        $("#postmessage").bind('click',postthemessage);
        $(".questioncat").bind('click',categorytypechoose);
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
    
    function categorytypechoose(e){
        e.preventDefault();
        var catid = $(e.currentTarget).attr('catid');
        var func="Users/expertquestionans";
        if (catid>0) {
            //remove pre select section
            $(".question").find('.active').removeClass('active');
            $(e.currentTarget).addClass('active');
            //$(".ques_ans").empty();
            $.ajax({
                url:baseurl+func,
                type:'post',
                dataType:'json',
                data:{expert_cat_id:catid,is_ajax_call:1},
                success:function(response){
                    console.log(response);
                    var datalen = response.expertquestionanswes.length;
                    var datahtml='';
                    if (datalen>0) {
                        
                        for(var i=0; i<datalen;i++){
                            var resans = response.expertquestionanswes[i];
                            datahtml+='<div class="sub_quesans">\
                                      <div class="sub1">\
                                      <div class="col-sm-1 col-xs-1 qIMG">\
                                      <?php echo $this->Html->image("question.png");?>\
                                      </div>\
                                      <div class="col-sm-10 col-xs-10">\
                                      <h2>'+resans.question+'</h2>\
                                      </div><div class="clr"></div></div>\
                                      <div class="sub2"><p>'+resans.answer+'</p></div></div>';
                        }
                    }
                    else{
                        console.log("data not found");
                    }
                    //added the code sections
                    $(".ques_ans").html(datahtml);
                },
                error:function(response){
                    console.log(response);
                }
            });
        }
    }
</script>
<div class="typeChat2">
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
    <div class="clr"></div>
</div>

<div class="setQuestion">
    <h2>Want to know the basics?<span>Click below or start typing to get questions!</span></h2>
    <div class="question">
        <?php
            if(is_array($askExpertCategories) && count($askExpertCategories)>0){
                foreach($askExpertCategories as $askExpertCategory_id=>$askExpertCategory_name){
                    $actclass="questioncat";
                    if($askExpertCategory_id==$expert_cat_id){
                        $actclass="questioncat active";
                    }
                   ?>
                   <div class="col-sm-3 commonset">
                        <div class="setQ">
                            <?php echo $this->Html->link(__($askExpertCategory_name),array('action'=>'askexpert',$askExpertCategory_id),array('class'=>$actclass,'catid'=>$askExpertCategory_id));?>
                            <!--<a href="" class="active">Corporate Entity</a>-->
                        </div>
                    </div>
                   <?php 
                }
            }
        ?>
        <!--
        <div class="col-sm-3 commonset">
                <div class="setQ">
                        <a href="" class="active">Corporate Entity</a>
                </div>
        </div>
        <div class="col-sm-3 commonset">
                <div class="setQ">
                        <a href="">Registration Proprietorship</a>
                </div>
        </div>
        <div class="col-sm-3 commonset">
                <div class="setQ">
                        <a href="">Registration Trademark</a>
                </div>
        </div>
        <div class="col-sm-3 commonset">
                <div class="setQ">
                        <a href="">Registration VAT or TIN Registration</a>
                </div>
        </div>
        
        <div class="col-sm-3 commonset">
                <div class="setQ">
                        <a href="">Service Tax Registration</a>
                </div>
        </div>
        <div class="col-sm-3 commonset">
                <div class="setQ">
                        <a href="">MSME or SSI Registration</a>
                </div>
        </div>
        <div class="col-sm-3 commonset">
                <div class="setQ">
                        <a href="">Import Export Registration</a>
                </div>
        </div>
        <div class="col-sm-3 commonset">
                <div class="setQ">
                        <a href="">Bank Loan and Funding</a>
                </div>
        </div>
        -->
        <div class="clr"></div>
    </div>
</div>

<div class="ques_ans">
        <?php
            if(is_array($allquestionanswers) && count($allquestionanswers)>0){
                foreach($allquestionanswers as $allquestionanswer){
                    $answer = $allquestionanswer["answer"];
                    $question=$allquestionanswer["question"];
                    ?>
                    <div class="sub_quesans">
                        <div class="sub1">
                            <div class="col-sm-1 col-xs-1 qIMG">
                                    <?php echo $this->Html->image('question.png');?>
                            </div>
                            <div class="col-sm-10 col-xs-10">
                                    <h2><?=$question?></h2>
                            </div>
                            <div class="clr"></div>
                        </div>
                        <div class="sub2">
                            <p><?=$answer?></p>
                        </div>
                    </div>
                    <?php
                }
            }
        ?>
        
        <!--
        <div class="sub_quesans">
                <div class="sub1">
                        <div class="col-sm-1 col-xs-1 qIMG">
                                <?php echo $this->Html->image('question.png',array('class'=>''));?>
                        </div>
                        <div class="col-sm-10 col-xs-10">
                                <h2>What is a Digital Signature Certificate?</h2>
                        </div>
                        <div class="clr"></div>
                </div>
                <div class="sub2">
                        <p>A Digital Signature establishes the identity of the sender or signee electronically while filing documents through the Internet. The Ministry of Corporate Affairs (MCA) mandates that the Directors sign some of the application documents using their Digital Signature. Hence, a Digital Signature is required for </p>
                </div>
        </div>
        <div class="sub_quesans">
                <div class="sub1">
                        <div class="col-sm-1 col-xs-1 qIMG">
                               <?php echo $this->Html->image('question.png',array('class'=>''));?>
                        </div>
                        <div class="col-sm-10 col-xs-10">
                                <h2>What is a Digital Signature Certificate?</h2>
                        </div>
                        <div class="clr"></div>
                </div>
                <div class="sub2">
                        <p>A Digital Signature establishes the identity of the sender or signee electronically while filing documents through the Internet. The Ministry of Corporate Affairs (MCA) mandates that the Directors sign some of the application documents using their Digital Signature. Hence, a Digital Signature is required for </p>
                </div>
        </div>
        <div class="sub_quesans">
                <div class="sub1">
                        <div class="col-sm-1 col-xs-1 qIMG">
                                <?php echo $this->Html->image('question.png',array('class'=>''));?>
                        </div>
                        <div class="col-sm-10 col-xs-10">
                                <h2>What is a Digital Signature Certificate?</h2>
                        </div>
                        <div class="clr"></div>
                </div>
                <div class="sub2">
                        <p>A Digital Signature establishes the identity of the sender or signee electronically while filing documents through the Internet. The Ministry of Corporate Affairs (MCA) mandates that the Directors sign some of the application documents using their Digital Signature. Hence, a Digital Signature is required for </p>
                </div>
        </div>
        -->
</div>