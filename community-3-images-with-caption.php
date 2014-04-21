<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');
widget_css();

if( $widget_config['title'] ) $title = $widget_config['title'];
else $title = 'no title';

if( $widget_config['forum1'] ) $_bo_table = $widget_config['forum1'];
else $_bo_table = $widget_config['default_forum_id'];

$limit = 4;



$list = g::posts( array(
			"bo_table" 	=>	$_bo_table,
			"limit"		=>	$limit
				)
		);

		
?>

<div class='community_images_with_captions'>
		<div class='title'>
			<span class='com-subject'>
			<img src='<?=x::url()?>/widget/<?=$widget_config['name']?>/img/icon.png'/> <a href='<?=G5_BBS_URL?>/board.php?bo_table=<?=$_bo_table?>'><?=$title?></a>
			</span>
			<a class='more-button' href='<?=G5_BBS_URL?>/board.php?bo_table=<?=$_bo_table?>'>자세히</a>
			<div style='clear:both;'></div>
		</div>
<?php
	if ( $list ) {	
		foreach( $list as $li ) {			
?>
				<div class='community_images_with_captions_container <?=$nomargin?>'>
					<div class='images_with_captions'>
						<div class='caption_image'>					
						<?						
							$imgsrc = x::post_thumbnail($bo_table, $li['wr_id'], 172, 87);					
							if ( empty($imgsrc['src']) )  $imgsrc['src'] = x::url()."/widget/".$widget_config['name'].'/img/no-image.png';
														
							$img = "<img src='$imgsrc[src]'/>";						
							echo "<div class='img-wrapper'><a href='$li[url]'>".$img."</a></div>";
						?>
						</div>
						<div class='caption'><a href='<?=$li['url']?>'><?=cut_str($li['wr_subject'],20,"...")?></a></div>
					</div>
					<div style='clear: left'></div>
				</div>		
	<?
		}
	}
	else {
		for ( $i = 0; $i < 4; $i++ ) {?>
			<div class='community_images_with_captions_container <?=$nomargin?>'>
				<div class='images_with_captions'>
						<div class='caption_image'>					
						<? $imgsrc['src'] = x::url()."/widget/".$widget_config['name'].'/img/no-image.png';
														
							$img = "<img src='$imgsrc[src]'/>";						
							echo "<div class='img-wrapper'><a href='".url_site_config()."'>".$img."</a></div>";
						?>
						</div>
					<div class='caption'><a href='<?=url_site_config()?>'>글을 등록해 주세요</a></div>						
				</div>
			</div>		
	<?
		}
	}	
?>
	<div style='clear:both'></div>
</div>

<?
$list = null;
?>