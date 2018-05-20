var gulp = require('gulp');
var autoprefixer = require('gulp-autoprefixer');
var postcss  = require('gulp-postcss');
var flexbugsfixes = require('postcss-flexbugs-fixes');
var cleanCSS = require('gulp-clean-css');
var uglify = require('gulp-uglify');
var pump = require('pump');
var rename = require('gulp-rename');

gulp.task('default', () =>
  gulp.src('./css/*.css')
    .pipe(postcss([flexbugsfixes]))
    .pipe(autoprefixer({
      browsers: ['last 2 versions']
    }))
    .pipe(cleanCSS({compatibility:'*'}))
    // .pipe(rename({ suffix: '.min' }))
    .pipe(gulp.dest('dist'))
);

gulp.task('style', () =>
  gulp.src('./style-original.css')
    .pipe(cleanCSS({compatibility:'*'}))
    .pipe(rename({ suffix: '.min' }))
    .pipe(gulp.dest('dist'))
);

gulp.task('js', function(cb) {
  pump([
    gulp.src('js/*.js'),
    uglify(),
    rename({ suffix: '.min' }),
    gulp.dest('js')
  ],cb);
});
