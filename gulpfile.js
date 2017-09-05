var gulp = require('gulp');
var compass = require('gulp-compass');
var watch = require('gulp-watch');
var prefix = require('gulp-autoprefixer');
var plumber = require('gulp-plumber');
var livereload = require('gulp-livereload');
var path = require('path');
var cleanCSS = require('gulp-clean-css');
function handleError(err) {
    console.log(err.toString());
    this.emit('end');
}
gulp.task('sass', function() {
    return gulp.src(['./scss/*'])
            .pipe(plumber())
            .pipe(compass({
                comments: true,
                sourcemap: true,
                css: './css',
                sass: './scss',
                image: './img',
                style: 'compressed' //nested, expanded, compact, compressed
            }).on('error', handleError))
            .pipe(prefix("last 8 version", "> 1%", "ie 9"), {cascade: false})
            .pipe(gulp.dest('./css'))
})
gulp.task('watch', function() {
    livereload.listen();
    gulp.watch('./scss/*', ['sass']);
});
var directories = ["./*.html", "js/*.js", "css/*.css", "./*.php", "./incs/*.php"];
gulp.task('default', ['watch'], function() {
    gulp.watch(directories, function() {
        gulp.src(directories)
                .pipe(livereload());
    });
});