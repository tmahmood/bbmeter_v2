function Main(opts) {
	this.opts = opts == null ?  opts : {};
}

Main.prototype.objectToArray = function(obj) {
	return $.map(obj, function(value, index) {
		return [value];
	});
};


var main = new Main();

$(function(){

});

