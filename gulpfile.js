var gulp = require('gulp');
var minifycss = require('gulp-minify-css');
var uglify = require('gulp-uglify');
var concat = require('gulp-concat');
var strip = require('gulp-strip-comments');
var minifyHTML = require('gulp-minify-html');
var livereload = require('gulp-livereload');
livereload({ start: true });


gulp.task('main-css', function(){
    return gulp.src([
        'public/v4.1.0/theme/assets/global/plugins/font-awesome/css/font-awesome.css',
        'public/v4.1.0/theme/assets/global/plugins/uniform/css/uniform.default.css',
        'public/v4.1.0/theme/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.css',
        'public/v4.1.0/theme/assets/global/plugins/simple-line-icons/simple-line-icons.css',
        'public/v4.1.0/theme/assets/global/plugins/Ladda-master/dist/ladda-themeless.min.css',
        'public/v4.1.0/theme/assets/global/plugins/toastr-master/build/toastr.css',
        'public/v4.1.0/theme/assets/global/plugins/sweetalert-master/dist/sweetalert.css',
        'public/metronic_v4.5.0/theme/assets/global/plugins/select2/css/select2.min.css',
        'public/v4.1.0/theme/assets/global/plugins/select2/css/select2-bootstrap.min.css',
        'public/v4.1.0/theme/assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.css',
        'public/v4.1.0/theme/assets/global/plugins/bootstrap-daterangepicker-master/daterangepicker-bs3.css',
        'public/v4.1.0/theme/assets/admin/pages/css/pricing-table.css',
        'public/v4.1.0/theme/assets/admin/pages/css/login.css',
        'public/v4.1.0/theme/assets/admin/pages/css/tasks.css',
        'public/v4.1.0/theme/assets/global/css/plugins.css',
        'public/metronic_v4.5.0/theme/assets/layouts/layout/css/layout.min.css',
        'public/v4.1.0/theme/assets/admin/layout/css/custom.css',
        'public/v4.1.0/theme/assets/global/css/components.css',
        'public/metronic_v4.5.0/theme/assets/global/plugins/datatables/datatables.min.css'
    ])
        .pipe(minifycss())
        .pipe(concat('main-css.min.css'))
        .pipe(gulp.dest('public/build/css'));
});

gulp.task('js', function() {
    return gulp.src('public/js/**/*.js')
        .pipe(concat('all.min.js'))
        .pipe(uglify())
        .pipe(gulp.dest('public/build/js'));
});

gulp.task('main-plugins', function() {
    return gulp.src([
        'public/v4.1.0/theme/assets/global/plugins/jquery-migrate.min.js',
        'public/v4.1.0/theme/assets/global/plugins/jquery-ui/jquery-ui.min.js',
        'public/metronic_v4.5.0/theme/assets/global/plugins/bootstrap/js/bootstrap.min.js',
        'public/metronic_v4.5.0/theme/assets/global/plugins/datatables/datatables.all.min.js',
        'public/v4.1.0/theme/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js',
        'public/v4.1.0/theme/assets/global/plugins/jquery.blockui.min.js',
        'public/v4.1.0/theme/assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js',
        'public/v4.1.0/theme/assets/global/plugins/jquery.cokie.min.js',
        'public/v4.1.0/theme/assets/global/plugins/uniform/jquery.uniform.min.js',
        'public/v4.1.0/theme/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.js',
        'public/v4.1.0/theme/assets/global/plugins/smooth-scroll/smooth-scroll.js',
        'public/v4.1.0/theme/assets/global/plugins/bootstrap-sessiontimeout/jquery.sessionTimeout.js',
        'public/v4.1.0/theme/assets/global/plugins/bootstrap-select/bootstrap-select.js',
        'public/v4.1.0/theme/assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js',
        'public/v4.1.0/theme/assets/global/plugins/bootstrap-session-timeout-master/dist/bootstrap-session-timeout.js',
        'public/v4.1.0/theme/assets/global/plugins/select2/js/select2.js',
        'public/v4.1.0/theme/assets/global/plugins/select2/js/i18n/fr.js',
        'public/v4.1.0/theme/assets/global/plugins/toastr-master/build/toastr.min.js',
        'public/v4.1.0/theme/assets/global/plugins/bootstrap-daterangepicker-master/moment.min.js',
        'public/v4.1.0/theme/assets/global/plugins/bootstrap-daterangepicker-master/moment-timezone.js',
        'public/v4.1.0/theme/assets/global/plugins/bootstrap-daterangepicker-master/daterangepicker.js',
        'public/v4.1.0/theme/assets/global/plugins/sweetalert-master/dist/sweetalert.min.js',
        'public/v4.1.0/theme/assets/global/plugins/jquery-animateNumber-master/jquery.animateNumber.min.js',
        'public/v4.1.0/theme/assets/global/plugins/Ladda-master/dist/spin.min.js',
        'public/v4.1.0/theme/assets/global/plugins/Ladda-master/dist/ladda.min.js',
        'public/v4.1.0/theme/assets/global/scripts/metronic.js',
        'public/v4.1.0/theme/assets/admin/layout/scripts/layout.js',
        'public/v4.1.0/theme/assets/admin/layout/scripts/demo.js',
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

gulp.task('watch', function(){
    livereload.listen();
    gulp.watch('public/js/pages/dashboard/paris/*.js', ['dashboard-js']);
});