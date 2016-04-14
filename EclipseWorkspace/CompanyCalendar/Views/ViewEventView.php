<?php

$model = array();
$model['event_datae'] = array(
	'event_title' => 'Company Bowling Tournament',
	'event_category' => 'Company Holiday',
	'event_start_date' => '2016-02-10',
	'event_end_date' => '2016-02-12',
	'employee' => 'Durrell Lyons',
	'event_descritpion' => 'Annual Bowling Retreat To Raise Money For Josea Feed The Hungry',
	'hours_of_work' => 16
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
	<div id="view_event">
	    <div class="row" id="title-row">
                
		<div class="five columns">
                    <h5>View Event</h5>
                </div><!-- .five .columns  -->
                
                <div class="six columns" id="right_side_title">
                    <div class="one columns" id="close_window">
                        <span>x</span>
                    </div><!-- #close_window-->
                </div><!-- #right_side_title  -->
		
            </div><!-- title row -->
	    
	     <hr>
            
            <div class="row" id="form_row">
                <div class="u-full-width">
                        
                        <div class="row" id="event_type_row">                            
                            <div class="three columns">
                                <b>Event Title: </b>
                            </div> <!-- three columns -->
                            
                            <div class="seven columns">
                                <input type="text" name="event_title" value="<?php echo $model['event_datae']['event_title']; ?>" />
                            </div> <!-- seven columns -->
                        </div> <!-- #event_type_row -->
                        
                        <div class="row" id="event_description_row">
                            <div class="three columns">
                                <b>Event Description: </b>
                            </div><!--  .three .columns  -->
                            
                            <div class="seven columns">
                                <textarea class= "u-full-width" name="event_description" cols=30><?php echo trim($model['event_datae']['event_descritpion']); ?></textarea>
                            </div><!-- .seven .columns  -->
                        </div><!-- #event_description_row  -->
                        
                        <div class="row" id="employee_list_row">
                            <div class="three columns">
                                <b>Employee: </b>
                            </div><!--  three columns  -->
                            
                            <div class="seven columns">
                                <?php echo $model['event_datae']['employee']; ?>
                            </div><!-- .seven .columns  -->
                        </div><!-- #employee_list_row  -->
                        
                        <div class="row" id="event_start_date">
                            <div class="three columns">
                                <b>Event Start Date:</b>
                            </div><!-- .three .columns  -->
                            
                            <div class="seven columns">
                                <input type="date" name="start_date" value="<?php echo $model['event_datae']['event_start_date']; ?>" />
                            </div><!-- .seven .columns  -->
                        </div><!--  #event_start_date  -->
                        
                        <div class="row" id="event_end_date">
                            <div class="three columns">
                                <b>Event End Date:</b>
                            </div><!-- .three .columns  -->
                            
                            <div class="seven columns">
                                <input type="date" name="end_date" value="<?php echo $model['event_datae']['event_end_date']; ?>" />
                            </div><!-- .seven .columns  -->
                        </div><!--  #event_end_date  -->
                        
                        <div class="row" id="event_category_row">
                            <div class="three columns">
                                <b>Event Category:</b>
                            </div><!-- .three .columns -->
                            
                            <div class="seven columns">
                                <input type="text" name="event_type" value="<?php echo $model['event_datae']['event_category']; ?> " />
                            </div><!-- .seven .columns  -->
                        </div><!-- #event_category_row -->
                        
                        <div class="row" id="hours_of_time">
                            <div class="three columns">
                                <b>Hours of work time:</b>
                            </div><!-- .three .columns  -->
                            
                            <div class="seven columns">
                                <input type="number" name="hours_of_time" value="<?php echo $model['event_datae']['hours_of_work']; ?>" />
                            </div><!-- .seven .columns  -->
                        </div><!--  #hours_of_time -->
                    
                </div> <!-- u-full-width -->
            </div> <!-- form_row -->
	    
	</div>       
    </body>
</html>