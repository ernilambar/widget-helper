// Config for theme.
var rootPath  = './';

// Gulp Nodes.
var gulp        = require( 'gulp' ),
    gulpPlugins = require( 'gulp-load-plugins' )();

var fs = require('fs');

// Error Handling.
var onError = function( err ) {
    console.log( 'An error occurred:', err.message );
    this.emit( 'end' );
};

gulp.task('scss', function () {
    const { autoprefixer, cleanCss, plumber, sass, sassGlob, rename } = gulpPlugins;
    return gulp.src(rootPath + 'assets/sass/*.scss')
        .on('error', sass.logError)
        .pipe(plumber())
        .pipe(sassGlob())
        .pipe(sass())
        .pipe(autoprefixer('last 4 version'))
        .pipe(gulp.dest('public/css'))
        .pipe(cleanCss())
        .pipe(rename({ extname: '.min.css' }))
        .pipe(gulp.dest('public/css'))
});

gulp.task('scripts', function() {
    const { plumber, rename, uglify } = gulpPlugins;
    return gulp.src( [rootPath + 'assets/scripts/*.js'] )
        .pipe(plumber())
        .pipe(gulp.dest('public/js'))
        .pipe(rename({suffix: '.min'}))
        .pipe(uglify())
        .pipe(gulp.dest('public/js'))
});

// Tasks.
gulp.task( 'build', gulp.series('scss', 'scripts'));
