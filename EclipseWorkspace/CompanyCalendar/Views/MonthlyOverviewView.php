<?php

$model = array();
$model['event_types'] = array(
        array(
            'id' => 1,
            'types' => 'Employee Birthday',
            'color' => '#ff5733'
        ),
        
        array(
            'id' => 2,
            'types' => 'Anniversary',
            'color' => '#004d99'
        ),
        
        array(
            'id' => 3,
            'types' => 'Company Events',
            'color' => '#00ff00'
        ),
        
        array(
            'id' => 4,
            'types' => 'Company Holidays',
            'color' => '#ff0000'
        ),
        
        array(
            'id' => 5,
            'types' => 'Out Of Office',
            'color' => '#996633'
        ),
        
        array(
            'id' => 6,
            'types' => 'Vacation',
            'color' => '#666699'
        ),
        
        array(
            'id' => 7,
            'types' => 'Training',
            'color' => '#ff9900'
        ),
        
        array(
            'id' => 8,
            'types' => 'Visitor',
            'color' => '#00ffcc'
        ),
        
        array(
            'id' => 9,
            'types' => 'Sick Days',
            'color' => '#660033'
        )
        
);

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

//echo "There was $days days in " . $current_Text_Month . " 2016";

?>
<html>
    <head>
        <link rel="stylesheet" href="Resources/normalize.css" />
        <link rel="stylesheet" href="Resources/skeleton.css" />
        <link rel="stylesheet" href="Resources/style.css" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function(){
                calendar_transition();
                function calendar_transition(){
                    var current_month_value = $("#month_type_row h3").attr("id");
                    var url = "http://localhost/ClassCalendar/EclipseWorkspace/CompanyCalendar/index.php?page=monthly_overview";
                    $("#count_down").click(function(){
                        if(current_month_value > 1){
                            current_month_value--;
                        }
                        else {
                            current_month_value = 12;
                        }
                        $(location).attr('href',url+'&month='+current_month_value);
                    });
                    
                    $("#count_up").click(function(){
                        if(current_month_value < 12){
                            current_month_value++;
                        }
                        else {
                            current_month_value = 1;
                        }
                        $(location).attr('href',url+'&month='+current_month_value);
                    });
                }
                
            });
        </script>
    </head>
    
    
    <body>
	<div id="view_calendar">
            
            <div class="row" id="event_type_row">
                <div class="two columns events" > Show All </div>
                <?php foreach($model['event_types'] as $event) { ?>
                <div class="two columns events" style="background-color:<?php echo $event['color']; ?>" id="event_id_<?php echo $event['id']; ?>">
                    <?php echo $event['types']; ?>
                </div><!-- #event_id -->
                <?php } ?>
            </div><!-- #event_type_row -->
            
            <hr>
                
            <div class="row" id="month_type_row">
                <div class="u-full-width">
                    <h3 id="<?php echo $current_number_month; ?>"> <span class="month_cycle" id="count_down"> < </span>  &nbsp;  <?php echo $current_Text_Month; ?>  &nbsp;  <span class="month_cycle" id="count_up"> > </span> </h3>
                </div>
            </div>
            
            <div class="row" id="calednar_days">
                <div class="u-full_width">
                    
                    <div class="row">
                    <?php for($i=1; $i <= $days; $i++) { ?>
                        <div class="two columns days">
                            <?php echo $i; ?>
                        </div>
                        <?php if($i%7==0){ ?>
                        </div>
                        <div class="row">
                        <?php } ?>
                    <?php } ?>
                    </div>
                </div>
            </div>
            
	</div><!-- #view_calendar -->
    </body>
</html>