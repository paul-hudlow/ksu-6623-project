<?php

$employee = $_POST['employee'];
$event = $_POST['event_type'];
$years = $_POST['years'];

$model = array();
$model['Summary'] = array(
    array(
        'month' => 1,
	'hours' =>0
    ),
    array(
        'month' => 2,
	'hours' =>4
    ),
    array(
        'month' => 3,
	'hours' =>0
    ),
    array(
        'month' => 4,
	'hours' =>0
    ),
    array(
        'month' => 5,
	'hours' =>8
    ),
    array(
        'month' => 6,
	'hours' =>16
    ),
    array(
        'month' => 7,
	'hours' =>16
    ),
    array(
        'month' => 8,
	'hours' =>0
    ),
    array(
        'month' => 9,
	'hours' =>0
    ),
    array(
        'month' => 10,
	'hours' =>0
    ),
    array(
        'month' => 11,
	'hours' =>0
    ),
    array(
        'month' => 12,
	'hours' =>24
    ),
);

$totalHours = 0;
foreach($model['Summary'] as $summary){
    $totalHours += $summary['hours'];
}


$model['Users'] = array(
    array(
        'id' => 5,
        'firstname' => 'Durrell',
        'lastname' => 'Lyons'
    ),
    array(
        'id' => 10,
        'firstname' => 'Paul',
        'lastname' => 'Hudlow'
    ),
    array(
        'id' => 15,
        'firstname' => 'Ilyas',
        'lastname' => 'Kure'
    ),
    array(
        'id' => 20,
        'firstname' => 'Josh',
        'lastname' => 'Nunez'
    )
);

$model['event_types'] = array(
    array(
        'id' => 1,
        'types' => 'Employee Birthday'
    ),
        array(
        'id' => 2,
        'types' => 'Sick Days'
    ),
            array(
        'id' => 3,
        'types' => 'Vacation'
    ),
                array(
        'id' => 4,
        'types' => 'Company Holiday'
    ),
                    array(
        'id' => 5,
        'types' => 'Company Event'
    ),
);

?>

<html>
    <head>
        <link rel="stylesheet" href="Resources/normalize.css" />
        <link rel="stylesheet" href="Resources/skeleton.css" />
        <link rel="stylesheet" href="Resources/style.css" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
	<script type="text/javascript">
            $(document).ready(function(){
                $('#right_side_title #close_window').click(function(){
                    window.location.replace('index.php?page=monthly_overview');
                });
            });
        </script>
    </head>
    
    
    <body>
	<div id="reports">
	    <div class="row" id="title-row">
                
		<div class="five columns">
                    <h5>Run Reports</h5>
                </div><!-- .five .columns  -->
                
                <div class="six columns" id="right_side_title">
                    <div class="one columns" id="close_window">
                        <span>x</span>
                    </div><!-- #close_window-->
                </div><!-- #right_side_title  -->
		
            </div><!-- title row -->
	    
	     <hr>
                
            <div class="row" id="summary_row">
                <div class="u-full-width">
                    
                    <div class="four columns" id='inputs_row'>
			<div class="row" id="employee_list_row">
                            <div class="u-full-width">
                                <b>Employee: </b>

				<?php
				    foreach($model['Users'] as $user) {
					if($user['id'] == $employee){
					    echo $user['firstname'] . ' ' .  $user['lastname'];
					}
				    }
				?>
                            </div><!-- .u-full-width  -->
                        </div><!-- #employee_list_row  -->
                        
                        <div class="row" id="event_category_row">
                            <div class="u-full-width">
                                <b>Event Category:</b>

				<?php
				    foreach($model['event_types'] as $events) {
					if($events['id'] == $event){
					    echo $events['types'];
					}
				    }
				?>
                            </div><!-- .u-full-width  -->
                        </div><!-- #event_category_row -->
                        
                        <div class="row" id="event_category_row">
                            <div class="u-full-width">
                                <b>Year:</b>
                           
                                <?php echo $years; ?>
                            </div><!-- .u-full-width  -->
                        </div><!-- #event_category_row -->
			
			 <div class="row" id="event_category_row">
                            <div class="u-full-width">
                                <b>Total Hours:</b>
                                <?php echo $totalHours; ?>
                            </div><!-- .u-full-width  -->
                        </div><!-- #event_category_row -->
                        
		    </div><!-- #Inputs_Row -->
		    
		    <div class="eight columns" id="monthly_details">
			<div class="row">
			<?php for( $i=0; $i < sizeof($model['Summary']); $i++){ ?>
			    <div class="four columns details">
				<div class="row" id="month_title_row">
				    <div class="month_title">
					<?php
					    $month = $model['Summary'][$i]['month'];
					    $current_number_month = date("m", mktime(0, 0, 0, $month));
					    $current_Text_Month = date("F", mktime(0, 0, 0, $month));
					    echo $current_Text_Month;
					?>
				    </div><!--  .month_title  -->
				</div><!--  #month_title_row -->
				    
				<div class="row" id="hours_value_row">
				    <div class="hours_value">
					<?php echo $model['Summary'][$i]['hours']; ?>
				    </div>
				</div><!--  #hours_value_row -->
			    </div>
			<?php } ?>
		    </div>
		    		
                </div>
            </div><!--  #summary_row  -->
            
        </div>
    </body>     
</html>