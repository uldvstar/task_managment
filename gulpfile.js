const pkg = require('./package.json');
const gulp = require('gulp');
const del = require('del');
const plugins = require('gulp-load-plugins')({pattern: ['*'], scope: ['devDependencies']});
let uglifyEs = require('gulp-uglify-es').default;

const onError = (error) => {
    console.log(error);
};

const sassOptions = {style: 'compressed'};

// compile vendor dependencies
gulp.task('vendorJs', () => {
    plugins.fancyLog('Compiling vendor JS dependencies');
    return gulp.src(pkg.globs.vendorJs)
        .pipe(plugins.plumber({errorHandler: onError}))
        .pipe(plugins.print())
        .pipe(plugins.concat('vendor.js'))
        .pipe(plugins.uglify())
        .pipe(gulp.dest(pkg.paths.build.js));
});

gulp.task('vendorCss', () => {
    plugins.fancyLog('Compiling vendor CSS dependencies');
    return gulp.src(pkg.globs.vendorCss)
        .pipe(plugins.plumber({errorHandler: onError}))
        .pipe(plugins.print())
        .pipe(plugins.concatCss('vendor.css'))
        .pipe(plugins.cleanCss())
        .pipe(plugins.replace('../../../font-awesome/', './'))
        .pipe(plugins.replace('../../jquery-ui-dist/', ''))
        .pipe(gulp.dest(pkg.paths.build.css));
});

gulp.task('vendorFonts', () => {
    plugins.fancyLog('Copying vendor fonts for dependencies');
    return gulp.src(pkg.globs.vendorFonts)
        .pipe(plugins.plumber({errorHandler: onError}))
        .pipe(plugins.print())
        .pipe(gulp.dest(pkg.paths.build.fonts));
});

gulp.task('vendorImages', () => {
    plugins.fancyLog('Copying vendor images for dependencies');
    return gulp.src(pkg.globs.vendorImages)
        .pipe(plugins.plumber({errorHandler: onError}))
        .pipe(plugins.print())
        .pipe(gulp.dest(pkg.paths.build.images));
});

// compile source scss
gulp.task('sourceCss', () => {
    plugins.fancyLog('Compiling source CSS files');
    return gulp.src(pkg.globs.sourceCss)
        .pipe(plugins.plumber({errorHandler: onError}))
        .pipe(plugins.print())
        .pipe(plugins.sass(sassOptions).on('error', plugins.sass.logError))
        .pipe(plugins.autoprefixer())
        .pipe(plugins.concatCss('site.css'))
        .pipe(gulp.dest(pkg.paths.build.css));
});

gulp.task('sourceJs', () => {
    plugins.fancyLog('Compiling source JS dependencies');
    return gulp.src(pkg.globs.sourceJs)
        .pipe(plugins.plumber({errorHandler: onError}))
        .pipe(plugins.print())
        .pipe(plugins.concat('site.js'))
        .pipe(uglifyEs())
        .pipe(gulp.dest(pkg.paths.build.js));
});

gulp.task('sourceImages', () => {
    plugins.fancyLog('Compiling source image files');
    return gulp.src(pkg.globs.sourceImages)
        .pipe(plugins.plumber({errorHandler: onError}))
        .pipe(plugins.print())
        .pipe(gulp.dest(pkg.paths.build.images));
});
gulp.task('sourceFonts', () => {
    plugins.fancyLog('Compiling source font files');
    return gulp.src(pkg.globs.sourceFonts)
        .pipe(plugins.plumber({errorHandler: onError}))
        .pipe(plugins.print())
        .pipe(gulp.dest(pkg.paths.build.fonts));
});
gulp.task('clean', () => {
    return del([pkg.paths.build.css + '/*', pkg.paths.build.js + '/*', !pkg.paths.build.js + '/app.js', pkg.paths.build.images + '/*', pkg.paths.build.fonts + '/*']);
});

gulp.task('vendor', ['vendorJs', 'vendorCss', 'vendorFonts', 'vendorImages']);
gulp.task('source', ['sourceCss', 'sourceImages', 'sourceJs', 'sourceFonts']);
gulp.task('build', ['clean', 'vendor', 'source']);

gulp.task('watch', () => {
    gulp.watch(pkg.globs.sourceCss, ['sourceCss']);
    gulp.watch(pkg.globs.sourceImages, ['sourceImages']);
    gulp.watch(pkg.globs.sourceJs, ['sourceJs']);
    gulp.watch(pkg.globs.sourceJs, ['sourceFonts']);
});