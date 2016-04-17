<?php


$model = array();
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
                
            <div class="row" id="form_row">
                <div class="u-full-width">
                    
                    <form action="index.php?page=REPORT_SUMMARY" method="post">
                        
                        <div class="row" id="employee_list_row">
                            <div class="three columns">
                                <b>Employee: </b>
                            </div><!--  three columns  -->
                            
                            <div class="seven columns">
                                <select name="employee">
                                    <option>Employee</option>
                                    <?php $users = $model['Users']; ?>
                                    <?php foreach($users as $user){ ?>
                                    <option value="<?php echo $user['id']; ?>">
                                        <?php echo $user['firstname']; ?> &nbsp; <?php echo $user['lastname']; ?>
                                    </option>
                                    <?php } ?>
                                </select>
                            </div><!-- .seven .columns  -->
                        </div><!-- #employee_list_row  -->
                        
                        <div class="row" id="event_category_row">
                            <div class="three columns">
                                <b>Event Category:</b>
                            </div><!-- .three .columns -->
                            
                            <div class="seven columns">
                                <select name="event_type">
                                    <option>Event</option>
                                    <?php $event_types = $model['event_types']; ?>
                                    <?php foreach($event_types as $type){ ?>
                                    <option value="<?php echo $type['id']; ?>">
                                        <?php echo $type['types']; ?>
                                    </option>
                                    <?php } ?>
                                </select>
                            </div><!-- .seven .columns  -->
                        </div><!-- #event_category_row -->
                        
                        <div class="row" id="event_category_row">
                            <div class="three columns">
                                <b>Year:</b>
                            </div><!-- .three .columns -->
                            
                            <div class="seven columns">
                                <input type="number" name="years" min="2000" max="2016" step="1" value="2000">
                            </div><!-- .seven .columns  -->
                        </div><!-- #event_category_row -->
                        
                        <div class="row" id="button_row">
                            <div class="u-full-width" id="button_div">
                                <input type="submit" value="Save" />
                                <input type="reset" value="Cancel" />
                            </div>
                        </div><!--  #button_row  -->
                    </form>
                </div>
            </div><!--  #form_row  -->
            
        </div>
    </body>     
</html>
