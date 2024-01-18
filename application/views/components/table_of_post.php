	
		<?php 
		
		$start = $start_from==""? 0:$start_from;
		$x = 10;
		$y = 20;
		$total_post = $total_user_post;
		for ($i= 0; $i <10 ; $i++) { ?>
			<tr>
                <input type="hidden" id="total_user_post" value="<?= $total_post ?>">
				<td nowrap="nowrap"><?= $start+$i+1; ?></td>
				<td nowrap="nowrap" width="30%" class="content_title">					
					<?php
                                        
					if ($start+$i < $total_post) {
						echo "<input type='hidden' name='word_id' id'word_id' class='word_id' value='".$user_posts[$i]->post_id."'>";
						// echo strip_tags($user_posts[$i]->post_title);
						$post_title = trim($user_posts[$i]->post_title);
						$post_title = preg_replace("/\s|&nbsp;|&nb/",'',$post_title);
						echo $post_title;
					}
					?>
				</td>
				<td nowrap="nowrap"><?= $start+$x+$i+1;?></td>
				<td nowrap="nowrap" width="30%" class="content_title">

					<?php
                                        
					if ($start+$x+$i<$total_post) {
						
						echo "<input type='hidden' name='word_id' id'word_id' class='word_id' value='".$user_posts[$x+$i]->post_id."'>";
						$se_title = trim($user_posts[$x+$i]->post_title);
						$se_title = preg_replace("/\s|&nbsp;|&nb/",'',$se_title);
						echo $se_title;
						// echo mb_substr(strip_tags($user_posts[$x+$i]->post_details), 0, 10);
					}
					?>
				</td>
				<td nowrap="nowrap"><?= $start+$y+$i+1; ?></td>
				<td nowrap="nowrap" width="30%" class="content_title">
					<?php
                                        
					if ($start+$y+$i<$total_post) {
						
						echo "<input type='hidden' name='word_id' id'word_id' class='word_id' value='".$user_posts[$y+$i]->post_id."'>";
						$last_title = trim($user_posts[$y+$i]->post_title);
						$last_title = preg_replace("/\s|&nbsp;|&nb/",'',$last_title);
						echo $last_title;
						// echo mb_substr(strip_tags($user_posts[$y+$i]->post_details), 0, 10);

					}
					?>

				</td>
			</tr>

		<?php
		}
		?>		