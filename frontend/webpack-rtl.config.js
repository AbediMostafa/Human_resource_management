import {deleteSync} from 'del';
import * as path from 'path';
import MiniCssExtractPlugin from "mini-css-extract-plugin"
import  RtlCssPlugin from "rtlcss-webpack-plugin";
import { fileURLToPath } from 'url';


/**
 * Main file of webpack config for RTL.
 * Please do not modified unless you know what to do
 */
// eslint-disable-next-line @typescript-eslint/no-var-requires
// const path = require("path");
// eslint-disable-next-line @typescript-eslint/no-var-requires
// const MiniCssExtractPlugin = require("mini-css-extract-plugin");
// eslint-disable-next-line @typescript-eslint/no-var-requires
// const del = require("del");
// eslint-disable-next-line @typescript-eslint/no-var-requires
// const RtlCssPlugin = require("rtlcss-webpack-plugin");

// global variables
const __filename = fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);
const rootPath = path.resolve(__dirname);
const distPath = rootPath + "/src/assets";

const entries = {
  "css/style": "./src/assets/sass/style.scss",
};

// remove older folders and files
(async () => {
  await deleteSync(distPath + "/css", { force: true });
})();

function mainConfig() {
  return {
    // enabled/disable optimizations
    mode: "development",
    // console logs output, https://webpack.js.org/configuration/stats/
    stats: "errors-only",
    performance: {
      // disable warnings hint
      hints: false,
    },
    entry: entries,
    output: {
      // main output path in assets folder
      path: distPath,
      // output path based on the entries' filename
      filename: "[name].js",
    },
    resolve: {
      extensions: [".scss"],
    },
    plugins: [
      new MiniCssExtractPlugin({
        filename: "[name].css",
      }),
      new RtlCssPlugin({
        filename: "[name].rtl.css",
      }),
      {
        apply: (compiler) => {
          // hook name
          compiler.hooks.afterEmit.tap("AfterEmitPlugin", () => {
            (async () => {
              await deleteSync(distPath + "/css/*.js", { force: true });
            })();
          });
        },
      },
    ],
    module: {
      rules: [
        {
          test: /\.scss$/,
          use: [
            MiniCssExtractPlugin.loader,
            "css-loader",
            {
              loader: "sass-loader",
              options: {
                sourceMap: true,
              },
            },
          ],
        },
      ],
    },
  };
}

export default function () {
  return [mainConfig()];
};
// module.exports = function () {
//   return [mainConfig()];
// };
