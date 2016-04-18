<html>
<!-- 
<?php
echo(var_export($model, true));
	$actionURL = "index.php?page=ADD_EDIT_EVENT&year=" . $model["year"] . "&month=" . $model["month"];
?>
 -->
    <head>
        <link rel="stylesheet" href="Resources/normalize.css" />
        <link rel="stylesheet" href="Resources/skeleton.css" />
        <link rel="stylesheet" href="Resources/style.css" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function(){
                $('#right_side_title #close_window').click(function(){
                    window.location.replace('index.php?page=monthly_overview<?php echo("&year=" . $model['year'] . "&month=" . $model['month'])?>');
                });
            });

            var categories = [<?php foreach($model["Categories"] as $cat) { echo("{'id':" . $cat->id . ", 'includeHour':" . $cat->includeHours . "},"); } ?>];
            
            function displayWorkTime()
            {
                var curCatId = document.getElementById("category").value;
                var display = "none";

                for(var i=0; i<categories.length; i++)
                {
                    if (curCatId == categories[i].id && categories[i].includeHour == 1)
                    {
                        display = "inline";
                    }
                }

                document.getElementById("hours_of_time").style.display = display;
            }
        </script>
    </head>
    
    
    <body>
    	<?php include("Resources/HeaderSnippet.php"); ?>
        <div id="event_form">
            <div class="row" id="title-row">
                
                
                <div class="five columns">
                    <h5>Add/Edit Event</h5>
                </div><!-- .five .columns  -->
                
                
                <div class="six columns" id="right_side_title">
                    
                    <div class="one columns" id="close_window">
                        <span>x</span>
                    </div><!-- #close_window-->
                    
                    <div class="four columns" id="delete_box" onClick="document.getElementById('action').value='delete'; document.getElementById('eventForm').submit();" >
                        <font>Delete this event</font>
                        <img src="Resources/images/delete_button.png" width="25px" />
                    </div><!-- #delte_box  -->

                </div><!-- #right_side_title  -->
                
                
            </div><!-- title row -->
            
            <hr>
            
            <div class="row" id="form_row">
                <div class="u-full-width">
                    
                    <form id="eventForm" action="<?php echo($actionURL) ?>" method="get" >
                        
                        <div class="row" id="event_type_row">                            
                            <div class="three columns">
                                <b>Event Title: </b>
                            </div> <!-- three columns -->
                            
                            <div class="seven columns">
                                <input type="text" name="title" placeholder="Event Title" value="<?php echo($model["Event"]->title) ?>"/>
                            </div> <!-- seven columns -->
                        </div> <!-- #event_type_row -->
                        
                        <div class="row" id="event_description_row">
                            <div class="three columns">
                                <b>Event Description: </b>
                            </div><!--  .three .columns  -->
                            
                            <div class="seven columns">
                                <textarea class="u-full-width" name="description" cols=30><?php echo($model["Event"]->description) ?></textarea>
                            </div><!-- .seven .columns  -->
                        </div><!-- #event_description_row  -->
                        
                        <div class="row" id="employee_list_row">
                            <div class="three columns">
                                <b>Employee: </b>
                            </div><!--  three columns  -->
                            
                            <div class="seven columns">
                                <select name="employee">
                                    <option>Employee</option>
                                    <?php $users = $model['Users']; ?>
                                    <?php foreach($users as $user){ echo("<!-- " . $user->userName . " = " . $model['Event']->employee->userName . " -->")?>
                                    <option value="<?php echo $user->userName;?>" <?php echo(($user->userName==$model['Event']->employee->userName?"SELECTED":""))?> >
                                        <?php echo $user->firstName; ?> &nbsp; <?php echo $user->lastName; ?>
                                    </option>
                                    <?php } ?>
                                </select>
                            </div><!-- .seven .columns  -->
                        </div><!-- #employee_list_row  -->
                        
                        <div class="row" id="event_start_date">
                            <div class="three columns">
                                <b>Event Start Date:</b>
                            </div><!-- .three .columns  -->
                            
                            <div class="seven columns">
                                <input type="date" name="start_date" value="<?php echo($model["Event"]->startDate->format("Y-m-d")) ?>"/>
                            </div><!-- .seven .columns  -->
                        </div><!--  #event_start_date  -->
                        
                        <div class="row" id="event_end_date">
                            <div class="three columns">
                                <b>Event End Date:</b>
                            </div><!-- .three .columns  -->
                            
                            <div class="seven columns">
                                <input type="date" name="end_date" value="<?php echo($model["Event"]->endDate->format("Y-m-d")) ?>" />
                            </div><!-- .seven .columns  -->
                        </div><!--  #event_end_date  -->
                        
                        <div class="row" id="event_category_row">
                            <div class="three columns">
                                <b>Event Category:</b>
                            </div><!-- .three .columns -->
                            
                            <div class="seven columns">
                                <select id="category" name="category" onchange="displayWorkTime();" >
                                    <option>Event</option>
                                    <?php $categories = $model['Categories']; ?>
                                    <?php foreach($categories as $category){ echo("<!-- " . $category->id . " = " . $model['Event']->category->id . " -->") ?>
                                    <option value="<?php echo $category->id; ?>" <?php echo(($category->id==$model['Event']->category->id?"SELECTED":"")) ?> >
                                        <?php echo $category->title; ?>
                                    </option>
                                    <?php } ?>
                                </select>
                            </div><!-- .seven .columns  -->
                        </div><!-- #event_category_row -->
                        
                        <div class="row" id="hours_of_time" style="display:<?php echo(($model['Event']->category->includeHours == 1?'inline':'none')) ?>">
                            <div class="three columns">
                                <b>Hours of work time:</b>
                            </div><!-- .three .columns  -->
                            
                            <div class="seven columns">
                                <input type="number" name="hours_of_time" value="<?php echo($model["Event"]->workTime->h) ?>" />
                            </div><!-- .seven .columns  -->
                        </div><!--  #hours_of_time -->
                        
                        <input type="hidden" name="eventid" value="<?php echo($model['Event']->eventId) ?>" />
                        <input type="hidden" id="action" name="action" />
                        <input type="hidden" name="page" value="ADD_EDIT_EVENT" />
                        <input type="hidden" name="year" value="<?php echo($model['year'])?>" />
                        <input type="hidden" name="month" value="<?php echo($model['month'])?>"/>
                        
                        <div class="row" id="button_row">
                            <div class="u-full-width" id="button_div">
                                <input type="submit" value="Save" onClick="document.getElementById('action').value='Save';" />
                                <!-- <input type="reset" value="Cancel" onClick="document.getElementById('action').value='Cancel';" /> -->
                            </div>
                        </div><!--  #button_row  -->
                        
                    </form>
                    
                </div> <!-- u-full-width -->
            </div> <!-- form_row -->
            
            
        </div> <!-- event_form -->
    </body>
</html>