website(document).ready(function () {
    fetchEmpDetails();
    inittinymace();
});

function fetchEmpDetails()
{
    website.ajax({
    url: "coi/fetchEmpDetails",
    //data:formdata,
    method: "POST",
    //contentType:'json',
    contentType: "application/x-www-form-urlencoded; charset=UTF-8",
    //default: 'application/x-www-form-urlencoded; charset=UTF-8' ,'multipart/form-data' , 'text/plain'
    dataType: "json",
    cache: false,
    //async:true, /*Cross domain checking*/
    beforeSend: function () {},
    uploadProgress: function (event, position, total, percentComplete) {},
    success: function (response, textStatus, jqXHR) 
    {
        if(response.logged === true) 
        {
            //console.log(response.data.fullname)
            website('.empname').html(response.data.fullname);
            website('.empid').html(response.data.employeecode);
            website('.designation').html(response.data.designation);
            website('.department').html(response.data.deptname);
            website('.dept').html(response.data.dept);
            website('.hr').html(response.data.hr);
            
        }
    },
    complete: function (response) {},
    error: function (jqXHR, textStatus, errorThrown) {},
  });
}

function inittinymace()
{
    tinymce.init({
        selector: 'textarea.textareforedit',  // change this value according to your HTML
        plugins: ["lists"],
        a_plugin_option: true,
        toolbar: 'undo redo | formatselect | ' +
        'bold italic backcolor | alignleft aligncenttextareforediter ' +
        'alignright alignjustify | bullist numlist outdent indent | ' +
        'removeformat ',
        a_configuration_option: 400
    });
}

website("body").on("click", ".coipolicy", function (e) {
    var coival = website(this).val();
    if(coival == 'Yes')
    {
        website("input[name=coipolicy][value=No]").removeAttr('checked');
        website("input[name=coipolicy][value=Yes]").attr('checked', 'checked');
        website('.divcoipolicy').css('display','block');
        website('#attachment_section').css('display','block');
    }
    else if(coival == 'No')
    {
        website('.divcoipolicy').css('display','none');
        website('#attachment_section').css('display','none');
    }
});

website("#coicategory").change(function () {
    var coicate = website(this).val();
    //console.log(coicate);
    var formdata = {coicate:coicate}
    website.ajax({
    url: "coi/fetchCateQuestions",
    data:formdata,
    method: "POST",
    //contentType:'json',
    contentType: "application/x-www-form-urlencoded; charset=UTF-8",
    //default: 'application/x-www-form-urlencoded; charset=UTF-8' ,'multipart/form-data' , 'text/plain'
    dataType: "json",
    cache: false,
    //async:true, /*Cross domain checking*/
    beforeSend: function () {},
    uploadProgress: function (event, position, total, percentComplete) {},
    success: function (response, textStatus, jqXHR) 
    {
        if(response.logged === true) 
        {
            website('.coicateque').html(response.data)
        }
    },
    complete: function (response) {},
    error: function (jqXHR, textStatus, errorThrown) {},
  });
});

website('body').on('click','.savecoi',function(e)
{
    var others_des = tinyMCE.activeEditor.getContent();
    website('#insertcoi #others_des').val(others_des);
    var coipolicy = website('#insertcoi input[name="coipolicy"]:checked').val();
    var coicategory = website('#insertcoi #coicategory').val();
    var cateque = website('#insertcoi input[name="question"]:checked').val();
    var catequeid = website('#insertcoi input[name="question"]:checked').attr('id');
    //console.log(catequeid)
    website('#insertcoi .coicategory option[value="'+coicategory+'"]').attr("selected", "selected");
    website('input[name=question][value="'+cateque+'"]').attr('checked', 'checked');
    
    
    if(coipolicy == 'Yes' && coicategory == '')
    {
        new PNotify({
            title: "Alert",
            text: 'Please select the category.',
            type: "university",
            hide: true,
            styling: "bootstrap3",
            addclass: "dark ",
        });
    }
    else if(coipolicy == 'Yes' && !cateque)
    {
        new PNotify({
            title: "Alert",
            text: 'Please select the category question.',
            type: "university",
            hide: true,
            styling: "bootstrap3",
            addclass: "dark ",
        });
    }
    else
    {
        website('#insertcoi #attachment_section').css("display", "none");
        website('#insertcoi #textarea_others').html('<div class="form-group"><textarea class="form-control rounded-0" id="textarea_othershtml"></textarea></div>');
        website('#insertcoi #textarea_others').css("display", "block");
        website('#insertcoi #coiothers').css("display", "none");
        var decoded_others_des = website("<div/>").html(others_des).text();
        website('#insertcoi #textarea_othershtml').html(decoded_others_des);
        var pdfdata = website("div .coihtmldata").html();
        website('#insertcoi #coipdfhtml').val(pdfdata)
        //console.log(pdfdata);
        /*website('#insertcoi #attachment_section').css("display", "block");*/
        website(".modalcoihtmldata").html(pdfdata);
        
        //website('.modalcoihtmldata #textarea_othershtml').html(others_des);
        website('.modalcoihtmldata #attachment_section').css("display", "none");
        /*website('.modalcoihtmldata #textarea_others').css("display", "none");*/
        website("#Mymodalcoideclara").modal("show");
    }
    
});

website("#insertcoi").ajaxForm({
  dataType: "json",
  beforeSend: function () 
  { website(".preloder_wraper").fadeIn();},
  uploadProgress: function (event, position, total, percentComplete) 
  { website(".preloder_wraper").fadeIn();},
  success: function (response, textStatus, jqXHR) 
  {
    if(response.logged === true) 
    {
        website('#sendcoiforapproval').modal('hide');
        website("#Mymodalcoideclara .coigeneratepdf").css("display", "none");
        
        new PNotify({
            title: "Alert",
            text: response.message,
            type: "university",
            hide: true,
            styling: "bootstrap3",
            addclass: "dark ",
        });
         website("#Mymodalcoideclara #downloadpdf").append('<a  href="' +
            response.pdfpath +
            '" target="_blank" class="downlodthfle btn btn-primary" style="color: white;"><span class="glyphicon-download-alt floatleft">Download</span> </a>'
        );
        
        /*var baseHref=getbaseurl();
        setTimeout(function(){window.location.href=baseHref+'coi';},1000);*/
    } 
    else 
    {
        new PNotify({
            title: "Alert",
            text: response.message,
            type: "university",
            hide: true,
            styling: "bootstrap3",
            addclass: "dark ",
        });
    }
  },
  complete: function (response) 
  { website(".preloder_wraper").fadeOut();},
  error: function (jqXHR, textStatus, errorThrown) {},
});

website("body").on("click", ".coigeneratepdf", function (e) {
    website("#sendcoiforapproval").modal("show");
});

website("body").on("click", ".sendcoiform", function (e) {
    var sendtype = website(this).val();
    website('#insertcoi #formsendtype').val(sendtype);
    website('#insertcoi').submit();
});

website("body").on("click", ".cateque", function (e) {
    var idattr = website(this).attr('id');
    //console.log(idattr)
    if (idattr.indexOf('_others') > -1) 
    {
        website('#coiothers').css('display','block');
    }
    else
    {
        website('#coiothers').css('display','none');
    }
});

/* ----- Start Add/Delete Email Rows ----- */
website('body').on('click','.btnaddfile',function()
{
    var getlastid = website('.appendfile').attr('filecntr');
    //console.log(getlastid); return false;
    getlastid = ++getlastid;
    
    var addhtmlnxt='';
    addhtmlnxt += '<div class="col-md-12 col-xs-12 " id="row-'+getlastid+'">';
    addhtmlnxt += '<label class="control-label">Upload File</label>';
    addhtmlnxt += '<div class="choose_files">';
    addhtmlnxt += '<input type="file" name="attachment[]" id="attachment" >';
    addhtmlnxt += '</div>';
    addhtmlnxt += '</div>';
    
    website('.appendfile').append(addhtmlnxt);
    website('.appendfile').attr('filecntr',getlastid);
});

website('body').on('click','.btndeletefile',function()
{
    var rownum  = website('.appendfile').attr('filecntr');
    //console.log(rownum); return false;     
    if(rownum != 1)
    {
        website('.appendfile #row-'+rownum).remove();
        website('.appendfile').attr('filecntr',parseInt(rownum)-1);
    }
    else
    {
        return false;
    }    
});
/* ----- Start Add/Delete Email Rows ----- */