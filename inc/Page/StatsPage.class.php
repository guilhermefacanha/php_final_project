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

    public static function showGroupAvailableChart(){
        echo '
        <script>
window.onload = function() {

var dataPoints = [];

var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	theme: "light2",
	title: {
		text: "Daily Sales Data"
	},
	axisY: {
		title: "Units",
		titleFontSize: 24
	},
	data: [{
		type: "column",
		yValueFormatString: "#,### Units",
		dataPoints: dataPoints
	}]
});

function addData(data) {
	for (var i = 0; i < data.length; i++) {
		dataPoints.push({
			x: new Date(data[i].date),
			y: data[i].units
		});
	}
	chart.render();

}

$.getJSON("https://canvasjs.com/data/gallery/javascript/daily-sales-data.json", addData);

}
</script>
        ';
        echo '<div id="chartContainer" style="height: 370px; width: 100%;"></div>
        <script src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>
        <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>';
    }

}

?>