require('dotenv').config();

var gulp = require('gulp');
var plugins = require('gulp-load-plugins')();
var browserSync = require('browser-sync').create();
var sass = require('gulp-sass')(require('sass'));

var config = require('./config');

var buildSass = env => {
    return gulp.src([
            config.sassPath + '/**/*.scss'
        ])
        .pipe(sass({
            outputStyle: env === 'production' ? 'compressed' : 'expanded',
            includePaths:[
                ...config.vendor.sass,
                config.sassPath,
            ],
            errLogToConsole: true
        }).on('error', plugins.notify.onError( error => {
            return "Error: " + error.message;
        })))
        .pipe(plugins.autoprefixer('last 10 version'))
        .pipe(gulp.dest( config.destPath + '/css' ))
        .pipe(browserSync.stream());
};

gulp.task('buildDev:sass', () => { return buildSass(process.env.NODE_ENV); } );
gulp.task('build:sass', () => { return buildSass("production"); } );

gulp.task('build:mainJS', () => {
    return gulp.src([
        ...config.vendor.js,
        config.jsMainPath + '/**/_*.js',
        config.jsMainPath + '/**/*.js',
        config.jsMainPath + '/_*.js',
        config.jsMainPath + '/*.js',
    ])
    .pipe(plugins.concat('main.js'))
    .pipe(gulp.dest(config.destPath + '/js/main'))
    .pipe(plugins.rename('main.min.js'))
    .pipe(plugins.uglify({mangle: {reserved: config.uglify.reserved, toplevel: true}}))
    .pipe(gulp.dest(config.destPath + '/js/main'));
});

gulp.task('build:extraJS', () => {
    return gulp.src([
        config.jsExtraPath + '/**/_*.js',
        config.jsExtraPath + '/**/*.js',
        config.jsExtraPath + '/_*.js',
        config.jsExtraPath + '/*.js',
    ])
    .pipe(plugins.uglify({mangle: {reserved: config.uglify.reserved, toplevel: true}}))
    .pipe(gulp.dest(config.destPath + '/js/extra'));
});

gulp.task('build:images', () => {
    return gulp.src([
        config.imgPath + '/**/*'
    ])
    .pipe(gulp.dest(config.destPath + '/img'));
});

gulp.task('build:fonts', () => {
    return gulp.src([
        config.fontPath + '/**/*'
    ])
    .pipe(gulp.dest(config.destPath + '/fonts'));
});

gulp.task('clean', () => {
    return gulp.src([
            config.destPath
        ], { read: false, allowEmpty: true })
    .pipe(plugins.clean());
});

gulp.task('watch', () => {
    browserSync.init({
      files: [
          config.destPath + '**/*'
        ],
      proxy: config.devUrl,
    });
    gulp.watch(config.sassPath + '/**/*.scss', gulp.series('buildDev:sass'));
    gulp.watch(config.jsMainPath + '/**/*.js', gulp.series('build:mainJS'));
    gulp.watch(config.jsExtraPath + '/**/*.js', gulp.series('build:extraJS'));
    gulp.watch(config.imgPath + '/**/*', gulp.series('build:images'));
    gulp.watch(config.fontPath + '/**/*', gulp.series('build:fonts'));
    gulp.watch(config.destPath + "/**/{*.css,*.js}").on('change', browserSync.reload);
});

gulp.task('build:watch', gulp.series('buildDev:sass', 'build:fonts', 'build:mainJS', 'build:extraJS', 'build:images', 'watch'));

gulp.task('build', gulp.series('clean', gulp.parallel('build:sass', 'build:fonts', 'build:mainJS', 'build:extraJS', 'build:images')));

gulp.task('default', gulp.series('build'));
