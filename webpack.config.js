// const path = require('path');
// const HtmlWebpackPlugin = require('html-webpack-plugin');

// module.exports = {
//   entry: './src/index.js', // Entry point
//   output: {
//     path: path.resolve(__dirname, 'dist'),
//     filename: 'bundle.js', // Bundle filename
//   },
//   mode: 'development', // Development mode
//   devServer: {
//     static: {
//       directory: path.join(__dirname, 'dist'), // This is the correct way to serve static files
//     },
//     compress: true,
//     port: 3001, // Runs the server on localhost:3000
//     open: true, // Open browser automatically
//   },
//   plugins: [
//     new HtmlWebpackPlugin({
//       template: './src/index.html', // Template HTML file
//     }),
//   ],
// };

const path = require('path');
const HtmlWebpackPlugin = require('html-webpack-plugin');
const glob = require('glob'); // Import glob to dynamically find HTML files

module.exports = {
  entry: {
    index: './src/index.js',  // Correct relative path to your JS entry point
    // Add other entries as needed
  },
  output: {
    path: path.resolve(__dirname, 'dist'),
    filename: '[name].bundle.js', // This will create bundles named after the entry points
  },
  mode: 'development', // Development mode
  devServer: {
    static: {
      directory: path.join(__dirname, 'dist'), // Serve files from dist folder
    },
    compress: true,
    port: 3001, // Runs the server on localhost:3001
    open: true, // Open browser automatically
  },
  plugins: [
    // Automatically generate an HTML file for each HTML template in the src folder
    ...glob.sync('./src/*.html').map((file) => {
      const filename = path.basename(file);
      const name = path.basename(file, '.html');

      return new HtmlWebpackPlugin({
        template: file,  // Template HTML file
        filename: filename, // Output file name
        chunks: [name], // Inject the corresponding JS file for this HTML file
      });
    }),
  ],
};

