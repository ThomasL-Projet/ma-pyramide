<?php
// titre de la page
$this->assign('title', 'Ma Pyramide Santé - Rapport Evolution : Diagrammes');
// balise meta pour le référencement
$this->start('meta');
echo $this->Html->meta('keywords', 'Un gestionnaire complet de votre santé grâce au suivi de votre activité physique et vos aliments consommés notamment.');
$this->end();
?>﻿
<?php echo $this->Html->script('jqplot.canvasOverlay.min.js'); ?>
<nav class="breadcrumbs" role="menubar" aria-label="breadcrumbs">
    <li role="menuitem"><?php echo $this->Html->link('Accueil', ['full_base' => true]); ?></li>
    <li role="menuitem"><?php echo $this->Html->link('Mon dossier patient', ['full_base' => true]) ?></li>
    <li role="menuitem"><?php echo $this->Html->link('Mes statistiques', ['controller' => 'pages', 'action' => 'supertracker', 'full_base' => true]); ?></li>
    <li role="menuitem"><?php echo $this->Html->link('Mes rapports d\'évolution', ['controller' => 'rapportEvolution', 'action' => 'index', 'full_base' => true]); ?></li>
    <li role="menuitem" class="current"><?php echo $this->Html->link('Diagrammes', 'Javascript:void(0);'); ?></li>
</nav>
<div id="presentation">
    <div class="row">
        <div class="small-12 small-centered columns">
            <div class="title-area"> Diagrammes </div> 
            <div class="textarea">
                <p class="text-justify">
                    Ces graphes résument un historique des tendances : poids, 
                    calories, groupes alimentaires et nutriments. <br>
                    Les <strong>lignes horizontales vertes</strong> représentent
                    les valeurs que vous devez normalement atteindre mais ne pas dépasser.
                </p>			
            </div>
        </div>
    </div>
    <div class="row">
        <div class="small-12 columns">

            <p>&nbsp</p>
            <div id ="graph1" style="position:absolute;">
                <div id="chart1" style="margin-left: 50px; margin-top: 50px; width: 500px; height: 300px; "></div>
                <script class="code" type="text/javascript" language="javascript">
                    $(document).ready(function () {

                        // Coordonnées x et y de chaque points de la courbe de la courbe
                        var points = <?php echo $diagCal; ?>;
                        // Permet de creer une courbe à partir d'un nombre quelconque de points 

                        var curve1 = $.jqplot("chart1", [points], {
                            // Titre de la courbe
                            title: 'Courbe des calories',
                            grid: {drawBorder: true, shadow: false},
                            // Permet de lisser la courbe
                            seriesDefaults: {
                                rendererOptions: {
                                    smooth: true
                                }
                            },
                            // Cette fonction permet de faire tourner le label de l'axe des ordonnées 
                            axesDefaults: {
                                labelRenderer: $.jqplot.CanvasAxisLabelRenderer
                            },
                            rendererOptions: {
                                barPadding: 8, // number of pixels between
                                // adjacent bars in the same
                                // group (same category or bin).
                                barMargin: 25, // number of pixels between
                                // adjacent groups of bars.
                                barDirection: 'vertical', // vertical or
                                // horizontal.
                                barWidth: 20, // width of the bars. null to
                                // calculate automatically.

                            },
                            axes: {
                                yaxis: {
                                    label: "calories (en kcal)",
                                    min: 0
                                },
                                xaxis: {
                                    renderer: $.jqplot.DateAxisRenderer,
                                    tickRenderer: $.jqplot.CanvasAxisTickRenderer,
                                    tickOptions: {
                                        angle: -30
                                    }
                                }
                            },
                            canvasOverlay: {
                                show: true,
                                objects: [
                                    {dashedHorizontalLine: {
                                            name: 'chart1',
                                            y: <?php echo $obEnKcal; ?>,
                                            lineWidth: 2,
                                            color: 'rgb(89, 198, 154)',
                                            shadow: false
                                        }}
                                ]
                            }
                        });
                    });
                </script>
            </div>
            <div id ="graph2" style="position:relative;">
                <div id="chart2" style="margin-left: 600px; margin-top: 50px; width: 500px; height: 300px; "></div>
                <script class="code" type="text/javascript" language="javascript">
                    $(document).ready(function () {

                        // Coordonnées x et y de chaque points de la courbe de la courbe
                        var points = <?php echo $diagProt; ?>;
                        // Permet de creer une courbe à partir d'un nombre quelconque de points 

                        var curve1 = $.jqplot("chart2", [points], {
                            // Titre de la courbe
                            title: 'Courbe des protéines',
                            // Permet de lisser la courbe
                            seriesDefaults: {
                                rendererOptions: {
                                    smooth: true
                                }
                            },
                            // Cette fonction permet de faire tourner le label de l'axe des ordonnées 
                            axesDefaults: {
                                labelRenderer: $.jqplot.CanvasAxisLabelRenderer
                            },
                            axes: {
                                yaxis: {
                                    label: "protéines (en g)",
                                    min: 0
                                },
                                xaxis: {
                                    renderer: $.jqplot.DateAxisRenderer,
                                    tickRenderer: $.jqplot.CanvasAxisTickRenderer,
                                    tickOptions: {
                                        angle: -30
                                    }
                                }
                            }, canvasOverlay: {
                                show: true,
                                objects: [
                                    {dashedHorizontalLine: {
                                            name: 'chart1',
                                            y: <?php echo $obPro; ?>,
                                            lineWidth: 2,
                                            color: 'rgb(89, 198, 154)',
                                            shadow: false
                                        }}
                                ]
                            }
                        });
                    });
                </script>

            </div>
            <div id ="graph3" style="position:absolute;">
                <div id="chart3" style="margin-left: 50px; margin-top: 100px; width: 500px; height: 300px; "></div>
                <script class="code" type="text/javascript" language="javascript">
                    $(document).ready(function () {

                        // Coordonnées x et y de chaque points de la courbe de la courbe
                        var points = <?php echo $diagLip; ?>;
                        // Permet de creer une courbe à partir d'un nombre quelconque de points 

                        var curve1 = $.jqplot("chart3", [points], {
                            // Titre de la courbe
                            title: 'Courbe des lipides',
                            // Permet de lisser la courbe
                            seriesDefaults: {
                                rendererOptions: {
                                    smooth: true
                                }
                            },
                            // Cette fonction permet de faire tourner le label de l'axe des ordonnées 
                            axesDefaults: {
                                labelRenderer: $.jqplot.CanvasAxisLabelRenderer
                            },
                            axes: {
                                yaxis: {
                                    label: "lipides (en g)",
                                    min: 0
                                },
                                xaxis: {
                                    renderer: $.jqplot.DateAxisRenderer,
                                    tickRenderer: $.jqplot.CanvasAxisTickRenderer,
                                    tickOptions: {
                                        angle: -30
                                    }
                                }
                            }, canvasOverlay: {
                                show: true,
                                objects: [
                                    {dashedHorizontalLine: {
                                            name: 'chart1',
                                            y: <?php echo $obLip; ?>,
                                            lineWidth: 2,
                                            color: 'rgb(89, 198, 154)',
                                            shadow: false
                                        }}
                                ]
                            }
                        });
                    });
                </script>

            </div>
            <div id ="graph4" style="position:relative;">
                <div id="chart4" style="margin-left: 600px; margin-top: 100px; width: 500px; height: 300px; "></div>
                <script class="code" type="text/javascript" language="javascript">
                    $(document).ready(function () {

                        // Coordonnées x et y de chaque points de la courbe de la courbe
                        var points = <?php echo $diagGlu; ?>;
                        // Permet de creer une courbe à partir d'un nombre quelconque de points 

                        var curve1 = $.jqplot("chart4", [points], {
                            // Titre de la courbe
                            title: 'Courbe des glucides',
                            // Permet de lisser la courbe
                            seriesDefaults: {
                                rendererOptions: {
                                    smooth: true
                                }
                            },
                            // Cette fonction permet de faire tourner le label de l'axe des ordonnées 
                            axesDefaults: {
                                labelRenderer: $.jqplot.CanvasAxisLabelRenderer
                            },
                            axes: {
                                yaxis: {
                                    label: "glucides (en g)",
                                    min: 0
                                },
                                xaxis: {
                                    renderer: $.jqplot.DateAxisRenderer,
                                    tickRenderer: $.jqplot.CanvasAxisTickRenderer,
                                    tickOptions: {
                                        angle: -30
                                    }
                                }
                            }, canvasOverlay: {
                                show: true,
                                objects: [
                                    {dashedHorizontalLine: {
                                            name: 'chart1',
                                            y: <?php echo $obGlu; ?>,
                                            lineWidth: 2,
                                            color: 'rgb(89, 198, 154)',
                                            shadow: false
                                        }}
                                ]
                            }
                        });
                    });
                </script>

            </div>
            <div id ="graph5" style="position:absolute;">
                <div id="chart5" style="margin-left: 50px; margin-top: 150px; width: 500px; height: 300px; "></div>
                <script class="code" type="text/javascript" language="javascript">
                    $(document).ready(function () {

                        // Coordonnées x et y de chaque points de la courbe de la courbe
                        var points = <?php echo $diagEau; ?>;
                        // Permet de creer une courbe à partir d'un nombre quelconque de points 

                        var curve1 = $.jqplot("chart5", [points], {
                            // Titre de la courbe
                            title: 'Courbe de l\'eau',
                            // Permet de lisser la courbe
                            seriesDefaults: {
                                rendererOptions: {
                                    smooth: true
                                }
                            },
                            // Cette fonction permet de faire tourner le label de l'axe des ordonnées 
                            axesDefaults: {
                                labelRenderer: $.jqplot.CanvasAxisLabelRenderer
                            },
                            axes: {
                                yaxis: {
                                    label: "eau (en ml)",
                                    min: 0
                                },
                                xaxis: {
                                    renderer: $.jqplot.DateAxisRenderer,
                                    tickRenderer: $.jqplot.CanvasAxisTickRenderer,
                                    tickOptions: {
                                        angle: -30
                                    }
                                }
                            }, canvasOverlay: {
                                show: true,
                                objects: [
                                    {dashedHorizontalLine: {
                                            name: 'chart1',
                                            y: <?php echo $obEau; ?>,
                                            lineWidth: 2,
                                            color: 'rgb(89, 198, 154)',
                                            shadow: false
                                        }}
                                ]
                            }
                        });
                    });
                </script>

            </div>
            <div id ="graph6" style="position:relative;">
                <div id="chart6" style="margin-left: 600px; margin-top: 150px; width: 500px; height: 300px; "></div>
                <script class="code" type="text/javascript" language="javascript">
                    $(document).ready(function () {

                        // Coordonnées x et y de chaque points de la courbe de la courbe
                        var points = <?php echo $diagFib; ?>;
                        // Permet de creer une courbe à partir d'un nombre quelconque de points 

                        var curve1 = $.jqplot("chart6", [points], {
                            // Titre de la courbe
                            title: 'Courbe des fibres',
                            // Permet de lisser la courbe
                            seriesDefaults: {
                                rendererOptions: {
                                    smooth: true
                                }
                            },
                            // Cette fonction permet de faire tourner le label de l'axe des ordonnées 
                            axesDefaults: {
                                labelRenderer: $.jqplot.CanvasAxisLabelRenderer
                            },
                            axes: {
                                yaxis: {
                                    label: "fibres (en g)",
                                    min: 0
                                },
                                xaxis: {
                                    renderer: $.jqplot.DateAxisRenderer,
                                    tickRenderer: $.jqplot.CanvasAxisTickRenderer,
                                    tickOptions: {
                                        angle: -30
                                    }
                                }
                            }, canvasOverlay: {
                                show: true,
                                objects: [
                                    {dashedHorizontalLine: {
                                            name: 'chart1',
                                            y: <?php echo $obFib; ?>,
                                            lineWidth: 2,
                                            color: 'rgb(89, 198, 154)',
                                            shadow: false
                                        }}
                                ]
                            }
                        });
                    });
                </script>

            </div>
            <div id ="graph7" style="position:relative;">
                <div id="chart7" style="margin-left: 50px; margin-top: 175px; width: 500px; height: 300px; "></div>
                <script class="code" type="text/javascript" language="javascript">
                    $(document).ready(function () {

                        // Coordonnées x et y de chaque points de la courbe de la courbe
                        var points = <?php echo $diagSel; ?>;
                        // Permet de creer une courbe à partir d'un nombre quelconque de points 

                        var curve1 = $.jqplot("chart7", [points], {
                            // Titre de la courbe
                            title: 'Courbe du sel',
                            // Permet de lisser la courbe
                            seriesDefaults: {
                                rendererOptions: {
                                    smooth: true
                                }
                            },
                            // Cette fonction permet de faire tourner le label de l'axe des ordonnées 
                            axesDefaults: {
                                labelRenderer: $.jqplot.CanvasAxisLabelRenderer
                            },
                            axes: {
                                yaxis: {
                                    label: "sel (en mg)",
                                    min: 0
                                },
                                xaxis: {
                                    renderer: $.jqplot.DateAxisRenderer,
                                    tickRenderer: $.jqplot.CanvasAxisTickRenderer,
                                    tickOptions: {
                                        angle: -30
                                    }
                                }
                            }, canvasOverlay: {
                                show: true,
                                objects: [
                                    {dashedHorizontalLine: {
                                            name: 'chart1',
                                            y: <?php echo $obSel; ?>,
                                            lineWidth: 2,
                                            color: 'rgb(89, 198, 154)',
                                            shadow: false
                                        }}
                                ]
                            }
                        });
                    });
                </script>

            </div>
        </div>
    </div> 
</div>