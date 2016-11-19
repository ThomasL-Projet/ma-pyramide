<div class="row">
    <div class="small-12 column">
        <div id="presentation">
            <br />
            <!-- premier paragraphe (avec photo) -->
            <div class="row">
                <div class="small-3 column">
                    <?php if ($affichage) : ?>
                        <?php
                        if ($pages['Statique']['category_id'] == 1 OR $pages['Statique']['category_id'] == 3 OR $pages['Statique']['category_id'] == 10) {
                            if (!empty($pages['Statique']['imagesid'])) {
                                $img = explode("@", $pages['Statique']['imagesid']);
                                if (isset($img[0])) {
                                    echo $this->Html->image('GestionPond/' . $img[0] . '.jpg', array('width' => 300, 'height' => 280));
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
                                $img = explode("@", $pages['Statique']['imagesid']);
                                if (isset($img[0])) {
                                    echo $this->Html->image('ActiPhy/' . $img[0] . '.jpg', array('width' => 300, 'height' => 280));
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

                    </div> 

                    <div class="small-8 small-offset-1 columns">
                        <!-- Cette page est accessible depuis le menu situé en haut de la page : Cliquez sur "Mon assiette" -> "Céréales" -->
                        <h1  class="text-center title"><?php echo $pages['Statique']['title']; ?></h1>

                        <?php if (!empty($pages['Statique']['content1'])) : ?>
                            <div class="p1"> <?php echo $pages['Statique']['content1']; ?>
                            </div> 
                            <br/>
                        <?php endif; ?>
                    </div>
                </div> 

                <?php if (!empty($pages['Statique']['content2'])) : ?>

                    <div class="row"> 
                        <!-- class = "images"-->

                        <div class="small-8 columns"> 
                            <?php echo $pages['Statique']['content2']; ?> 
                        </div> 


                        <!-- Image illustrant le paragraphe n°2 -->
                        <div class="small-3 small-offset-1 columns">
                            <?php
                            if ($pages['Statique']['category_id'] == 1 OR $pages['Statique']['category_id'] == 3 OR $pages['Statique']['category_id'] == 10) {
                                if (!empty($pages['Statique']['imagesid'])) {
                                    $img = explode("@", $pages['Statique']['imagesid']);
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
                                    $img = explode("@", $pages['Statique']['imagesid']);
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
                    </div>

                <?php endif; ?>
                <div class="row">
                    <div class="small-12 column">
                        <?php if (!empty($pages['Statique']['content3'])) : ?>
                            <div id="texte6">
                                <div class="p1"> <?php echo $pages['Statique']['content3']; ?>
                                </div> 
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
