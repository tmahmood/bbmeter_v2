
function DiscretBar() {
	this.container = null;
	this.title = null;
	this.subtitle = null;
	this.changecolor = false;
	this.series = [];
}

DiscretBar.prototype.set = function(field, val) {
	this[field] = val;
	return this;
};

DiscretBar.prototype.addData = function(values) {
	var k = 0;
	var colors = this.colors.slice();
	for (var i in values) {
		var val = values[i]
		this.series.push({ name: val.label, y: val.value * 1 });
		var lbl = val.label.toLowerCase();
		if (lbl in this.parent.colormap && typeof(this.parent.colormap[lbl]) != 'function' ) {
			colors[i] = this.parent.colormap[lbl];
			k++;
		}
	}
	if (k >= 4) {
		this.colors = colors;
		this.changecolor = true;
	}
};

DiscretBar.prototype.draw = function() {
	var me = this;

    $(me.container).highcharts({
        chart: { type: 'column', backgroundColor: me.background },
		colors: me.colors,
        title: { text: me.info },
        xAxis: { type: 'category' },
        yAxis: { min: 0, title: { text: 'Percent' } },
		legend: { enabled: false },
		credits: { enabled: false, },
	    tooltip: {
			headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
			pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b><br/>'
		},
		plotOptions: {
			series: {
				borderWidth: 0,
				dataLabels: {
					enabled: true,
					format: '{point.y:.1f}%'
				}
			}
		},
        series: [{
			name: me.title,
            colorByPoint: me.changecolor,
			data: me.series
		}]
    });
};

