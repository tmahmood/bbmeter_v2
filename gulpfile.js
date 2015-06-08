var gulp = require('gulp');
var sass = require('gulp-ruby-sass');

var dev = 1;
// Where do you store your Sass files?
var sassDir = './resources/assets/sass';
var targetCSSDir = './public/assets/css';

var jsDir = './resources/assets/js';
var staticDirSrc = './resources/assets/libs';
var staticDirDest = './public/assets/libs';
var targetJSDir = './public/assets/js';
var imgDirSrc = './resources/assets/imgs';
var imgDirDest = './public/assets/imgs';

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
		return gulp.src('resources/assets/js/*.js')
			.pipe(gulp.dest('public/assets/js/'));
	} else {
		return gulp.src('resources/assets/js/*.js')
		 .pipe(concat('all.js'))
		 .pipe(gulp.dest('public/assets/js/'))
		 .pipe(rename('all.min.js'))
		 .pipe(uglify())
		 .pipe(gulp.dest('public/assets/js/'));
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
    gulp.watch('resources/assets/js/**/*.js', ['scripts']);
    gulp.watch('resources/assets/libs/**/**', ['static']);
    gulp.watch('resources/assets/imgs/**/**', ['img']);
});

// What tasks does running gulp trigger?
gulp.task('default', ['sass', 'scripts', 'static', 'img', 'watch']);
