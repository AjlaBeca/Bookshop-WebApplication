var Utils = {
    init_spapp : function(){
        var app = $.spapp({
            defaultView: "#home",
            templateDir: "views/",
        });
    
        app.run();
        console.log("SPApp initialized");
    }
}
