module.exports = {
    "environment": process.env.NODE_ENV || "production",
    "imgPath"    : "./src/img",
    "fontPath"   : "./src/fonts",
    "jsMainPath" : "./src/js/main",
    "jsExtraPath": "./src/js/extra",
    "sassPath"   : "./src/sass",
    "destPath"   : "./dist",
    "devUrl"     : process.env.DEVELOPMENT_URL || "",
    "vendor"     : {
        "sass": [
            // './node_modules/bootstrap/scss',
        ],
        "js": [
            // './node_modules/bootstrap/dist/js/bootstrap.bundle.min.js',
        ]
    },
    "uglify": {
        "reserved": [
            // "Commons",
        ]
    },
};
