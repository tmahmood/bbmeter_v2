var gulp = require('gulp');
var sass = require('gulp-ruby-sass');
var merge = require('merge-stream');
var concat = require('gulp-concat');
var rename = require('gulp-rename');
var fs = require('fs');
var path = require('path');

var dev = 1;
// Where do you store your Sass files?
var sassDir = './resources/assets/sass';
var targetCSSDir = './public/assets/css';

var jsDir = './resources/assets/js';
var targetJSDir = './public/assets/js';
var staticDirSrc = './resources/assets/libs';
var staticDirDest = './public/assets/libs';
var imgDirSrc = './resources/assets/imgs';
var imgDirDest = './public/assets/imgs';


function getFolders(dir) {
    return fs.readdirSync(dir)
      .filter(function(file) {
        return fs.statSync(path.join(dir, file)).isDirectory();
      });
}

gulp.task('mergejs', function() {
	var folders = getFolders(jsDir);
	var tasks = folders.map(function(folder) {
		return gulp.src(path.join(jsDir, folder, '/*.js'))
				.pipe(concat(folder + '.js'))
				.pipe(gulp.dest(targetJSDir));
	});
	return merge(tasks);
});


gulp.task('sass', function() {
    return sass('resources/assets/sass/')
		.on('error', function (err) {
            console.error('Error!', err.message);
        })
        .pipe(gulp.dest('public/assets/css/'));
});

// Concatenate & Minify JS
gulp.task('scripts', function() {

	if (dev == 1) {
		return gulp.src(jsDir + '/*.js')
			.pipe(gulp.dest(targetJSDir));
	} else {
		return gulp.src(jsDir + '/*.js')
		 .pipe(concat('all.js'))
		 .pipe(gulp.dest(targetJSDir))
		 .pipe(rename('all.min.js'))
		 .pipe(uglify())
		 .pipe(gulp.dest(targetJSDir));
	}
});

gulp.task('static', function () {
    return gulp.src("resources/assets/libs/**/**")
        .pipe(gulp.dest('public/assets/libs'));
});

gulp.task('img', function () {
    return gulp.src("resources/assets/imgs/**/**")
        .pipe(gulp.dest('public/assets/imgs/'));
});

// Keep an eye on Sass, JS files for changes...
gulp.task('watch', function () {
    gulp.watch('resources/assets/sass/*.scss', ['sass']);
    gulp.watch('resources/assets/js/**/*.js', ['mergejs', 'scripts']);
    gulp.watch('resources/assets/libs/**/**', ['static']);
    gulp.watch('resources/assets/imgs/**/**', ['img']);
});

// What tasks does running gulp trigger?
gulp.task('default', ['sass', 'mergejs', 'scripts', 'static', 'img', 'watch']);
