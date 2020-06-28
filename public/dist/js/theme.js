// $(document).on("load turbolinks:load", function () {

//     if(window.jQuery){
//         init();
//     }else{
//         var fixloop = setInterval(function(){
//                 clearInterval(fixloop);
//                 try {
//                     init();
//                 } catch (error) {
//                     console.log('Refresh Page');
//                     // Turbolinks.visit(window.location)
//                     Turbolinks.visit(window.location)
//                     init();
//                 }
//         }, 100);
//     }
// });
init();

function init() {
    // $('.dropdown-toggle').dropdown('toggle')

        function a(window, document) {
            window.children(".submenu-content")
                .show()
                .slideUp(200, function () {
                    $(this).css("display", ""),
                        $(this).find(".menu-item").removeClass("is-shown"),
                        window.removeClass("open"),
                        document && document();
                });
        }

        var s = $(".app-sidebar"),
            n = $(".sidebar-content"),
            l = $(".wrapper"),
            o = document.querySelector(".sidebar-content");
        new PerfectScrollbar(o, {
            wheelSpeed: 10,
            wheelPropagation: !0,
            minScrollbarLength: 5,
        }),
            n.on("click", ".navigation-main .nav-item a", function () {
                var window = $(this).parent(".nav-item");
                if (window.hasClass("has-sub") && window.hasClass("open")) a(window);
                else {
                    if (
                        (window.hasClass("has-sub") &&
                            (function (window, document) {
                                var a = window.children(".submenu-content"),
                                    s = a
                                        .children(".menu-item")
                                        .addClass("is-hidden");
                                window.addClass("open"),
                                    a.hide().slideDown(200, function () {
                                        $(this).css("display", "");
                                    }),
                                    setTimeout(function () {
                                        s.addClass("is-shown"),
                                            s.removeClass("is-hidden");
                                    }, 0);
                            })(window),
                        n.data("collapsible"))
                    )
                        return !1;
                    a(window.siblings(".open")),
                        window
                            .siblings(".open")
                            .find(".nav-item.open")
                            .removeClass("open");
                }
            }),
            $(".nav-toggle").on("click", function () {
                var window = $(this).find(".toggle-icon");
                "expanded" === window.attr("data-toggle")
                    ? (l.addClass("nav-collapsed"),
                      $(".nav-toggle")
                          .find(".toggle-icon")
                          .removeClass("ik-toggle-right")
                          .addClass("ik-toggle-left"),
                      window.attr("data-toggle", "collapsed"))
                    : (l.removeClass("nav-collapsed menu-collapsed"),
                      $(".nav-toggle")
                          .find(".toggle-icon")
                          .removeClass("ik-toggle-left")
                          .addClass("ik-toggle-right"),
                      window.attr("data-toggle", "expanded"));
            }),
            s
                .on("mouseenter", function () {
                    if (l.hasClass("nav-collapsed")) {
                        l.removeClass("menu-collapsed");
                        var window = $(
                            ".navigation-main .nav-item.nav-collapsed-open"
                        );
                        window
                            .children(".submenu-content")
                            .hide()
                            .slideDown(300, function () {
                                $(this).css("display", "");
                            }),
                            n
                                .find(".nav-item.active")
                                .parents(".nav-item")
                                .addClass("open"),
                            window
                                .addClass("open")
                                .removeClass("nav-collapsed-open");
                    }
                })
                .on("mouseleave", function (window) {
                    if (l.hasClass("nav-collapsed")) {
                        l.addClass("menu-collapsed");
                        var document = $(".navigation-main .nav-item.open"),
                            a = document.children(".submenu-content");
                        document.addClass("nav-collapsed-open"),
                            a.show().slideUp(300, function () {
                                $(this).css("display", "");
                            }),
                            document.removeClass("open");
                    }
                }),
            $(window).width() < 992 &&
                (s.addClass("hide-sidebar"),
                l.removeClass("nav-collapsed menu-collapsed")),
            $(window).resize(function () {
                $(window).width() < 992 &&
                    (s.addClass("hide-sidebar"),
                    l.removeClass("nav-collapsed menu-collapsed")),
                    $(window).width() > 992 &&
                        (s.removeClass("hide-sidebar"),
                        "collapsed" ===
                            $(".toggle-icon").attr("data-toggle") &&
                            l.not(".nav-collapsed menu-collapsed") &&
                            l.addClass("nav-collapsed menu-collapsed"));
            }),
            $(document).on("click", ".navigation li:not(.has-sub)", function () {
                $(window).width() < 992 && s.addClass("hide-sidebar");
            }),
            $(document).on("click", ".logo-text", function () {
                $(window).width() < 992 && s.addClass("hide-sidebar");
            }),
            $(".mobile-nav-toggle").on("click", function (window) {
                window.stopPropagation(), s.toggleClass("hide-sidebar");
            }),
            $("html").on("click", function (document) {
                $(window).width() < 992 &&
                    (s.hasClass("hide-sidebar") ||
                        0 !== s.has(document.target).length ||
                        s.addClass("hide-sidebar"));
            }),
            $("#sidebarClose").on("click", function () {
                s.addClass("hide-sidebar");
            }),
            $("#checkbox_select_all").on("click", function () {
                for (
                    var window = document.getElementsByName("item_checkbox"), a = 0;
                    a < window.length;
                    a++
                )
                    "checkbox" == window[a].type && (window[a].checked = !0),
                        $(window).parent().parent().addClass("selected");
            }),
            $("#checkbox_deselect_all").on("click", function () {
                for (
                    var window = document.getElementsByName("item_checkbox"), a = 0;
                    a < window.length;
                    a++
                )
                    "checkbox" == window[a].type && (window[a].checked = !1),
                        $(window).parent().parent().removeClass("selected");
            }),
            $("#quick-search").keyup(function () {
                var window = $(this).val().trim().toLowerCase();
                $(".app-item")
                    .hide()
                    .filter(function () {
                        return (
                            -1 !=
                            $(this).html().trim().toLowerCase().indexOf(window)
                        );
                    })
                    .show();
            }),
            $(".list-item input:checkbox").change(function () {
                $(this).is(":checked")
                    ? $(this).parent().parent().addClass("selected")
                    : $(this).parent().parent().removeClass("selected");
            }),
            $("#navbar-fullscreen").on("click", function (window) {
                "undefined" != typeof screenfull &&
                    screenfull.enabled &&
                    screenfull.toggle();
            }),
            $("#selectall").click(function () {
                $(this).is(":checked")
                    ? $(".select_all_child:checkbox").attr("checked", !0)
                    : $(".select_all_child:checkbox").attr("checked", !1);
            }),
            $(".list-item-wrap .list-item .list-title a").on(
                "click",
                function (window) {
                    $(".list-item.quick-view-opened")
                        .not(this)
                        .removeClass("quick-view-opened"),
                        $(this)
                            .parents()
                            .parent(".list-item")
                            .toggleClass("quick-view-opened");
                }
            ),
            $(document).on("click", function (window) {
                $(window.target).closest(".list-item").length ||
                    $(".list-item").removeClass("quick-view-opened");
            }),
            "undefined" != typeof screenfull &&
                screenfull.enabled &&
                $(document).on(screenfull.raw.fullscreenchange, function () {
                    screenfull.isFullscreen
                        ? $("#navbar-fullscreen")
                              .find("document")
                              .toggleClass("ik-minimize ik-maximize")
                        : $("#navbar-fullscreen")
                              .find("document")
                              .toggleClass("ik-maximize ik-minimize");
                }),
            $(".minimize-widget").on("click", function () {
                var window = $(this),
                    document = $(window.parents(".widget"));
                $(document).children(".widget-body").slideToggle(),
                    $(this).toggleClass("ik-minus").fadeIn("slow"),
                    $(this).toggleClass("ik-plus").fadeIn("slow");
            }),
            $(".remove-widget").on("click", function () {
                var window = $(this);
                window
                    .parents(".widget")
                    .animate({
                        opacity: "0",
                        "-webkit-transform": "scale3d(.3, .3, .3)",
                        transform: "scale3d(.3, .3, .3)",
                    }),
                    setTimeout(function () {
                        window.parents(".widget").remove();
                    }, 800);
            }),
            $(".card-header-right .card-option .action-toggle").on(
                "click",
                function () {
                    var window = $(this);
                    window.hasClass("ik-chevron-right")
                        ? window
                              .parents(".card-option")
                              .animate({ width: "28px" })
                        : window
                              .parents(".card-option")
                              .animate({ width: "90px" }),
                        $(this)
                            .toggleClass("ik-chevron-right")
                            .fadeIn("slow");
                }
            ),
            $(".card-header-right .close-card").on("click", function () {
                var window = $(this);
                window
                    .parents(".card")
                    .animate({
                        opacity: "0",
                        "-webkit-transform": "scale3d(.3, .3, .3)",
                        transform: "scale3d(.3, .3, .3)",
                    }),
                    setTimeout(function () {
                        window.parents(".card").remove();
                    }, 800);
            }),
            $(".card-header-right .minimize-card").on("click", function () {
                var window = $(this),
                    document = $(window.parents(".card"));
                $(document).children(".card-body").slideToggle(),
                    $(this).toggleClass("ik-minus").fadeIn("slow"),
                    $(this).toggleClass("ik-plus").fadeIn("slow");
            }),
            $(".task-list").on("click", "li.list", function () {
                $(this).toggleClass("completed");
            }),
            $(".search-btn").on("click", function () {
                $(".header-search").addClass("open"),
                    $(".header-search .form-control").animate({
                        width: "200px",
                    });
            }),
            $(".search-close").on("click", function () {
                $(".header-search .form-control").animate({ width: "0" }),
                    setTimeout(function () {
                        $(".header-search").removeClass("open");
                    }, 300);
            });




    $('[data-toggle="tooltip"]').tooltip();
    $('.dropdown-toggle').dropdown();
}
