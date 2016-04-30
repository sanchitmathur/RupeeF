<?php
    $isshownleftactions=false;
    if($this->Session->check('adminuser')){
        $isshownleftactions=true;
    }
    if($isshownleftactions){
        ?>
        <div class="actions">
            
            <h3><?php echo __('Actions'); ?></h3>
            <ul>
                <li><?php echo $this->Html->link(__('Log Out'), array('controller'=>'MainServices','action' => 'logout'),array('style'=>'color:#e32;')); ?></li>
                <li><?php echo $this->Html->link(__('Change Password'), array('controller'=>'AdminUsers','action' => 'changepassword'),array('style'=>'color:#e32;')); ?></li>
                <li><?php echo $this->Html->link(__('Menues'), array('controller'=>'Menus','action' => 'index')); ?></li>
                <li><?php echo $this->Html->link(__('Main Services'), array('controller'=>'MainServices','action' => 'index')); ?></li>
                <li><?php echo $this->Html->link(__('Sub Services'), array('controller'=>'SubServices','action' => 'index')); ?></li>
                <li><?php echo $this->Html->link(__('Services'), array('controller'=>'Services','action' => 'index')); ?></li>
                <li><?php echo $this->Html->link(__('Document Types'), array('controller' => 'DocumentTypes', 'action' => 'index')); ?> </li>
                <li><?php echo $this->Html->link(__('Cities'), array('controller'=>'cities','action' => 'index')); ?></li>
                
                <li><?php echo $this->Html->link(__('Service Packages'), array('controller'=>'service_packages','action' => 'index')); ?></li>
                <li><?php echo $this->Html->link(__('Service Document Types'), array('controller' => 'ServiceDocuments', 'action' => 'index')); ?> </li>
                <li><?php echo $this->Html->link(__('Service Related Services'), array('controller' => 'RelatedServices', 'action' => 'index')); ?> </li>
                
                <li><?php echo $this->Html->link(__('User Communications'), array('controller' => 'communications', 'action' => 'index')); ?> </li>
                
                <li><?php echo $this->Html->link(__('User Documents'), array('controller' => 'UserDocuments', 'action' => 'index')); ?> </li>
                <li><?php echo $this->Html->link(__('Send Notification'), array('controller' => 'Notifications', 'action' => 'add')); ?> </li>
                
                <li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
                
                <li><?php echo $this->Html->link(__('Ask Expert Categories'), array('controller' => 'AskExpertCategories', 'action' => 'index')); ?> </li>
                <li><?php echo $this->Html->link(__('Ask Expert Questions'), array('controller' => 'AskExperts', 'action' => 'index')); ?> </li>
                
                <li><?php echo $this->Html->link(__('Careers'), array('controller' => 'careers', 'action' => 'index')); ?> </li>
                
                <li><?php echo $this->Html->link(__('New Main Service'), array('controller'=>'MainServices','action' => 'add')); ?></li>
                <li><?php echo $this->Html->link(__('New Sub Service'), array('controller' => 'sub_services', 'action' => 'add')); ?> </li>
                <li><?php echo $this->Html->link(__('New City'), array('action' => 'add')); ?></li>
                
            </ul>
        </div>
        <?php
    }
    else{
        ?>
        <!--<div class="actions">
            
            <h3><?php echo __('Actions'); ?></h3>
            <ul>
                <li><?php echo $this->Html->link(__('Forgot Password'), array('controller'=>'AdminUsers','action' => 'forgotpassword'),array('style'=>'color:#e32;')); ?></li>
            </ul>
        </div>-->
        <?php
    }
?>
