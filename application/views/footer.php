
  <!-- Main Footer -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2014-2020 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.1.0-rc
    </div>
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->

<script src="<?php echo base_url();?>assets/plugins/jquery/jquery.min.js"></script>

<!-- Bootstrap -->
<script src="<?php echo base_url();?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>

<!-- //  User Management // -->

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
<!-- Toastr -->
  <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
  <!-- DataTables -->
  <script type="text/javascript" src="//cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
  

<!-- AdminLTE -->
<script src="<?php echo base_url();?>assets/dist/js/adminlte.js"></script>

<!-- OPTIONAL SCRIPTS -->
<!-- <script src="<?php echo base_url();?>assets/plugins/chart.js/Chart.min.js"></script> -->
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url();?>assets/dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!-- <script src="<?php echo base_url();?>assets/dist/js/pages/dashboard3.js"></script> -->
<script type="text/javascript">

  


  
  var calendar = $('#calendar').fullCalendar(
    {
      firstDay: 1,
    locale: 'en',  
    timeZone: 'local', 
    editable: true,
    selectable: true,
    selectHelper: true,
    displayEventTime: true, // don't show the time column in list view
    buttonIcons: true, // show the prev/next text
    weekNumbers: false,
    navLinks: true, // can click day/week names to navigate views
    editable: true,
    eventLimit: true,
    header:{
          left:'prev,next today',
          center:'title',
          right:'month,agendaWeek,agendaDay'
      },
      buttonText: {
          today: "Today",  
          month: "Month",
          week: "Week",
          day : "Day",
          listMonth: 'List'
        },
  events:"<?php echo base_url(); ?>admin/load",
    
  select: function(start, end, allDay)
  {
    var title = prompt("Enter Event Title");
    // var formatDate = "Y-MM-DD HH:mm:ss";
    if(title)
    {
      var start = moment(start, 'DD.MM.YYYY').format('YYYY-MM-DD');
      var end = moment(end, 'DD.MM.YYYY').format('YYYY-MM-DD');
      $.ajax
      ({
        url: "<?php echo base_url();?>admin/insert",
        type: "post",
        data: {title:title, start:start, end:end},
        success: function()
        {
          $('#calendar').fullCalendar('refetchEvents');
          alert("Added Successfully");
        }

      })
    }
  },


  eventResize: function(event)
  {

    var start = moment(start, 'DD.MM.YYYYY').format('YYYYY-MM-DD');
    var end = moment(end, 'DD.MM.YYYY').format('YYYY-MM-DD');
    var title = event.title;
    var id = event.id;
    $.ajax({
      url: "<?php echo base_url();?>admin/update",
      type: 'post',
      data: {title:title, start:start, end:end, id:id},
      success:function()
      {
        $('#calendar').fullCalendar('refetchEvents');
        alert("Event update");
      }
    })
  },
  eventDrop:function(event)
  {
    var start = moment(start, 'DD.MM.YYYYY').format('YYYYY-MM-DD');
    var end = moment(end, 'DD.MM.YYYYY').format('YYYYY-MM-DD');
    var title = event.title;
    var id = event.id;
    $.ajax({
      url: "<?php echo base_url();?>admin/update",
      type:'post',
      data: {title:title, start:start, end:end, id:id},
      success: function()
      {
        $('#calendar').fullCalendar('refetchEvents');
        alert("Event Updated");
      }
    })
  },
  eventClick:function(event)
  {
    if (confirm("Are You sure you want to remove it?"))
    {
      var id = event.id;
      $.ajax({
        url: "<?php echo base_url();?>admin/delete",
        type: 'post',
        data: {id:id},
        success: function()
        {
          $('#calendar').fullCalendar('refetchEvents');
        alert("Event Removed");
        }
      })
    }
  }
});

</script>
</body>
</html>
