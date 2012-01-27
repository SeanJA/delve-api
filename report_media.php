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
	<?php foreach ($d->response as $r): ?>
		<tr>
			<td class="media" id="<?php echo $r->media_id; ?>">
				<?php echo $r->media_title; ?>
			</td>
			<td>
				<?php echo $r->times_plays; ?>
			</td>
			<td>
				<span title="<?php echo $r->total_time_viewed ?>">
					<?php echo time_wasted($r->total_time_viewed); ?>
				</span>
			</td>
		</tr>
	<?php endforeach; ?>
</table>