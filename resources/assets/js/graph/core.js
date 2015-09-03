function GraphCore() {
	this.colordict = {};
	this.colors = {
		'very_pos': 	'#2b48aa',
		'medium_pos': 	'#6998d6',
		'fairly_pos': 	'#afdde9',
		'neutral': 		'#99ba81',
		'fairly_neg': 	'#ffaaaa',
		'medium_neg': 	'#d67b7b',
		'very_neg': 	'#b9403f',
		'dont_know': 	'#e4c145',
		'refused': 		'#87744d'
	}

	this.colormap = {
			'right': 				this.colors['very_pos'],
			'wrong': 				this.colors['very_neg'],
			'very good': 			this.colors['very_pos'],
			'good': 				this.colors['medium_pos'],
			'fairly good': 			this.colors['fairly_pos'],
			'neither': 				this.colors['neutral'],
			'fairly bad': 			this.colors['fairly_neg'],
			'bad': 					this.colors['medium_neg'],
			'very bad': 			this.colors['very_neg'],
			"strongly agree": 		this.colors['very_pos'],
			"agree": 				this.colors['medium_pos'],
			"disagree": 			this.colors['medium_neg'],
			"strongly disagree": 	this.colors['very_neg'],
			"don't know": 			this.colors['dont_know'],
			"don't know/can't say": this.colors['dont_know'],
			"can't say": 			this.colors['dont_know'],
			"refused": 				this.colors['refused'],
			"don't know/ refused":	this.colors['dont_know'],
			"don't know/unsure":	this.colors['dont_know'],
			"no confidence":		this.colors['very_neg'],
			"some confidence":		this.colors['neutral'],
			"a lot of confidence":	this.colors['very_pos'],
		}
}

var graphcore = new GraphCore();

GraphCore.prototype.drawChart = function(cfg) {
	  $(cfg.container).append('<div id="highchart_graph"></div>');
	  var gp = new window[cfg.type]();
	  gp.set('container', '#highchart_graph');
	  gp.parent = this;
	  gp.title = cfg.key;
	  gp.background = '#E9E8E7';
	  gp.info = cfg.info;
	  if (gp.colors == undefined) {
		  gp.colors = [ '#a6cee3', '#1f78b4', '#b2df8a', '#33a02c', '#fb9a99',
						  '#e31a1c', '#fdbf6f', '#ff7f00', '#cab2d6', '#6a3d9a',
						  '#ffff99', '#b15928',];
	  }
	  gp.explanation = cfg.explanation;
	  gp.addData(cfg.values);
	  gp.draw();
	  $('#page-header strong').empty().append(gp.title);
	  $('#site-menu h4').empty().append(gp.explanation.heading);
	  $('#site-menu p').empty().append(gp.explanation.text);
};

