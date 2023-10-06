const gulp       = require('gulp');
const wpPot      = require('gulp-wp-pot');
const { series } = require('gulp');

// watch build of files watching scss, js and php for translations. 
function watch() {
  gulp.watch('./**/**/*.php', wp_pot);
}

// Build .pot file for php.
function wp_pot() {
  return gulp.src('./**/**/*.php')
    .pipe(
      wpPot(
        {
          domain: 'years-since',
          package: 'YearsSince'
        }
      )
    )
    .pipe(gulp.dest('./languages/years-since.pot'));
}

exports.watch  = watch;
exports.wp_pot = wp_pot;