const path = require('path');
const webpack = require("webpack");
const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const FixStyleOnlyEntriesPlugin = require("webpack-fix-style-only-entries");
const OptimizeCssAssetsPlugin = require('optimize-css-assets-webpack-plugin');
const TerserJSPlugin = require('terser-webpack-plugin');
const GoogleFontsPlugin = require("@beyonk/google-fonts-webpack-plugin");
const __publicPath = path.join(__dirname, '..', 'public');

module.exports = (env, argv) => {

  const __baselurl = argv.mode === 'production' ? '' : 'http://localhost:9000/';

  var config = {
    entry: {
      'css/load-page': './css/scss/style-load.scss',
      'css/estilo-login': './css/scss/style-login.scss',
      'js/script-login': './js/script-login.js',
      'css/estilo-painel': './css/scss/style-painel.scss',
      'js/script-painel': './js/script-painel.js'
    },
    output: {
      filename: argv.mode === 'production' ? '[name].min.js' : '[name].js',
      path: __publicPath
    },
    optimization: {
      minimize: argv.mode === 'production',
      minimizer: [new TerserJSPlugin({})],
    },
    mode: 'development',
    devtool: argv.mode === 'production' ? 'source-map' : 'cheap-eval-source-map',
    devServer: {
      contentBase: __publicPath,
      compress: argv.mode === 'production',
      port: 9000,
      headers: {
        "Access-Control-Allow-Origin": "*",
        "Access-Control-Allow-Methods": "GET, POST",
        "Access-Control-Allow-Headers": "X-Requested-With, content-type, Authorization"
      }
      //open: 'chrome',
    },
    resolve: {
      alias: {
        modules: path.join(__dirname, "node_modules"),
      }
    },
    module: {
      rules: [
        {
          test: /\.(css)$/,
          use: [
            {
              loader: MiniCssExtractPlugin.loader
            },
            {
              loader: 'css-loader', // translates CSS into CommonJS modules
              options: {
                sourceMap: true,
              }
            }
          ]
        },
        {
          test: /\.(scss)$/,
          use: [
            {
              loader: MiniCssExtractPlugin.loader
            },
            {
              loader: 'css-loader', // translates CSS into CommonJS modules
              options: {
                sourceMap: true,
              }
            }, {
              loader: 'postcss-loader', // Run post css actions
              options: {
                sourceMap: true,
                plugins:
                  argv.mode === 'production' ?
                    [
                      require('precss'),
                      require('cssnano'),
                      require('autoprefixer')
                    ]
                    :
                    [
                      require('precss')
                    ]
                // post css plugins, can be exported to postcss.config.js
              }
            }, {
              loader: 'sass-loader', // compiles Sass to CSS
              options: {
                sourceMap: true,
                implementation: require('node-sass'),
                sassOptions: {
                  outputStyle: argv.mode === 'production' ? 'compressed' : ''
                }
              }
            }]
        },
        {
          test: /\.js$/,
          exclude: /node_modules/,
          use: {
            loader: 'babel-loader',
            options: {
              presets: ['@babel/preset-env'],
              cacheDirectory: true
            }
          }
        },
        {
          test: /\.(woff|woff2|eot|ttf)$/,
          loader: 'url-loader',
          options: {
            limit: false,
            name(filename) {
              var part_file = filename.split('\\');
              return 'fonts/' + part_file[part_file.length - 1];
            },
            publicPath: __baselurl
          }
        },
        {
          test: /\.(png|jpe?g|svg)$/i,
          use: [
            {
              loader: 'url-loader',
              options: {
                limit: false,
                name(filename) {
                  var part_file = filename.split('\\');
                  var len = part_file.length;

                  return 'img/' + part_file[len - 1];
                },
                publicPath: __baselurl
              }
            },
            {
              loader: 'img-loader',
              options: {
                plugins: argv.mode === 'production' && [
                  require('imagemin-mozjpeg')({
                    progressive: true,
                    arithmetic: false
                  }),
                  require('imagemin-pngquant')({
                    floyd: 0.5,
                    speed: 2
                  }),
                  require('imagemin-svgo')({
                    plugins: [
                      { removeTitle: true },
                      { convertPathData: false }
                    ]
                  })
                ]
              }
            }
          ]
        }
      ]
    },
    plugins: [
      new webpack.ContextReplacementPlugin(
        /jquery-validation[\/\\]dist[\/\\]localization$/,
        /messages_pt_BR\.min\.js/
      ),
      new MiniCssExtractPlugin({
        filename: argv.mode === 'production' ? '[name].min.css' : '[name].css',
        chunkFilename: '[id].css',
      }),
      new FixStyleOnlyEntriesPlugin(),
      new webpack.ProvidePlugin({
        //"$": 'jquery',
        "$": 'jquery-validation',
        //"window.jQuery": 'jquery',
        //"jQuery": "jquery",
      }),
      /*new GoogleFontsPlugin({
        fonts: [
          { family: "Montserrat", variants: ["400", "700"] }
        ],
        path: "fonts",
        // ...options
      })*/
    ]
  };

  if (argv.mode === 'production')
    config.plugins.push(
      new OptimizeCssAssetsPlugin({
        assetNameRegExp: /\.(css|scss)$/g,
        cssProcessorOptions: {
          map: { inline: false }
        }
      })
    );

  return config;
};

/*
module.exports = {

}*/