<div style="width: 100%;  height: 100%;">
    <h1>Dear, <?=(isset($reciever_name))?$reciever_name:'User'?></h1>
    <p><?=$body_text?></p>
    <p>
    <?php
        if(isset($sitelink)){
            ?>
                <a href="<?=$sitelink?>" target="_blank"><?=$linktitle?></a>
            <?php
        }
    ?>
    </p>
</div>