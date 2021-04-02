// Imports
import gulp from 'gulp';
import rename from 'gulp-rename';
import wait from 'gulp-wait';
import globSass from 'gulp-sass-glob';
import sourcemap from 'gulp-sourcemaps';
import sass from 'gulp-sass';
import grMediaQueries from 'gulp-group-css-media-queries';
import autoprefixer from 'gulp-autoprefixer';
import cleanCSS from 'gulp-clean-css';
import rigger from 'gulp-rigger';
import uglify from 'gulp-uglify';
import del from 'del';
import browserSync from 'browser-sync';
import sysConfig from './system-config.json';

// Variables
let bs = browserSync.create();

// Tasks
// Cleaners from build folder
export const cleanStyles = () => del(sysConfig.paths.clear.styles);
export const cleanScripts = () => del(sysConfig.paths.clear.scripts);
export const cleanImages = () => del(sysConfig.paths.clear.images);
export const cleanFonts = () => del(sysConfig.paths.clear.fonts);
export const cleanBuild = () => del(sysConfig.paths.clear.build);

// Move vendor style to source
export function vendorStyles() {
  return gulp.src(sysConfig.paths.src.vendorStyles+'**/*.css')
        .pipe(gulp.dest(sysConfig.paths.build.css.vendors))
        .pipe(browserSync.stream());
}
// Compile styles
export function styles() {
  return gulp.src(sysConfig.paths.src.scss+'style.scss')
        .pipe(wait(500))
        .pipe(globSass())
        .pipe(sourcemap.init())
          .pipe(sass().on('error', sass.logError))
          .pipe(autoprefixer({
            browsers: ['last 2 versions'],
            cascade: false
          }))
          .pipe(cleanCSS())
        .pipe(sourcemap.write())
        .pipe(rename({
          suffix: '.min'
        }))
        .pipe(gulp.dest(sysConfig.paths.build.css.mainstyle))
        .pipe(browserSync.stream());
}

// Compile styles and group mediaqueries
export function stylesFinal() {
  return gulp.src(sysConfig.paths.src.scss+'style.scss')
        .pipe(wait(500))
        .pipe(globSass())
        .pipe(sass().on('error', sass.logError))
        .pipe(autoprefixer({
          browsers: ['last 2 versions'],
          cascade: false
        }))
        .pipe(grMediaQueries())
        .pipe(cleanCSS())
        .pipe(rename({
          suffix: '.min'
        }))
        .pipe(gulp.dest(sysConfig.paths.build.css.mainstyle))
        .pipe(browserSync.stream());
}

// Compile all styles
const compileStyles = gulp.series(cleanStyles, vendorStyles, stylesFinal);
gulp.task('compile-styles', compileStyles);

// Move vendor scripts
export function vendorScripts() {
  return gulp.src(sysConfig.paths.src.vendorScripts+'**/*.js')
        .pipe(gulp.dest(sysConfig.paths.build.js.vendors))
        .pipe(browserSync.stream());
}
// Compile main script
export function scripts() {
  return gulp.src(sysConfig.paths.src.js+'*.js')
        .pipe(rigger())
        .pipe(sourcemap.init())
          .pipe(uglify())
          .pipe(rename({
            suffix: '.min'
          }))
        .pipe(sourcemap.write())
        .pipe(gulp.dest(sysConfig.paths.build.js.mainScript))
        .pipe(browserSync.stream());
}

// Move images
export function images() {
  return gulp.src(sysConfig.paths.src.img+'**/*.*')
        .pipe(gulp.dest(sysConfig.paths.build.img))
        .pipe(browserSync.stream());
}

// Move fonts
export function fonts() {
  return gulp.src(sysConfig.paths.src.fonts+'**/*.*')
        .pipe(gulp.dest(sysConfig.paths.build.fonts))
        .pipe(browserSync.stream());
}

// Start Server
export function serverStart() {
  bs.init(sysConfig.serverConf);
}

export function serverReload(done) {
  bs.reload();
  return done();
}

// Watch
export function watch() {
  // Styles
  gulp.watch(sysConfig.paths.watch.scss, gulp.series(cleanStyles, styles, vendorStyles, serverReload));
  // JS
  gulp.watch([sysConfig.paths.watch.js], gulp.series(cleanScripts, scripts, vendorScripts, serverReload));
  // Images
  gulp.watch([sysConfig.paths.watch.img], gulp.series(cleanImages, images, serverReload));
  // Fonts
  gulp.watch([sysConfig.paths.watch.fonts], gulp.series(cleanFonts, fonts, serverReload));
}

// Build Task
gulp.task('build', gulp.series(
  cleanBuild,
  gulp.parallel(vendorScripts, vendorStyles, scripts, stylesFinal, fonts, images)
));

// Dev Task
gulp.task('dev', gulp.series(
  vendorScripts,
  vendorStyles,
  scripts,
  styles,
  fonts,
  images,
  watch
  // gulp.parallel(watch, serverStart)
));