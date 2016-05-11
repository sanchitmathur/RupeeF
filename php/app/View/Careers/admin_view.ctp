<?php
	//pr($career);
?>
<div class="career view">
<h2><?php echo __('Career Job'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($career['Career']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Job Type'); ?></dt>
		<dd>
			<?php echo h($career['Career']['job_type']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Job Title'); ?></dt>
		<dd>
			<?php echo h($career['Career']['job_title']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Job Role'); ?></dt>
		<dd>
			<?php echo h($career['Career']['job_role']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Monthly Salary'); ?></dt>
		<dd>
			<?php echo h($career['Career']['monthly_salary']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Vacancy'); ?></dt>
		<dd>
			<?php echo h($career['Career']['vacancy']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Job Description'); ?></dt>
		<dd>
			<?php echo h($career['Career']['job_description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Is Blocked'); ?></dt>
		<dd>
			<?php echo h($career['Career']['is_blocked']); ?>
			&nbsp;
		</dd>
		
	</dl>
	</br></br>
	<div class="actions">
		<?php echo $this->Html->link(__('Back'), array('action' => 'index','admin'=>true)); ?>
	</div>
	
	</br></br></br>
	
	<div class="related">
		<h3><?php echo __('Job Applicants'); ?></h3>
		<?php if (!empty($career['JobApplicant'])):
			//pr($career['JobApplicant']);
		?>
		<table cellpadding = "0" cellspacing = "0">
		<tr>
			<th><?php echo __('Id'); ?></th>
			<th><?php echo __('Name'); ?></th>
			<th><?php echo __('Email'); ?></th>
			<th><?php echo __('Contact Number'); ?></th>
			<th><?php echo __('CV'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
		</tr>
		<?php foreach ($career['JobApplicant'] as $jobApplicant): ?>
			<tr>
				<td><?php echo $jobApplicant['id']; ?></td>
				<td><?php echo $jobApplicant['name']; ?></td>
				<td><?php echo $jobApplicant['email']; ?></td>
				<td><?php echo $jobApplicant['contact_number']; ?></td>
				<td><?php echo $jobApplicant['cv']; ?></td>
				<td class="actions">
					<?php //echo $this->Html->link(__('View'), array('controller' => 'user_service_packages', 'action' => 'view', $jobApplicant['id'])); ?>
					<?php //echo $this->Html->link(__('Edit'), array('controller' => 'user_service_packages', 'action' => 'edit', $jobApplicant['id'])); ?>
					<?php //echo $this->Form->postLink(__('Delete'), array('controller' => 'user_service_packages', 'action' => 'delete', $jobApplicant['id']), array(), __('Are you sure you want to delete # %s?', $jobApplicant['id'])); ?>
				</td>
			</tr>
		<?php endforeach; ?>
		</table>
	<?php endif; ?>
	
	</div>
	
</div>

