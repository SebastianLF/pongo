var gulp = require('gulp');
var minifycss = require('gulp-minify-css');
var uglify = require('gulp-uglify');
var concat = require('gulp-concat');
var strip = require('gulp-strip-comments');
var minifyHTML = require('gulp-minify-html');

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
    return gulp.src(['public/js/pages/dashboard/*.js', 'public/js/pages/dashboard/paris/*.js'])
        .pipe(concat('dashboard.js'))
        .pipe(uglify())
        .pipe(gulp.dest('public/build/js'));
});

gulp.task('tipsters-js', function() {
    return gulp.src(['public/js/pages/tipsters/*.js'])
        .pipe(concat('tipsters.js'))
        .pipe(uglify())
        .pipe(gulp.dest('public/build/js'));
});

gulp.task('welcome-js', function() {
    return gulp.src(['public/js/pages/welcome/*.js'])
        .pipe(concat('welcome.js'))
        .pipe(uglify())
        .pipe(gulp.dest('public/build/js'));
});

gulp.task('minify-html', function() {
    var opts = {
        conditionals: true,
        spare:true
    };

    return gulp.src('app/views/pages/login.blade.php')
        .pipe(minifyHTML(opts))
        .pipe(gulp.dest('app/dist'));
});

gulp.task('default', ["dashboard-js"], function(){
    gulp.watch(['public/js/pages/dashboard/paris', 'public/js/pages/dashboard/'], function(){
        gulp.run('dashboard-js');
    });
});