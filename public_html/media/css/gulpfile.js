// noinspection JSUnresolvedFunction,JSUnresolvedVariable

const gulp = require('gulp');
const sass = require('gulp-sass');
//var concat = require('gulp-concat');
//var sourcemaps = require('gulp-sourcemaps');
//var babel = require('gulp-babel');

gulp.task('styles', function () {
    gulp.src('./**/*.scss')
        .pipe(sass().on('error', sass.logError))
        .pipe(gulp.dest('assets/css'))
});

// gulp.task('scripts', function () {
//     return gulp.src(['node_modules/babel-polyfill/dist/polyfill.js', './src/**/*.js'])
//         .pipe(sourcemaps.init())
//         .pipe(concat('web.app.js'))
//         .pipe(sourcemaps.write())
//         .pipe(gulp.dest('assets/js'))
// });

//Watch task
gulp.task('default', function () {
    gulp.watch('./src/**/*.scss', ['styles']);
    //gulp.watch('./src/**/*.js', ['scripts']);
});