var gulp = require('gulp');

var less = require('gulp-less');
var minifyCSS = require('gulp-minify-css');
var rename = require('gulp-rename');
var watch = require('gulp-watch');
var autoprefixer = require('gulp-autoprefixer');
var browserSync = require('browser-sync').create();

// Compile Our Less
gulp.task('less', function () {
    return gulp.src('assets/css/main.min.less')
        .pipe(
            autoprefixer(
                {
                    browsers: ['last 6 versions'],
                    cascade: false
                }
            )
        )
        .pipe(less())
        .pipe(minifyCSS())
        .pipe(rename('main.min.css'))
        .pipe(gulp.dest('./assets/css'));
});

gulp.task('watch', function() {
    gulp.watch('assets/css/*.less', ['less']);
});

gulp.task('default', ['watch']);
