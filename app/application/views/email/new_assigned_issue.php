<p><?php echo sprintf(__('email.assignment'),$issue->title,$project->name); ?>.</p>

<p><?php echo nl2br($issue->body); ?></p>

<p><?php echo sprintf(__('email.created_by'),$issue->user->firstname . ' ' . $issue->user->lastname); ?><br />
<?php echo __('email.more_url'); ?><a href="<?php echo $issue->to(); ?>"><?php echo $issue->to(); ?></a></p>
<!--

<pre>
	<h2>Issue</h2>
	<? // print_r($issue);?>
	
		<h2>Project</h2>
	<? // print_r($project);?>
</pre>
-->