
function GroupedMultiBar() {
	this.container = null;
	this.title = null;
	this.subtitle = null;
	this.series = [];
	this.stacked = false;
	this.direction = "";
	this.colors = ['#7cb5ec', '#434348', '#90ed7d', '#f7a35c', '#8085e9', '#4C9A55', '#e4d354', '#2b908f', '#f45b5b', '#91e8e1'];
}

GroupedMultiBar.prototype.set = function(field, val) {
	this[field] = val;
	return this;
};

GroupedMultiBar.prototype.addData = function(d) {

	if ( typeof d.categories == 'object' ) {
		this.categories = main.objectToArray(d.categories);
	} else {
		this.categories = d.categories;
	}
	if (typeof d.data == 'object') {
		this.series = main.objectToArray(d.data);
	} else {
		this.series = d.data;
	}

};

GroupedMultiBar.prototype.draw = function(colors) {

	var me = this;
	var d = {
        chart: { type: 'column', backgroundColor: me.background },
		colors: me.colors,
        title: { text: me.info },
		credits: {
			enabled: false,
		},
        xAxis: {
            categories: me.categories,
			labels: {
				style: {
					"width": "95px",
						"font-size": '9px',
						"color": "#000"
				}
			}
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Percentage'
            },
        },
        tooltip: {
			formatter: function() {
				var l = []
				$.each(this.points, function(idx, val)  {
					l.push(
							'<tr>' +
								'<td>' + val.series.name  + '</td>' +
								'<td>' + this.y  + '</td>' +
							'</tr>');
				});
				l.push ();

				var header = this.x;
				if (this.x.length > 80) {
					var no_of_lines = this.x.length / 80;
					var lines = [];
					for (var i = 0 ; i < this.x.length; i+= 80) {
						lines.push(this.x.substring(i, i + 80));
					}
					console.log(lines);
					header = lines.join('<br>');
				}

				var html = [
 					'<table class="table table-bordered table-striped">' ,
						'<thead><tr><th colspan="2">' ,  header ,  '</th></tr><thead>',
						'<tbody>' + l.join(''), '</tbody>',
					'</table>'
				];

				return html.join("");

			},
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0,
			},
			series: {
				dataLabels: {
					enabled: true,
					format: '{point.y:.1f}%'
				}
            }
        },
        series: me.series
	};

	if (this.stacked == true) {
		if (this.direction == "V") {
			d.plotOptions.column.stacking = 'percent';
		} else {
			d.plotOptions.series = {};
			d.plotOptions.series.stacking = 'percent';
			d.chart.type = 'bar';
		}
	}

    $(me.container).highcharts(d);
};

function VStackedBar() {
	var gp = new GroupedMultiBar();
	gp.stacked = true;
	gp.direction = "V";
	return gp;
}

function HStackedBar() {
	var gp = new GroupedMultiBar();
	gp.stacked = true;
	gp.direction = "H";
	return gp;
}
