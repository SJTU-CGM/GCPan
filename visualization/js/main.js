/*
var JBROWSE_ADDRESS = (function(){
    var loc = window.location;
    var prot = loc.protocol;
    var host = loc.host;
    return prot + '//' + host + '/Browser';
})();
*/
var BASE_TRACKS = ["DNA", "gene", "PF"];
//var JBROWSE_URL = "../../Browser/";
var TREE_URL = "YaPTV/index.html";


function after(isReady, act) {
    function waiter() {
	if (! isReady()) {
	    setTimeout(waiter, 100);
	} else {
	    act();
	}
    }
    setTimeout(waiter, 100);
}

var Tree = {
    init: function (tracks, callback) {
	this.loadTreePage();
        var that = this;
	var act = null;
	if (callback) {
	    act = function () {
		that.initHandle();
		after(function(){return that._handle.ready()}, callback);
	    }
	} else {
	    act = function () {
		that.initHandle();
	    }
	}
	after(function(){return that.isPageReady()}, act);
    },
    loadTreePage: function() {
        this._win = document.getElementById("tree").contentWindow.window;
        this._win.location.href = TREE_URL;
    },
    isPageReady: function() {
	return this._win.HANDLE;
    },
    initHandle: function() {
	this._handle = this._win.HANDLE;
	this._handle.submitHandle = function (sel) {
	    var ls = sel.concat(JBrowse.getSelection())
	    JBrowse.setSelection(ls);
	};
    },
    setSelection: function (sel) {
        this._handle.loadSelection(sel);
    },
    submit: function () {
        this._handle.submit();
    }
};

/*
var JBrowse = {
    init: function (x, callback) {
        // x :: list of tracks | search::string
	this.initElement();
	this.loadJBrowsePage();
        var url;
        if (typeof x == "string") {
            url = JBROWSE_URL + x;
        } else {
            var search = "?tracks=" + BASE_TRACKS.concat(x).join("%2C");
            url = JBROWSE_URL + search;
        }
        this._win.location.href = url;
        //this._win.location.href = JBROWSE_ADDRESS;
        if (callback) {
            callback();
        } else {
            // pass
        }
    },
    ready: function (callback) {
        var that = this;
        function waiter () {
            if (that.getSearch().length > 0) {
                callback();
            } else {
                setTimeout(waiter, 100);
            }
        }
        setTimeout(waiter, 100);
    },
    getSearch: function () {
        return this._win.location.search || "";
    },
    setSearch: function (sear) {
        this._win.location.search = sear;
    },    
    getSelection: function () {
        function isNotPreservedTrack(track) {
            function isRNATrack(track) {
                return (track.match(/[SDE]RR/) != null);
            }
            function isPFTrack(track) {
                return track.endsWith("PF");
            }
            var list = ["gene", "DNA"];
            return list.indexOf(track) < 0
                && ! isRNATrack(track)
                && ! isPFTrack(track);
        }
        var search = this.getSearch();
        var match = search.match(/\?.*tracks=([^&]*)&?/);
        if (match == null) {
            return [];
        } else {
            return match[1].split(/%2C/).filter(isNotPreservedTrack);
        }
    },
    setSelection: function (sel) {
        var str = BASE_TRACKS.concat(sel).join("%2C");
        var search = this.getSearch();
        var match = search.match(/\?.*tracks=([^&]*)&?/);
        if (match == null) {
            this.setSearch("?tracks=" + str);
        } else {
            this.setSearch(search.replace(match[1], str));
        }
    },
    getWindow: function () {
	return this._win;
    },
    getElement: function() {
	return this._elem;
    },
    initElement: function () {
	this._elem = document.getElementById("jbrowse")
    },
    loadJBrowsePage: function() {
        this._win = this._elem.contentWindow.window;
    }
};
*/
// End of JBrowse


function init() {
    if (window.location.search == "") {
        respondPost();
    } else {
        respondGet();
    }
/*
    setInterval(function syncJBrowseURL() {
	    var search = JBrowse.getSearch();
	    var base = window.location.origin + window.location.pathname;
	    var url = base + search;
	    window.history.pushState({}, "", url);
	}, 300);
*/
}


function respondGet() {
    var search = window.location.search;
    //JBrowse.init(search);
    var tracks = search.match(/\?.*tracks=([^&]*)&?/)[0].split('%2C');
    Tree.init(tracks, function(){
        //JBrowse.ready(function(){
            //var sel = JBrowse.getSelection();
            Tree.setSelection(sel);
        //});
    });
}


function respondPost() {
    var search = '?';
    search += 'tracks=' + BASE_TRACKS.concat(INIT_CODES).join('%2C');
    if (INIT_LOC.length > 0) {
	var chro = INIT_LOC[0];
	var start = INIT_LOC[1];
	var end = INIT_LOC[2];
	search += '&loc=' + chro +':' + start +'..' + end;
    }
    //JBrowse.init(search);
    Tree.init(INIT_CODES);
}


var toggleTreeVisibility = (function(){
    var hided = false;
    return function () {
        if (! hided) {
            $('#tree').css({'display':'none'});
            $('#toggle-tree').text('>');
        } else {
            $('#tree').css({'display':'flex'});
            $('#toggle-tree').text('<');
        }
        hided = ! hided;
    }
})()
