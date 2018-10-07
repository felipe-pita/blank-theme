const gulp       = require('gulp');
const hasFlag    = require('has-flag');
const plumber    = require('gulp-plumber');
const sourcemaps = require('gulp-sourcemaps');

const paths = {
	scss:   ['./assets/scss/**/*'],
	js:     ['./assets/js/*'],
	libs:   ['./assets/js/vendor/*.js'],
	img:    ['./assets/img/**/*'],
	deploy: ['./**/*', '!./node_modules/**/*', '!./.*/**/*', '!./.*', '!./gulpfile.js', '!./assets/**/*', '!./package*.json'],

	dest: './build'
}

// /*
// * CSS
// */
const sass         = require('gulp-sass');
const autoprefixer = require('gulp-autoprefixer');
const clean        = require('gulp-clean-css');
const wait         = require('gulp-wait');

gulp.task('scss', (done) => {
	if (hasFlag('prod')) {
		return gulp.src(paths.scss)
		.pipe(plumber())
		.pipe(wait(500))
		.pipe(sass())
		.pipe(autoprefixer('last 8 version', '> 1%', 'ie 8'))
		.pipe(clean())
		.pipe(gulp.dest(paths.dest + '/css'));
	} else {
		return gulp.src(paths.scss)
		.pipe(plumber())
		.pipe(sourcemaps.init())
		.pipe(sass().on('error', sass.logError))
		.pipe(sourcemaps.write())
		.pipe(gulp.dest(paths.dest + '/css'));
	}
});

/*
* Js
*/
const uglify = require('gulp-uglify');

gulp.task('js', (done) => {
	return gulp.src(paths.js)
	.pipe(plumber())
	.pipe(hasFlag('prod') ? uglify() : () => {})
	.pipe(gulp.dest(paths.dest + '/js'));
});

const concat = require('gulp-concat');

gulp.task('libs', (done) => {
	return gulp
	.src(paths.lib)
	.pipe(concat('libs.js'))
	.pipe(gulp.dest(paths.dest + '/js'));
});

/*
* Imagens
*/
const imagemin = require('gulp-imagemin');

gulp.task('img', (done) => {
	return gulp.src(paths.images)
	.pipe(plumber())
	.pipe(imagemin({progressive: true, optimizationLevel: 7}))
	.pipe(gulp.dest(paths.dest + '/images'));
});

/*
* Deploy
*/
const sftp   = require('gulp-sftp');
const cache  = require('gulp-cached');

gulp.task('deploy', (done) => {
	if (hasFlag('prod')) {
		return gulp.src(paths.deploy, {base: '.'})
		.pipe(plumber())
		.pipe(cache('deploy'))
		.pipe(sftp({
			host: '',
			user: '',
			pass: '',
			remotePath: path,
		}));
	
	} else {
		console.log('dev deploy');
		done();
	}
});

/**
 * Ao alterar os arquivos
 */
gulp.task('watch', (done) => {
	gulp.watch(paths.scss,   gulp.parallel('scss'));
	gulp.watch(paths.js,     gulp.parallel('js'));
	gulp.watch(paths.libs,   gulp.parallel('libs'));
	gulp.watch(paths.img,    gulp.parallel('img'));
	gulp.watch(paths.deploy, gulp.parallel('deploy'));

	done();
});

gulp.task('default', gulp.parallel('watch'), (done) => {
	done();
});
