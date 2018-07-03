// General.
var pkg				= require('./package.json');
var project 			= pkg.name;
var project 			= project.replace(/_/g, " ");
var slug			= pkg.slug;
var projectURL			= 'http://theme.coblocks.dev/';

// Translation.
var text_domain			= '@@textdomain';
var destFile			= slug+'.pot';
var packageName			= project;
var bugReport			= pkg.author_uri;
var lastTranslator		= pkg.author;
var team			= pkg.author_shop;
var translatePath		= './languages';

// Styles.
var styleSRC			= './scss/style.scss';
var styleDestination		= './';
var cssFiles			= './**/*.css';
var scssDistFolder		= './_dist/'+slug+'/scss/';
var scssDistFiles		= './_dist/'+slug+'/scss/**/';
var scssDistFolderPackageDest	= './_dist/'+slug+'/assets/scss/';
var styleCustomizerSCSSDir	= './_dist/'+slug+'/inc/customizer/scss';

// Visual Editor.
var editorStyles		= './scss/editor.scss';
var editorDestination		= './assets/css/';
var distEditorStyleSheet	= './_dist/'+slug+'/assets/css/editor.css';

// Gutenberg Editor.
var gutenbergStyles		= './scss/gutenberg.scss';
var gutenbergDestination	= './assets/css/';
var distGutenbergStyleSheet	= './_dist/'+slug+'/assets/css/gutenberg.css';

// Customize Controls.
var customizeControlsStyles	= './inc/customizer/scss/customize-controls.scss';
var customizeControlsRangeStyles = './inc/customizer/scss/customize-range-control.scss';
var customizeControlsDestination = './assets/css/';

// BrowserSync.
var styleWatchFiles	  	= ['./scss/**/*.scss', '!/scss/gutenberg.scss', '!/scss/editor.scss' ];
var jsWatchFiles	  	= ['./assets/js/**/*.js'];
var customizerWatchFiles	= ['./inc/customizer/scss/**/*.scss' ];
var projectPHPWatchFiles	= ['./**/*.php', '!_dist', '!_dist/**', '!_dist/**/*.php', '!_demo', '!_demo/**','!_demo/**/*.php'];

// Build.
var distBuildFiles		= ['./**', '!_dist', '!_dist/**', '!_demo', '!_demo/**', '!node_modules/**', '!*.json', '!*.map', '!*.xml', '!gulpfile.js', '!*.sublime-project', '!*.sublime-workspace', '!*.sublime-gulp.cache', '!*.log', '!*.DS_Store', '!*.gitignore', '!TODO', '!*.git', '!*.ftppass', '!*.DS_Store', '!yarn.lock', '!package.lock'];
var distDestination		= './_dist/';
var distCleanFiles		= ['./_dist/'+slug+'/', './_dist/'+slug+'-package/', './_dist/'+slug+'.zip', './_dist/'+slug+'-package.zip' ];
var demoCleanFiles		= ['./_demo/'];

// Build /slug/ contents within the _dist folder
var themeDestination		= './_dist/'+slug+'/';
var themeBuildFiles		= './_dist/'+slug+'/**/*';

// Build _demo contents.
var demoDestination		= './_demo/';

// Browsers you care about for autoprefixing. https://github.com/ai/browserslist
const AUTOPREFIXER_BROWSERS = [
	'last 2 version',
	'> 1%',
	'ie >= 9',
	'ie_mob >= 10',
	'ff >= 30',
	'chrome >= 34',
	'safari >= 7',
	'opera >= 23',
	'ios >= 7',
	'android >= 4',
	'bb >= 10'
];

/**
 * Load Plugins.
 */
var gulp		= require('gulp');
var sass		= require('gulp-sass');
var minifycss		= require('gulp-uglifycss');
var autoprefixer 	= require('gulp-autoprefixer');
var concat	   	= require('gulp-concat');
var uglify	   	= require('gulp-uglify');
var del                 = require('del');
var imagemin	 	= require('gulp-imagemin');
var rename	   	= require('gulp-rename');
var lineec	   	= require('gulp-line-ending-corrector');
var filter	   	= require('gulp-filter');
var sourcemaps   	= require('gulp-sourcemaps');
var notify	   	= require('gulp-notify');
var browserSync  	= require('browser-sync').create();
var reload	   	= browserSync.reload;
var wpPot		= require('gulp-wp-pot');
var sort		= require('gulp-sort');
var replace	  	= require('gulp-replace-task');
var zip		  	= require('gulp-zip');
var copy		= require('gulp-copy');
var open	  	= require('gulp-open');
var gulpif              = require('gulp-if');
var cache               = require('gulp-cache');

function clearCache(done) {
	cache.clearAll();
	done();
}
gulp.task(clearCache);

gulp.task( 'browser-sync', function(done) {
	browserSync.init( {
		proxy: projectURL,
		open: true,
		injectChanges: true,
	} );
	done();
});

gulp.task( 'styles', function(done) {
	gulp.src( styleSRC )
	.pipe( sass( {
		errLogToConsole: true,
		outputStyle: 'expanded',
		precision: 10
	} ) )
	.on('error', console.error.bind(console))
	.pipe( autoprefixer( AUTOPREFIXER_BROWSERS ) )
	.pipe( lineec() )
	.pipe( gulp.dest( styleDestination ) )
	.pipe( filter( '**/*.css' ) )
	.pipe(replace({
	patterns: [
		{
		  match: 'pkg.name',
		  replacement: project
		},
		{
		  match: 'pkg.author_shop',
		  replacement: pkg.author_shop
		},
		{
		  match: 'pkg.author_uri',
		  replacement: pkg.author_uri
		},
		{
		  match: 'pkg.version',
		  replacement: pkg.version
		},
		{
		  match: 'pkg.theme_uri',
		  replacement: pkg.theme_uri
		},
		{
		  match: 'pkg.description',
		  replacement: pkg.description
		},
		{
		  match: 'pkg.textdomain',
		  replacement: pkg.textdomain
		},
	]
	}))
	.pipe( gulp.dest( './' ) )
	.pipe( browserSync.stream() )
	done();
});

gulp.task( 'gutenberg-styles', function(done) {
	gulp.src( gutenbergStyles, { allowEmpty: true } )
	.pipe( sass( {
		errLogToConsole: true,
		outputStyle: 'expanded',
		precision: 10
	} ) )
	.on('error', console.error.bind(console))
	.pipe( autoprefixer( AUTOPREFIXER_BROWSERS ) )
	.pipe( lineec() )
	.pipe( gulp.dest( gutenbergDestination ) )
	.pipe( browserSync.stream() )
	done();
});

gulp.task( 'editor-styles', function(done) {
	gulp.src( editorStyles, { allowEmpty: true } )
	.pipe( sass( {
		errLogToConsole: true,
		outputStyle: 'expanded',
		precision: 10
	} ) )
	.on('error', console.error.bind(console))
	.pipe( autoprefixer( AUTOPREFIXER_BROWSERS ) )
	.pipe( lineec() )
	.pipe( gulp.dest( editorDestination ) )
	.pipe( browserSync.stream() )
	done();
});

gulp.task( 'customizer-styles', function(done) {
	gulp.src( [ customizeControlsStyles, customizeControlsRangeStyles ], { allowEmpty: true } )
	.pipe( sass( {
		errLogToConsole: true,
		outputStyle: 'expanded',
		precision: 10
	} ) )
	.on('error', console.error.bind(console))
	.pipe( autoprefixer( AUTOPREFIXER_BROWSERS ) )
	.pipe( lineec() )
	.pipe( gulp.dest( customizeControlsDestination ) )
	.pipe( browserSync.stream() )
	done();
});

gulp.task('clean', function(done) {
	return del( distCleanFiles );
	done();
});

gulp.task('clean_demo', function (done) {
	return del( demoCleanFiles );
	done();
});

gulp.task('clean_dist_scss', function (done) {
	return del( scssDistFolder );
	done();
});

gulp.task('clean_dist_customizer_scss', function (done) {
	return del( styleCustomizerSCSSDir );
	done();
});

gulp.task('clean-dist', function (done) {
	return del( './_dist/' + slug + '/' );
	done();
});

gulp.task('copy', function(done) {
	return gulp.src( distBuildFiles )
	.pipe( copy( themeDestination ) );
	done();
});

gulp.task('variables', function(done) {
	return gulp.src( themeBuildFiles )
	.pipe(replace({
		patterns: [
		{
			match: 'pkg.name',
			replacement: project
		},
		{
			match: 'pkg.version',
			replacement: pkg.version
		},
		{
			match: 'pkg.author',
			replacement: pkg.author
		},
		{
			match: 'pkg.author_shop',
			replacement: pkg.author_shop
		},
		{
			match: 'pkg.license',
			replacement: pkg.license
		},
		{
			match: 'pkg.slug',
			replacement: pkg.slug
		},
		{
			match: 'pkg.theme_uri',
			replacement: pkg.theme_uri
		},
		{
			match: 'textdomain',
			replacement: pkg.textdomain
		},
		{
			match: 'pkg.description',
			replacement: pkg.description
		}
		]
	}))
	.pipe(gulp.dest( themeDestination ));
	done();
});

gulp.task('move-to-demo', function(done){
	return gulp.src('./_dist/'+slug+'/**')
	.pipe( gulp.dest( demoDestination ) );
	done();
});

gulp.task( 'translate', function(done) {
	gulp.src( projectPHPWatchFiles )

	.pipe(sort())
	.pipe(wpPot( {
		 domain		: text_domain,
		 destFile	: destFile,
		 package	: project,
		 bugReport	: bugReport,
		 lastTranslator : lastTranslator,
		 team		: team
	} ))
	.pipe( gulp.dest( translatePath ) )
	done();
});

gulp.task('css_variables', function(done) {
  gulp.src( cssFiles )
	.pipe(replace({
	  patterns: [
		{
		  match: 'pkg.name',
		  replacement: project
		},
	  ]
	}))
	.pipe(gulp.dest( './' ));
	done();
});

gulp.task('zip-theme', function(done) {
	return gulp.src( themeDestination + '/**', { base: '_dist' } )
	.pipe( zip( slug + '.zip' ) )
	.pipe( gulp.dest( distDestination ) );
	done();
});

gulp.task( 'build_notice', function() {
	return gulp.src( './' )
	.pipe( notify( { message: 'Your build of ' + packageName + ' is complete.', onLast: false } ) );
});

gulp.task( 'upload-to-wordpressorg', function(done){
	gulp.src(__filename)
	.pipe( open( { uri: 'https://wordpress.org/themes/upload/' } ) )
	done();
});

gulp.task( 'default', gulp.series( 'clearCache', 'styles', 'gutenberg-styles', 'editor-styles', 'customizer-styles', 'browser-sync', function(done) {
	gulp.watch( projectPHPWatchFiles, gulp.parallel(reload));
	gulp.watch( styleWatchFiles, gulp.parallel('styles'));
	gulp.watch( customizerWatchFiles, gulp.parallel('customizer-styles'));
	gulp.watch( gutenbergStyles, gulp.parallel('gutenberg-styles'));
	gulp.watch( jsWatchFiles, gulp.parallel(reload));
	done();
} ) );

gulp.task( 'build-process', gulp.series( 'clearCache', 'clean', 'clean_demo', 'styles', 'css_variables', 'translate', 'gutenberg-styles', 'editor-styles', 'customizer-styles', 'copy', 'variables', 'clean_dist_customizer_scss', 'clean_dist_scss', 'zip-theme', 'move-to-demo', 'clean-dist', 'upload-to-wordpressorg', function(done) {
	done();
} ) );

gulp.task( 'build', gulp.series( 'build-process', 'build_notice', function(done) {
	done();
} ) );
