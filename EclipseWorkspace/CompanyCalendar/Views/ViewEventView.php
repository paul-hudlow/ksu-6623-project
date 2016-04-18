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
    <?php include("Resources/HeaderSnippet.php"); ?>
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
                                <input type="text" name="event_title" value="<?php echo $model['event_title']; ?>" />
                            </div> <!-- seven columns -->
                        </div> <!-- #event_type_row -->
                        
                        <div class="row" id="event_description_row">
                            <div class="three columns">
                                <b>Event Description: </b>
                            </div><!--  .three .columns  -->
                            
                            <div class="seven columns">
                                <textarea class= "u-full-width" name="event_description" cols=30><?php echo trim($model['event_description']); ?></textarea>
                            </div><!-- .seven .columns  -->
                        </div><!-- #event_description_row  -->
                        
                        <div class="row" id="employee_list_row">
                            <div class="three columns">
                                <b>Employee: </b>
                            </div><!--  three columns  -->
                            
                            <div class="seven columns">
                                <span><?php echo $model['employee']; ?></span>
                            </div><!-- .seven .columns  -->
                        </div><!-- #employee_list_row  -->
                        
                        <div class="row" id="event_start_date">
                            <div class="three columns">
                                <b>Event Start Date:</b>
                            </div><!-- .three .columns  -->
                            
                            <div class="seven columns">
                                <span><?php echo $model['event_start_date']; ?></span>
                            </div><!-- .seven .columns  -->
                        </div><!--  #event_start_date  -->
                        
                        <div class="row" id="event_end_date">
                            <div class="three columns">
                                <b>Event End Date:</b>
                            </div><!-- .three .columns  -->
                            
                            <div class="seven columns">
                                <span><?php echo $model['event_end_date']; ?></span>
                            </div><!-- .seven .columns  -->
                        </div><!--  #event_end_date  -->
                        
                        <div class="row" id="event_category_row">
                            <div class="three columns">
                                <b>Event Category:</b>
                            </div><!-- .three .columns -->
                            
                            <div class="seven columns">
                                <span><?php echo $model['event_category']; ?></span>
                            </div><!-- .seven .columns  -->
                        </div><!-- #event_category_row -->
                        
                        <div class="row" id="hours_of_time">
                            <div class="three columns">
                                <b>Work Time:</b>
                            </div><!-- .three .columns  -->
                            
                            <div class="seven columns">
                                <span><?php echo $model['work_time']; ?></span>
                            </div><!-- .seven .columns  -->
                        </div><!--  #hours_of_time -->
                    
                </div> <!-- u-full-width -->
            </div> <!-- form_row -->
	    
	</div>       
    </body>
</html>