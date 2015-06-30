var gulp = require('gulp');
var minifycss = require('gulp-minify-css');
var uglify = require('gulp-uglify');
var concat = require('gulp-concat');
var strip = require('gulp-strip-comments');

gulp.task('css', function(){
    return gulp.src(['public/css/*.css', 'public/css/**/*.css'])
        .pipe(minifycss())
        .pipe(concat('all.min.css'))
        .pipe(gulp.dest('public/build/css'));
});

gulp.task('js', function() {
    return gulp.src('public/js/**/*.js')
        .pipe(concat('all.min.js'))
        .pipe(uglify())
        .pipe(gulp.dest('public/build/js'));
});

gulp.task('config-js', function() {
    return gulp.src(['public/js/pages/configuration/**/*.js'])
        .pipe(concat('config.js'))
        .pipe(uglify())
        .pipe(gulp.dest('public/build/js'));
});

gulp.task('dashboard-js', function() {
    return gulp.src(['public/js/pages/dashboard/**/*.js'])
        .pipe(concat('dashboard.js'))
        .pipe(uglify())
        .pipe(gulp.dest('public/build/js'));
});

gulp.task('default', function(){
    gulp.run('css');

    gulp.watch('css/*.css', function(){
        gulp.run('css');
    });
});