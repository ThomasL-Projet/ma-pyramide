<div id="presentation">
<?php if ($affichage) : ?>
	<?php 
        
            if ($pages['Statique']['category_id'] == 1 OR $pages['Statique']['category_id'] == 3 OR $pages['Statique']['category_id'] == 10) {
                    if (!empty($pages['Statique']['imagesid'])) {
                            $img = explode("@",$pages['Statique']['imagesid']);
                            if (isset($img[0])) {
                                    echo $this->Html->image('GestionPond/' . $img[0] . '.jpg', array('width' => 300, 'height' => 280, 'style' => 'background-color : #FFFFFF;border-radius:10px; -moz-border-radius:10px; -webkit-border-radius:10px;', 'align' => 'left'));
                            } else {
                                    echo '<div id="image">

                                          </div>';
                            }
                    } else {
                            echo '<div id="image">

                                          </div>';
                    }
            } elseif ($pages['Statique']['category_id'] == 2) {
                    if (!empty($pages['Statique']['imagesid'])) {
                            $img = explode("@",$pages['Statique']['imagesid']);
                            if (isset($img[0])) {
                                    echo $this->Html->image('ActiPhy/' . $img[0] . '.jpg', array('width' => 300, 'height' => 280, 'style' => 'background-color : #FFFFFF;border-radius:10px; -moz-border-radius:10px; -webkit-border-radius:10px;', 'align' => 'left'));
                            } else {
                                    echo '<div id="image">

                                          </div>';
                            }
                    } else {
                            echo '<div id="image">

                                          </div>';
                    }
            } else {
                    echo '<div id="image">

                              </div>';
            }
	?>
    <div class="texte">
		<!-- Cette page est accessible depuis le menu situé en haut de la page : Cliquez sur "Mon assiette" -> "Céréales" -->
		<div class="span1" style="margin-left:-20px"><?php echo $pages['Statique']['title']; ?></div> <br/>
<?php if (!empty($pages['Statique']['content1'])) : ?>
		<div class="p1"> <?php echo $pages['Statique']['content1']; ?>
		</div> 
		<br/>
<?php endif; ?>
	</div> 
<?php if (!empty($pages['Statique']['content2'])) : ?>
	<div id="texte4">
		<table>
			<tr>
				<td >
					<!-- class = "images"-->

		<div class="p1"> <?php echo $pages['Statique']['content2']; ?>
		</div> 
				</td>
				<td>
					<br/><br/><br/>
					<!-- Image illustrant le paragraphe n°2 -->
					<div class="p1">
					<?php 
					if ($pages['Statique']['category_id'] == 1 OR $pages['Statique']['category_id'] == 3 OR $pages['Statique']['category_id'] == 10) {
						if (!empty($pages['Statique']['imagesid'])) {
							$img = explode("@",$pages['Statique']['imagesid']);
							if (isset($img[1])) {
								echo $this->Html->image('GestionPond/' . $img[1] . '.jpg', array('width' => 300, 'height' => 280, 'style' => 'background-color : #FFFFFF;border-radius:10px; -moz-border-radius:10px; -webkit-border-radius:10px;', 'align' => 'left'));
							} else {
								echo $this->Html->image('Fruits.png', array('height' => '200', 'width' => '260', 'alt' => 'Fruits'));
							}
						} else {
							echo $this->Html->image('Fruits.png', array('height' => '200', 'width' => '260', 'alt' => 'Fruits'));
						}
					} elseif ($pages['Statique']['category_id'] == 2) {
						if (!empty($pages['Statique']['imagesid'])) {
							$img = explode("@",$pages['Statique']['imagesid']);
							if (isset($img[1])) {
								echo $this->Html->image('ActiPhy/' . $img[1] . '.jpg', array('width' => 300, 'height' => 280, 'style' => 'background-color : #FFFFFF;border-radius:10px; -moz-border-radius:10px; -webkit-border-radius:10px;', 'align' => 'left'));
							} else {
								echo $this->Html->image('Fruits.png', array('height' => '200', 'width' => '260', 'alt' => 'Fruits'));
							}
						} else {
							echo $this->Html->image('Fruits.png', array('height' => '200', 'width' => '260', 'alt' => 'Fruits'));
						}
					} else {
						echo $this->Html->image('Fruits.png', array('height' => '200', 'width' => '260', 'alt' => 'Fruits'));
					}
					?>
					</div>
				</td>
			</tr>
		</table>
	</div>
<?php endif; ?>
<?php if (!empty($pages['Statique']['content3'])) : ?>
	<div id="texte6">
		<div class="p1"> <?php echo $pages['Statique']['content3']; ?>
		</div> 
	</div>
<?php endif; ?>
<?php endif; ?>
</div>