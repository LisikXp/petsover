/**********************************************************************************
            Funções uteis 
            Copyright (c) 2013 Tuyoshi Vinicius (tuyoshi_vinicius@hotmail.com))
            Version: 1.1
            ***********************************************************************************/
            $(function() {
                __IMAGE_LOADING = "";
                PcDialog = function(c, a, b, d, f, h, k, l, e, g) {
                    a = null == a ? "PictureCutDialog" + Math.round(99 * Math.random()) : a;
                    $dialog = $("<div></div>").attr({
                        id: a
                    });
                    if (0 < $("#" + a).size()) {
                        return !1
                    }
                    $dialog.css({
                        overflow: "hidden",
                        "background-image": "url(" + __IMAGE_LOADING + ")",
                        "background-repeat": "no-repeat",
                        "background-position": "center"
                    });
                    $("body").prepend($dialog);
                    $dialog.dialog({
                        draggable: k,
                        modal: h,
                        width: d,
                        height: f,
                        title: b,
                        resizable: l,
                        zIndex: 100,
                        close: function(a, b) {
                            $(this).dialog("destroy").remove()
                        }
                    });
                    e = null == e ? {} : e;
                    $.post(c, e, function(a) {
                        $dialog.html(a);
                        $dialog.css({
                            "background-image": "none"
                        });
                        "function" == typeof g && g.call(this, $dialog)
                    })
                };
                PcAlert = function(c, a, b) {
                    b = "undefined" == typeof b ? function() {} : b;
                    a = "undefined" == typeof b ? "" : a;
                    $Dialog = $('<div id="dialog-PcAlert" ></div>').html(c).css({
                        padding: "15px",
                        "max-height": 405,
                        overflow: "auto"
                    });
                    $("body").prepend($Dialog);
                    $Dialog.dialog({
                        modal: !0,
                        resizable: 1,
                        zIndex: 100,
                        width: 450,
                        title: a,
                        buttons: {
                            Ok: function() {
                                $(this).dialog("destroy").remove();
                                "function" == typeof b && b.call(this)
                            }
                        },
                        beforeClose: function(a, b) {
                            $(this).dialog("destroy").remove()
                        }
                    })
                };
                PcLoading = {
                    show: function(c, a) {
                        var b = $("<div id='dialog-UiConfirm' ></div>");
                        c = "undefined" == typeof c ? "Wait..." : c;
                        a = "undefined" == typeof a ? "Wait!" : a;
                        var d = $("<div></div>").css("margin", "15px"),
                        f = $("<img src='" + __IMAGE_LOADING + "' >").css({
                            "float": "left",
                            "margin-right": "20px",
                            "margin-top": "-5px"
                        });
                        $MsgContent = $("<div>" + c + "</div>");
                        d.append(f).append($MsgContent);
                        b.append(d);
                        $("body").prepend(b);
                        b.dialog({
                            modal: !0,
                            resizable: !1,
                            zIndex: 100,
                            width: 450,
                            title: a,
                            create: function(a, b) {
                                $(this).parent().children(".ui-dialog-titlebar").children(".ui-dialog-titlebar-close").hide()
                            }
                        })
                    },
                    hide: function() {
                        var c = $("#dialog-UiConfirm");
                        0 < c.size() && c.dialog("destroy").remove()
                    }
                }
            });
/**********************************************************************************
            uploadAjax plugin para jQuery
            Copyright (c) 2013 Tuyoshi Vinicius (tuyoshi_vinicius@hotmail.com))
            Version: 1.3
            ***********************************************************************************/
            (function(a) {
                var f;
                a.fn.uploadAjax = function(g) {
                    var b = a.extend({
                        accept: /^(jpg|png|gif)/gi,
                        acceptEx: "",
                        name: "file",
                        method: "POST",
                        url: "/",
                        data: !1,
                        onSubmit: function() {
                            return !0
                        },
                        onComplete: function() {
                            return !0
                        },
                        extError: function() {
                            return !1
                        }
                    }, g);
                    return this.each(function() {
                        var e = a(this);
                        e.css("position", "relative");
                        e.setData = function(a) {
                            b.data = a
                        };
                        var c = a('<form  method="' + b.method + '" enctype="multipart/form-data" action="' + b.url + '"> <input name="' + b.name + '" type="file" accept="' + b.acceptEx + '" /></form>'),
                        h = c.find("input[name=" + b.name + "]");
                        h.css({
                            display: "block",
                            position: "absolute",
                            left: 0,
                            top: 0,
                            width: e.width(),
                            height: e.height(),
                            "font-size": "100pt",
                            cursor: "hand",
                            opacity: 0,
                            filter: "alpha(opacity=0)",
                            "z-index": 10,
                            "cursor": "pointer",
                            overflow: "hidden"
                        }).attr("title", "Choose a picture");
                        h.on("change", function(d) {
                            d = h.val().replace(/C:\\fakepath\\/i, "");
                            d = d.substring(d.lastIndexOf(".") + 1);
                            if (!b.accept.test(d)) {
                                return b.extError.call(e, this), c.get(0).reset(), !1
                            }
                            c.find("input[type=hidden]").remove();
                            b.onSubmit.call(e, a(this));
                            b.data && a.each(b.data, function(b, d) {
                                c.append(a('<input type="hidden" name="' + b + '" value="' + d + '">'))
                            });
                            c.submit();
                            a(c).find("input[type=file]").attr("disabled", "disabled")
                        });
                        a(e).append(c);
                        f || (f = a('<iframe id="picture-element-iframe" name="picture-element-iframe"></iframe>').attr("style", 'style="width:0px;height:0px;border:0px solid #fff;"').hide(), f.attr("src", ""), a(document.body).append(f));
                        var g = function() {
                            a(c).find("input[type=file]").removeAttr("disabled");
                            var d = a(this).contents().find("html body").text();
                            a(c).get(0).reset();
                            b.onComplete.call(e, d);
                            f.unbind()
                        };
                        c.submit(function(a) {
                            f.load(g);
                            c.attr("target", "picture-element-iframe");
                            a.stopPropagation()
                        })
                    })
                }
            })(jQuery);
/**********************************************************************************
            PictureCut plugin para jQuery
            Copyright (c) 2013 Tuyoshi Vinicius (tuyoshi_vinicius@hotmail.com))
            Version: 1.1
            ***********************************************************************************/
            (function($) {
                var maxFiles = 4;
                var dataArray = [];
                var methods = {
                    clear: function(Options) {
                        return this.each(function() {
                            var InputOfImageDirectory = $(this).find(".picture-element-image-directory");
                            InputOfImageDirectory.val("").change()
                        })
                    },
                    init: function(Options) {
                        var OptionsIfEmpty = {
                            ActionToSubmitUpload: "src/php/upload.php",
                            ActionToSubmitCrop: "src/php/crop.php",
                            DefaultImageButton: "src/img/add.svg"
                        };
                        var defaults = {
                            Extensions: ["jpg", "png", "gif"],
                            InputOfImageDirectory: "image",
                            InputOfImageDirectoryAttr: {},
                            InputOfFile: "",
                            ActionToSubmitUpload: "",
                            ActionToSubmitCrop: "",
                            FolderOnServer: "",
                            ThumbFolderOnServer: "",
                            DataPost: {},
                            DefaultImageButton: "",
                            EnableCrop: false,
                            EnableResize: true,
                            MinimumWidthToResize: 630,
                            MinimumHeightToResize: 630,
                            MaximumSize: 1024,
                            EnableMaximumSize: false,
                            PluginFolderOnServer: "",
                            CropWindowStyle: "bootstrap",
                            ImageNameRandom: true,
                            EnableButton: false,
                            ImageButtonCSS: {
                                border: "1px #CCC dashed",
                                width: 80,
                                height: 80
                            },
                            CropModes: {
                                widescreen: true,
                                letterbox: true,
                                free: true
                            },
                            CropOrientation: true,
                            UploadedCallback: function(response) {
                              console.log(response.options.FolderOnServer+response.currentFileName);
                              dataArray.push(response.options.FolderOnServer+response.currentFileName);
                              $('#result').append('<div class="attach-image" id="attach_image_'+dataArray.length+'">\
                                <img src="'+response.options.FolderOnServer+response.currentFileName+'" alt="" class="image ">\
                                <button class="attach-image-close">\
                                <img src="img/red-cross.svg" alt="" class="image">\
                                </button>\
                                </div>');
                              if((dataArray.length) == maxFiles) {
                                $('#container_image').css('display', 'none');
                            }
                        }
                    };
                    if (Options.ImageButtonCSS != undefined) Options.ImageButtonCSS = $.extend(defaults.ImageButtonCSS, Options.ImageButtonCSS);
                    var Options = $.extend(defaults, Options);
                    if (Options.CropModes != undefined) Options.CropModes = $.extend(defaults.CropModes, Options.CropModes);
                    if (Options.FolderOnServer == "") {
                        alert("ATTENTION:\nFolderOnServer parameter must be set");
                        return false
                    };
                    if (Options.PluginFolderOnServer == "") {
                        alert("ATTENTION:\nPluginFolderOnServer parameter must be set");
                        return false
                    } else {
                        if (Options.PluginFolderOnServer.length > 0) {
                            if (Options.PluginFolderOnServer.charAt(Options.PluginFolderOnServer.length - 1) != "/") Options.PluginFolderOnServer += "/";
                            if (Options.PluginFolderOnServer.charAt(0) != "/") {
                                Options.PluginFolderOnServer = "/" + Options.PluginFolderOnServer
                            }
                        }
                    };
                    Options.ActionToSubmitUpload = (Options.ActionToSubmitUpload == "") ? Options.PluginFolderOnServer + OptionsIfEmpty.ActionToSubmitUpload : Options.ActionToSubmitUpload;
                    Options.ActionToSubmitCrop = (Options.ActionToSubmitCrop == "") ? Options.PluginFolderOnServer + OptionsIfEmpty.ActionToSubmitCrop : Options.ActionToSubmitCrop;
                    Options.DefaultImageButton = (Options.DefaultImageButton == "") ? Options.PluginFolderOnServer + OptionsIfEmpty.DefaultImageButton : Options.DefaultImageButton;
                    Options.CropWindowStyle = Options.CropWindowStyle.toLowerCase();
                    if (Options.InputOfFile == "") {
                        Options.InputOfFile = "file-" + Options.InputOfImageDirectory
                    };
                    __IMAGE_LOADING = Options.PluginFolderOnServer + "src/img/ajaxloader.gif";
                    if (Options.PastaCrop != undefined) Options.PluginFolderOnServer = Options.PastaCrop;
                    if (Options.CropWindowStyle.toLowerCase() == "bootstrap") {
                        var id = "picture_element_css_to_bootstrap";
                        if ($("#" + id).size() == 0) {
                            $('<link/>', {
                                id: id,
                                rel: 'stylesheet',
                                type: 'text/css',
                                href: Options.PluginFolderOnServer + 'src/windows/JanelaBootstrap/jquery-ui-1.10.0.custom.css'
                            }).appendTo('head')
                        }
                    };
                    var basic_dependence_css_id = "picture_basic_dependence_css";
                    if ($("#" + basic_dependence_css_id).size() == 0) {
                        $('<style type="text/css" id="' + basic_dependence_css_id + '">' + ".picture-element-principal{background:url(" + Options.DefaultImageButton + ") no-repeat 50% 50%}" + ".picture-dropped{border:2px #666 dashed!important;}" + '</style>').appendTo('head')
                    };
                    return this.each(function() {
                        var Elemento;
                        var CropWindowStyle = {
                            "jqueryui": "src/windows/window.jqueryui.php",
                            "popstyle": "src/windows/window.popstyle.php",
                            "bootstrap": "src/windows/window.bootstrap.php"
                        };
                        var $EnableButton;
                        JpaneDialogCrop = function(action, titulo, w, h, wmodal, drag, resize, post, Call) {
                            var Jid = "JtuyoshiCrop";
                            $dialog = $("<div id='" + Jid + "' class='JtuyoshiContainerElement' ></div>");
                            var posx = ($(window).width() - w) / 2;
                            var posy = ($(window).height() - h) / 2;
                            $dialog.css({
                                "position": "absolute",
                                "left": posx,
                                "top": posy,
                                "width": w,
                                "height": h,
                                "border": "1px #CCC solid",
                                "background-color": "#FFF",
                                "background-image": "url(" + __IMAGE_LOADING + ")",
                                "background-repeat": "no-repeat",
                                "background-position": "center",
                                "z-index": 600,
                                "-webkit-box-shadow": "0px 0px 80px 0px rgba(0, 0, 0, 0.7)",
                                "box-shadow": "0px 0px 80px 0px rgba(0, 0, 0, 0.7)"
                            });
                            var $modal = $("<div id='JtuyoshiCrop_model' />").css({
                                "position": "absolute",
                                "left": 0,
                                "top": 0,
                                "width": "100%",
                                "height": "100%",
                                "border": "1px #CCC solid",
                                "background-image": "url(" + __IMAGE_LOADING + ")",
                                "background-image": "url(" + Options.PluginFolderOnServer + "src/img/fundo_crop.png)",
                                "z-index": 598
                            });
                            if (wmodal) $("body").append($modal);
                            $("body").append($dialog);
                            $.post(action, post, function(data) {
                                $dialog.html(data);
                                $dialog.css({
                                    "background-image": "none"
                                });
                                if (typeof Call == "function") Call.call(this, $dialog)
                            })
                        };
                        var TuyoshiCrop = function(element, response) {
                            var response = response;
                            var MontarSelecaoRecorte = function(SelecaoRecorte, state) {
                                var ElemSelectProporcao,ElemSelectOrientacao;
                                var Swidth = (response.currentWidth / 2) * 2;
                                var Sheight = (Swidth / 2) * 2;
                                SelecaoRecorte.css({
                                    "width": Swidth,
                                    "height": Sheight,
                                    "left": (response.currentWidth - Swidth) / 2,
                                    "top": (response.currentHeight - Sheight) / 2
                                });
                                SelecaoRecorte.resizable({
                                    containment: "parent",
                                                aspectRatio: 1,//InitRatio,
                                                minWidth: (Swidth / 100) * 10,
                                                minHeight: (Sheight / 100) * 10
                                            })
                                ElemSelectProporcao = $("#JtuyoshiCrop #SelectProporcao");
                                ElemSelectOrientacao = $("#JtuyoshiCrop #SelectOrientacao");
                                if (state == "create") {                            
                                    if (Options.CropModes.widescreen || Options.CropModes.letterbox || Options.CropModes.free) {
                                        ElemSelectProporcao.show()
                                    } else {
                                        ElemSelectProporcao.hide();
                                        ElemSelectOrientacao.parent().hide();
                                        ElemSelectOrientacao.hide();
                                        ElemSelectOrientacao.parent().hide()
                                        }; /*if (Options.CropModes.widescreen) ElemSelectProporcao.append($('<option value="wide">16:9</option>'));
                                        if (Options.CropModes.letterbox) ElemSelectProporcao.append($('<option value="box">4:3</option>'));
                                        if (Options.CropModes.free) ElemSelectProporcao.append($('<option value="livre">Free</option>'));
                                        if (Options.CropModes.widescreen || Options.CropModes.letterbox && (Options.CropOrientation)) {
                                            ElemSelectOrientacao.append('<option value="Horizontal">Landscape</option>').append('<option value="Vertical">Portrait</option>  ')
                                        } else {
                                            ElemSelectOrientacao.append('<option value="Horizontal" selected>Portrait</option>');
                                            ElemSelectOrientacao.hide();
                                            ElemSelectOrientacao.parent().hide()
                                        }; if (ElemSelectProporcao.find("option").size() > 0) {
                                            ElemSelectProporcao.find("option:first-child").attr("selected", "selected")
                                        };*/
                                        SelecaoRecorte.draggable({
                                            containment: "parent"
                                        });
                                        if (ElemSelectProporcao.val() == "livre") {
                                            Swidth = (response.currentWidth / 100) * 100;
                                            Sheight = Swidth;
                                            SelecaoRecorte.css({
                                                "width": Swidth,
                                                "height": Sheight,
                                                "left": (response.currentWidth - Swidth) / 2,
                                                "top": (response.currentHeight - Sheight) / 2
                                            });
                                            SelecaoRecorte.resizable({
                                                containment: "parent",
                                                aspectRatio: 1,
                                                minWidth: (Swidth / 100) * 10,
                                                minHeight: (Sheight / 100) * 10
                                            })
                                        } else {
                                            var InitRatio = 0;
                                            if (ElemSelectProporcao.val() == "wide") {
                                                InitRatio = 16 / 9;
                                                Swidth = (response.currentWidth / 100) * 80;
                                                Sheight = (Swidth / 16) * 9
                                            } else {
                                                InitRatio = 1 / 1;
                                                Swidth = (response.currentWidth / 100) * 100;
                                                Sheight = (Swidth / 1) * 1
                                            };
                                            SelecaoRecorte.css({
                                                "width": Swidth,
                                                "height": Sheight,
                                                "left": (response.currentWidth - Swidth) / 2,
                                                "top": (response.currentHeight - Sheight) / 2
                                            });
                                            SelecaoRecorte.resizable({
                                                containment: "parent",
                                                aspectRatio: 1,//InitRatio,
                                                minWidth: (Swidth / 100) * 10,
                                                minHeight: (Sheight / 100) * 10
                                            })
                                        }
                                    };
                                    if (Sheight > response.currentHeight) {
                                        Sheight = (response.currentHeight / 100) * 100;
                                        Swidth = (Sheight * 16) / 9;
                                        SelecaoRecorte.css({
                                            "width": Swidth,
                                            "height": Sheight,
                                            "left": (response.currentWidth - Swidth) / 2,
                                            "top": (response.currentHeight - Sheight) / 2
                                        });                                                                            
                                    };
                                    ElemSelectProporcao.change();
                                };
                                var Redimencionar_Janela = function() {
                                    if ((response.currentWidth + 80) > 410) {
                                        if (Options.CropWindowStyle == "jqueryui") {
                                            $("#JtuyoshiCrop").dialog("option", {
                                                "width": response.currentWidth + 40,
                                                "height": response.currentHeight + 110
                                            });
                                            $("#JtuyoshiCrop").dialog("option", "position", {
                                                my: "center",
                                                at: "center",
                                                of: window
                                            })
                                        } else if (Options.CropWindowStyle == "popstyle") {
                                            var posx = ($(window).width() - response.currentWidth) / 2;
                                            var posy = ($(window).height() - response.currentHeight) / 2;
                                            $("#JtuyoshiCrop").css({
                                                "width": response.currentWidth,
                                                "height": response.currentHeight,
                                                "left": posx,
                                                "top": posy
                                            })
                                        } else if (Options.CropWindowStyle == "bootstrap") {
                                            $("#JtuyoshiCrop").dialog("option", {
                                                "width": response.currentWidth + 40,
                                                "height": response.currentHeight + 130
                                            });
                                            $("#JtuyoshiCrop").dialog("option", "position", {
                                                my: "center",
                                                at: "center",
                                                of: window
                                            })
                                        }
                                    } else {
                                        if (Options.CropWindowStyle == "jqueryui") {
                                            $("#JtuyoshiCrop").dialog("option", {
                                                "width": 410,
                                                "height": response.currentHeight + 110
                                            });
                                            $("#JtuyoshiCrop").dialog("option", "position", {
                                                my: "center",
                                                at: "center",
                                                of: window
                                            })
                                        } else if (Options.CropWindowStyle == "popstyle") {
                                            var posx = ($(window).width() - 410) / 2;
                                            var posy = ($(window).height() - response.currentHeight) / 2;
                                            $("#JtuyoshiCrop").css({
                                                "width": 410,
                                                "height": response.currentHeight,
                                                "left": posx,
                                                "top": posy
                                            })
                                        } else if (Options.CropWindowStyle == "bootstrap") {
                                            $("#JtuyoshiCrop").dialog("option", {
                                                "width": 410,
                                                "height": response.currentHeight + 130
                                            });
                                            $("#JtuyoshiCrop").dialog("option", "position", {
                                                my: "center",
                                                at: "center",
                                                of: window
                                            })
                                        }
                                    }
                                };
                                var Dborder = 2;
                                var Carregar_Imagem = function(Principal, Imagem) {
                                    Principal.css({
                                        "border": Dborder + "px #ccc solid",
                                        "width": response.currentWidth,
                                        "height": response.currentHeight
                                    });
                                    Imagem.css({
                                        "width": response.currentWidth,
                                        "height": response.currentHeight
                                    }).attr("src", Options.FolderOnServer + response.currentFileName + "?" + Math.round(Math.random() * 9999))
                                };
                                var JpaneDialogCallBack = function() {
                                    $.getScript(Options.PluginFolderOnServer + "src/windows/core/window.pc.js");
                                    var Principal = $("#JtuyoshiCrop #Principal");
                                    var Imagem = $("<img />");
                                    Principal.append(Imagem);
                                    Carregar_Imagem(Principal, Imagem);
                                    MontarSelecaoRecorte($("#JtuyoshiCrop #SelecaoRecorte"), "create");
                                    Redimencionar_Janela();
                                    $("#JtuyoshiCrop #button_crop_original").bind("click", function() {
                                        Retorno_Requisicao(element, response, 1);
                                        
                                    });
                                    $("#JtuyoshiCrop #button_crop_recortar").bind("click", function() {
                                        var thisRecort = $(this);
                                        thisRecort.attr("disabled", "disabled");
                                        PcLoading.show();
                                        var data = response;
                                        data["request"] = "crop";
                                        data["folderOnServer"] = Options.FolderOnServer;
                                        data["inputOfFile"] = Options.InputOfFile;
                                        data["maximumSize"] = Options.MaximumSize;
                                        data["enableMaximumSize"] = Options.EnableMaximumSize;
                                        data["toCropImgX"] = $("#JtuyoshiCrop #SelecaoRecorte").position().left;
                                        data["toCropImgY"] = $("#JtuyoshiCrop #SelecaoRecorte").position().top;
                                        data["toCropImgW"] = $("#JtuyoshiCrop #SelecaoRecorte").width();
                                        data["toCropImgH"] = $("#JtuyoshiCrop #SelecaoRecorte").height();
                                        data["currentFileName"] = response["currentFileName"].substring(response["currentFileName"].lastIndexOf('/') + 1);
                                        var url = (Options.ActionToSubmitCrop == "") ? Options.ActionToSubmitUpload : Options.ActionToSubmitCrop;
                                        $.post(url, data, function(data) {
                                            thisRecort.removeAttr("disabled");
                                            PcLoading.hide();
                                            response = data;
                                            response.currentWidth = parseInt(response.currentWidth);
                                            response.currentHeight = parseInt(response.currentHeight);
                                            Carregar_Imagem(Principal, Imagem);
                                            MontarSelecaoRecorte($("#JtuyoshiCrop #SelecaoRecorte"));
                                            Redimencionar_Janela()
                                        }, "JSON")
                                    })
                                };
                                if (Options.CropWindowStyle == "jqueryui") PcDialog(Options.PluginFolderOnServer + CropWindowStyle[Options.CropWindowStyle], "JtuyoshiCrop", "Crop image", 900, 555, true, true, false, null, JpaneDialogCallBack);
                                else if (Options.CropWindowStyle == "popstyle") JpaneDialogCrop(Options.PluginFolderOnServer + CropWindowStyle[Options.CropWindowStyle], "Crop image", 980, 555, true, false, false, null, JpaneDialogCallBack);
                                else if (Options.CropWindowStyle == "bootstrap") PcDialog(Options.PluginFolderOnServer + CropWindowStyle[Options.CropWindowStyle], "JtuyoshiCrop", "Crop image", 900, 555, true, true, false, null, JpaneDialogCallBack)
                            };
                        var Construir_Widget = function(element) {
                            element.css($.extend(Options.ImageButtonCSS, {
                                "position": "relative",
                                "cursor": "pointer",
                                "overflow": "hidden"
                            })).addClass("picture-element-principal");
                            element.on('dragenter', function(e) {
                                if ($(e.target).attr("name") == Options.InputOfFile) {
                                    element.addClass("picture-dropped")
                                } else {
                                    element.removeClass("picture-dropped")
                                };
                                e.stopPropagation();
                                e.preventDefault()
                            });
                            $(document).on('drop dragend', function(e) {
                                console.log(element);
                                element.removeClass("picture-dropped");
                                e.stopPropagation()
                            });
                            element.on("mouseout", function(e) {
                                element.removeClass("picture-dropped");
                                e.stopPropagation()
                            });
                            var $image = $("<img src='data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==' class='picture-element-image'>");
                            $image.css({
                                "position": "relative",
                                "cursor": "pointer"
                            });
                            $image.css({
                                "height": Options.ImageButtonCSS.height
                            });
                            //element.append($image);

                            var $inputHidden = $("<input type='hidden' name='" + Options.InputOfImageDirectory + "' id='" + Options.InputOfImageDirectory + "'>");
                            $inputHidden.addClass("picture-element-image-directory");
                            element.append($inputHidden);
                            $inputHidden.attr(Options.InputOfImageDirectoryAttr);
                            $inputHidden.bind('change', function() {
                                if ($(this).val() != "") {
                                    var image_thumb;
                                    if (Options.ThumbFolderOnServer != "") image_thumb = Options.ThumbFolderOnServer + $(this).val().substring($(this).val().lastIndexOf("/") + 1);
                                    else image_thumb = Options.FolderOnServer + $(this).val().substring($(this).val().lastIndexOf("/") + 1);
                                    $image.removeAttr("style");
                                    $image.css({
                                        "position": "relative",
                                        "cursor": "pointer"
                                    });
                                    $image.attr("src", image_thumb);
                                    if (Options.EnableButton) {
                                        $EnableButton.unbind("click").bind("click", function() {
                                            $inputHidden.val("").change()
                                        }).val("Remove Picture")
                                    };
                                    $image.on("load", function() {
                                        console.log("load");
                                        if ($(this).height() < $(this).width()) {
                                            $(this).css({
                                                "height": Options.ImageButtonCSS.height
                                            });
                                            $(this).css({
                                                "width": "none"
                                            })
                                        } else if ($(this).width() < $(this).height()) {
                                            $(this).css({
                                                "width": Options.ImageButtonCSS.width
                                            });
                                            $(this).css({
                                                "height": "none"
                                            })
                                        } else {
                                            $(this).css({
                                                "width": Options.ImageButtonCSS.width
                                            });
                                            $(this).css({
                                                "height": Options.ImageButtonCSS.height
                                            })
                                        }
                                    }).each(function() {
                                        if (this.complete) $(this).load()
                                    })
                                } else {
                                    $image.attr("src", 'data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==');
                                    if (Options.EnableButton) {
                                        $EnableButton.unbind("click").bind("click", function() {
                                            Elemento.find("input[name='" + Options.InputOfFile + "']:file").click()
                                        }).val("Selecionar imagem")
                                    }
                                }
                            })
                        };
                        var getExt = function(name) {
                            return name.slice(name.lastIndexOf(".") + 1)
                        };
                        var Setando_AjaxUpload = function(element) {
                            var post = Options.DataPost;
                            post["request"] = "upload";
                            post["inputOfFile"] = Options.InputOfFile;
                            post["enableResize"] = Options.EnableResize;
                            post["minimumWidthToResize"] = Options.MinimumWidthToResize;
                            post["minimumHeightToResize"] = Options.MinimumHeightToResize;
                            post["folderOnServer"] = Options.FolderOnServer;
                            post["imageNameRandom"] = Options.ImageNameRandom;
                            post["maximumSize"] = Options.MaximumSize;
                            post["enableMaximumSize"] = Options.EnableMaximumSize;
                            var CustomRegex = new RegExp("^(" + Options.Extensions.join("|") + ")", "i");
                            element.uploadAjax({
                                accept: CustomRegex,
                                acceptEx: "image/*",
                                name: Options.InputOfFile,
                                method: 'POST',
                                url: Options.ActionToSubmitUpload,
                                data: post,
                                onSubmit: function() {
                                    PcLoading.show()
                                },
                                onComplete: function(response) {
                                    var response = $.parseJSON(response);
                                    PcLoading.hide();
                                    if (response.status) {
                                        Retorno_Requisicao(element, response)
                                    } else {
                                        PcAlert(response.errorMessage, "Attention")
                                    }
                                },
                                extError: function() {
                                    PcAlert("types are supported: " + (Options.Extensions.join(",")).toString(), "Attention")
                                }
                            });
                            element.find(":file[name='" + Options.InputOfFile + "']").mouseenter(function() {
                                element.addClass("TuyoshiImageUpload_div")
                            }).mouseout(function() {
                                element.removeClass("TuyoshiImageUpload_div")
                            })
                        };
                        var Retorno_Requisicao = function(element, response, concluir) {
                            var response = response;
                            var ColocarImagemNoBox = function() {
                                var InputOfImage = element.children("input[name='" + Options.InputOfImageDirectory + "']");
                                InputOfImage.val(Options.FolderOnServer + response.currentFileName).change();
                                if (typeof(Options.UploadedCallback) == 'function') {
                                    var data_response = response;
                                    data_response["options"] = {
                                        "FolderOnServer": Options.FolderOnServer
                                    };
                                    Options.UploadedCallback.call(this, response)
                                }
                            };
                            if (concluir == 1 || !Options.EnableCrop) {
                                if (Options.CropWindowStyle == "jqueryui" || Options.CropWindowStyle == "bootstrap") {
                                    $("#JtuyoshiCrop").dialog("destroy").remove()
                                } else if (Options.CropWindowStyle == "popstyle") {
                                    $("#JtuyoshiCrop").remove();
                                    $("#JtuyoshiCrop_model").remove()
                                };
                                ColocarImagemNoBox()
                            } else {
                                TuyoshiCrop(element, response)
                            }
                        };
                        $(this).html("");
                        Elemento = $(this);
                        Construir_Widget(Elemento);
                        Setando_AjaxUpload(Elemento);
                        if (Options.EnableButton) {
                            $EnableButton = $("<input type='button' value='Selecionar imagem' />").button().css({
                                "font-size": "12px",
                                "margin-top": 5,
                                "margin-left": "-0.5px"
                            });
                            Elemento.after($EnableButton);
                            $EnableButton.unbind("click").bind("click", function() {
                                Elemento.find("input[name='" + Options.InputOfFile + "']:file").click()
                            })
                        }
                    })
}
};
$.fn.PictureCut = function(MetodoOuOptions) {
    if (window.jQuery.ui === undefined) alert("Could not instantiate the PictureCut is missing jquery.ui");
    else {
        if (methods[MetodoOuOptions]) return methods[MetodoOuOptions].apply(this, Array.prototype.slice.call(arguments, 1));
        else if (typeof MetodoOuOptions === 'object' || !MetodoOuOptions) return methods.init.apply(this, arguments)
    }
}


/*-----button set post-----*/
var select;
$(document).on('click','#send', function() {
    select = $(this).attr('data-user');
    var text_set = document.getElementById("newpost-text").value; 
    var countLi = $(".users_wall_posts").length;
    var i=0;
    var f=dataArray.length;
    if (f == 0 && text_set != "") {
/*  $('.user_wall').append('<li><div id="post_'+countLi+'" class="posts">\
        <div class="users_posts">\
        <img src="">\
        <p class="users_name"></p></div>\
        <div class="posts_content">\
        <p>'+text_set+'</p></div></div></li>');*/
        set_post_db(dataArray, text_set);
    } else if (f > 0 && text_set != "")  {
/*$('.user_wall').append('<li><div id="post_'+countLi+'" class="posts">\
        <div class="users_posts">\
        <img src="">\
        <p class="users_name"></p></div>\
        <div class="posts_content">\
        <p>'+text_set+'</p>\
        <ul class="posts_attach"></ul></div></div></li>');  
    for( i=0; i<f; i++) {
        $('#post_'+countLi+' .posts_attach').append('<li><img src="'+dataArray[i]+'"></li>');
    }*/
    set_post_db(dataArray, text_set);
} else if (f > 0 && text_set == "") {
/*  
    $('.user_wall').append('<li><div id="post_'+countLi+'" class="posts">\
        <div class="users_posts">\
        <img src="">\
        <p class="users_name"></p></div>\
        <div class="posts_content">\
        <ul class="posts_attach"></ul></div></div></li>');
    for( i=0; i<f; i++) {
        $('#post_'+countLi+' .posts_attach').append('<li><img src="'+dataArray[i]+'"></li>');
    }*/
    set_post_db(dataArray, text_set);
} else if (f == 0 && text_set == "") {
   // alert('выберите фото или ввыедите текст');
}
$('#result').empty();
dataArray = [];
document.getElementById("newpost-text").value='';
});
/*-----end set post-----*/

/*-----follow-dogs-----*/
var send_e;
$(document).on('click','.follow-dog', function() {

   send_e = $(this).attr('id');

});

/*-----end follow-dogs-----*/


/*-----set post in db-----*/
function set_post_db(attachment, message){

    if (send_e == null) {
        send_e = select;
    }
    var data =  new FormData();
    var countLi = $(".users_wall_posts").length;
    data.append("attachment", attachment);
    data.append("count", attachment.length);
    data.append("message", message);
    data.append("post_id", (countLi+1));
    data.append("user_from", send_e);
    $.ajax({
        url: "setpost",
        type: "POST",
        data: data,
        processData: false,
        contentType: false,
        success: function (data) {
            $('.user_wall').prepend(data);
            initShare();
            pool_event();
            get_feedcount();
            
        }
    });
}
/*-----end set post-----*/
function initShare(){
    (function(t,e){"use strict";var a=function(t){this.elem=t};a.init=function(){var t=e.querySelectorAll(".sharer"),r,i=t.length;for(r=0;r<i;r++){t[r].addEventListener("click",a.add)}};a.add=function(t){var e=t.currentTarget||t.srcElement;var r=new a(e);r.share()};a.prototype={constructor:a,getValue:function(t){var e=this.elem.getAttribute("data-"+t);return e===undefined||e===null?false:e},share:function(){var t=this.getValue("sharer").toLowerCase(),e={facebook:{shareUrl:"https://www.facebook.com/sharer/sharer.php",params:{u:this.getValue("url")}},googleplus:{shareUrl:"https://plus.google.com/share",params:{url:this.getValue("url")}},linkedin:{shareUrl:"https://www.linkedin.com/shareArticle",params:{url:this.getValue("url"),mini:true}},twitter:{shareUrl:"https://twitter.com/intent/tweet/",params:{text:this.getValue("title"),url:this.getValue("url"),hashtags:this.getValue("hashtags"),via:this.getValue("via")}},email:{shareUrl:"mailto:"+this.getValue("to"),params:{subject:this.getValue("subject"),body:this.getValue("title")+"\n"+this.getValue("url")},isLink:true},whatsapp:{shareUrl:"whatsapp://send",params:{text:this.getValue("title")+" "+this.getValue("url")},isLink:true},telegram:{shareUrl:"tg://msg_url",params:{text:this.getValue("title")+" "+this.getValue("url")},isLink:true},viber:{shareUrl:"viber://forward",params:{text:this.getValue("title")+" "+this.getValue("url")},isLink:true},line:{shareUrl:"http://line.me/R/msg/text/?"+encodeURIComponent(this.getValue("title")+" "+this.getValue("url")),isLink:true},pinterest:{shareUrl:"https://www.pinterest.com/pin/create/button/",params:{url:this.getValue("url"),media:this.getValue("image"),description:this.getValue("description")}},tumblr:{shareUrl:"http://tumblr.com/widgets/share/tool",params:{canonicalUrl:this.getValue("url"),content:this.getValue("url"),posttype:"link",title:this.getValue("title"),caption:this.getValue("caption"),tags:this.getValue("tags")}},hackernews:{shareUrl:"https://news.ycombinator.com/submitlink",params:{u:this.getValue("url"),t:this.getValue("title")}},reddit:{shareUrl:"https://www.reddit.com/submit",params:{url:this.getValue("url")}},vk:{shareUrl:"http://vk.com/share.php",params:{url:this.getValue("url"),title:this.getValue("title"),description:this.getValue("caption"),image:this.getValue("image")}},xing:{shareUrl:"https://www.xing.com/app/user",params:{op:"share",url:this.getValue("url"),title:this.getValue("title")}},buffer:{shareUrl:"https://buffer.com/add",params:{url:this.getValue("url"),title:this.getValue("title"),via:this.getValue("via"),picture:this.getValue("picture")}},instapaper:{shareUrl:"http://www.instapaper.com/edit",params:{url:this.getValue("url"),title:this.getValue("title"),description:this.getValue("description")}},pocket:{shareUrl:"https://getpocket.com/save",params:{url:this.getValue("url")}},digg:{shareUrl:"http://www.digg.com/submit",params:{url:this.getValue("url")}},stumbleupon:{shareUrl:"http://www.stumbleupon.com/submit",params:{url:this.getValue("url"),title:this.getValue("title")}},flipboard:{shareUrl:"https://share.flipboard.com/bookmarklet/popout",params:{v:2,title:this.getValue("title"),url:this.getValue("url"),t:Date.now()}},weibo:{shareUrl:"http://service.weibo.com/share/share.php",params:{url:this.getValue("url"),title:this.getValue("title"),pic:this.getValue("image"),appkey:this.getValue("appkey"),ralateUid:this.getValue("ralateuid"),language:"zh_cn"}},renren:{shareUrl:"http://share.renren.com/share/buttonshare",params:{link:this.getValue("url")}},myspace:{shareUrl:"https://myspace.com/post",params:{u:this.getValue("url"),t:this.getValue("title"),c:this.getValue("description")}},blogger:{shareUrl:"https://www.blogger.com/blog-this.g",params:{u:this.getValue("url"),n:this.getValue("title"),t:this.getValue("description")}},baidu:{shareUrl:"http://cang.baidu.com/do/add",params:{it:this.getValue("title"),iu:this.getValue("url")}},douban:{shareUrl:"https://www.douban.com/share/service",params:{name:this.getValue("title"),href:this.getValue("url"),image:this.getValue("image")}},okru:{shareUrl:"https://connect.ok.ru/dk",params:{"st.cmd":"WidgetSharePreview","st.shareUrl":this.getValue("url"),title:this.getValue("title")}},mailru:{shareUrl:"http://connect.mail.ru/share",params:{share_url:this.getValue("url"),linkname:this.getValue("title"),linknote:this.getValue("description"),type:"page"}}},a=e[t];if(a){a.width=this.getValue("width");a.height=this.getValue("height")}return a!==undefined?this.urlSharer(a):false},urlSharer:function(e){var a=e.params||{},r=Object.keys(a),i,s=r.length>0?"?":"";for(i=0;i<r.length;i++){if(s!=="?"){s+="&"}if(a[r[i]]){s+=r[i]+"="+encodeURIComponent(a[r[i]])}}e.shareUrl+=s;if(!e.isLink){var l=e.width||600,h=e.height||480,u=t.innerWidth/2-l/2+t.screenX,n=t.innerHeight/2-h/2+t.screenY,g="scrollbars=no, width="+l+", height="+h+", top="+n+", left="+u,o=t.open(e.shareUrl,"",g);if(t.focus){o.focus()}}else{t.location.href=e.shareUrl}}};if(e.readyState==="complete"||e.readyState!=="loading"){a.init()}else{e.addEventListener("DOMContentLoaded",a.init)}t.addEventListener("page:load",a.init);t.Sharer=a})(window,document);
}

function get_feedcount(){
    var data =  new FormData();
    data.append("autofeed", 'true');

    $.ajax({
        url: "setpost",
        type: "POST",
        data: data,
        async: true, 
        cache: false,
        processData: false,
        contentType: false,
        success: function (data) {
            $('.my_feed_list').empty();
            $('.my_feed_list').append(data);
        }
    });

}



$(document).on('click','.attach-image-close', function() {
    var parid = this.parentNode.id;
    var listid = $('#result > div').index($('#'+parid));
    
    dataArray.splice(listid, 1);
    
    this.parentNode.remove();

});

/*-------------------end--------------------*/

})(jQuery);