"use strict";

var gulp = require("gulp");
var sass = require("gulp-sass")(require("sass"));
var sourcemaps = require("gulp-sourcemaps");
var autoprefixer = require("gulp-autoprefixer");
var importer = require("node-sass-globbing");
var plumber = require("gulp-plumber");
var cssmin = require("gulp-cssmin");
var browserSync = require("browser-sync").create();

var cleanCss = require("gulp-clean-css");
var rename = require("gulp-rename");

var sass_config = {
  importer: importer,
  includePaths: [
    "node_modules/breakpoint-sass/stylesheets/",
    "node_modules/singularitygs/stylesheets/",
    "node_modules/compass-mixins/lib/",
  ],
};

var paths = {
  sass: ["./src/scss/**/*.scss"],
};


gulp.task("sass", function (done) {
  gulp
    gulp.src('./src/scss/*.scss')
    .pipe(sass())
    .on("error", sass.logError)
    .pipe(gulp.dest("./css/"))
    .pipe(
      cleanCss({
        keepSpecialComments: 0,
      })
    )
    .pipe(rename({ extname: ".min.css" }))
    .pipe(gulp.dest("./css/"))
    .on("end", done);
});

gulp.task("watch", function () {
  // browserSync.init({
  //   //injectChanges: true,
  //   proxy: "myanywhere.test",
  // });
   gulp.watch(paths.sass, gulp.series("sass"));
});


gulp.task("default", gulp.series("watch"));
