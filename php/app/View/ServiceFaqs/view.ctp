<div class="serviceFaqs view">
<h2><?php echo __('Service Faq'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($serviceFaq['ServiceFaq']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Service'); ?></dt>
		<dd>
			<?php echo $this->Html->link($serviceFaq['Service']['service_name'], array('controller' => 'services', 'action' => 'view', $serviceFaq['Service']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Question'); ?></dt>
		<dd>
			<?php echo h($serviceFaq['ServiceFaq']['question']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Answer'); ?></dt>
		<dd>
			<?php echo h($serviceFaq['ServiceFaq']['answer']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Is Blocked'); ?></dt>
		<dd>
			<?php echo h($serviceFaq['ServiceFaq']['is_blocked']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Is Deleted'); ?></dt>
		<dd>
			<?php echo h($serviceFaq['ServiceFaq']['is_deleted']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Service Faq'), array('action' => 'edit', $serviceFaq['ServiceFaq']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Service Faq'), array('action' => 'delete', $serviceFaq['ServiceFaq']['id']), array(), __('Are you sure you want to delete # %s?', $serviceFaq['ServiceFaq']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Service Faqs'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Service Faq'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Services'), array('controller' => 'services', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Service'), array('controller' => 'services', 'action' => 'add')); ?> </li>
	</ul>
</div>
