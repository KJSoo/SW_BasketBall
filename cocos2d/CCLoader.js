/****************************************************************************
 Copyright (c) 2010-2012 cocos2d-x.org
 Copyright (c) 2008-2010 Ricardo Quesada
 Copyright (c) 2011      Zynga Inc.

 http://www.cocos2d-x.org

 Permission is hereby granted, free of charge, to any person obtaining a copy
 of this software and associated documentation files (the "Software"), to deal
 in the Software without restriction, including without limitation the rights
 to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 copies of the Software, and to permit persons to whom the Software is
 furnished to do so, subject to the following conditions:

 The above copyright notice and this permission notice shall be included in
 all copies or substantial portions of the Software.

 THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 THE SOFTWARE.
 ****************************************************************************/

/**
 * A class to pre-load resources before engine start game main loop.
 * @class
 * @extends cc.Class
 */
cc.Loader = cc.Class.extend(/**  @lends cc.Loader# */{
    resourceCount:0,
    loadedResourceCount:0,
    timer:0,

    /**
     *  Check the loading status
     */
    isLoadedComplete:function () {
        var loaderCache = cc.Loader.getInstance();
        if (loaderCache.loadedResourceCount == loaderCache.resourceCount) {
            if (loaderCache.onload) {
                loaderCache.timer = setTimeout(loaderCache.onload, 16);
            } else {
                cc.Assert(0, "cocos2d:no load callback defined");
            }
        } else {
            if (loaderCache.onloading) {
                loaderCache.timer = setTimeout(loaderCache.onloading, 16);
            }
            else {
                cc.LoaderScene.getInstance().draw();
            }
            loaderCache.timer = setTimeout(loaderCache.isLoadedComplete, 16);
        }
    },

    /**
     * Callback when loading resource error
     * @param {String} name
     * @example
     * //example
     * cc.Loader.getInstance().onResLoadingErr(name);
     */
    onResLoadingErr:function (name) {
        cc.log("cocos2d:Failed loading resource: " + name);
    },

    /**
     *Callback when a resource file loaded.
     * @example
     * //example
     * cc.Loader.getInstance().onResLoaded();
     */
    onResLoaded:function () {
        this.loadedResourceCount++;
    },

    /**
     *  For loading percentage
     *  You can use this method to create a custom loading screen.
     * @return {Number}
     * @example
     * //example
     * cc.log(cc.Loader.getInstance().getProgressBar() + "%");
     */
    getProgressBar:function () {
        var per = this.loadedResourceCount / this.resourceCount;
        per = 0 | (per * 100);
        return per;
    },

    /**
     * status when resources loading success
     * @example
     *  //example
     * cc.Loader.getInstance().onload = function () {
     *      cc.AppController.shareAppController().didFinishLaunchingWithOptions();
     * };
     */
    onload:undefined,

    /**
     *  status when res loading error
     * @example
     * //example
     * cc.Loader.getInstance().onerror = function () {
     *      //do something
     * };
     */
    onerror:undefined,

    /**
     *  status when res loading
     * @example
     * //example
     * cc.Loader.getInstance().onloading = function () {
     *       cc.LoaderScene.getInstance().draw();
     * };
     */
    onloading:undefined,

    _registerFaceFont:function (fontRes) {
        var srcArr = fontRes.srcArr;
        if (fontRes.srcArr && srcArr.length > 0) {
            var fontStyle = document.createElement("style");
            fontStyle.type = "text/css";
            document.body.appendChild(fontStyle);

            var fontStr = "@font-face { font-family:" + fontRes.fontName + "; src:";
            for (var i = 0; i < srcArr.length; i++) {
                fontStr += "url('" + encodeURI(srcArr[i].src) + "') format('" + srcArr[i].type + "')";
                fontStr += (i == (srcArr.length - 1)) ? ";" : ",";
            }
            fontStyle.textContent += fontStr + "};";
        }
        cc.Loader.getInstance().onResLoaded();
    },

    /**
     * Pre-load the resources before engine start game main loop.
     * There will be some error without pre-loading resources.
     * @param {object} res
     * @example
     * //example
     * var res = [
     *               {type:"image", src:"hello.png"},
     *               {type:"tmx", src:"hello.tmx"}
     *     ]
     * cc.Loader.getInstance().preload(res);
     */
    preload:function (res) {
        var sharedTextureCache = cc.TextureCache.getInstance();
        var sharedEngine = cc.AudioEngine.getInstance();
        var sharedParser = cc.SAXParser.getInstance();
        var sharedFileUtils = cc.FileUtils.getInstance();

        this.loadedResourceCount = 0;
        this.resourceCount = res.length;
        for (var i = 0; i < res.length; i++) {
            switch (res[i].type) {
                case "image":
                    sharedTextureCache.addImage(res[i].src);
                    break;
                case "sound":
                    sharedEngine.preloadSound(res[i].src);
                    break;
                case "plist":
                case "tmx":
                case "fnt":
                    sharedParser.preloadPlist(res[i].src);
                    break;
                case "tga":
                    //cc.log("cocos2d:not implemented yet")
                    break;
                case "ccbi":
                case "binary":
                    sharedFileUtils.preloadBinaryFileData(res[i].src);
                    break;
                case "face-font":
                    this._registerFaceFont(res[i]);
                    break;
                default:
                    throw "cocos2d:unknow type : " + res[i].type;
                    break;
            }
        }
        this.isLoadedComplete();
    }
});

/**
 * Share Loader
 * @return {cc.Loader}
 */
cc.Loader.getInstance = function () {
    if (!this._instance) {
        this._instance = new cc.Loader();
    }
    return this._instance;
};
cc.Loader._instance = null;

/**
 * Default loading screen, you can customize the loading screen.
 * @class
 * @extends cc.Class
 */
cc.LoaderScene = cc.Class.extend(/**  @lends cc.LoaderScene# */{
    _logo:new Image(),

    /**
     * Constructor
     */
    ctor:function () {
        this._logo.src = "data:image/jpeg;base64,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";

        this._logo.width = 35;
        this._logo.height = 35;
    },

    /**
     * Draw loading screen
     */
    draw:function () {
        var logoWidth = (cc.canvas.width - this._logo.width) / 2;
        var logoHeight = (cc.canvas.height - this._logo.height) / 2;
        cc.renderContext.clearRect(0, -cc.canvas.height, cc.canvas.width, cc.canvas.height);
        cc.renderContext.fillStyle = "#ffffff";
        cc.renderContext.fillRect(0, -cc.canvas.height, cc.canvas.width, cc.canvas.height);
        cc.drawingUtil.drawImage(this._logo, cc.p(logoWidth, logoHeight));
        cc.renderContext.fillStyle = "#000000";
        cc.renderContext.font = 'Bold 12px Verdana';
        cc.renderContext.textAlign = 'left';
        cc.drawingUtil.fillText("Loading " + cc.Loader.getInstance().getProgressBar() + "%", logoWidth-10, logoHeight - 15);
    }
});

/**
 * Shared loader scene
 * @return {cc.LoaderScene}
 */
cc.LoaderScene.getInstance = function () {
    if (!this._instance) {
        this._instance = new cc.LoaderScene();
    }
    return this._instance;
};

cc.LoaderScene._instance = null;