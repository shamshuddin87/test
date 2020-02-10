/*var run = function(){
  if (Offline.state === 'up')
    Offline.check();
}
setInterval(run, 5000);*/
var website = $.noConflict();
function getgeolocation(getip)
{
    var formdata = {getip:getip}
        website.ajax({
            url:'bhimraogeo/getgeolocation',
            data:formdata,
            method:'POST',
            contentType:'application/x-www-form-urlencoded; charset=UTF-8',
            dataType:"json",
            cache:false,
            /*beforeSend: function() {},
            uploadProgress: function(event, position, total, percentComplete) {},
            success: function(response, textStatus, jqXHR) {},
            complete: function(response) {},
            error: function(jqXHR, textStatus, errorThrown){}*/
        });

}

website(document).mouseup(function (e) {
    var container = website('#live-search-header-wrapper');
    if (!container.is(e.target) && container.has(e.target).length === 0) {
        container.hide();
        website('.header-search-input').val('');
    }
  });
website(document).mouseup(function (e) {
    var container = website('#live-search-header-wrapper1');
    if (!container.is(e.target) && container.has(e.target).length === 0) {
        container.hide();
        website('.header-search-input1').val('');
    }
  });
website('body').on('focus','.rajuharry-form input',function (e) {
    var container = website(this);
    container.prev('.icon-append').toggleClass('colorchangeicon');
  });

website('body').on('blur','.rajuharry-form input',function (e) {
    var container = website(this);
    container.prev('.icon-append').toggleClass('colorchangeicon');
  });
/*----------------------------------- Additional Validation ----------------------------*/

function validateField_searchCriteria_tan(field) {
    var vlaget = website('#'+field).val();
    var errors = false;
    var continueValidation = true;
    if (continueValidation && vlaget =='') {
        errors = 'Please Fill TAN ';
        tanerror(errors);
        continueValidation = false;
    }
    if (continueValidation && regexChecktan(vlaget, " Invalid TAN. Please retry.", '^.{10}$|^$')) {
        errors = 'TAN Always consists of 10 Chracters';
        tanerror(errors);
        continueValidation = false;
    }
    if (continueValidation && regexChecktan(vlaget, " Invalid TAN. Please retry.", '^[A-Za-z]{4}[0-9]{5}[A-Za-z]{1}$|^$')) {
        errors = 'Please Enter Valid TAN ';
        tanerror(errors);
        continueValidation = false;
    }
    return !errors;
}
function tanerror(errors)
{
    PNotify.removeAll();
    new PNotify({title: 'Warning !',
    text: errors,
    type: 'university',
    hide: true,
    styling: 'bootstrap3',
    addclass: 'dark ',
    });
}
function regexChecktan(field,error,regEx){

    var row = (field != '') ? field : '';

    if (row != '' && !row.match(regEx)) {
        tanerror(error);
        return true;
    }
    else
    {
        PNotify.removeAll();
        return false;
    }

}

function getbaseurl()
{
    var bases = document.getElementsByTagName('base');
    var baseHref = '';
    if (bases.length > 0) {
        baseHref = bases[0].href;
    }
    return baseHref;
}
function goBack() {
    window.history.back();
}
function onlyAlphabets(e, t) {
    try {
        if (window.event) {
            var charCode = window.event.keyCode;
        }
        else if (e) {
            var charCode = e.which;
        }
        else { return true; }
        if ((charCode > 64 && charCode < 91) || (charCode > 96 && charCode < 123))
            return true;
        else
            return false;
    }
    catch (err) {
        alert(err.Description);
    }
}
function numbersonly(myfield, e, dec) {

    var key;
    var keychar;

    if (window.event)
        key = window.event.keyCode;
    else if (e)
        key = e.which;
    else
        return true;
    keychar = String.fromCharCode(key);

    // control keys
    if ((key == null) || (key == 0) || (key == 8) ||
            (key == 9) || (key == 13) || (key == 27))
        return true;

    // numbers
    else if ((("0123456789").indexOf(keychar) > -1))
        return true;

    // decimal point jump
    else if (dec && (keychar == ".")) {
        myfield.form.elements[dec].focus();
        return false;
    }

    else
        return false;
}

function isAlphaNumeric(e){ // Alphanumeric only
            var k;
            document.all ? k=e.keycode : k=e.which;
            return((k>47 && k<58)||(k>64 && k<91)||(k>96 && k<123)||k==0);
         }
// New Decimal number
function validateFloatKeyPress(el, evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode;
    var number = el.value.split('.');
    if (charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    //just one dot
    if(number.length>1 && charCode == 46){
         return false;
    }
    //get the carat position
    var caratPos = getSelectionStart(el);
    var dotPos = el.value.indexOf(".");
    if( caratPos > dotPos && dotPos>-1 && (number[1].length > 1)){
        return false;
    }
    return true;
}

function getSelectionStart(o) {
	if (o.createTextRange) {
		var r = document.selection.createRange().duplicate()
		r.moveEnd('character', o.value.length)
		if (r.text == '') return o.value.length
		return o.value.lastIndexOf(r.text)
	} else return o.selectionStart
}
// New Decimal number Enter only
function isAlphaNumeric_space(e){ // Alphanumeric only
            var k;
            document.all ? k=e.keycode : k=e.which;
            return((k>47 && k<58)||(k>64 && k<91)||(k>96 && k<123)||k==0 || k==32);
         }
function isAlpha_space(e){ // Alphanumeric only
            var k;
            document.all ? k=e.keycode : k=e.which;
            return((k>64 && k<91)||(k>96 && k<123)|| k==32);
         }
function nospclchar() {
    var charCode = event.keyCode;

    if ((charCode > 64 && charCode < 91) || (charCode > 48 && charCode < 57) || (charCode > 96 && charCode < 123)  || charCode == 8 || charCode == 32 )

        return true;
    else
        return false;
}


function toggleFullScreen() {
    if ((document.fullScreenElement && document.fullScreenElement !== null) ||
      (!document.mozFullScreen && !document.webkitIsFullScreen)) {
      if (document.documentElement.requestFullScreen) {
        document.documentElement.requestFullScreen();
      }
      else if (document.documentElement.mozRequestFullScreen) {
        document.documentElement.mozRequestFullScreen();
      }
      else if (document.documentElement.webkitRequestFullScreen) {
        document.documentElement.webkitRequestFullScreen(Element.ALLOW_KEYBOARD_INPUT);
      }
    }
    else {
      if (document.cancelFullScreen) {
        document.cancelFullScreen();
      }
      else if (document.mozCancelFullScreen) {
        document.mozCancelFullScreen();
      }
      else if (document.webkitCancelFullScreen) {
        document.webkitCancelFullScreen();
      }
    }
}

function chlogironmanrajuharry(){
     var gbaseurl = getbaseurl() ;
     website.get("bhimraogeo/checklog", function(response){
        
        if(response.status==false) {
            window.location = gbaseurl+"login/logout"; 
        }
        setTimeout(function(){  chlogironmanrajuharry(); }, 7000); 
        });
}
function chlogiironmanrajuharry(){
     var gbaseurl = getbaseurl() ;
     website.get("bhimraogeo/checklog", function(response){
        
        if(response.status==true) {
            window.location = gbaseurl+"home"; 
        }
        setTimeout(function(){  chlogiironmanrajuharry(); }, 7000); 
        });
}
//
/*
//It is American Technique to convert numbers 
var th = ['', 'thousand','million', 'billion', 'trillion'];

var dg = ['zero', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine'];

var tn = ['ten', 'eleven', 'twelve', 'thirteen', 'fourteen', 'fifteen', 'sixteen', 'seventeen', 'eighteen', 'nineteen'];

var tw = ['twenty', 'thirty', 'forty', 'fifty', 'sixty', 'seventy', 'eighty', 'ninety'];

function toWords(s) {
    s = s.toString();
    s = s.replace(/[\, ]/g, '');
    if (s != parseFloat(s)) return 'not a number';
    var x = s.indexOf('.');
    if (x == -1) x = s.length;
    if (x > 15) return 'too big';
    var n = s.split('');
    var str = '';
    var sk = 0;
    for (var i = 0; i < x; i++) {
        if ((x - i) % 3 == 2) {
            if (n[i] == '1') {
                str += tn[Number(n[i + 1])] + ' ';
                i++;
                sk = 1;
            } else if (n[i] != 0) {
                str += tw[n[i] - 2] + ' ';
                sk = 1;
            }
        } else if (n[i] != 0) {
            str += dg[n[i]] + ' ';
            if ((x - i) % 3 == 0) str += 'hundred ';
            sk = 1;
        }
        if ((x - i) % 3 == 1) {
            if (sk) str += th[(x - i - 1) / 3] + ' ';
            sk = 0;
        }
    }
    if (x != s.length) {
        var y = s.length;
        str += 'point ';
        for (var i = x + 1; i < y; i++) str += dg[n[i]] + ' ';
    }
    return str.replace(/\s+/g, ' ');

}*/

function toWords(number)
{
    //console.log(number);
    if ((number < 0) || (number > 999999999)) 
    { 
        return "NUMBER OUT OF RANGE!";
    }
    var Gn = Math.floor(number / 10000000);  /* Crore */ 
    number -= Gn * 10000000; 
    var kn = Math.floor(number / 100000);     /* lakhs */ 
    number -= kn * 100000; 
    var Hn = Math.floor(number / 1000);      /* thousand */ 
    number -= Hn * 1000; 
    var Dn = Math.floor(number / 100);       /* Tens (deca) */ 
    number = number % 100;               /* Ones */ 
    var tn= Math.floor(number / 10); 
    var one=Math.floor(number % 10); 
    var res = ""; 

    if (Gn>0) 
    { 
        res += (toWords(Gn) + " CRORE"); 
    } 
    if (kn>0) 
    { 
            res += (((res=="") ? "" : " ") + 
            toWords(kn) + " LAKH"); 
    } 
    if (Hn>0) 
    { 
        res += (((res=="") ? "" : " ") +
            toWords(Hn) + " THOUSAND"); 
    } 

    if (Dn) 
    { 
        res += (((res=="") ? "" : " ") + 
            toWords(Dn) + " HUNDRED"); 
    } 


    var ones = Array("", "ONE", "TWO", "THREE", "FOUR", "FIVE", "SIX","SEVEN", "EIGHT", "NINE", "TEN", "ELEVEN", "TWELVE", "THIRTEEN","FOURTEEN", "FIFTEEN", "SIXTEEN", "SEVENTEEN", "EIGHTEEN","NINETEEN"); 
var tens = Array("", "", "TWENTY", "THIRTY", "FOURTY", "FIFTY", "SIXTY","SEVENTY", "EIGHTY", "NINETY"); 

    if (tn>0 || one>0) 
    { 
        if (!(res=="")) 
        { 
            res += " AND "; 
        } 
        if (tn < 2) 
        { 
            res += ones[tn * 10 + one]; 
        } 
        else 
        { 

            res += tens[tn];
            if (one>0) 
            { 
                res += ("-" + ones[one]); 
            } 
        } 
    }

    if (res=="")
    { 
        res = "zero"; 
    } 
    return res;
}


/*number to words start*/
                    
function NumToWord(inputNumber, outputControl) {
	var str = new String(inputNumber);
	var splt = str.split("");
	var rev = splt.reverse();
	var once = ['Zero', ' One', ' Two', ' Three', ' Four', ' Five', ' Six', ' Seven', ' Eight', ' Nine'];
	var twos = ['Ten', ' Eleven', ' Twelve', ' Thirteen', ' Fourteen', ' Fifteen', ' Sixteen', ' Seventeen', ' Eighteen', ' Nineteen'];
	var tens = ['', 'Ten', ' Twenty', ' Thirty', ' Forty', ' Fifty', ' Sixty', ' Seventy', ' Eighty', ' Ninety'];

	numLength = rev.length;
	var word = new Array();
	var j = 0;

	for (i = 0; i < numLength; i++) {
		switch (i) {

			case 0:
				if ((rev[i] == 0) || (rev[i + 1] == 1)) {
					word[j] = '';
				}
				else {
					word[j] = '' + once[rev[i]];
				}
				word[j] = word[j];
				break;

			case 1:
				aboveTens();
				break;

			case 2:
				if (rev[i] == 0) {
					word[j] = '';
				}
				else if ((rev[i - 1] == 0) || (rev[i - 2] == 0)) {
					word[j] = once[rev[i]] + " Hundred ";
				}
				else {
					word[j] = once[rev[i]] + " Hundred and";
				}
				break;

			case 3:
				if (rev[i] == 0 || rev[i + 1] == 1) {
					word[j] = '';
				}
				else {
					word[j] = once[rev[i]];
				}
				if ((rev[i + 1] != 0) || (rev[i] > 0)) {
					word[j] = word[j] + " Thousand";
				}
				break;


			case 4:
				aboveTens();
				break;

			case 5:
				if ((rev[i] == 0) || (rev[i + 1] == 1)) {
					word[j] = '';
				}
				else {
					word[j] = once[rev[i]];
				}
				if (rev[i + 1] !== '0' || rev[i] > '0') {
					word[j] = word[j] + " Lakh";
				}

				break;

			case 6:
				aboveTens();
				break;

			case 7:
				if ((rev[i] == 0) || (rev[i + 1] == 1)) {
					word[j] = '';
				}
				else {
					word[j] = once[rev[i]];
				}
				if (rev[i + 1] !== '0' || rev[i] > '0') {
					word[j] = word[j] + " Crore";
				}                
				break;

			case 8:
				aboveTens();
				break;          

			default: break;
		}
		j++;
	}

	function aboveTens() {
		if (rev[i] == 0) { word[j] = ''; }
		else if (rev[i] == 1) { word[j] = twos[rev[i - 1]]; }
		else { word[j] = tens[rev[i]]; }
	}

	word.reverse();
	var finalOutput = '';
	for (i = 0; i < numLength; i++) {
		finalOutput = finalOutput + word[i];
	}
	document.getElementById(outputControl).innerHTML = finalOutput;
}

/*number to words end*/



/*------ Mysql To javascript Date Change -----------*/
Date.createFromMysql = function(mysql_string)
{
   var t, result = null;
   if( typeof mysql_string === 'string' )
   {
      t = mysql_string.split(/[- :]/);
      //when t[3], t[4] and t[5] are missing they defaults to zero
      result = new Date(t[0], t[1] - 1, t[2], t[3] || 0, t[4] || 0, t[5] || 0);
   }
   return result;
}
/*example = var d1 = Date.createFromMysql(result_c.data[i].date_added);
d1.getDay()+'-'+d1.getMonth()+'-'+d1.getFullYear()*/
/*------ Mysql To javascript Date Change end here -----------*/

/*----------------------------------- Additional Validation End ----------------------------*/



/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/** ******  left menu  *********************** **/
website(function () {
    website( "li" ).first().addClass('topulmn');
    website( "ul li:first-child" ).addClass('topulmn');
    website( "li" ).last().addClass('bottomulmn');
    website( "ul li:last-child" ).addClass('bottomulmn');

});

website(function () 
{
    
// ------------- SideBar Start -------------
var CURRENT_URL = window.location.href.split('#')[0].split('?')[0],
    $BODY = website('body'),
    $MENU_TOGGLE = website('#menu_toggle'),
    $SIDEBAR_MENU = website('#sidebar-menu'),
    $SIDEBAR_FOOTER = website('.sidebar-footer'),
    $LEFT_COL = website('.left_col'),
    $RIGHT_COL = website('.right_col'),
    $NAV_MENU = website('.nav_menu'),
    $FOOTER = website('footer');

$SIDEBAR_MENU.find('a').on('click', function(ev) {
	    //console.log('clicked - sidebar_menu'); return false;
        var $li = website(this).parent();

        if ($li.is('.active')) {
            $li.removeClass('active active-sm');
            website('ul:first', $li).slideUp(function() {
                setContentHeight();
            });
        } else {
            // prevent closing menu if we are on child menu
            if (!$li.parent().is('.child_menu')) {
                $SIDEBAR_MENU.find('li').removeClass('active active-sm');
                $SIDEBAR_MENU.find('li ul').slideUp();
            }else
            {
				if ( $BODY.is( ".nav-sm" ) )
				{
					$li.parent().find( "li" ).removeClass( "active active-sm" );
					$li.parent().find( "li ul" ).slideUp();
				}
			}
            $li.addClass('active');

            website('ul:first', $li).slideDown(function() {
                setContentHeight();
            });
        }
    });

var setContentHeight = function () {
	// reset height
	$RIGHT_COL.css('min-height', website(window).height());

	var bodyHeight = $BODY.outerHeight(),
		footerHeight = $BODY.hasClass('footer_fixed') ? -10 : $FOOTER.height(),
		leftColHeight = $LEFT_COL.eq(1).height() + $SIDEBAR_FOOTER.height(),
		contentHeight = bodyHeight < leftColHeight ? leftColHeight : bodyHeight;

	// normalize content
	contentHeight -= $NAV_MENU.height() + footerHeight;

	$RIGHT_COL.css('min-height', contentHeight);
};

/*
$SIDEBAR_MENU.find('a').on('click', function(ev) {
      //console.log('clicked - sidebar_menu');
        var $li = website(this).parent();

        if ($li.is('.active')) {
            $li.removeClass('active active-sm');
            website('ul:first', $li).slideUp(function() {
                setContentHeight();
            });
        } else {
            // prevent closing menu if we are on child menu
            if (!$li.parent().is('.child_menu')) {
                $SIDEBAR_MENU.find('li').removeClass('active active-sm');
                $SIDEBAR_MENU.find('li ul').slideUp();
            }else
            {
                if ( $BODY.is( ".nav-sm" ) )
                {
                    $li.parent().find( "li" ).removeClass( "active active-sm" );
                    $li.parent().find( "li ul" ).slideUp();
                }
            }
            $li.addClass('active');

            website('ul:first', $li).slideDown(function() {
                setContentHeight();
            });
        }
    });
*/


// ------------- SideBar End -------------

    website('#menu_toggle').click(function () {
        if (website('body').hasClass('nav-md')) 
        {
            website('body').removeClass('nav-md');
            website('body').addClass('nav-sm');
            website('.left_col').removeClass('scroll-view');
            website('.left_col').removeAttr('style');
            website('.sidebar-footer').hide();

            if (website('#sidebar-menu li').hasClass('active')) {
                website('#sidebar-menu li.active').addClass('active-sm');
                website('#sidebar-menu li.active').removeClass('active');
                website('#sidebar-menu .child_menu').css('display','none');
            }
        } else {
            website('body').removeClass('nav-sm');
            website('body').addClass('nav-md');
            website('.sidebar-footer').show();

            if (website('#sidebar-menu li').hasClass('active-sm')) {
                website('#sidebar-menu li.active-sm').addClass('active');
                website('#sidebar-menu li.active-sm').removeClass('active-sm');
            }
        }
    });

website('.containergrid .row:first-child').addClass('nosearch');
//website( ".containergrid .row" ).first().addClass( "nosearch" );

});

/* Sidebar Menu active class */
website(function () {
    var url = window.location;
    website('#sidebar-menu a[href="' + url + '"]').parent('li').addClass('current-page');
    website('#sidebar-menu a').filter(function () {
        return this.href == url;
    }).parent('li').addClass('current-page').parent('ul').slideDown().parent().addClass('active');
});

/** ******  /left menu  *********************** **/



/** ******  tooltip  *********************** **/
website(function () {
        website('[data-toggle="tooltip"]').tooltip()
    })
    /** ******  /tooltip  *********************** **/
    /** ******  progressbar  *********************** **/
if (website(".progress .progress-bar")[0]) {
    website('.progress .progress-bar').progressbar(); // bootstrap 3
}
/** ******  /progressbar  *********************** **/
/** ******  switchery  *********************** **/
if (website(".js-switch")[0]) {
    var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
    elems.forEach(function (html) {
        var switchery = new Switchery(html, {
            color: '#26B99A'
        });
    });
}
/** ******  /switcher  *********************** **/
/** ******  collapse panel  *********************** **/
// Close ibox function
website('.close-link').click(function () {
    var content = website(this).closest('div.x_panel');
    content.remove();
});

// Collapse ibox function
website('.collapse-link').click(function () {
    var x_panel = website(this).closest('div.x_panel');
    var button = website(this).find('i');
    var content = x_panel.find('div.x_content');
    content.slideToggle(200);
    (x_panel.hasClass('fixed_height_390') ? x_panel.toggleClass('').toggleClass('fixed_height_390') : '');
    (x_panel.hasClass('fixed_height_320') ? x_panel.toggleClass('').toggleClass('fixed_height_320') : '');
    button.toggleClass('fa-chevron-up').toggleClass('fa-chevron-down');
    setTimeout(function () {
        x_panel.resize();
    }, 50);
});
/** ******  /collapse panel  *********************** **/
/** ******  iswitch  *********************** **/
/*if (website("input.flat")[0]) {
    website(document).ready(function () {
        website('input.flat').iCheck({
            checkboxClass: 'icheckbox_flat-green',
            radioClass: 'iradio_flat-green'
        });
    });
}*/
/** ******  /iswitch  *********************** **/

    /** ******  /table  *********************** **/
    /** ******    *********************** **/
    /** ******    *********************** **/
    /** ******    *********************** **/
    /** ******    *********************** **/
    /** ******    *********************** **/
    /** ******    *********************** **/
    /** ******  Accordion  *********************** **/

website(function () {
    website(".expand").on("click", function () {
        website(this).next().slideToggle(200);
        websiteexpand = website(this).find(">:first-child");

        if (websiteexpand.text() == "+") {
            websiteexpand.text("-");
        } else {
            websiteexpand.text("+");
        }
    });
});
// Search functionality
website("#search_text").on("keyup", function () {
    var keyword = website(this).val();
    if(website.trim(keyword))
    {
        var formdata = {getsearchwo:keyword};
        website.ajax({
            url:'search/getsearch',
            data:formdata,
            method:'POST',
            contentType:'application/x-www-form-urlencoded; charset=UTF-8',
            //default: 'application/x-www-form-urlencoded; charset=UTF-8' ,'multipart/form-data' , 'text/plain'
            dataType:"json",
            cache:false,
            success: function(response, textStatus, jqXHR)
            {
                if (response.logged === true) {

                    website('.containergrid .row.nosearch').hide();
                    website('.containergrid .row.search').remove();
                    var content = '';
                    var count   = 1;
                    content     += '<div class="row search">';
                    content     +=  '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 scrollflow -pop -opacity pad_set_align">';
                    for(var i = 0; i < response.data.length; i++)
                    {
                        if(i>9){
                            j = 1+1;
                        }
                        else
                        {
                            if(i===0)
                            {j= 1; }
                            else
                            {j = i;}
                        }

                        content     +=  '<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 bg_color_img'+j+' pad0">';
                        content     +=  '<div class="pad_p">';
                        content     +=  '<a href="virtualtools/vca" ><p><i class="fa fa-university" aria-hidden="true"></i></p></a>';
                        content     +=  '</div>';
                        content     +=  '<div class="text_background_color">';
                        content     +=  '<p class="heading_center text-center">'+response.data[i].category_name+'</p>';
                        content     +=  '<p class="decs_text">'+response.data[i].category_desc+'</p>';
                        content     +=  '</div>';
                        content     +=  '</div>';

                    }
                    content     += '</div>';
                    content     += '</div>';
                    website('.containergrid').append(content);

                    /*website.each(response, function(key, val){
                        if ((count - 1) % 3 === 0 || count == 1) {
                            
                        }

                        count++;
                    });*/

                    //website('.containergrid .row.search').show();
                }
                else
                    {
                        var content = '';
                        website('.containergrid .row.search').remove();
                        content     += '<div class="row search">';
                        content     +=  '<h3>';
                        content     +=  'No Result Found.Please Enter Another Keyword.';
                        content     +=  '</h3>';
                        content     += '</div>';
                        website('.containergrid').css({'text-align':'center'});
                        website('.containergrid').append(content);
                    }
            }
        });
    }
    else{
        website('.containergrid .row.search').remove();
        website('.containergrid .row.nosearch').show();
    }
});
//for mobile by vik
  website(document).ready(function(){
        website(".search_icons").click(function(){
           website(".mob_sarch_box").toggle(1000); 
        });
    });
//for mobile end



 
/* ############################ (rushi) NOTIFICATIONS on day Section START ############################ */
website(document).ready ( function()
{
    var today = new Date();
    //console.log(today); return false;
    
    var rday = today.getDate();    
    if(rday<10){ rday='0'+rday; } else { rday=rday; };
    var rmonth = today.getMonth() + 1;
    if(rmonth<10){ rmonth='0'+rmonth; } else { rmonth=rmonth; };
    var ryear = today.getFullYear();
    var rdate= ryear+'-'+rmonth+'-'+rday;     
    //console.log(rday,rmonth,ryear,rdate); return false;
    
    //IMP NOTE: This function is called to load all notifications which exists today.
    //trigger_notifications(rdate,rday,rmonth,ryear); 
    
    //IMP NOTE: This function is called to send email to users of EscalationMatrix if notifications exist.
    //email_notifications(rdate,rday,rmonth,ryear); 
    
    //checkinguserloggedin();
});


function trigger_notifications(rdate,rday,rmonth,ryear)
{
    var formdata = {fulldate:rdate,day:rday,month:rmonth,year:ryear};
    
    website.ajax({
                url:'importantduedates/fetchnotifications',
                data:formdata,
                method:'POST',
                //contentType:'json',
                contentType:'application/x-www-form-urlencoded; charset=UTF-8',
                //default: 'application/x-www-form-urlencoded; charset=UTF-8' ,'multipart/form-data' , 'text/plain'
                dataType:"json",
                cache:false,
                beforeSend: function() 
                {    },
                uploadProgress: function(event, position, total, percentComplete)
                {    },
                success:function(response)
                {
                    //console.log(response); return;
                    
                    if(response.logged===true)
                    {
                        website('#notificationModal').modal('show');
                        //website('#notificationDoneUpload').modal('show');
                        var addhtml='', addhtmlnxt='';
                        
                        for(var i = 0; i < response.data.length; i++) 
                        {   
                            addhtmlnxt += '<div class="col-md-6 col-sm-6 col-xs-12">';
                            addhtmlnxt += '<div class="x_panel">';
                            addhtmlnxt += '<div class="x_title">';
                            addhtmlnxt += '<h2>'+response.data[i].trigger_date+'</h2>';
                            addhtmlnxt += '<div class="clearfix"></div>';
                            addhtmlnxt += '</div>';
                            addhtmlnxt += '<div class="x_content">';
                            addhtmlnxt += '<p><b>'+response.data[i].eventname+'</b></p>';
                            addhtmlnxt += '<p><b>Due Date : </b>'+response.data[i].notification_date+'</p>';
                            addhtmlnxt += '<p><b>Today : </b>'+response.data[i].trigger_date+'</p>';
                            addhtmlnxt += '</div>';
                            addhtmlnxt += '<button type="button" class="btn btn-primary notifydone" notification_id="'+response.data[i].srno+'" duedate="'+response.data[i].notification_date+'" trigger_date="'+response.data[i].trigger_date+'" snoozecount="'+response.data[i].snoozecount+'"><span class="fa fa-check-square-o"> Done</span></button>';
                            addhtmlnxt += '<button type="button" class="btn btn-danger notifysnooze" notification_id="'+response.data[i].srno+'" duedate="'+response.data[i].notification_date+'" trigger_date="'+response.data[i].trigger_date+'" snoozecount="'+response.data[i].snoozecount+'" ><span class="fa fa-clock-o"> Snooze</span></button>';
                            addhtmlnxt += '</div>';
                            addhtmlnxt += '</div>';
                            
                            website('.notificationsection').html(addhtmlnxt);
                        }
                    }
                    else
                    {
                        //console.log('here in else'); return;
                        //website('.event_heading').html(response.message);
                    }
                },
                complete: function(response)
                {
                    
                },
                error:function(response)
                {                    
                    //console.log(response);
                }
            });
}

function email_notifications(rdate,rday,rmonth,ryear)
{
    var formdata = {fulldate:rdate,day:rday,month:rmonth,year:ryear};
    
    website.ajax({
                url:'importantduedates/emailnotifications',
                data:formdata,
                method:'POST',
                //contentType:'json',
                contentType:'application/x-www-form-urlencoded; charset=UTF-8',
                //default: 'application/x-www-form-urlencoded; charset=UTF-8' ,'multipart/form-data' , 'text/plain'
                dataType:"json",
                cache:false,
                beforeSend: function() 
                {    },
                uploadProgress: function(event, position, total, percentComplete)
                {    },
                success:function(response)
                {
                    //console.log(response); return;
                },
                complete: function(response)
                {
                },
                error:function(response)
                {                    
                    //console.log(response);
                }
            });
}


/* ############################ (rushi) NOTIFICATIONS on day Section END ############################ */



website(function() {
    var websiteelem = website('.container');

    website('#nav_up').fadeIn('slow');
    website('#nav_down').fadeIn('slow');  

    website(window).bind('scrollstart', function(){
        website('#nav_up,#nav_down').stop().animate({'opacity':'0.2'});
    });
    website(window).bind('scrollstop', function(){
        website('#nav_up,#nav_down').stop().animate({'opacity':'1'});
    });

    website('#nav_down').click(
        function (e) {
            website('html, body').animate({scrollTop: websiteelem.height()}, 800);
        }
    );
    website('#nav_up').click(
        function (e) {
            website('html, body').animate({scrollTop: '0px'}, 800);
        }
    );
});

function validateField_panOfDeductee(field, toclear) {
	if (toclear) {
		clearFieldErrorMessages(field);
		clearFieldErrorLabels(field);
	}
	var errors = false;
	var continueValidation = true;
	if (continueValidation
			&& requiredStringCheck(field, " Please enter a PAN.")) {
		errors = true;
		continueValidation = false;
	}
	if (continueValidation
			&& stringLengthCheck(field, "Invalid PAN. Please retry.", '10',
					'10')) {
		errors = true;
		continueValidation = false;
	}
	if (continueValidation
			&& regexCheck(field, "Invalid PAN. Please retry .",
					'[A-Za-z]{5}[0-9]{4}[A-Za-z]{1}$')) {
		errors = true;
		continueValidation = false;
	}
	return !errors;
}

website(document).ready(function() {
    website(".button-floating").click(function() {
        var websitewrapper = website("#btnmnwrapper");

        if (!websitewrapper.hasClass("button-floating-clicked"))
        {
            websitewrapper.attr("class", "center");
            websitewrapper.toggleClass("button-floating-clicked-out");
        }

        websitewrapper.toggleClass("button-floating-clicked");

        website(".button-sub").click(function() {
            var color = website(this).data("color");

            websitewrapper.attr("class", "center button-floating-clicked button-floating-clicked-out");
            websitewrapper.addClass("button-sub-" + color + "-clicked");
        });
    });
});

function getorgdtm()
{
    var formData ='';
    website.ajax({
        url:'organisation/getorgdt',
        data:formData,
        method:'POST',
        contentType:'application/x-www-form-urlencoded; charset=UTF-8',
        dataType:"json",
        cache:false,
        beforeSend: function()
        { website('.progress-indeterminate').fadeIn();  },
        uploadProgress: function(event, position, total, percentComplete)
        {},
        success: function(response, textStatus, jqXHR)
        {
            if(response.logged===true)
            {    
                    
                if( response.data.empcount=='0' )
                    {
                        website('.updateorgmn').fadeOut();
                        website('.footnote').fadeOut();
                        website('.updateorgemp').fadeIn();
                        website('#myModaleorginit').modal('show');
                    }
                else
                    {
                        website('#myModaleorginit').modal('hide');
                    }
                    
                
            }
            else
            {
                website('.updateorgmn').fadeIn();
                website('.updateorgemp').fadeIn();
                website('#myModaleorginit').modal('show');
            }
        },
        complete: function(response)
        {  website('.progress-indeterminate').fadeOut(); },
        error: function(jqXHR, textStatus, errorThrown)
        {}
    });
}
//getorgdtm();

function gettaskbundleto()
{
    var appendhtml ='';
    var formData = {tpof:'all',cid:0};
    website.ajax({
        url:'taskbundle/getttodaywman',
        data:formData,
        method:'POST',
        contentType:'application/x-www-form-urlencoded; charset=UTF-8',
        dataType:"json",
        cache:false,
        beforeSend: function()
        { website('.progress-indeterminate').fadeIn();  },
        uploadProgress: function(event, position, total, percentComplete)
        {   },
        success: function(response, textStatus, jqXHR)
        {
            var appendhtml='',appendhtmlm='',clrddot='',appendhtmlmn='';
            website(".top_blo_center").mCustomScrollbar('destroy');
            if(response.logged===true)
            {
                if(response.data.length>0)
                 {
                    for (var i=0;i<response.data.length;i++)
                    {
                        appendhtmlm='';
                        appendhtml +='<div class="notification">';
                        appendhtml +='<div class="notification-image-wrapper">';
                        appendhtml +='<div class="notification-image">';
                        appendhtml +='<i class="fa fa-bell"></i>';
                        appendhtml +='</div>';
                        appendhtml +='</div>';
                        appendhtml +='<div class="notification-text">';
                        appendhtml +='<span class="highlight">'+response.data[i].event.meettp+'</span> '+response.data[i].event.eventname;                   
                        appendhtml +='</div>';
                        appendhtml +='</div>';
                    }
                     website('.top_blo_center').html(appendhtml);
                }
                var mfmmm='',appendhtmlfm='',mfmmmcl='';
                if(response.mgenditm.length>0)
                    {
                        for (var n=0;n<response.mgenditm.length;n++)
                        {
                            appendhtmlfm +='<div class="notification">';
                            appendhtmlfm +='<div class="notification-image-wrapper">';
                            appendhtmlfm +='<div class="notification-image">';
                            appendhtmlfm +='<i class="fa fa-bell"></i>';
                            appendhtmlfm +='</div>';
                            appendhtmlfm +='</div>';
                            appendhtmlfm +='<div class="notification-text">';
                            if(response.mgenditm[n].modstatus=='1'){mfmmm = 'Completed'; mfmmmcl ='voiletcolor';}else{mfmmm = 'No Completed';mfmmmcl ='orangecolor';}
                            appendhtmlfm +='<div class="mnmnbmmm">Event Name : '+response.mgenditm[n].eventname+'</div>';  
                            appendhtmlfm +='<div class="mnmnmnmmm">Event date : '+response.mgenditm[n].zeventdate+'</div>';   
                            appendhtmlfm +='<div class="floatleft"><span class="highlight">'+response.mgenditm[n].itemtxt+'</span></div>';
                            appendhtmlfm +='<div class="floatright '+mfmmmcl+'"></div>';  
                            appendhtmlfm +='<div class="clearelement"></div>';
                            
                            appendhtmlfm +='</div>';
                            appendhtmlfm +='</div>';
                        }
                        website('.top_blofff_center').html(appendhtmlfm);
                    }
                
                
                var notcount = parseFloat(response.data.length)+parseFloat(response.mgenditm.length);
                
                website('#dd-notifications-count').html(notcount);
                
                
                
                // if(notcount > 0)
                //     {
                        
                //         website('.fa-bell-o').addClass('pulse2');
                        
                //         setTimeout(function(){ 
                //             website('#mnotificationcmmm .player_audio').attr("src","mp3/ios_notification.mp3"); 
                //                              website('.player_audio').trigger('play');
                //         }, 1000);
                //     }
                // else
                //     {
                //         appendhtml +='<div class="notification">';
                //         appendhtml +='<div class="bs-example" data-example-id="simple-jumbotron">';
                //         appendhtml +='<div class="jumbotron">';
                //         appendhtml +='<p class="not_record_m"><i class="fa fa-bell-slash-o"></i></p>';                
                //         appendhtml +='<p>No records found yet</p>';
                //         appendhtml +='</div>';
                //         appendhtml +='</div>';
                //         appendhtml +='</div>';
                //         website('.top_blofff_center').html(appendhtml);
                //     }
                
            }
            else
            {
                appendhtml +='<div class="notification">';
                appendhtml +='<div class="bs-example" data-example-id="simple-jumbotron">';
                appendhtml +='<div class="jumbotron">';
                appendhtml +='<p class="not_record_m"><i class="fa fa-bell-slash-o"></i></p>';                
                appendhtml +='<p>No records found yet</p>';
                appendhtml +='</div>';
                appendhtml +='</div>';
                appendhtml +='</div>';
            }
            /*<li><a href="accountsetting?moc=changepwd"><i class="icon-user-lock"></i> Account security</a></li>*/
                       
            
            
            /*website(".table-contract").mCustomScrollbar({axis:"y",scrollButtons:{enable:true},theme:"rounded-dark",scrollbarPosition:"inside"});*/
            website(".mnnmp").mCustomScrollbar({
                                    scrollButtons:{enable:true,scrollType:"stepped"},
                                    keyboard:{scrollType:"stepped"},
                                    mouseWheel:{scrollAmount:188},
                                    theme:"rounded-dark",
                            });
        },
        complete: function(response)
        {  website('.progress-indeterminate').fadeOut(); },
        error: function(jqXHR, textStatus, errorThrown)
        {   }
    });
 }  
website('body').on('click','.bottomulmn', function(e) 
{
    website.ajax({
        url:'tradingrequest/deletenotification',
        // data:formData,
        method:'POST',
        contentType:'application/x-www-form-urlencoded; charset=UTF-8',
        dataType:"json",
        cache:false,
        beforeSend: function()
        {   },
        uploadProgress: function(event, position, total, percentComplete)
        {   },
        success: function(response, textStatus, jqXHR)
        {
        }
});

});




