'use strict';

// Gulp and plugins
const gulp = require('gulp');
const { src, dest, parallel } = require('gulp');
const babel = require('gulp-babel');
const browserSync = require('browser-sync').create();
const concat = require('gulp-concat');
const deporder = require('gulp-deporder');
const order = require('gulp-order');
const newer = require('gulp-newer');
const postcss = require('gulp-postcss');
const sass = require('gulp-sass');
const sourcemaps = require('gulp-sourcemaps');
const uglify = require('gulp-uglify');
const fsCache = require('gulp-fs-cache');


const srcDir = './src';
const buildDir = './dist';


// JAVASCRIPT DEPENDENCIES MINIFY - CONCAT
function jsLibraries() {
	return src(srcDir + '/libraries/*.js')
		.pipe(deporder())
		.pipe(babel({
			presets: ['@babel/env']
		}))
		.pipe(concat('libraries.js'))
		.pipe(uglify())
		.pipe(dest(buildDir + '/js/'))
		.pipe(browserSync.stream())
}


// JAVASCRIPT MINIFY - CONCAT
function js() {
	var jsFsCache = fsCache('.tmp/jscache');
	return src([
			// srcDir + '/js/_main.js',
			srcDir + '/js/**/*.js'
		])
		.pipe(order([
			'src/js/_main.js',
			'src/js/**/*.js'
		], { base: './' }))
		.pipe(babel({
			presets: ['@babel/env']
		}))
		.pipe(concat('scripts.js'))
		.pipe(jsFsCache)
		.pipe(uglify())
		.pipe(jsFsCache.restore)
		.pipe(dest(buildDir + '/js/'))
		.pipe(browserSync.stream())
}


// JAVASCRIPT ADMIN FILES MINIFY - CONCAT
function jsAdmin() {
	return src(srcDir + '/admin/*.js')
		.pipe(deporder())
		.pipe(babel({
			presets: ['@babel/env']
		}))
		.pipe(concat('scripts-admin.js'))
		.pipe(uglify())
		.pipe(dest(buildDir + '/js/'))
		.pipe(browserSync.stream())
}


// SASS MINIFY AND CONCAT
var cssSettings = {
	sassOpts: {
		outputStyle: 'nested',
		precision: 3,
		errLogToConsole: true
	},
	processors: [
		require('autoprefixer'),
		require('css-mqpacker'),
		require('cssnano')
	]
};

function css() {
	return src(srcDir + '/scss/main.scss')
		.pipe(sourcemaps.init())
		.pipe(sass(cssSettings.sassOpts))
		.pipe(postcss(cssSettings.processors))
		.pipe(concat('updated-styles.css'))
		.pipe(sourcemaps.write('.'))
		.pipe(dest('dist/'))
		.pipe(browserSync.stream())
}

function cssLibraries() {
	return src(srcDir + '/scss_libraries/*.scss')
		.pipe(sourcemaps.init())
		.pipe(sass(cssSettings.sassOpts))
		.pipe(postcss(cssSettings.processors))
		.pipe(concat('libraries.css'))
		.pipe(sourcemaps.write('.'))
		.pipe(dest('./dist/css/'))
		.pipe(browserSync.stream())
}


// BROWSER SYNC UPDATE PAGE ON PHP, JS, OR SCSS CHANGE
const syncSettings = {
	proxy: 'umfwnc.localhost',
	files: './**/*',
	open: "local",
	port: 3000,
	notify: false,
	watchOptions: {
		ignoreInitial: true,
		ignored: ['node_modules']
	},
	ghostMode: false,
	ui: {
		port: 8001
	}
};

function watch() {
	browserSync.init(syncSettings);
	gulp.watch(srcDir + '/js/**/*.js', js)
	gulp.watch(srcDir + '/admin/*.js', jsAdmin)
	gulp.watch(srcDir + '/libraries/*.js', jsLibraries)
	gulp.watch(srcDir + '/scss/**/*.scss', css)
	gulp.watch(srcDir + '/scss_libraries/**/*.scss', cssLibraries)
}


// RUN ABOVE
exports.js = js;
exports.jsLibraries = jsLibraries;
exports.jsAdmin = jsAdmin;
exports.css = css;
exports.watch = watch;
exports.default = parallel(js, jsAdmin, jsLibraries, css, cssLibraries, watch);
