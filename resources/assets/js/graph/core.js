function GraphCore() {
	this.colordict = {};
	this.colors = {
		'very_pos': 	'#1F264F',
		'medium_pos': 	'#4A527C',
		'fairly_pos': 	'#afdde9',
		'neutral': 		'#75677D',
		'fairly_neg': 	'#ffaaaa',
		'medium_neg': 	'#B96F6F',
		'very_neg': 	'#742C2C',
		'dont_know': 	'#838282',
		'refused': 		'#87744d'
	}

	this.colormap = {
			'right': 				this.colors['very_pos'],
			'wrong': 				this.colors['very_neg'],
			'very likely': 			this.colors['very_pos'],
			'not likely': 			this.colors['very_neg'],
			'very good': 			this.colors['very_pos'],
			'good': 				this.colors['medium_pos'],
			'fairly good': 			this.colors['medium_pos'],
			'neither': 				this.colors['neutral'],
			'fairly bad': 			this.colors['medium_neg'],
			'bad': 					this.colors['medium_neg'],
			'very bad': 			this.colors['very_neg'],
			"strongly agree": 		this.colors['very_pos'],
			"agree": 				this.colors['medium_pos'],
			"disagree": 			this.colors['medium_neg'],
			"strongly disagree": 	this.colors['very_neg'],
			"somewhat disagree": 	this.colors['medium_neg'],
			"don't know": 			this.colors['dont_know'],
			"don't know/can't say": this.colors['dont_know'],
			"can't say": 			this.colors['dont_know'],
			"refused": 				this.colors['refused'],
			"don't know/ refused":	this.colors['dont_know'],
			"don't know/unsure":	this.colors['dont_know'],
			"no confidence":		this.colors['very_neg'],
			"some confidence":		this.colors['neutral'],
			"a lot of confidence":	this.colors['very_pos'],
			"better off":			this.colors['very_pos'],
			"stayed the same":		this.colors['neutral'],
			"worse off":			this.colors['very_neg'],
			"highly credible":		this.colors['very_pos'],
			"credible":				this.colors['medium_pos'],
			"less credible":		this.colors['medium_neg'],
			"not credible":			this.colors['very_neg'],
			"very important":		this.colors['very_pos'],
			"important":			this.colors['medium_pos'],
			"not too important":	this.colors['medium_neg'],
			"not important at all":	this.colors['very_neg'],
			"right direction":		this.colors['medium_pos'],
			"wrong direction":		this.colors['medium_neg'],
			"very interested":		this.colors['very_pos'],
			"somewhat interested":	this.colors['medium_pos'],
			"somewhat agree":		this.colors['medium_pos'],
			"not interested":		this.colors['medium_neg'],
			"not at all interested":this.colors['very_neg'],
			"highly satisfied":		this.colors['very_pos'],
			"somewhat satisfied":	this.colors['medium_pos'],
			"somewhat dissatisfied":this.colors['medium_neg'],
			"highly dissatisfied":	this.colors['very_neg'],
			"often":				this.colors['medium_pos'],
			"rarely":				this.colors['neutral'],
			"never":				this.colors['medium_neg'],
			"strongly support":		this.colors['very_pos'],
			"somewhat support":		this.colors['medium_pos'],
			"somewhat oppose":		this.colors['medium_neg'],
			"strongly oppose":		this.colors['very_neg'],
			/////////////////////////////////////////////////////
			// unique
			'neither agree nor disagree': this.colors['neutral'],
			"yes, i received sufficient information to make a decision.":	this.colors['medium_pos'],
			"no, i did not receive sufficient information to make a decision.": this.colors['neutral'],
			"i received no information to make a decision.":  this.colors['medium_neg'],
			"no, they do not feel free": this.colors['very_neg'],
			"yes, they feel free": this.colors['very_pos'],
			"neither optimistic nor pessimistic": this.colors['neutral'],
			"optimistic": this.colors['very_pos'],
			"pessimistic": this.colors['very_neg'],
			"bnp calling blockades and hartals will force al to agree to bnps demands.": this.colors['very_pos'],
			"bnp calling blockades and hartals will not force al to agree to bnp's demands.": this.colors['very_neg'],
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
		  gp.colors = [ '#4A527C', '#6998d6', '#afdde9', '#99ba81', '#ffaaaa',
		  '#d67b7b', '#b9403f', '#e4c145', '#87744d', '#a6cee3', '#1f78b4',
		  '#b2df8a', '#33a02c', '#fb9a99', '#e31a1c', '#fdbf6f', '#ff7f00',
		  '#cab2d6', '#6a3d9a', '#ffff99', '#b15928', ];
	  }
	  gp.explanation = cfg.explanation;
	  gp.addData(cfg.values);
	  gp.draw();
	  $('#page-header strong').empty().append(gp.title);
	  $('#site-menu h4').empty().append(gp.explanation.heading);
	  $('#site-menu p').empty().append(gp.explanation.text);
};

