function Main(opts) {
	this.opts = opts == null ?  opts : {};
}

Main.prototype.objectToArray = function(obj) {
	return $.map(obj, function(value, index) {
		return [value];
	});
};

Main.prototype.spliceSlice = function(str, index, count, add) {
  return str.slice(0, index) + (add || "") + str.slice(index + count);
}

var main = new Main();

$(function(){

});

