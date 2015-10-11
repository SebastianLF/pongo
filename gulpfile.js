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

gulp.task('main-plugins', function() {
    return gulp.src(['public/v4.1.0/theme/assets/global/plugins/jquery-migrate.min.js',
        'public/v4.1.0/theme/assets/global/plugins/jquery-ui/jquery-ui.min.js',
        'public/v4.1.0/theme/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js',
        'public/v4.1.0/theme/assets/global/plugins/jquery.blockui.min.js',
        'public/v4.1.0/theme/assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js',
        'public/v4.1.0/theme/assets/global/plugins/jquery.cokie.min.js',
        'public/v4.1.0/theme/assets/global/plugins/uniform/jquery.uniform.min.js',
        'public/v4.1.0/theme/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js',
        'public/v4.1.0/theme/assets/global/plugins/smooth-scroll/smooth-scroll.js',
        'public/v4.1.0/theme/assets/global/plugins/bootstrap-sessiontimeout/jquery.sessionTimeout.js',
        'public/v4.1.0/theme/assets/global/plugins/bootstrap-select/bootstrap-select.min.js',
        'public/v4.1.0/theme/assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js',
        'public/dist/bootstrap-session-timeout.min.js',
        'public/js/plugin/select2-master/dist/js/select2.min.js',
        'public/js/plugin/select2-master/dist/js/i18n/fr.js',
        'public/js/plugin/toastr.js',
        'public/js/plugin/bootstrap-daterangepicker-master/moment.min.js',
        'public/js/plugin/bootstrap-daterangepicker-master/moment-timezone.js',
        'public/js/plugin/sweetalert.min.js',
        'public/js/plugin/jquery.animateNumber.min.js',
        'public/js/plugin/bootstrap-daterangepicker-master/daterangepicker.js',
        'public/dist/spin.min.js',
        'public/dist/ladda.min.js',
        'public/v4.1.0/theme/assets/global/scripts/metronic.js',
        'public/v4.1.0/theme/assets/admin/layout/scripts/layout.js',
        'public/v4.1.0/theme/assets/admin/pages/scripts/form-samples.js',
        'public/v4.1.0/theme/assets/admin/pages/scripts/components-dropdowns.js',
        'public/js/pages/getPaginationSelectedPage.js',
        'public/js/pages/getBookmakersForSelection.js'
    ])
        .pipe(concat('main-plugins.js'))
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

gulp.task('bookmakers-js', function() {
    return gulp.src(['public/js/pages/bookmakers/*.js'])
        .pipe(concat('bookmakers.js'))
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