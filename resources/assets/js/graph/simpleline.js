// SimpleLine class starts here

function SimpleLine(){
	this.container = null;
	this.title = null;
	this.subtitle = null;
	this.series = [];
	this.xtext = 'Date';
	this.ytext = 'Percentage';
}

SimpleLine.prototype.set = function(field, val) {
	this[field] = val;
	return this;
};

SimpleLine.prototype.addData = function(values) {
	for (var i in values) {
		var val = values[i]
		this.series.push({ name: val.key, data:  val.values });
		if (val.key.toLowerCase() in this.parent.colormap) {
			this.colors[i] = this.parent.colormap[val.key.toLowerCase()];
		}
	}
};

SimpleLine.prototype.draw = function() {
	var me = this;
	var d = {
		title: { text: me.info },
		subtitle: { text: me.subtitle },
		chart: { backgroundColor: me.background, },
		colors: me.colors,
		credits: {
			enabled: false,
		},
		exporting: {
			type: 'svg'
		},
		xAxis: {
			type: 'datetime',
			title: { text: me.xtext },
			gridLineWidth: 1,
			tickInterval: 30 * 24 * 3600 * 1000,
			dateTimeLabelFormats: {
                month: '%b, %Y',
                year: '%Y'
            }
		},
		yAxis: {
			title: { text: me.ytext },
			min: 0,
            gridLineWidth: 1,
		},
        tooltip: {
            headerFormat: '<b>{series.name}</b><br>',
            pointFormat: '{point.x:%e. %b, %Y}: {point.y:.2f}%'
        },
		series: me.series
	}
	$(me.container).highcharts(d);
};

