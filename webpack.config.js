const CopyPlugin = require('copy-webpack-plugin');
const FixStyleOnlyEntriesPlugin = require('webpack-fix-style-only-entries');
const HandlebarsPlugin = require('handlebars-webpack-plugin');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const OptimizeCssAssetsPlugin = require('optimize-css-assets-webpack-plugin');
const TerserPlugin = require('terser-webpack-plugin');
const autoprefixer = require('autoprefixer');
const path = require('path');

const paths = {
	src: {
		fonts: './assets/fonts/src',
		js: './assets/js/src',
		scss: './assets/scss'
	},
	dist: {
		css: './assets/css',
		fonts: './assets/fonts',
		js: './assets/js'
	}
};

module.exports = {
	devtool: 'source-map',
	entry: {
		theme: [ paths.src.js + '/theme.js', paths.src.scss + '/theme.scss', paths.src.scss + '/libs.scss' ]
	},
	mode: 'development',
	module: {
		rules: [
			{
				test: /\.(sass|scss)$/,
				include: path.resolve(__dirname, paths.src.scss.slice(2)),
				use: [
					{
						loader: MiniCssExtractPlugin.loader
					},
					{
						loader: 'css-loader',
						options: {
							url: false
						}
					},
					{
						loader: 'postcss-loader',
						options: {
							plugins: function() {
								return [ require('autoprefixer') ];
							}
						}
					},
					{
						loader: 'sass-loader'
					}
				]
			}
		]
	},
	optimization: {
		splitChunks: {
			cacheGroups: {
				vendor: {
					test: /[\\/](node_modules)[\\/].+\.js$/,
					name: 'vendor',
					chunks: 'all'
				}
			}
		},
		minimizer: [
			new OptimizeCssAssetsPlugin({
				cssProcessorOptions: {
					map: {
						inline: false
					}
				},
				cssProcessorPluginOptions: {
					preset: [
						'default',
						{
							discardComments: {
								removeAll: true
							}
						}
					]
				}
			}),
			new TerserPlugin({
				extractComments: false,
				terserOptions: {
					output: {
						comments: false
					}
				}
			})
		]
	},
	output: {
		filename: './assets/js/[name].bundle.js',
		path: path.resolve(__dirname, '')
	},
	plugins: [
		new CopyPlugin({
			patterns: [
				{
					from: paths.src.fonts,
					to: paths.dist.fonts
				}
			]
		}),
		new FixStyleOnlyEntriesPlugin(),
		new MiniCssExtractPlugin({
			filename: './assets/css/wpchill-style.bundle.css',
			path: path.resolve(__dirname, '')
		})
	]
};
