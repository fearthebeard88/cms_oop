  </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    <script src = "js/dropzone.js"></script>
    <script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=hfohzifm985q5220u6yp39zacykfmyfbnyvz5u8nz07qc6d0"></script>
    <script src = "js/scripts.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['Views', <?php echo $session->count; ?>],
          ['Photos', <?php echo Photo::count_all(); ?>],
          ['Users', <?php echo User::count_all(); ?>],
          ['Comments', <?php echo Comment::count_all(); ?>]
        ]);

        var options = {
          title: 'Views, Photos, Users, and Comments',
          is3D: 'true',
          backgroundColor: 'transparent',
          slices: {
            0: {offset: 1},
            1: {offset: 0.1},
            2: {offset: 0.1},
            3: {offset: 0.1}
          },
          colors: [
            'steelblue', 'limegreen', 'goldenrod', 'crimson'
          ]
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>
</body>

</html>
