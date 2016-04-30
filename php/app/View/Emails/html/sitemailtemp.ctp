<div style="width: 100%;  height: 100%; background-color: red;">
    <h1>Hello, <?=$reciever_name?></h1>
    <p><?=$body_text?></p>
    <?php
        if(isset($sitelink)){
            ?>
                <a href="<?=$sitelink?>" target="_blank">Click here</a>
            <?php
        }
    ?>
</div>