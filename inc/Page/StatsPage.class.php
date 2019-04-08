<?php
class StatsPage
{
    public static function showTable($records)
    {
        echo '
            <div class="card">
                <div class="card-body">
                    <form class="form-inline" style="width:100%;" action="?" method="POST">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Availabity: </label>
                            </div>
                            <div class="col">
                                <select class="form-control form-control-sm" name="available" id="available">
                                    <option value="-1">Select One</option>
                                    <option value="0">Not Available</option>
                                    <option value="1">Available</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-8">
                                <label>Library / Title / Author / Category: </label>
                                <input type="text" class="form-control" name="textSearch" id="textSearch" placeholder="text search...">
                            </div>
                        </div>

                        <button type="submit" class="btn btn-sm btn-primary" btn-lg btn-block">
                            <i class="fa fa-search"></i> Filter
                        </button>
                    </form>
                </div>
            </div>
            
        ';

        //Setup the table
        echo '<h2>Libraries</h2>';
        echo '<table id="tb_records" name="tb_records" class="display table table-striped table-hover"> <thead>';
        echo '<th>Library</th>';
        echo '<th>Title</th>';
        echo '<th>Author</th>';
        echo '<th>Category</th>';
        echo '<th>Available</th>';
        echo '<th>RentedBy</th>';
        echo '<th>RentStart</th>';
        echo '<th>RentEnd</th>';
        echo '</thead> <tbody>';

        //Iterate
        foreach ($records as $rec) {
            echo '<tr>
            <td>' . $rec->getLibrary() . '</td>
            <td>' . $rec->getTitle() . '</td>
            <td>' . $rec->getAuthor() . '</td>
            <td>' . $rec->getCategory() . '</td>
            <td>' . $rec->getAvailable() . '</td>
            <td>' . $rec->getRentedBy() . '</td>
            <td>' . $rec->getRentStart() . '</td>
            <td>' . $rec->getRentEnd() . '</td>
            </tr>';
        }

        //close the table
        echo '</tbody>';
        //Display the total count of list -->
        echo '<tfoot>
        <tr class="alert-info">
            <td colspan="8" style="font-weight:bold;">Total Count: ' . count($records) . '</td>
        </tr>
      </tfoot>';
        echo '</table> <hr style="border-top:1px solid darkgray !important">';
    }

    public static function showGroupChart($groupsLib, $title){
        ?>
        
        <h3><?php echo $title ?></h3>
        <canvas id="myChart" width="1200" height="400"></canvas>

        <script>
            var jsonfile  = {<?php echo 'jsonarray:'.$groupsLib ?>};
            var labels = jsonfile.jsonarray.map(function(e) {
                return e.label;
            });
            var data = jsonfile.jsonarray.map(function(e) {
                return e.qty;
            });;
            var ctx = document.getElementById('myChart').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: '<?php echo $title ?>',
                        data: data,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    legend: {
                        display: true,
						position: 'top',
					},
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });
        </script>
    <?php
    }        

}

?>