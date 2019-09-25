<?php 
include('header.php');

?>
<title>רוגע על המים</title>
<link rel="stylesheet" href="css/calendar.css">

<style>
    background-image: url('/waters/background.jpeg');
</style>

<body>
<?php include('container.php');?>
<div class="container">	
	<h2>לוח זמנים</h2>	
	<div class="page-header">
		<div class="pull-right form-inline">
			<div class="btn-group">
				<button class="btn btn-primary" data-calendar-nav="prev">קודם</button>
				<button class="btn btn-default" data-calendar-nav="today">היום</button>
				<button class="btn btn-primary" data-calendar-nav="next">הבא</button>
			</div>
			<div class="btn-group">
				<button class="btn btn-warning" data-calendar-view="year">שנה</button>
				<button class="btn btn-warning active" data-calendar-view="month">חודש</button>
				<button class="btn btn-warning" data-calendar-view="week">שבוע</button>
				<button class="btn btn-warning" data-calendar-view="day">יום</button>
				<a class="btn btn-warning" data-calendar-view="activity" href = "/waters/activity.php">הוספת פעילות</a>
			</div>
		</div>
		<h3></h3>
		<small>כל הפעילויות החודש</small>
	</div>
	<div class="row">
		<div class="col-md-9">
			<div id="showEventCalendar"></div>
		</div>
		<div class="col-md-3">
			<li>לימאי</li>
			<li>אלה</li>
		</div>
	</div>	
	
</div>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.8.3/underscore-min.js"></script>
<script type="text/javascript" src="js/calendar.js"></script>
<script type="text/javascript" src="js/events.js"></script>

<?php include('footer.php');?>
</body>
