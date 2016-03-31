<?php
    $isshownleftactions=true;
    
    if($isshownleftactions){
        ?>
        <div class="actions">
            <h3><?php echo __('Actions'); ?></h3>
            <ul>
                <li><?php echo $this->Html->link(__('New Main Service'), array('action' => 'add')); ?></li>
                <li><?php echo $this->Html->link(__('List Sub Services'), array('controller' => 'sub_services', 'action' => 'index')); ?> </li>
                <li><?php echo $this->Html->link(__('New Sub Service'), array('controller' => 'sub_services', 'action' => 'add')); ?> </li>
                <li><?php echo $this->Html->link(__('New City'), array('action' => 'add')); ?></li>
                <li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
                
                <li><?php echo $this->Html->link(__('List Document Type'), array('controller' => 'DocumentTypes', 'action' => 'index')); ?> </li>
                <li><?php echo $this->Html->link(__('Service Document'), array('controller' => 'ServiceDocuments', 'action' => 'index')); ?> </li>
                <li><?php echo $this->Html->link(__('User Documents'), array('controller' => 'UserDocuments', 'action' => 'index')); ?> </li>
                
            </ul>
        </div>
        <?php
    }
?>
