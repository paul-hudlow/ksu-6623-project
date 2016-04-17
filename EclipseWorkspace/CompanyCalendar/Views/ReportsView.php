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
	    
	     <hr/>
                
            <div class="row" id="form_row">
                <div class="u-full-width">
                    
                    <form action="index.php" method="get">
                        
                        <div class="row" id="employee_list_row">
                            <div class="three columns">
                                <b>Employee: </b>
                            </div><!--  three columns  -->
                            
                            <div class="seven columns">
                                <select name="employee">
                                    <option value="">All</option>
                                    <?php $users = $model['employeeList']; ?>
                                    <?php foreach($users as $user){ ?>
                                    <option value="<?php echo $user->id; ?>">
                                        <?php echo ($user['firstname'] . ' ' .$user['lastname']); ?>
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
                                <select name="category">
                                    <option value="">All</option>
                                    <?php foreach($model['categoryList'] as $category){ ?>
                                    <option value="<?php echo $category->id; ?>">
                                        <?php echo($category->title); ?>
                                    </option>
                                    <?php } ?>
                                </select>
                            </div><!-- .seven .columns  -->
                        </div><!-- #event_category_row -->
                        
                        <div class="row" id="event_category_row">
                            <div class="three columns">
                                <b>Month:</b>
                            </div><!-- .three .columns -->
                            
                            <div class="seven columns">
                                <select name="category">
                                    <option value="">All</option>
                                    <option value="0">January</option>
                                    <option value="1">February</option>
                                    <option value="2">March</option>
                                    <option value="3">April</option>
                                    <option value="4">May</option>
                                    <option value="5">June</option>
                                    <option value="6">July</option>
                                    <option value="7">August</option>
                                    <option value="8">September</option>
                                    <option value="9">October</option>
                                    <option value="10">November</option>
                                    <option value="11">December</option>
                                </select>
                            </div><!-- .seven .columns  -->
                        </div><!-- #event_category_row -->
                        
                        <div class="row" id="event_category_row">
                            <div class="three columns">
                                <b>Year:</b>
                            </div><!-- .three .columns -->
                            
                            <div class="seven columns">
                                <input type="number" name="year" min="2000" max="2016" step="1" value="2016">
                            </div><!-- .seven .columns  -->
                        </div><!-- #event_category_row -->
                        
                        <input type="hidden" name="page" value="reports" />
                        
                        <div class="row" id="button_row">
                            <div class="u-full-width" id="button_div">
                                <input type="submit" value="Run" />
                            </div>
                        </div><!--  #button_row  -->
                    </form>
                </div>
            </div><!--  #form_row  -->

			<hr/>

			<table>
				<?php if (isset($model['monthlyTime'])){ ?>
					<tr>
						<th>Month</th><th>Time (Hours)</th>
					</tr>
					<?php foreach ($model['monthlyTime'] as $month => $time) { ?>
					<tr>
						<td><?php echo($month) ?></td><td><?php echo($time) ?></td>
					</tr>
					<?php } ?>
					<tr class="summary">
						<td>All</td><td><?php echo($model['totalTime']) ?></td>
					</tr>
				<?php } else { ?>
					<tr>
						<th>Event</th><th>Date</th><th>Time (Hours)</th>
					</tr>
					<?php foreach ($model['events'] as $event) { ?>
					<tr>
						<td><?php echo($event->title) ?></td><td><?php echo($event->startDate.format('d')) ?></td><td><?php echo($event->workTime) ?></td>
					</tr>
					<?php } ?>
					<tr class="summary">
						<td>All</td><td></td><td><?php echo($model['totalTime']) ?></td>
					</tr>
				<?php } ?>
			</table>
            
        </div>
    </body>     
</html>
