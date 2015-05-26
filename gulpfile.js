var gulp = require('gulp');
var sass = require('gulp-ruby-sass');

// Where do you store your Sass files?
var sassDir = './resources/assets/sass';
var targetCSSDir = './public/assets/css';

var jsDir = './resources/assets/js';
var staticDirSrc = './resources/assets/libs';
var staticDirDest = './public/assets/libs';
var targetJSDir = './public/assets/js';

gulp.task('js', function () {
    return gulp.src(jsDir + '/**/*.js')
        .pipe(gulp.dest(targetJSDir))
});

// Compile Sass, autoprefix CSS3,
// and save to target CSS directory
gulp.task('css', function () {
    return sass(sassDir + '/master.scss',{ style: 'compressed' })
        .pipe(gulp.dest(targetCSSDir));
});
//
gulp.task('static', function () {
    return gulp.src(staticDirSrc + "/**/**")
        .pipe(gulp.dest(staticDirDest + "/"));
});

// Keep an eye on Sass, JS files for changes...
gulp.task('watch', function () {
    gulp.watch(sassDir + '/*.scss', ['css']);
    gulp.watch(jsDir + '/**/*.js', ['js']);
    gulp.watch(staticDirSrc + '/**/**', ['static']);
});

// What tasks does running gulp trigger?
gulp.task('default', ['css', 'js', 'static', 'watch']);
