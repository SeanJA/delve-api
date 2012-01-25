<?php

include 'config.php';
$d = new delve_analytics();
$d->access_key = ACCESS_KEY;
$d->secret = SECRET;
$d->org_id = ORG_ID;

$d->report_media();
?>
<table>
	<tr>
		<th>Title</th>
		<th>Plays</th>
		<th>Time Wasted</th>
	</tr>
<?php foreach($d->response as $r): ?>
	<tr>
		<td>
			<?php echo $r->media_title; ?>
		</td>
		<td>
			<?php echo $r->times_plays; ?>
		</td>
		<td>
			<?php echo fuzzy_span(time() - $r->total_time_viewed); ?>
		</td>
	</tr>
<?php endforeach; ?>
</table>