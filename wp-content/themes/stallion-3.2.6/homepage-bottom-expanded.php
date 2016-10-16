<?php 

$a1_id = (ot_get_option('hp_box_a1','')) ? ot_get_option('hp_box_a1','') : "1";
$a1_name = get_category($a1_id)->name;

$a2_id = (ot_get_option('hp_box_a2','')) ? ot_get_option('hp_box_a2','') : "1";
$a2_name = get_category($a2_id)->name;

$a3_id = (ot_get_option('hp_box_a3','')) ? ot_get_option('hp_box_a3','') : "1";
$a3_name = get_category($a3_id)->name;

$a4_id = (ot_get_option('hp_box_a4','')) ? ot_get_option('hp_box_a4','') : "1";
$a4_name = get_category($a4_id)->name;

$b1_title = (ot_get_option('hp_box_b1_title','')) ? ot_get_option('hp_box_b1_title','') : "";
$b1_content = (ot_get_option('hp_box_b1_content','')) ? ot_get_option('hp_box_b1_content','') : "";

$b2_id = (ot_get_option('hp_box_b2','')) ? ot_get_option('hp_box_b2','') : "1";
$b2_name = get_category($b2_id)->name;

$b3_id = (ot_get_option('hp_box_b3','')) ? ot_get_option('hp_box_b3','') : "1";
$b3_name = get_category($b3_id)->name;

?>
	<div class="category-section">
		<div class="container">
			<div class="row" style="margin-top:10px">
				<div class="span3">
					<?php bw_CategoryTickerExpanded($a1_id, $a1_name); ?>
				</div>
				<div class="span3">
					<?php bw_CategoryTickerExpanded($a2_id, $a2_name); ?>
				</div>
				<div class="span3">
					<?php bw_CategoryTickerExpanded($a3_id, $a3_name); ?>
				</div>
				<div class="span3">
					<?php bw_CategoryTickerExpanded($a4_id, $a4_name); ?>
				</div>
			</div>
			<div class="row" style="margin-top:15px">
				<div class="span3">
					<div class="schooldesc-about">
						<h3 class="balance-text"><?php echo $b1_title; ?></h3>
						<?php echo $b1_content; ?>
					</div>
				</div>
				<div class="span3">
					<?php bw_CategoryTickerExpanded($b2_id, $b2_name); ?>
				</div>
<?php if (ot_get_option('hp_box_b3_content','')) : 
	$b3_content = (ot_get_option('hp_box_b3_content','')) ? ot_get_option('hp_box_b3_content','') : "";
?>
				<div class="span3">
					<div class="hp-customblock">
						<?php echo $b3_content; ?>&nbsp;
					</div>
				</div>
<?php else : ?>
				<div class="span3">
					<?php bw_CategoryTickerExpanded($b3_id, $b3_name); ?>
				</div>
<?php endif; ?>
<?php if (ot_get_option('pbj_disable_full','') != "disable") : ?>
				<div class="span3">
					<div class="pbj-block">
						<a href="http://betterjournalism.org/" class="pbj-block-logo"></a>
						<p>The <a href="http://betterjournalism.org/">Project for Better Journalism</a> is a not-for-profit, student-run organization that aims to modernize journalism and increase collaboration. We're providing and supporting publications like this at high schools across the country.</p>
						<p><?php echo bloginfo("name"); ?> is a member chapter of the Project. Its content is created and updated by a team of students at this school, and supported by a faculty advisor.</p>
						<p><a href="http://betterjournalism.org/">Learn more about the Project.</a></p>
					</div>
				</div>
<?php else : ?>
				<div class="span3" style="background:#F5F5F5">
					<iframe src="//www.facebook.com/plugins/likebox.php?href=http%3A%2F%2Fwww.facebook.com%2F<?php echo (ot_get_option('hp_box_b4_fburl','')) ? ot_get_option('hp_box_b4_fburl','') : "google"; ?>&amp;width=220&amp;height=423&amp;colorscheme=light&amp;show_faces=true&amp;border_color=%23DDD&amp;stream=false&amp;header=false" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:220px; height:423px;background:#FFF" allowTransparency="true"></iframe>
				</div>
<?php endif; ?>
			</div>
		</div>
	</div>