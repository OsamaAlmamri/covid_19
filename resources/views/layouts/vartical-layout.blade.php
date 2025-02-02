<script>
    function handlemenutype(e) {
        $(".pcoded").attr("nav-type", e)
    }

    $(document).ready(function () {
        $("#pcoded").pcodedmenu({
            themelayout: "vertical",
            verticalMenuplacement: "{{(lang() == 'ar')?'right':'left'}}",
            verticalMenulayout: "wide",
            MenuTrigger: "click",
            SubMenuTrigger: "click",
            activeMenuClass: "active",
            ThemeBackgroundPattern: "pattern4",
            HeaderBackground: "theme2",
            LHeaderBackground: "theme2",
            NavbarBackground: "theme2",
            ActiveItemBackground: "theme2",
            {{--HeaderBackground: "{{setting('HeaderBackground')}}",--}}
            {{--LHeaderBackground: "{{setting('LHeaderBackground')}}",--}}
            {{--NavbarBackground: "{{setting('NavbarBackground')}}",--}}
            {{--ActiveItemBackground: "{{setting('ActiveItemBackground')}}",--}}
            SubItemBackground: "theme2",
            ActiveItemStyle: "style0",
            ItemBorder: !0,
            ItemBorderStyle: "none",
            SubItemBorder: !0,
            DropDownIconStyle: "style3",
            menutype: "st5",
            freamtype: "theme1",
            layouttype: "light",//dark,light
            FixedNavbarPosition: !0,
            FixedHeaderPosition: !0,
            collapseVerticalLeftHeader: !0,
            VerticalSubMenuItemIconStyle: "style1",
            VerticalNavigationView: "view1",
            verticalMenueffect: {desktop: "shrink", tablet: "overlay", phone: "overlay"},
            defaultVerticalMenu: {desktop: "expanded", tablet: "offcanvas", phone: "offcanvas"},
            onToggleVerticalMenu: {desktop: "offcanvas", tablet: "expanded", phone: "expanded"}
        }), function () {
            $(".theme-color > a.fream-type").on("click", function () {
                var e = $(this).attr("fream-type");

                $(".pcoded").attr("fream-type", e), $(".pcoded-header").attr("header-theme", "themelight" + e), $(".pcoded-navbar").attr("navbar-theme", "theme" + e), $(".navbar-logo").attr("logo-theme", "theme" + e)
            })
        }(), function () {
            $(".theme-color > a.Layout-type").on("click", function () {
                var e = $(this).attr("layout-type");
                // alert(e);
                $(".pcoded").attr("layout-type", e), "dark" == e && ($(".pcoded-header").attr("header-theme", "theme6"), $(".pcoded-navbar").attr("navbar-theme", "theme1"), $(".navbar-logo").attr("logo-theme", "theme6"), $("body").addClass("dark")), "light" == e && ($(".pcoded-header").attr("header-theme", "theme1"), $(".pcoded-navbar").attr("navbar-theme", "themelight1"), $(".navbar-logo").attr("logo-theme", "theme1"), $("body").removeClass("dark"))
            })
        }(), function () {
            $(".theme-color > a.logo-theme").on("click", function () {
                var e = $(this).attr("logo-theme");
                ChangeSetting('LHeaderBackground', e);
                $(".navbar-logo").attr("logo-theme", e)
            })
        }(), function () {
            $(".theme-color > a.leftheader-theme").on("click", function () {
                var e = $(this).attr("lheader-theme");
                $(".pcoded-navigatio-lavel").attr("menu-title-theme", e)
            })
        }(), function () {
            $(".theme-color > a.header-theme").on("click", function () {
                var e = $(this).attr("header-theme");
                ChangeSetting('HeaderBackground', e);
                $(".pcoded-header").attr("header-theme", e), $(".navbar-logo").attr("logo-theme", e)
            })
        }(), function () {
            $(".theme-color > a.navbar-theme").on("click", function () {
                var e = $(this).attr("navbar-theme");
                ChangeSetting('NavbarBackground', e);
                $(".pcoded-navbar").attr("navbar-theme", e)
            })
        }(), function () {
            $(".theme-color > a.active-item-theme").on("click", function () {
                var e = $(this).attr("active-item-theme");
                ChangeSetting('ActiveItemBackground', e);
                $(".pcoded-navbar").attr("active-item-theme", e)
            })
        }(), function () {
            $(".theme-color > a.sub-item-theme").on("click", function () {
                var e = $(this).attr("sub-item-theme");
                $(".pcoded-navbar").attr("sub-item-theme", e)
            })
        }(), function () {
            $(".theme-color > a.themebg-pattern").on("click", function () {
                var e = $(this).attr("themebg-pattern");
                $("body").attr("themebg-pattern", e)
            })
        }(), function () {
            $("#navigation-view").val("view1").on("change", function (e) {
                e = $(this).val(), $(".pcoded").attr("vnavigation-view", e)
            })
        }(), function () {
            $("#theme-layout").change(function () {
                $(this).is(":checked") ? ($(".pcoded").attr("vertical-layout", "box"), $("#bg-pattern-visiblity").removeClass("d-none")) : ($(".pcoded").attr("vertical-layout", "wide"), $("#bg-pattern-visiblity").addClass("d-none"))
            })
        }(), function () {
            $("#vertical-menu-effect").val("shrink").on("change", function (e) {
                e = $(this).val(), $(".pcoded").attr("vertical-effect", e)
            })
        }(), function () {
            $("#vertical-navbar-placement").val("left").on("change", function (e) {
                e = $(this).val(), $(".pcoded").attr("vertical-placement", e), $(".pcoded-navbar").attr("pcoded-navbar-position", "absolute"), $(".pcoded-header .pcoded-left-header").attr("pcoded-lheader-position", "relative")
            })
        }(), function () {
            $("#vertical-activeitem-style").val("style1").on("change", function (e) {
                e = $(this).val(), $(".pcoded-navbar").attr("active-item-style", e)
            })
        }(), function () {
            $("#vertical-item-border").change(function () {
                $(this).is(":checked") ? $(".pcoded-navbar .pcoded-item").attr("item-border", "false") : $(".pcoded-navbar .pcoded-item").attr("item-border", "true")
            })
        }(), function () {
            $("#vertical-subitem-border").change(function () {
                $(this).is(":checked") ? $(".pcoded-navbar .pcoded-item").attr("subitem-border", "false") : $(".pcoded-navbar .pcoded-item").attr("subitem-border", "true")
            })
        }(), function () {
            $("#vertical-border-style").val("solid").on("change", function (e) {
                e = $(this).val(), $(".pcoded-navbar .pcoded-item").attr("item-border-style", e)
            })
        }(), function () {
            $("#vertical-dropdown-icon").val("style1").on("change", function (e) {
                e = $(this).val(), $(".pcoded-navbar .pcoded-hasmenu").attr("dropdown-icon", e)
            })
        }(), function () {
            $("#vertical-subitem-icon").val("style5").on("change", function (e) {
                e = $(this).val(), $(".pcoded-navbar .pcoded-hasmenu").attr("subitem-icon", e)
            })
        }(), function () {
            $("#sidebar-position").change(function () {
                $(this).is(":checked") ? ($(".pcoded-navbar").attr("pcoded-navbar-position", "fixed"), $(".pcoded-header .pcoded-left-header").attr("pcoded-lheader-position", "fixed")) : ($(".pcoded-navbar").attr("pcoded-navbar-position", "absolute"), $(".pcoded-header .pcoded-left-header").attr("pcoded-lheader-position", "relative"))
            })
        }(), function () {
            $("#header-position").change(function () {
                $(this).is(":checked") ? ($(".pcoded-header").attr("pcoded-header-position", "fixed"), $(".pcoded-navbar").attr("pcoded-header-position", "fixed"), $(".pcoded-main-container").css("margin-top", $(".pcoded-header").outerHeight())) : ($(".pcoded-header").attr("pcoded-header-position", "relative"), $(".pcoded-navbar").attr("pcoded-header-position", "relative"), $(".pcoded-main-container").css("margin-top", "0px"))
            })
        }(), function () {
            $("#collapse-left-header").change(function () {
                $(this).is(":checked") ? ($(".pcoded-header, .pcoded ").removeClass("iscollapsed"), $(".pcoded-header, .pcoded").addClass("nocollapsed")) : ($(".pcoded-header, .pcoded").addClass("iscollapsed"), $(".pcoded-header, .pcoded").removeClass("nocollapsed"))
            })
        }()
    }), handlemenutype("st2");


    function ChangeSetting(name, val) {
        var data = '_token=' + encodeURIComponent("{{csrf_token()}}") + '&name=' + encodeURIComponent(name) + '&val=' + encodeURIComponent(val);
        var url = '/setting/changeSetting';
        var _this = $(this);
        $.ajax({
            url: url,//   var url=$('#news').attr('action');
            method: 'POST',
            dataType: 'json',// data type that i want to return
            data: data,// var form=$('#news').serialize();
            success: function (data) {
            },
            error: function (xhr, status, error) {
            }
        });
        return (false);


    }
</script>
