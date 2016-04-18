<?php

$number_of_events = sizeof($model['event_list']);

if(!@$_GET['month']){
    $current_number_month = date('m');
    $current_Text_Month = date('F');
}
else {
    $current_number_month = date("m", mktime(0, 0, 0, $_GET['month']));
    $current_Text_Month = date("F", mktime(0, 0, 0, $_GET['month']));
}
$current_number_year = date('Y');
$days = cal_days_in_month(CAL_GREGORIAN, $current_number_month, (int)$current_number_year );
$today = date('d');
$current_month = date('m');

$addeditmonthyearURLpart = "month=" . $current_number_month . "&year=" . $current_number_year;

?>
<html>
    <head>
        <link rel="stylesheet" href="Resources/normalize.css" />
        <link rel="stylesheet" href="Resources/skeleton.css" />
        <link rel="stylesheet" href="Resources/style.css" />
        <link rel="stylesheet" href="Resources/monthly_overview.css" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    </head>
    
    
    <body>
    <?php include("Resources/HeaderSnippet.php"); ?>
	<div id="view_calendar">
            
            <div class="row" id="event_type_row">
                <?php foreach($model['event_types'] as $event) { ?>
                <div class="two columns events" style="background-color:<?php echo $event['color']; ?>" id="event_id_<?php echo $event['id']; ?>">
                    <?php echo $event['types']; ?>
                </div><!-- #event_id -->
                <?php } ?>
            </div><!-- #event_type_row -->
            
            <hr>
                
            <div class="row" id="month_type_row">
                <div class="u-full-width">
                    <h3 id="<?php echo $current_number_month; ?>">
                    	<a class="normal" href="<?php echo('?page=monthly_overview&year=' . $model['previousYear'] . '&month=' . $model['previousMonth']); ?>"><span class="month_cycle" id="count_down"> &lt; </span></a>
                    	<?php echo($current_Text_Month . ' ' . $model['currentYear']); ?>
                    	<a class="normal" href="<?php echo('?page=monthly_overview&year=' . $model['nextYear'] . '&month=' . $model['nextMonth']); ?>"><span class="month_cycle" id="count_up"> &gt; </span></a>
                	</h3>
                </div>
            </div>
            
            <div class="row" id="calednar_days">
                <div class="u-full_width">
                    <table>
                    	<tr>
                    		<th>Sunday</th>
                    		<th>Monday</th>
                    		<th>Tuesday</th>
                    		<th>Wednesday</th>
                    		<th>Thursday</th>
                    		<th>Friday</th>
                    		<th>Saturday</th>
                    	</tr>
                    	<?php for ($week = 0; $week < 6; $week++) { ?>
                    	<tr>
                    		<?php for ($day = 0; $day < 7; $day++) { ?>
                    		<td>
                    		<?php if ($model['days'][$week][$day]->dayOfMonth != '') { ?>
                    			<a class="normal" href="<?php if ($_SESSION['HR']) { echo("index.php?page=ADD_EDIT_EVENT&" . $addeditmonthyearURLpart . "&day=" . $model['days'][$week][$day]->dayOfMonth); } ?>" >
                    		    <div class="dayLabel">
								<?php echo($model['days'][$week][$day]->dayOfMonth); ?>
                    			</div>
                    		    </a>
                    		<?php } ?>
                    			<ul class="taskList">
                    				<?php foreach ($model['days'][$week][$day]->eventList as $event) { ?>
                    					<a class="normal" href="<?php echo("index.php?page=ADD_EDIT_EVENT&" . $addeditmonthyearURLpart . "&event_id=" . $event->eventId); ?>" >
                    				    	<li style="background-color: <?php echo($event->category->color); ?>"><?php echo($event->title); ?></li>
                    					</a>
                    				<?php } ?>
                    			</ul>
                    		</td>
                    		<?php } ?>
                    	</tr>
                    	<?php } ?>
                    </table>
                </div>
            </div>
            
	</div><!-- #view_calendar -->
    </body>
</html>