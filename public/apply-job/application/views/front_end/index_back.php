<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>National Institute of Rock Mechanics</title>
	<meta http-equiv="Content-Type" content="text/html; charset=WINDOWS-1252">
	<meta name="description" content="National Institute of Rock Mechanics, Kolar Gold Fields, India is a 
	Premier Research Institute engaged in Research, Training and Consultancy in all areas of Rock Engineering">
	<meta name="keywords" content="Kolar Gold Fields, KGF, NIRM, Rock Mechanics, Engineering Geophysics, GPR Tomography, 
	Seismic Tomography, GPR Profiling, Seismic Refraction, Resistivity Imaging,  Geotechnical Engineering, Numerical Modelling, 
	Rock &amp; Material Testing, In-situ NDT testing, Blasting, Excavation Engineering, Coal Mining, Environmental Geotechnology,
	In-situ stress measurement, P. C. Jha, Fracture Mechanics, Granite Mining, Mining Electronics, Rockbursts,
	Seismology, Broad-band recording, Centre of Excellence in Rock Engineering">


    <!-- Mobile Meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- Put favicon.ico and apple-touch-icon(s).png in the images folder -->
	<link rel="shortcut icon" href="<?php echo base_url();?>../assets/small.png">

    <!-- CSS StyleSheets -->
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,700,800&amp;amp;subset=latin,latin-ext">
    <link rel="stylesheet" href="<?php echo base_url();?>../css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>../css/animate.css">
    <link rel="stylesheet" href="<?php echo base_url();?>../css/prettyPhoto.css">
    <link rel="stylesheet" href="<?php echo base_url();?>../css/slick.css">
    <link rel="stylesheet" href="<?php echo base_url();?>../rs-plugin/css/settings.css">
    <link rel="stylesheet" href="<?php echo base_url();?>../css/style.css">
    <link rel="stylesheet" href="<?php echo base_url();?>../css/responsive.css">

    <link rel="stylesheet" href="<?php echo base_url();?>../css/skins/default.css">
    <script type="text/javascript" src="<?php echo base_url();?>../js/jquery-1.9.1.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>../js/jssor.slider.mini.js"></script>
	
    <script>
        jQuery(document).ready(function($) {

            var jssor_1_SlideoTransitions = [
                [{
                    b: 5500,
                    d: 3000,
                    o: -1,
                    r: 240,
                    e: {
                        r: 2
                    }
                }],
                [{
                    b: -1,
                    d: 1,
                    o: -1,
                    c: {
                        x: 51.0,
                        t: -51.0
                    }
                }, {
                    b: 0,
                    d: 1000,
                    o: 1,
                    c: {
                        x: -51.0,
                        t: 51.0
                    },
                    e: {
                        o: 7,
                        c: {
                            x: 7,
                            t: 7
                        }
                    }
                }],
                [{
                    b: -1,
                    d: 1,
                    o: -1,
                    sX: 9,
                    sY: 9
                }, {
                    b: 1000,
                    d: 1000,
                    o: 1,
                    sX: -9,
                    sY: -9,
                    e: {
                        sX: 2,
                        sY: 2
                    }
                }],
                [{
                    b: -1,
                    d: 1,
                    o: -1,
                    r: -180,
                    sX: 9,
                    sY: 9
                }, {
                    b: 2000,
                    d: 1000,
                    o: 1,
                    r: 180,
                    sX: -9,
                    sY: -9,
                    e: {
                        r: 2,
                        sX: 2,
                        sY: 2
                    }
                }],
                [{
                    b: -1,
                    d: 1,
                    o: -1
                }, {
                    b: 3000,
                    d: 2000,
                    y: 180,
                    o: 1,
                    e: {
                        y: 16
                    }
                }],
                [{
                    b: -1,
                    d: 1,
                    o: -1,
                    r: -150
                }, {
                    b: 7500,
                    d: 1600,
                    o: 1,
                    r: 150,
                    e: {
                        r: 3
                    }
                }],
                [{
                    b: 10000,
                    d: 2000,
                    x: -379,
                    e: {
                        x: 7
                    }
                }],
                [{
                    b: 10000,
                    d: 2000,
                    x: -379,
                    e: {
                        x: 7
                    }
                }],
                [{
                    b: -1,
                    d: 1,
                    o: -1,
                    r: 288,
                    sX: 9,
                    sY: 9
                }, {
                    b: 9100,
                    d: 900,
                    x: -1400,
                    y: -660,
                    o: 1,
                    r: -288,
                    sX: -9,
                    sY: -9,
                    e: {
                        r: 6
                    }
                }, {
                    b: 10000,
                    d: 1600,
                    x: -200,
                    o: -1,
                    e: {
                        x: 16
                    }
                }]
            ];

            var jssor_1_options = {
                $AutoPlay: true,
                $SlideDuration: 800,
                $SlideEasing: $Jease$.$OutQuint,
                $CaptionSliderOptions: {
                    $Class: $JssorCaptionSlideo$,
                    $Transitions: jssor_1_SlideoTransitions
                },
                $ArrowNavigatorOptions: {
                    $Class: $JssorArrowNavigator$
                },
                $BulletNavigatorOptions: {
                    $Class: $JssorBulletNavigator$
                }
            };

            var jssor_1_slider = new $JssorSlider$("jssor_1", jssor_1_options);

            //responsive code begin
            //you can remove responsive code if you don't want the slider scales while window resizing
            function ScaleSlider() {
                var refSize = jssor_1_slider.$Elmt.parentNode.clientWidth;
                if (refSize) {
                    refSize = Math.min(refSize, 1920);
                    jssor_1_slider.$ScaleWidth(refSize);
                } else {
                    window.setTimeout(ScaleSlider, 30);
                }
            }
            ScaleSlider();
            $(window).bind("load", ScaleSlider);
            $(window).bind("resize", ScaleSlider);
            $(window).bind("orientationchange", ScaleSlider);
            //responsive code end
        });
    </script>

    <style>
        /* jssor slider bullet navigator skin 05 css */
        /*
        .jssorb05 div           (normal)
        .jssorb05 div:hover     (normal mouseover)
        .jssorb05 .av           (active)
        .jssorb05 .av:hover     (active mouseover)
        .jssorb05 .dn           (mousedown)
        */
        
        .jssorb05 {
            position: absolute;
        }
        
        .jssorb05 div,
        .jssorb05 div:hover,
        .jssorb05 .av {
            position: absolute;
            /* size of bullet elment */
            width: 16px;
            height: 16px;
            background: url('<?php echo base_url();?>../img/b05.png') no-repeat;
            overflow: hidden;
            cursor: pointer;
        }
        
        .jssorb05 div {
            background-position: -7px -7px;
        }
        
        .jssorb05 div:hover,
        .jssorb05 .av:hover {
            background-position: -37px -7px;
        }
        
        .jssorb05 .av {
            background-position: -67px -7px;
        }
        
        .jssorb05 .dn,
        .jssorb05 .dn:hover {
            background-position: -97px -7px;
        }
        /* jssor slider arrow navigator skin 22 css */
        /*
        .jssora22l                  (normal)
        .jssora22r                  (normal)
        .jssora22l:hover            (normal mouseover)
        .jssora22r:hover            (normal mouseover)
        .jssora22l.jssora22ldn      (mousedown)
        .jssora22r.jssora22rdn      (mousedown)
        */
        
        .jssora22l,
        .jssora22r {
            display: block;
            position: absolute;
            /* size of arrow element */
            width: 40px;
            height: 58px;
            cursor: pointer;
            background: url('<?php echo base_url();?>../img/a22.png') center center no-repeat;
            overflow: hidden;
        }
        
        .jssora22l {
            background-position: -10px -31px;
        }
        
        .jssora22r {
            background-position: -70px -31px;
        }
        
        .jssora22l:hover {
            background-position: -130px -31px;
        }
        
        .jssora22r:hover {
            background-position: -190px -31px;
        }
        
        .jssora22l.jssora22ldn {
            background-position: -250px -31px;
        }
        
        .jssora22r.jssora22rdn {
            background-position: -310px -31px;
        }
    </style>
	
	<style>
	
	/* 
	Max width before this PARTICULAR table gets nasty
	This query will take effect for any screen smaller than 760px
	and also iPads specifically.
	*/
	@media 
	only screen and (max-width: 760px),
	(min-device-width: 768px) and (max-device-width: 1024px)  {
	
		/* Force table to not be like tables anymore */
		table, thead, tbody, th, td, tr { 
			display: block; 
		}
		
		/* Hide table headers (but not display: none;, for accessibility) */
		thead tr { 
			position: absolute;
			top: -9999px;
			left: -9999px;
		}
		
		tr { border: 1px solid #ccc; }
		
		td { 
			/* Behave  like a "row" */
			border: none;
			border-bottom: 1px solid #eee; 
			position: relative;
			padding-left: 6%; 
		}
		
		td:before { 
			/* Now like a table header */
			position: absolute;
			/* Top/left values mimic padding */
			top: 6px;
			left: 6px;
			width: 45%; 
			padding-right: 10px; 
			white-space: nowrap;
		}
		
		/*
		Label the data
		*/
		
	}
	
	/* Smartphones (portrait and landscape) ----------- */
	@media only screen
	and (min-device-width : 320px)
	and (max-device-width : 480px) 
	{
			body 
			{ 
				padding: 0; 
				margin: 0; 
				width: 320px; 
			}
		}
	
	/* iPads (portrait and landscape) ----------- */
	@media only screen and (min-device-width: 768px) and (max-device-width: 1024px) {
		body { 
			width: 495px; 
		}
	}
	
	</style>
	<style>
		.contact-form input[type=text]
		{
			float:none;
		}
	</style>
	<script src="<?php echo base_url();?>../pop/jquery-loader.js"></script>
    <link rel="stylesheet" href="<?php echo base_url();?>../pop/qunit/qunit/qunit.css" media="screen">
    <script src="<?php echo base_url();?>../pop/qunit/qunit/qunit.js"></script>
    <link rel="stylesheet" href="<?php echo base_url();?>../pop/remodal.css">
    <link rel="stylesheet" href="<?php echo base_url();?>../pop/remodal-default-theme.css">
    <script src="<?php echo base_url();?>../pop/remodal.js"></script>
    <script src="<?php echo base_url();?>../popremodal_test.js"></script>
    <style>
        .remodal-overlay.without-animation.remodal-is-opening,
        .remodal-overlay.without-animation.remodal-is-closing,
        .remodal.without-animation.remodal-is-opening,
        .remodal.without-animation.remodal-is-closing,
        .remodal-bg.without-animation.remodal-is-opening,
        .remodal-bg.without-animation.remodal-is-closing {
            animation: none;
        }
    </style>
	<style>
			/* The Modal (background) */
			.modal {
				display: none; /* Hidden by default */
				position: fixed; /* Stay in place */
				z-index: 9999; /* Sit on top */
				padding-top: 100px; /* Location of the box */
				
				left: 0;
				top: 0;
				width: 100%; /* Full width */
				height: 100%; /* Full height */
				overflow: auto; /* Enable scroll if needed */
				background-color: rgb(0,0,0); /* Fallback color */
				background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
			}

			/* Modal Content */
			.modal-content {
				background-color: #fefefe;
				margin: auto;
				padding: 20px;
				padding-bottom: 0%;
				border: 1px solid #888;
				width: 40%;
			}

			/* The Close Button */
			.close {
				color: #aaaaaa;
				float: right;
				font-size: 28px;
				font-weight: bold;
			}

			.close:hover,
			.close:focus {
				color: #000;
				text-decoration: none;
				cursor: pointer;
			}
	</style>

<style>
		@media only screen and (max-width: 768px) 
		{
			/* For mobile phones: */
			.modal-content 
			{
				width: 80%;
			}
		}
</style>
	<script>
		function check_citizen()
		{
			val=$("#citizen").val();
			if(val=="Yes")
			{
				$("#state_div").css("display","block");
				$("#state").attr("required",true);
				$("#not_indian").css("display","none");
				$("#other_country").attr("required",false);
			}
			else if(val=="No")
			{
				$("#other_country").attr("required",true);
				$("#state_div").css("display","none");
				$("#not_indian").css("display","block");
				$("#state").attr("required",false);
			}
		}
		function check_medical()
		{
			val=$("#medical").val();
			if(val=="Yes")
			{
				$("#medical_div").css("display","block");
				$("#medical_details").attr("required",true);
			}
			else
			{
				$("#medical_div").css("display","none");
				$("#medical_details").attr("required",false);
			}
		}
		function check_outside()
		{
			val=$("#outside").val();
			if(val=="Yes")
			{
				$("#outside_ind").css("display","block");
			}
			else
			{
				$("#outside_ind").css("display","none");
			}
		}
		function check_vrs1()
		{
			val=$("#vrs").val();
			if(val=="Yes")
			{
				$("#vrs_div").css("display","block");
				$("#vrs_details").attr("required",true);
			}
			else
			{
				$("#vrs_div").css("display","none");
				$("#vrs_details").attr("required",false);
			}
		}
		function check_nirm()
		{
			val=$("#nirm_earlier").val();
			if(val=="Yes")
			{
				$("#nirm_earlier_div").css("display","block");
			}
			else
			{
				$("#nirm_earlier_div").css("display","none");
			}
		}
		function check_govt_servant()
		{
			val=$("#govt_servant").val();
			if(val=="Yes")
			{
				$("#govt_servant_div").css("display","block");
				$("#nature_app").attr("required",true);
				$("#noa_doc").attr("required",true);
			}
			else if(val=="No")
			{
				$("#govt_servant_div").css("display","none");
				$("#nature_app").attr("required",false);
				$("#noa_doc").attr("required",false);
			}
		}
		function check_min_emoluments()
		{
			val=$("#min_emoluments").val();
			if(val=="Yes")
			{
				$("#min_emoluments_div").css("display","none");
				$("#lowest_initial").attr("required",false);
			}
			else if(val=="No")
			{
				$("#min_emoluments_div").css("display","block");
				$("#lowest_initial").attr("required",true);
			}
		}
		function check_suspended_info()
		{
			suspended=$("#suspended").val();
			if(suspended=="Yes")
			{
				$("#suspended_div").css("display","block");
				$("#suspended_info").attr("required",true);
			}
			else
			{
				$("#suspended_div").css("display","none");
				$("#suspended_info").attr("required",false);
			}
		}
		function check_arrested_info()
		{
			arrested=$("#arrested").val();
			if(arrested=="Yes")
			{
				$("#arrested_div").css("display","block");
				$("#arrested_info").attr("required",true);
			}
			else
			{
				$("#arrested_div").css("display","none");
				$("#arrested_info").attr("required",false);
			}
		}
		function check_regligion_info()
		{
			religion=$("#religion_changed").val();
			if(religion=="Yes")
			{
				$("#religion_div").css("display","block");
				$("#religion_info").attr("required",true);
			}
			else
			{
				$("#religion_div").css("display","none");
				$("#religion_info").attr("required",false);
			}
		}
	</script>
	<script>
		function job_change()
		{
			$("#qualification").val("");
			$("#dob").val("");
			$("#category").val("");
			get_job_details();
		}
		function validate_qualification()
		{
			post_name=$("#post_name").val();
			qualification=$("#qualification").val();
			
			if(post_name =="" || qualification =="")
			{
				return;
			}
				jQuery.ajax({
					type:"POST",
					url:"<?php echo base_url(); ?>" + "/home/validate_qualification",
					datatype:"text",
					data:{post_name:post_name,qualification:qualification},
					success:function(response)
					{
						if(response==0)
						{
							var modal = document.getElementById('my_pop1');
							modal.style.display = "block";
							$("#qualification").val("");
						}
					},
					error:function (xhr, ajaxOptions, thrownError){}
					});
		}
		function validate_age()
		{
			post_value=$("#post_code").val();
			vrs=$("#vrs").val();
			post_name=$("#post_name").val();
			dob=$("#dob").val();
			category=$("#category").val();
			job_for=$("#job_for").val();
			code="";
			res=post_value.split("-");
			post_code=res[1];
			
			var post_match ="";
			if(job_for.indexOf(category) != -1)
			{
				var post_match ="found";
			}
			else if(job_for.indexOf("General") !=-1)
			{
				var post_match="found";
			}
			if(post_value=="")
			{
				alert("Please Select Post Code & Category !");
				$("#category").val("");
				return;
			}
				if(post_code !="" && category !="")
				{
					if(post_code !="")
					{
						if(post_code =="UR")
						{
							code="General";
						}
						else if(post_code=="OBC")
						{
							code="OBC";
						}
						else if(post_code=="SC")
						{
							code="SC / ST";
						}
						else if(post_code=="ST")
						{
							code="SC / ST";
						}
						if(code=="General")
						{
							
						}
						else if(code != category)
						{
							alert("Post Code & Category Mismatched !");
							$("#category").val("");
							return;
						}
					}
					else
					{
						alert("Select Post Code & Category !");
					}
					
				}
				if(post_name=="" || dob=="" || category=="")
				{
					return;
				}
				if(post_match=="found" || job_for=="General" || job_for=="All")
				{					
					jQuery.ajax({
							type:"POST",
							url:"<?php echo base_url(); ?>" + "/home/validate_age",
							datatype:"text",
							data:{post_name:post_name,category:category,dob:dob,vrs:vrs,job_for:job_for},
							success:function(response)
							{
								if(response==0)
								{
									alert("You are not Qualified for this job...!");
									$("#category").val("");
								}
							},
							error:function (xhr, ajaxOptions, thrownError){}
							});
				}
				else
				{
					alert("This Job is only for "+job_for+"...!");
					$("#category").val("");
				}
		}
		function validate_date(id)
		{
			var date1 = $(".expfdate");
			var date2 = $(".exptdate");
			
			check_date=$("#"+id).val();
			for(var i = 0; i < date1.length; i++)
			{
				from_date=$(date1[i]).val();
				to_date=$(date2[i]).val();
				
				var d1 = from_date.split("-");
				var d2 = to_date.split("-");
				var c = check_date.split("-");

				var fdate = new Date(d1[2], parseInt(d1[1])-1, d1[0]);  // -1 because months are from 0 to 11
				var tdate   = new Date(d2[2], parseInt(d2[1])-1, d2[0]);
				var check = new Date(c[2], parseInt(c[1])-1, c[0]);
				
				if(check > fdate && check < tdate)
				{
					alert("Invalid");
					$("#"+id).val("");
					return;
				}
			}			
		}
	</script>
	<script>
		function get_job_details()
		{
			job_id=$("#post_name").val();
			if(job_id!="")
			{
				jQuery.ajax({
						type:"POST",
						url:"<?php echo base_url(); ?>" + "/home/get_job",
						datatype:"text",
						data:{job_id:job_id},
						success:function(response)
						{
							a=response.split("****");
							job_posting=a[0];
							$("#job_for").val(""+job_posting);
							$("#job_div").css("padding","2%");
							$("#job_details").empty();
							$("#job_details").append(a[1]);
							$("#job_details").css("display","block");
							check_job_condition();
							get_job_post_code();
						},
						error:function (xhr, ajaxOptions, thrownError){
						}
						});
			}
			else
			{
				$("#job_div").css("padding","0%");
				$("#job_details").empty();
				$("#job_details").css("display","none");
			}
		}
		function get_job_post_code()
		{
			job_id=$("#post_name").val();
					jQuery.ajax({
						type:"POST",
						url:"<?php echo base_url(); ?>" + "/home/get_job_post_code",
						datatype:"text",
						data:{job_id:job_id},
						success:function(response)
						{
							if(response)
							{
								$("#post_code").empty();
								$("#post_code").append(response);
							}
						},
						error:function (xhr, ajaxOptions, thrownError){
						}
					});
		}
		function check_nationality(id)
		{
			value=$("#"+id).val();
			
			if(value=="Yes" || value=="yes")
			{
				alert("You are not eligible");
				window.location = "http://www.nirm.in";
			}
		}
		function validate_file(id)
		{
			var file_size = $('#'+id)[0].files[0].size;
			if(file_size>2097152) 
			{
				alert("File Size Should Below 2mb");
				$('#'+id).val("");
			} 
		}
	</script>
	<script>
		function validate_mark(this_id)
		{
			res=this_id.split("_");
			id=res[1];
			type=$("#type_"+id).val();
			mark=$("#cgpa_"+id).val();
			
			category=$("#category").val();
			job_for=$("#job_for").val();
			
			if(category =="SC / ST" || category=="ST" || category=="OBC")
			{
				if(type=="CGPA")
				{
					if(mark<7)
					{
						alert("You are not qualified for this post!");
						//$("#type_"+id).val("");
						$("#cgpa_"+id).val("");
						$("#type_"+id).focus();
					}
				}
				else
				{
					if(mark<60)
					{
						alert("You are not qualified for this post!");
						//$("#type_"+id).val("");
						$("#cgpa_"+id).val("");
						$("#type_"+id).focus();
					}
				}
			}
			else
			{
				if(type=="CGPA")
				{
					if(mark<7)
					{
						alert("You are not qualified for this post!");
						//$("#type_"+id).val("");
						$("#cgpa_"+id).val("");
						$("#type_"+id).focus();
					}
				}
				else
				{
					if(mark<60)
					{
						alert("You are not qualified for this post!");
						//$("#type_"+id).val("");
						$("#cgpa_"+id).val("");
						$("#type_"+id).focus();
					}
				}
			}
		}
	</script>
	<style>
		.form-input label
		{
			color:#000;
			font-weight: 600;
		}
		th, td, caption 
		{
			padding: 10px;
			color: #000;
			font-weight: 600;
		}

	</style>
	<script>
		function printDiv()
		{
			 var divToPrint=document.getElementById('print_div');

			  var newWin=window.open('','Print-Window');

			  newWin.document.open();

			  newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');

			  newWin.document.close();

			  setTimeout(function(){newWin.close();},10);
		}
		function PrintElem(elem)
			{
				alert(elem);
				Popup($(elem).html());
			}
		function Popup(data)
		{
			var mywindow = window.open('', 'new div', 'height=400,width=600');
			mywindow.document.write('<html><head><title>my div</title>');
			/*optional stylesheet*/ //mywindow.document.write('<link rel="stylesheet" href="main.css" type="text/css" />');
			mywindow.document.write('</head><body >');
			mywindow.document.write(data);
			mywindow.document.write('</body></html>');

			mywindow.print();
			mywindow.close();

			return true;
		}
	</script>
	<script>
		function close_my_pop()
		{
			var modal = document.getElementById('my_pop1');
			modal.style.display = "none";
		}
		function redirect_nirm()
		{
			close_my_pop();
		}
	</script>
	<script>
		function save_details(id)
		{
			value=$("#"+id).val();
				jQuery.ajax({
							type:"POST",
							url:"<?php echo base_url(); ?>" + "/home/save_details",
							datatype:"text",
							data:{id:id,value:value},
							success:function(response)
							{
							},
							error:function (xhr, ajaxOptions, thrownError){}
					});
			
		}
		
		function save_and_continue()
		{
			
			action="<?php echo base_url();?>"+"/home/save_continue";
			action1="<?php echo base_url();?>"+"/home/save_application";
			
			$('#myform').attr('action', action);
			$('#myform').submit();
			$('#myform').attr('action', action1);
		}
		function print_application()
		{
			action="<?php echo base_url();?>"+"/home/print_my_app";
			action1="<?php echo base_url();?>"+"/home/save_application";
			
			$('#myform').attr('action', action);
			$('#myform').attr('target', "_blank");
			$('#myform').submit();
			$('#myform').attr('target', "");
			$('#myform').attr('action', action1);
		}
	</script>
	<script>
		function check_job_condition()
		{
			job_id=$("#post_name").val();
			post_code=$("#post_code").val();
			
				jQuery.ajax({
						type:"POST",
						url:"<?php echo base_url(); ?>" + "/home/check_job_condition",
						datatype:"text",
						data:{job_id:job_id,post_code:post_code},
						success:function(response)
						{
							if(response>=1)
							{
								alert("You have already applied for this post in this category !");
								//$("#post_name").val("");
								$("#post_code").val("");
							}
							else
							{
								get_candidate_info();
							}
						},
						error:function (xhr, ajaxOptions, thrownError){
						}
						});
		}
		function get_qualification(id)
		{
			jQuery.ajax({
							type:"POST",
							url:"<?php echo base_url(); ?>" + "/home/get_qualification",
							datatype:"text",
							data:{id:id},
							success:function(response)
							{
								$("#qualification").empty();
								$("#qualification").append(response);
							},
							error:function (xhr, ajaxOptions, thrownError){
							}
					});
		}
		function get_candidate_info()
		{
			job_id=$("#post_name").val();
			post_code=$("#post_code").val();
			jQuery.ajax({
						type:"POST",
						url:"<?php echo base_url(); ?>" + "/home/get_candidate_info",
						datatype:"text",
						data:{job_id:job_id,post_code:post_code},
						success:function(response)
						{
							if(response)
							{
								a=response.split("****");
								$("#name").val(""+a[0]);
								$("#email").val(""+a[1]);
								$("#phone").val(""+a[2]);
								$("#fname").val(""+a[3]);
								$("#occupation").val(""+a[4]);
								$("#address").val(""+a[5]);
								$("#permanent_address").val(""+a[6]);
								$("#nationality").val(""+a[7]);
								$("#citizen").val(""+a[8]);
								$("#state").val(""+a[9]);
								$("#other_country").val(""+a[10]);
								$("#marital").val(""+a[11]);
								$("#dob").val(""+a[12]);
								$("#place_birth").val(""+a[13]);
								$("#present_work").val(""+a[14]);
								$("#category").val(""+a[15]);
								$("#suspended").val(""+a[16]);
								$("#arrested").val(""+a[17]);
								$("#medical").val(""+a[18]);
								$("#medical_details").val(""+a[19]);
								$("#religion").val(""+a[20]);
								$("#religion_changed").val(""+a[21]);
								$("#int_journals").val(""+a[22]);
								$("#int_symposium").val(""+a[23]);
								$("#national_journals").val(""+a[24]);
								$("#national_symposium").val(""+a[25]);
								$("#other_publications").val(""+a[26]);
								$("#significant_1").val(""+a[27]);
								$("#significant_2").val(""+a[28]);
								$("#significant_3").val(""+a[29]);
								$("#any_significant").val(""+a[30]);
								$("#outside").val(""+a[31]);
								$("#vrs").val(""+a[32]);
								$("#vrs_details").val(""+a[33]);
								$("#nirm_earlier").val(""+a[34]);
								$("#referees_1").val(""+a[35]);
								$("#referees_2").val(""+a[36]);
								$("#govt_servant").val(""+a[37]);
								$("#nature_app").val(""+a[38]);
								$("#min_emoluments").val(""+a[39]);
								$("#lowest_initial").val(""+a[40]);
								$("#notice_period").val(""+a[41]);
								$("#suspended_info").val(""+a[42]);
								$("#arrested_info").val(""+a[43]);
								
								check_arrested_info();
								check_suspended_info();
								check_min_emoluments();
								check_govt_servant();
								check_outside();
								check_nirm();
								check_medical();
								check_citizen();
								get_qualification(job_id);
							}
							else
							{
								$("#name").val("");
								$("#email").val("");
								$("#phone").val("");
								$("#fname").val("");
								$("#occupation").val("");
								$("#address").val("");
								$("#permanent_address").val("");
								$("#nationality").val("");
								$("#citizen").val("");
								$("#state").val("");
								$("#other_country").val("");
								$("#marital").val("");
								$("#dob").val("");
								$("#place_birth").val("");
								$("#present_work").val("");
								$("#category").val("");
								$("#suspended").val("");
								$("#arrested").val("");
								$("#medical").val("");
								$("#medical_details").val("");
								$("#religion").val("");
								$("#religion_changed").val("");
								$("#int_journals").val("");
								$("#int_symposium").val("");
								$("#national_journals").val("");
								$("#national_symposium").val("");
								$("#other_publications").val("");
								$("#significant_1").val("");
								$("#significant_2").val("");
								$("#significant_3").val("");
								$("#any_significant").val("");
								$("#outside").val("");
								$("#vrs").val("");
								$("#vrs_details").val("");
								$("#nirm_earlier").val("");
								$("#referees_1").val("");
								$("#referees_2").val("");
								$("#govt_servant").val("");
								$("#nature_app").val("");
								$("#min_emoluments").val("");
								$("#lowest_initial").val("");
								$("#notice_period").val("");
								$("#suspended_info").val("");
								$("#arrested_info").val("");
								check_arrested_info();
								check_suspended_info();
								check_min_emoluments();
								check_govt_servant();
								check_outside();
								check_nirm();
								check_medical();
								check_citizen();
								get_qualification(job_id);
							}
						},
			error:function (xhr, ajaxOptions, thrownError){
			}
			});
		}
	</script>
	<script>
		 function isNumberKey(txt, evt) 
		  {
			   evt = (evt) ? evt : window.event;
				var charCode = (evt.which) ? evt.which : evt.keyCode;
				 if(charCode==46)
				 {
					   return true;
				 }
				 else if (charCode != 8 && charCode != 0 && (charCode < 48 || charCode > 57)) 
				 {  
						   return false;
				 }
				return true;
			}
		function isNumber(evt) 
		{
			evt = (evt) ? evt : window.event;
			var charCode = (evt.which) ? evt.which : evt.keyCode;
			
			if (charCode > 31 && (charCode < 48 || charCode > 57)) 
			{
				return false;
			}
			return true;
		}
		function isNumbera(evt) 
		{
			evt = (evt) ? evt : window.event;
			var charCode = (evt.which) ? evt.which : evt.keyCode;
			if(charCode==46)
			{
				return true;
			}
			if (charCode > 31 && (charCode < 48 || charCode > 57)) 
			{
				return false;
			}
			return true;
		}
		
	</script>
	<script>
		function form_validate1()
		{
			email=$("#candidate_email").val();
			phone=$("#candidate_phone").val();
			
			var len=phone.length;
			if(email =="" || phone=="")
			{
				return false;
			}
			if(len !=10)
			{
				alert("Invalid Phone Number");
				return false;
			}
		}
	</script>
	
	<style>
	
	.contact-form select{float:none !important;}
	.contact-form input[type=file]{float:none !important;}
	</style>
</head>

<body>

    <!-- site preloader start -->
   <!--  <div class="page-loader">
        <div class="loader-in"></div>
    </div>
    <!-- site preloader end -->

    <div class="pageWrapper">

        <!-- login box End -->
   <div class="top-bar">
      <div class="container">
         <div class="row">
             <?php include("top-bar.php");?>
			<div class="cell-1 right-bar">
               <ul class="right">
                 <!-- <li><a href="#"><i class="fa  fa-language"></i>हिन्दी</a></li>-->
               </ul>
            </div>
         </div>
      </div>
   </div>
        <!-- Header Start -->
       <?php include("menu.php");?>
        <!-- Header End -->

        <!-- Content Start -->
        <div id="contentWrapper">
				<div class="page-title title-1">
					<div class="container">
						<div class="row">
							<div class="cell-12">
								<h1 class="fx" style="color:#fff;">Apply <span style="color:#fff;">Job</span></h1>
								<div class="breadcrumbs main-bg fx" >
									<span class="bold">You Are In:</span><a href="index.php">Home</a><span class="line-separate"><span class="line-separate">/</span><span>Apply Job</span>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="padd-top-50" id="print_div">
					<div class="container">
						<div class="row">
			    			<div class="cell-12 contact-form fx" data-animate="fadeInLeft" id="contact">
			    				
			    				<mark id="message"></mark>
			    				<form class="form-signin cform" id="myform" method="POST" action="<?php echo site_url('home/save_application');?>" id="cform" autocomplete="on" enctype="multipart/form-data" onsubmit="return confirm('Do you want to continue ?');">
			    					<div class="row">
										<div class="cell-4">
											<div class="form-input">
												<label>Name of post applied <span class="red">*</span></label>
												<select required="required" name="post_name" id="post_name" onchange="job_change();">
													<option value="">Select</option>
													<?php 
														foreach($job as $res)
														{
															echo '<option value="'.$res['id'].'">'.$res['job_title'].'</option>';
														}
													?>
												</select>
											</div>
										</div>
										<div class="cell-4">
											<div class="form-input">
												<label>Post Code & Category<span class="red">*</span></label>
												<select type="text" required="required" name="post_code" id="post_code" onchange="check_job_condition();" style="padding: 13px 15px;" spellcheck="true">
														<option value="">Select</option>
												</select>
											</div>
										</div>
										<div class="cell-4">
											<div class="form-input">
												<label>Minimum Qualification ?<span class="red">*</span></label>
												<select type="text" required="required" name="qualification" id="qualification" style="padding: 13px 15px;" spellcheck="true">
														<option value="">Select</option>
												</select>
											</div>
										</div>
									</div>
									<div class="clearfix"></div>
									<div class="row" id="job_div">
										<div class="form-input">
											<div class="cell-12" style="border: 1px solid #f3e6e6;display:none" id="job_details">
												
											</div>
										</div>										
										<div class="form-input">
											<input type="hidden" name="job_for" id="job_for">
											<input type="hidden" name="application_no" id="application_no" value="<?php echo date("s").rand(10000,99999);?>">
											<input type="hidden" name="ack_no" id="ack_no" value="<?php echo date("s").rand(10000,99999);?>">
										</div>
										
									</div>
									
									<div class="clearfix"></div>
									<div class="row">
										<div class="cell-6">
											<div class="form-input">
												<label>1. Name (Female applicants to prefix Ms.)<span class="red">*</span></label>
												<input type="text" required="required" name="name" id="name" onkeypress="return isalphadot(event);">
											</div>
										</div>
										<div class="cell-6">
											<div class="form-input">
												<label>Passport Size Photo (Max 2 MB)<span class="red">*</span> </label>
												<input name="file" type="file" required="required" id="file"  onchange="validate_file(this.id);">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="cell-6">
											<div class="form-input">
												<label>2.(a) Father's Name <span class="red">*</span></label>
												<input type="text" required="required" name="fname" id="fname" onkeypress="return isalphadot(event);">
											</div>
										</div>
										<div class="cell-6">
											<div class="form-input">
												<label>(b) Father's Occupation <span class="red">*</span></label>
												<input name="occupation" id="occupation" type="text" required="required" onkeypress="return isalphadot(event);">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="cell-6">
											<div class="form-input">
												<label>3.(a) Address for communication<span class="red">*</span></label>
												<textarea required="required" name="address" id="address" rows="3" style="height: 120px;"></textarea>
											</div>
										</div>
										<div class="cell-6">
											<div class="form-input">
												<label>(b) Permanent address<span class="red">*</span></label>
												<textarea name="permanent_address" id="permanent_address" rows="3" style="height: 120px;" required="required"></textarea>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="cell-6">
											<div class="form-input">
												<label>&nbsp;(c) Contact Phone No <span class="red">*</span></label>
												<input name="phone" type="text" id="phone" maxlength="10" onkeypress="return isNumber(event)" required>			    						
											</div>
										</div>
										<div class="cell-6">
											<div class="form-input">
												<label>(d) e-mail id<span class="red">*</span></label>
												<input type="email" required="required" name="email" id="email">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="cell-6">
											<div class="form-input">
												<label>4.(a) Nationality<span class="red">*</span></label>
												<input name="nationality" type="text" id="nationality" onkeypress="return isalpha(event)" required>			    						
											</div>
										</div>
										<div class="cell-6" style="display:none">
											<div class="form-input">
												<label> (b) Passport No</label>
												<input type="text" name="passport" id="passport">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="cell-6">
											<div class="form-input">
												<label>5.(a) Whether a citizen of India by birth ?<span class="red">*</span></label>
												<select name="citizen" id="citizen" required="required" style="padding: 13px 15px;" onchange="check_citizen();">
													<option value="">Select</option>
													<option value="Yes">Yes</option>
													<option value="No">No</option>
												</select>
											</div>
										</div>
										<div class="cell-6" id="state_div" style="display:none">
											<div class="form-input">
												<label>Which State you belong<span class="red">*</span></label>
												<input name="state" type="text" id="state" onkeypress="return isalpha(event);">			    						
											</div>
										</div>
										<div class="cell-6" id="not_indian" style="display:none">
											<div class="form-input">
												<label> (b) Which Category you belong ? select the option <span class="red">*</span></label>
												<select name="other_country" id="other_country" style="padding: 13px 15px;">
													<option value="">Select the option</option>
													<option value="pakistan">Pakistan</option>
													<option value="bangladesh">Bangladesh</option>
													<option value="nepal">Nepal</option>
													<option value="sikkim">Sikkim</option>
												</select>
											</div>
										</div>
									</div>
									<div class="clearfix"></div>
								
									<div class="clearfix"></div>
									<div class="row">
										<div class="cell-3">
											<div class="form-input">
												<label>6.(a) Date of Birth <span class="red">*</span></label>
												<input name="dob" type="text" id="dob" class="datepicker" onchange="validate_age();" autocomplete="off" required>			    						
											</div>
										</div>
										<div class="cell-3">
											<div class="form-input">
												<label>Place of Birth<span class="red">*</span></label>
												<input type="text" required="required" name="place_birth" onkeypress="return isalpha(event)" id="place_birth">
											</div>
										</div>
										<div class="cell-6">
											<div class="form-input">
												<label>DOB proof (SSLC marksheet,Birth Certificate,Passport) <span class="red">*</span></label>
												<input type="file" name="dob_proof" id="dob_proof" required spellcheck="true" onchange="validate_file(this.id);">   						
											</div>
										</div>
										
									</div>
									<div class="clearfix"></div>
									<div class="row">
										<div class="cell-6">
											<div class="form-input">
												<label>&nbsp;&nbsp; (b) Marital Status<span class="red">*</span></label>
												<select name="marital" id="marital" required="required" style="padding: 13px 15px;">
													<option value="">Select</option>
													<option value="Married">Married</option>
													<option value="Single">Single</option>
												</select>
											</div>
										</div>
									</div>
									
									<div class="clearfix"></div>
									<div class="row">
										
										<div class="cell-6">
											<div class="form-input">
												<label>7. Nature of present work/ job <span class="red">*</span></label>
												<select name="present_work" id="present_work" required style="padding: 13px 15px;">
													<option value="">Select</option>
													<option value="Govt. Servant">Govt. Servant</option>
													<option value="Private Employee">Private Employee</option>
													<option value="Contract Worker">Contract Worker</option>
													<option value="Self Employed">Self Employed</option>
													<option value="Not Employed">Not Employed</option>
												</select>
											</div>
										</div>
										
									</div>
									<div class="clearfix"></div>
									<div class="row">
										<div class="cell-6">
											<div class="form-input">
												<label>8. Category <span class="red">*</span><br>(General / SC / ST / OBC)</label>
												<select required="required" name="category" id="category" onchange="validate_age();" spellcheck="true">
													<option value="">Select</option>
													<option value="SC / ST">SC / ST</option>
													<option value="OBC">OBC</option>
													<option value="General">General</option>
												</select>
											</div>
										</div>
										<div class="cell-6" style="margin-top:1%">
											<div class="form-input">
												<label>Upload proof (if reserved category)</label>
												<input type="file" name="reserved" id="reserved" spellcheck="true" onchange="validate_file(this.id);">   						
											</div>
										</div>
									</div>
									<div class="clearfix"></div>
									<div class="row">
										<div class="cell-6">
											<div class="form-input">
												<label>9.(a) Have you ever been suspended / dismissed from past  service ?<span class="red">*</span></label>
													<select name="suspended" type="text" id="suspended" style="padding: 13px 15px;" onchange="check_suspended_info();" required>
														<option value="">Select</option>
														<option value="Yes">Yes</option>
														<option value="No">No</option>
													</select>
											</div>
										</div>
										<div class="cell-6">
											<div class="form-input">
												<label>&nbsp;&nbsp; (b) Have you ever been arrested / prosecuted (while in service or otherwise) ?<span class="red">*</span></label>
												<select type="text" required="required" name="arrested" id="arrested" onchange="check_arrested_info();" style="padding: 13px 15px;" spellcheck="true">
													<option value="">Select</option>
													<option value="Yes">Yes</option>
													<option value="No">No</option>
												</select>
											</div>
										</div>
									</div>
									<div class="clearfix"></div>
									<div class="row">
										<div class="cell-6" id="suspended_div" style="display:none">
											<div class="form-input">
												<label>Reason for suspended / dismissed from past  service ?<span class="red">*</span></label>
													<input name="suspended_info" type="text" id="suspended_info" style="padding: 13px 15px;">
											</div>
										</div>
										<div class="cell-6" id="arrested_div" style="display:none">
											<div class="form-input">
												<label>Reason for arrested / prosecuted (while in service or otherwise) ?<span class="red">*</span></label>
												<input type="text" name="arrested_info" id="arrested_info" style="padding: 13px 15px;" spellcheck="true">
											</div>
										</div>
									</div>
									<div class="clearfix"></div>
									<div class="row">
										<div class="cell-6">
											<div class="form-input">
												<label>10. Do you have any medical infirmity or have you been hospitalized for over three months ?<span class="red">*</span></label>
													<select name="medical" type="text" id="medical" style="padding: 13px 15px;" required onchange="check_medical();">
														<option value="">Select</option>
														<option value="Yes">Yes</option>
														<option value="No">No</option>
													</select>
											</div>
										</div>
										<div class="cell-6" id="medical_div" style="display:none">
											<div class="form-input">
												<label>Provide Details, if you have any medical infirmity or have you been hospitalized for over three months ?<span class="red">*</span></label>
												<input type="text" name="medical_details" id="medical_details" spellcheck="true">
											</div>
										</div>
									</div>
									<div class="clearfix"></div>
									<div class="row">
										<div class="cell-6">
											<div class="form-input">
												<label>11.(a) Religion to which you belong <span class="red">*</span></label>
												<input type="text" name="religion" id="religion" onkeypress="return isalpha(event)" required spellcheck="true">
											</div>
										</div>
										<div class="cell-6">
											<div class="form-input">
												<label>(b) Have you ever changed your religion ?<span class="red"></span></label>
													<select name="religion_changed" type="text" id="religion_changed" style="padding: 13px 15px;">
														<option value="">Select</option>
														<option value="Yes">Yes</option>
														<option value="No">No</option>
													</select>
											</div>
										</div>
										<div class="cell-6" id="religion_div" style="display:none">
											<div class="form-input">
												<label>Details for religion changed ?<span class="red">*</span></label>
												<input type="text" name="religion_info" id="religion_info" spellcheck="true" >
											</div>
										</div>
									</div>
									<div class="clearfix"></div>
									<div class="row">
										<div class="cell-12">
										<label style="color:#000;font-weight:600;">12. Educational & Professional qualifications - (Start with SSLC/ SSC)<span class="red">*</span>
											<br><span style="font-weight:400">(Click on + to add further)</span>
										</label>
											<div class="padd-vertical-45" style="padding: 15px 0;">
												<table>
													<thead>
														<tr>
															<td style="width: 13%;">Exam Passed</td>
															<td style="width: 13%;">Board/University</td>
															<td style="width: 9%;">Duration of study</td>
															<td style="width: 9%;">Year of passing</td>
															<td style="width: 13%;">Major Subject(s)</td>
															<td style="width: 9%;">Type</td>
															<td style="width: 10%;">Marks</td>
															<td style="width: 10%;">Class</td>
															<td style="width: 15%;">Certificate</td>
															<td style="width: 1%;"></td>
														</tr>
													</thead>
													<tbody id="edu_table">
														<tr>
															<td><input name="exam_passed[]" type="text" id="exam_passed_1" value="SSLC/ 10th" readonly required></td>
															<td><input name="board[]" type="text" id="board_1" onkeypress="return isalpha(event)"  required></td>
															<td><input name="study[]" onkeypress="return isNumbera(event)" type="text" id="study_1" required></td>
															<td><input name="year_passing[]" onkeypress="return isNumber(event)" type="text" id="year_passing_1" required></td>
															<td><input name="major_subjects[]" type="text" id="major_subjects_1" onkeypress="return isalpha(event)"  required></td>
															<td>
																<select name="type[]" type="text" id="type_1" required>
																	<option value="">Select</option>
																	<option value="%">%</option>
																	<option value="CGPA">CGPA</option>
																</select>
															</td>
															<td><input name="cgpa[]" type="text" id="cgpa_1" onkeypress="return isNumbera(event)" onchange="validate_mark(this.id);" required></td>
															<td><input name="class[]" type="text" id="class_1" onkeypress="return isalpha(event)"  required></td>
															<td><input name="edu_file[]" type="file" id="edu_file" required></td>
															<td></td>
														</tr>
														<tr>
															<td><input name="exam_passed[]" type="text" id="exam_passed_2" value="PUC / Dip. / ITI" readonly required></td>
															<td><input name="board[]" type="text" id="board_2" onkeypress="return isalpha(event)"  required></td>
															<td><input name="study[]" onkeypress="return isNumbera(event)" type="text" id="study_2" required></td>
															<td><input name="year_passing[]" onkeypress="return isNumber(event)" type="text" id="year_passing_2" required></td>
															<td><input name="major_subjects[]" type="text" id="major_subjects_2" onkeypress="return isalpha(event)"  required></td>
															<td>
																<select name="type[]" type="text" id="type_2" required>
																	<option value="">Select</option>
																	<option value="%">%</option>
																	<option value="CGPA">CGPA</option>
																</select>
															</td>
															<td><input name="cgpa[]" type="text" id="cgpa_2" onkeypress="return isNumbera(event)" onchange="validate_mark(this.id);" required></td>
															<td><input name="class[]" type="text" id="class_2" onkeypress="return isalpha(event)"  required></td>
															<td><input name="edu_file[]" type="file" id="edu_file" required></td>
															<td><a href="javascript:void(0);" id="addButton2"><i class="fa fa-plus-square" aria-hidden="true"></i></a></td>
														</tr>
													</tbody>
													</table>
											</div>
										</div>
									</div>
									<div class="row">
										<label style="margin-left: 2%;"><b>13. No. of publications</b><span class="red"></span></label>
										<div class="cell-12" style="margin-top: 2%;">
											<div class="cell-6" >
												<div class="form-input">
													<label>(a) International (Journals)</label>
													<input type="text" name="int_journals" id="int_journals" spellcheck="true">
												</div>
											</div>
											<div class="cell-6">
												<div class="form-input">
													<label>International (Symposium)</label>
													<input type="text" name="int_symposium" id="int_symposium" spellcheck="true">
												</div>
											</div>
											<div class="cell-6" >
												<div class="form-input">
													<label>(b) National (Journal)</label>
													<input type="text" name="national_journals" id="national_journals" spellcheck="true">
												</div>
											</div>
											<div class="cell-6">
												<div class="form-input">
													<label>National (Symposium)</label>
													<input type="text" name="national_symposium" id="national_symposium" spellcheck="true">
												</div>
											</div>
											<div class="cell-6">
												<div class="form-input">
													<label>(c) Other publications</label>
													<input type="text" name="other_publications" id="other_publications" spellcheck="true">
												</div>
											</div>
										</div>
									</div>
									<div class="clearfix"></div>
									<div class="row">
										<div class="cell-12">
											<div class="form-input">
												<label><b>List details of three significant publications separately, if space provided is less.</b></label>
												<input type="text" name="significant_1" id="significant_1" spellcheck="true">
											</div>
										</div>
										<div class="cell-12">
											<div class="form-input">
												<input type="text" name="significant_2" id="significant_2" spellcheck="true">
											</div>
										</div>	
										<div class="cell-12">
											<div class="form-input">
												<input type="text" name="significant_3" id="significant_3" spellcheck="true">
											</div>
										</div>	
									</div>
									<div class="clearfix"></div>
									<div class="row">
										<div class="cell-6">
											<div class="form-input">
												<label>14. Any significant achievements (mention in detail) :<span class="red"></span></label>
												<input name="any_significant" type="text" id="any_significant">			    						
											</div>
										</div>
										<div class="cell-6">
											<div class="form-input">
												<label>15. Have you been outside India ? If yes, please provide details below :<span class="red">*</span></label>
													<select name="outside" type="text" id="outside" style="padding: 13px 15px;" required onchange="check_outside();">
														<option value="">Select</option>
														<option value="Yes">Yes</option>
														<option value="No">No</option>
													</select>
											</div>
										</div>
									</div>
									<div class="row" id="outside_ind" style="display:none;">
										<div class="cell-12">
											<div class="padd-vertical-45" style="padding: 15px 0;">
												<table>
													<thead>
														<tr>
															<td>Country Visited </td>
															<td>Period of Visit</td>
															<td>Purpose of Visit</td>
														</tr>
													</thead>
													<tbody>
														<tr>
															<td><input name="country_visited[]" type="text" id="country_visited1" placeholder="Country Visited" ></td>
															<td><input name="period_visit[]" type="text" id="period_visit1" placeholder="Period of Visit"></td>
															<td><input name="purpose_visit[]" type="text" id="purpose_visit1" placeholder="Purpose of Visit"></td>
														</tr>
														<tr>
															<td><input name="country_visited[]" type="text" id="country_visited2" placeholder="Country Visited"></td>
															<td><input name="period_visit[]" type="text" id="period_visit2" placeholder="Period of Visit"></td>
															<td><input name="purpose_visit[]" type="text" id="purpose_visit2" placeholder="Purpose of Visit"></td>
														</tr>
														<tr>
															<td><input name="country_visited[]" type="text" id="country_visited3" placeholder="Country Visited"></td>
															<td><input name="period_visit[]" type="text" id="period_visit3" placeholder="Period of Visit"></td>
															<td><input name="purpose_visit[]" type="text" id="purpose_visit3" placeholder="Purpose of Visit"></td>
														</tr>															
													</tbody>
													</table>
											</div>
										</div>
									</div>
									<div class="row" style="display:none;">
										<div class="cell-6">
											<div class="form-input">
												<label>16. Are you a retiree/ VRS/ ex-servicemen <span class="red"></span></label>
													<select name="vrs" id="vrs" style="padding: 13px 15px;" >
														<option value="">Select</option>
														<option value="Yes">Yes</option>
														<option value="No" >No</option>
													</select>
											</div>
										</div>
										<div class="cell-6" id="vrs_div" style="display:none">
											<div class="form-input">
												<label>If you a retiree/ ex-servicemen,provide details & mention current age<span class="red"></span></label>
												<input name="vrs_details" type="text" id="vrs_details" onchange="save_details(this.id);">			    						
											</div>
										</div>
									</div>
									<div class="clearfix"></div>
									<div class="row">
										<div class="cell-12">
											<div class="cell-6" style="padding-left: 0% !important;padding-rigth: 0% !important;">
												<label style="margin-left: 0%;color:#000;font-weight:600"><b>16. Employment details (in reverse chronological order)</b><span class="red"></span><br>(Enclose certificate of experience in respect of minimum desirable qualification)
												<br><span style="font-weight:400">(Click on + to add further)</span></label>
											</div>
											<div class="cell-6" style="padding-rigth: 0% !important;">
												<div class="form-input">
													<label>Total Experience</label>
													<input type="text" name="total_exp">    						
												</div>
											</div>
										
										
											<div class="padd-vertical-45" style="padding: 15px 0;">
												<table>
													<thead>
														<tr>
															<td>Employer</td>
															<td>Date of Joining</td>
															<td>Date of Leaving</td>
															<td>Designation</td>
															<td>Nature of Job done</td>
															<td>Gross monthly pay</td>
															<td>Certificate</td>
															<td style="width: 1%;">More</td>
														</tr>
													</thead>
													<tbody id="exp_table">
														<tr id="abc_1">
															<td><input name="employer[]" type="text" id="employer" placeholder="Employer" ></td>
															
															<td><input name="doj[]" type="text" id="doj_1" class="datepicker expfdate" autocomplete="off" placeholder="Date of Joining"></td>
															<td><input name="date_leave[]" type="text" id="date_leave_1" class="datepicker exptdate" autocomplete="off" placeholder="Date of Leaving"></td>
															<td><input name="designation[]" type="text" id="designation" placeholder="Designation"></td>
															<td><input name="job_done[]" type="text" id="job_done" placeholder="Nature of Job done"></td>
															<td><input name="gross_pay[]" type="text" id="gross_pay" maxlength="8" onkeypress="return isNumber(event)" placeholder="Gross monthly pay" ></td>
															<td><input name="exp_file[]" type="file" id="exp_file"></td>
															<td><a href="javascript:void(0);" id="addButton1"><i class="fa fa-plus-square" aria-hidden="true"></i></td>
														</tr>																											
													</tbody>
													</table>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="cell-6">
											<div class="form-input">
												<label>17. Have you applied for any other post(s) at NIRM earlier ? <span class="red"></span><br>(If applied during the last five years, please mention details)</label>
													<select name="nirm_earlier" id="nirm_earlier" style="padding: 13px 15px;" onchange="check_nirm();">
														<option value="">Select</option>
														<option value="Yes">Yes</option>
														<option value="No">No</option>
													</select>
											</div>
										</div>
									</div>
									<div class="row" id="nirm_earlier_div" style="display:none;">
										<div class="cell-12">
											<div class="padd-vertical-45" style="padding: 15px 0;">
												<table>
													<thead>
														<tr>
															<td>Advt. No</td>
															<td>Date of Application</td>
															<td>Post applied for</td>
															<td>Whether called for Interview</td>
															<td>Date of Interview</td>
														</tr>
													</thead>
													<tbody>
														<tr>
															<td><input name="advt_no[]" type="text" id="advt_no1" onchange="save_details(this.id);"  placeholder="Advt. No"></td>
															<td><input name="date_apply[]" type="text" id="date_apply_1" onchange="save_details(this.id);" class="datepicker" autocomplete="off" placeholder="Date of Application"></td>
															<td><input name="post_applied[]" type="text" id="post_applied_1" onchange="save_details(this.id);" placeholder="Post applied for"></td>
															<td><input name="called_interview[]" type="text" id="called_interview" onchange="save_details(this.id);" placeholder="Called for Interview"></td>
															<td><input name="date_interview[]" type="text" id="date_interview_1" onchange="save_details(this.id);" class="datepicker" autocomplete="off" placeholder="Date of Interview"></td>
														</tr>
														<tr>
															<td><input name="advt_no[]" type="text" id="advt_no2" onchange="save_details(this.id);" placeholder="Advt. No"></td>
															<td><input name="date_apply[]" type="text" id="date_apply_2" onchange="save_details(this.id);" class="datepicker" autocomplete="off" placeholder="Date of Application"></td>
															<td><input name="post_applied[]" type="text" id="post_applied_2" onchange="save_details(this.id);" placeholder="Post applied for"></td>
															<td><input name="called_interview[]" type="text" id="called_interview_2" onchange="save_details(this.id);" placeholder="Called for Interview"></td>
															<td><input name="date_interview[]" type="text" id="date_interview_2" onchange="save_details(this.id);" class="datepicker" autocomplete="off" placeholder="Date of Interview"></td>
														</tr>														
													</tbody>
													</table>
											</div>
										</div>
									</div>
									<div class="clearfix"></div>
									<div class="row">
										<div class="cell-6">
										<label style="color:#000;font-weight:600">18. Name and address of two Referees for verifying your credentials <span class="red">*</span></label>
											<div class="form-input">
												<textarea name="referees_1" id="referees_1" rows="3" style="height: 120px;" onchange="save_details(this.id);" required></textarea>
											</div>
										</div>
										<div class="cell-6">
											<label>&nbsp;</label>
											<div class="form-input">
												<textarea name="referees_2" id="referees_2" rows="3" style="height: 120px;" onchange="save_details(this.id);" required></textarea>
											</div>
										</div>
									</div>
									<div class="clearfix"></div>
									<div class="row">
										<div class="cell-6">
											<div class="form-input">
												<label>19.(a) Are you a Government Servant ?<span class="red">*</span></label>
												<select name="govt_servant" id="govt_servant" style="padding: 13px 15px;" required onchange="check_govt_servant();">
													<option value="">Select</option>
													<option value="Yes">Yes</option>
													<option value="No">No</option>
												</select>			    						
											</div>
										</div>
										<div id="govt_servant_div" style="display:none">
											<div class="cell-3">
												<div class="form-input">
													<label>(b) Nature of Appointment ?<span class="red">*</span></label>
													<select name="nature_app" id="nature_app" style="padding: 13px 15px;">
														<option value="">Select</option>
														<option value="Temporary">Temporary</option>
														<option value="Permanent">Permanent</option>
														<option value="Contract">Contract</option>
													</select>
												</div>   			
											</div>
											<div class="cell-3">
												<label style="font-weight:600;color:#000;">Attach NOC<span class="red">*</span></label>
												<input type="file" name="noa_doc" id="noa_doc" spellcheck="true" onchange="validate_file(this.id);">
											</div>
										</div>
									</div>
									<div class="clearfix"></div>
									<div class="row">
										<div class="cell-6">
											<div class="form-input">
												<label>20.(a) Are You willing to accept the minimum initial emoluments offered ?<span class="red">*</span></label>
												<select name="min_emoluments" id="min_emoluments" style="padding: 13px 15px;" required onchange="check_min_emoluments();">
													<option value="">Select</option>
													<option value="Yes">Yes</option>
													<option value="No">No</option>
												</select>			    						
											</div>
										</div>
										<div class="cell-6" id="min_emoluments_div" style="display:none">
											<div class="form-input">
												<label>&nbsp;&nbsp; (b) Lowest Initial monthly emoluments expected per month?<span class="red">*</span></label>
													<input type="text" name="lowest_initial" id="lowest_initial" onkeypress="return isNumber(event)" maxlength="8" spellcheck="true">
											</div>
										</div>
										<div class="clearfix"></div>
										<div class="cell-6">
											<div class="form-input">
												<label> &nbsp;(c) Minimum joining time required, if selected for the post in days ?<span class="red">*</span><br>(Request for extension of joining time beyond 30 days will not normally be considered)</label>
												<input type="text" name="notice_period" id="notice_period" onchange="save_details(this.id);" required spellcheck="true">   						
											</div>
										</div>
									</div>
									<div class="clearfix"></div>
									<div class="row">
										<div class="cell-12">
										<label style="color:#000;font-weight:600">21. Document Attachment<span class="red"></span><br><span style="font-weight:400">(Click on + to add further)</span></label>
											<div class="padd-vertical-45" style="padding: 15px 0;">
												<table>
													<thead>
														<tr>
															<td style="width: 13%;">Name of Document</td>
															<td style="width: 13%;">Attachment</td>
															<td style="width: 13%;">Action</td>
														</tr>
													</thead>
													<tbody id="cycles">
														<tr id="row_1">
															<td><input name="document_name[]" type="text" id="document_name" placeholder="Document Name"></td>
															<td><input type="file" name="document_file[]" class="form_control" id="document_file"></td>
															<td><a href="javascript:void(0);" id="addButton"><i class="fa fa-plus-square" aria-hidden="true"></i></a></td>
														</tr>
													</tbody>
													</table>
											</div>
										</div>
									</div>
									<div class="clearfix"></div>
									<div class="cell-12">
										<div class="form-input">
											<label> <input type="checkbox" required>I here by agree that I have read the <a href="#terms_condition">terms and conditions </a>for the contractual appointment for which I am applying the post.  Under no circumstances I shall not have a claim for a regular jobs/position at NIRM in future.</label>
											<label style="color:red">Kindly note : once the application form is submitted you cannot edit further</label>
											
										</div>
									</div>
			    					<div class="form-input" id="buttons">
			    						<input type="submit" class="btn main-bg" id="submit_form" name="save_application" value="Submit" style="">&nbsp;&nbsp;
			    						<input type="button" class="btn main-bg" id="save_continue" name="save_continue" onclick="save_and_continue();" value="Save & Continue">&nbsp;&nbsp;
										<input type="button" class="btn main-bg" id="preview" name="print_preview" onclick="print_application();" value="Preview">
			    					</div>
									<div class="clearfix"></div>
										<div class="cell-12" style="margin-bottom:2%;padding-left: 0%;">
											<div class="form-input">
												<label style="color:blue"><span style="color:red; text-transform: uppercase;">* Online applications are preferred</span>, In case if you are not able to apply online, you may download and send the filled application form to the following address.</label>
												<a href="<?php echo  base_url();?>../downloads/nirm_application.pdf"><input type="button" class="btn main-bg"  value="Download Application"></a>
												<br>
												<br>
												<label>
													Head, Project Monitoring Cell, <br>
													National Institute of Rock Mechanics,<br>
													Eshwar Nagar, Outer Ring Road,<br>
													Banashankari 2nd Stage,<br>
													Bengaluru-560 070 Karnataka, India <br>
													Phone: +91-80–26934402 / +91-80–26934414
												</label>
											</div>
										</div>
									</div>
			    				</form>
			    			</div>
			    			
						</div>
					</div>
				</div>

		
			</div>
				
			
				
		</div>
            <!-- footer bottom bar start -->
             <?php include("sub_footer.php");?>
            <!-- footer bottom bar end -->

        </footer>
        <!-- Footer end -->
		<div id="login" class="modal">
			<div class="modal-content">
				<span class="close" onclick="close_popup1();"></span>	  
				<div class="contact-form" id="contact" style="width:100%;padding: 2px 13px;">
					<h3 class="block-head" style="margin-bottom: 10px;padding: 0 0 4px;">LogIn</h3>
					<form class="" method="post" action="#"  autocomplete="on">
						<div class="form-input" style="margin: 0px 0 15px 0;">
							<label>Email<span class="red">*</span></label>
							<input type="email" required="required" name="u_email" id="u_email" style="width:100%;padding: 4px 13px;">
						</div>
						<div class="form-input" style="margin: 0px 0 15px 0;">
							<label>Password<span class="red">*</span></label>
							<input name="password" type="password" id="pass" style="width:100%;padding: 4px 13px;" required>
						</div>
						<div class="form-input" style="margin: 0px 0 15px 0;">
						   <div class="g-recaptcha" data-sitekey="6LcoEDoUAAAAAPRNv358xV8wx8AVxg5EMLBy4RjC"></div>
						</div>
						<div class="form-input" style="margin: 0px 0 15px 0;">
							<input type="button" onclick="candidate_login();" name="submit_pop"  id="submit" style="font-size: 15px;line-height: 25px;background: #3d1349;color: white;" class="btn btn-large main-bg" value="Login">&nbsp;&nbsp;<a href="javascript:void(0);" onclick="show_register();">Create an Account</a>
							<input type="hidden" id="myBtn" class="myBtn">
						</div>
					</form>
				</div>
			</div>
		</div>
		<div id="register" class="modal">
			<div class="modal-content">
				<span class="close" id="close1" onclick="close_popup1();"></span>	  
				<div class="contact-form" id="contact" style="width:100%;padding: 2px 13px;">
					<h3 class="block-head" style="margin-bottom: 10px;padding: 0 0 4px;">Register</h3>
					<form class="" method="post" action="<?php echo site_url('home/candidate_register');?>" onsubmit="return form_validate1();" autocomplete="on">
						<div class="form-input" style="margin: 0px 0 15px 0;">
							<label>Name<span class="red">*</span></label>
							<input type="text" required="required" name="name" id="name" style="width:100%;padding: 4px 13px;">
							<input type="hidden" required="required" name="base_url" id="base_url" value="<?php echo base_url();?>" style="width:100%;padding: 4px 13px;">
						</div>
						<div class="form-input" style="margin: 0px 0 15px 0;">
							<label>Email<span class="red">*</span></label>
							<input type="email" required="required" name="email" id="candidate_email" onchange="check_user_email_availability();" style="width:100%;padding: 4px 13px;">
						</div>
						<div class="form-input" style="margin: 0px 0 15px 0;">
							<label>Phone<span class="red">*</span></label>
							<input type="text" required="required" name="phone" id="candidate_phone" maxlength="10" onkeypress="return isNumber(event)" onchange="check_user_phone_availability();" style="width:100%;padding: 4px 13px;">
						</div>
						<div class="form-input" style="margin: 0px 0 15px 0;">
							<input type="submit"  name="submit_register"  id="submit" style="font-size: 15px;line-height: 25px;background: #3d1349;color: white;" class="btn btn-large main-bg" value="Create an Account">&nbsp;&nbsp;<a href="javascript:void(0);" onclick="apply_job();">Login</a>
							<input type="hidden" id="myBtn1" class="myBtn">
						</div>
					</form>
					
				</div>
			</div>
		</div>
        <!-- Back to top Link -->
        <div id="to-top" class="main-bg"><span class="fa fa-chevron-up"></span></div>

    </div>

    <!-- Load JS siles -->
    <script type="text/javascript" src="<?php echo base_url();?>../js/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>../js/jquery.webo.js"></script>
	
	<?php 
		
		if($this->session->userdata('candidate_id')=="")
		{
		?>	
					<script>
						var register = document.getElementById("login");
						register.style.display = "block";
					</script>
	<?php
		}
	
	?>
	<script>
		function apply_job()
		{
			var register = document.getElementById('register');
			register.style.display = "none";
			
			var login = document.getElementById('login');
			login.style.display = "block";
		}
		function show_register()
		{
			var login = document.getElementById('login');
			login.style.display = "none";
			
			var register = document.getElementById('register');
			register.style.display = "block";
		}
		function close_popup1()
		{
			var login = document.getElementById('login');
			login.style.display = "none";
			var register = document.getElementById('register');
			 register.style.display = "none";
		}
	</script>
	 <script>
		$(document).ready(function()
			{
				var counter = 1;
				$("#addButton").click(function () 
				{
					jQuery.ajax({
								type:"POST",
								url:"<?php echo base_url(); ?>"+ "/home/add_enquiry_div",
								datatype:"text",
								data:{counter:counter},
								success:function(response)
								{
									$("#cycles").append(response);
									counter++;
								},
								error:function (xhr, ajaxOptions, thrownError){}
							});
			 }); 
		  });
		  $(document).ready(function()
			{
				var counter1 = 1;
				$("#addButton1").click(function () 
				{
					jQuery.ajax({
								type:"POST",
								url:"<?php echo base_url(); ?>"+ "/home/add_exp_table",
								datatype:"text",
								data:{counter1:counter1},
								success:function(response)
								{
									$("#exp_table").append(response);
									counter1++;
										var d = new Date();
										d.setFullYear(d.getFullYear());
										var date = $('.datepicker').datepicker({dateFormat: 'dd-mm-yy',changeMonth: true,
										changeYear: true,yearRange: '1970:' + d.getFullYear(),maxDate:0,onSelect: function(dateText) 
										{
											var id = $(this).attr('id');
											validate_date(id);
										  }}).val();
								},
								error:function (xhr, ajaxOptions, thrownError){}
							});
				}); 
		  });
		  $(document).ready(function()
			{
				var counter2 = 2;
				
				$("#addButton2").click(function () 
				{
					jQuery.ajax({
								type:"POST",
								url:"<?php echo base_url(); ?>"+ "/home/add_edu_details",
								datatype:"text",
								data:{counter2:counter2},
								success:function(response)
								{
									$("#edu_table").append(response);
									counter2++;
								},
								error:function (xhr, ajaxOptions, thrownError){}
							});
				}); 
		  });
		  function remove_cycle_div(id)
		  {
			  r=confirm("Are You Sure To Delete ?");
			  if(r==true)
			  {
				$("#row_"+id).empty();
			  }
		  }
		  function remove_exp_table(id)
		  {
			  r=confirm("Are You Sure To Delete ?");
			  if(r==true)
			  {
				$("#abc_"+id).empty();
			  }
		  }
		  function remove_edu_table(id)
		  {
			  r=confirm("Are You Sure To Delete ?");
			  if(r==true)
			  {
				$("#edu_"+id).empty();
			  }
		  }
	</script>
	<script>

	</script>
        <script>
        window.jQuery || document.write('<script src="../bower_components/jquery/dist/jquery.min.js"><\/script>')
        </script>
	<script src="<?php echo base_url();?>../js/jQuery.print.js"></script>
<script>
	   $(document).ready(function () 
	   {
			 $("#phone").keypress(function (e) 
			 {
				 if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) 
				 {
					   return false;
				 }
			 });
         });
		$(document).ready(function(){
			$("#phone").focusout(function()
			{
				var val=$("#phone").val();
				if(val!="")
				{
					var len=val.length;
					if(len!=10)
					{
						alert("Invalid Mobile Number!");
						$("#phone").val("");
						$("#phone").focus();
					}
				}
			});
		});
		

</script>	
    <!-- Waypoints script -->
	
    <script type="text/javascript" src="<?php echo base_url();?>../js/waypoints.min.js"></script>

    <!-- SLIDER REVOLUTION SCRIPTS  -->
    <script type="text/javascript" src="<?php echo base_url();?>../rs-plugin/js/jquery.themepunch.tools.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>../rs-plugin/js/jquery.themepunch.revolution.min.js"></script>

    <!-- Animate numbers increment -->
    <script type="text/javascript" src="<?php echo base_url();?>../js/jquery.animateNumber.min.js"></script>

    <!-- slick slider carousel -->
    <script type="text/javascript" src="<?php echo base_url();?>../js/slick.min.js"></script>

    <!-- Animate numbers increment -->
    <script type="text/javascript" src="<?php echo base_url();?>../js/jquery.easypiechart.min.js"></script>

    <!-- PrettyPhoto script -->
    <script type="text/javascript" src="<?php echo base_url();?>../js/jquery.prettyPhoto.js"></script>

    <!-- Share post plugin script -->
    <script type="text/javascript" src="<?php echo base_url();?>../js/jquery.sharrre.min.js"></script>

    <!-- Product images zoom plugin -->
    <script type="text/javascript" src="<?php echo base_url();?>../js/jquery.elevateZoom-3.0.8.min.js"></script>

    <!-- Input placeholder plugin -->
    <script type="text/javascript" src="<?php echo base_url();?>../js/jquery.placeholder.js"></script>

    <!-- Tweeter API plugin -->
    <script type="text/javascript" src="<?php echo base_url();?>../js/twitterfeed.js"></script>

    <!-- Flickr API plugin -->
    <script type="text/javascript" src="<?php echo base_url();?>../js/jflickrfeed.min.js"></script>

    <!-- MailChimp plugin -->
    <script type="text/javascript" src="<?php echo base_url();?>../js/mailChimp.js"></script>

    <!-- NiceScroll plugin -->
    <script type="text/javascript" src="<?php echo base_url();?>../js/jquery.nicescroll.min.js"></script>

    <!-- general script file -->
    <script type="text/javascript" src="<?php echo base_url();?>../js/script.js"></script>
	
	
	<script>

$('.up').on('click', function () {
    $('.block-head,p,li,a,h1,h2,h3,h4,h5,h6').animate({'font-size': '+=1'});
});

$('.down').on('click', function () {
    $('.block-head,p,li,a,h1,h2,h3,h4,h5,h6').animate({'font-size': '-=1'});
});






</script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<script>
		function isalpha(evt) 
			{
				evt = (evt) ? evt : window.event;
				var charCode = (evt.which) ? evt.which : evt.keyCode;
				if(charCode==32)
					{
						return true;
					}
						
				else if (charCode > 31 && (charCode < 65 || charCode > 90) && (charCode < 97 || charCode > 122) || charCode==13)
					{
						return false;
					}
			}
		function isalphadot(evt) 
			{
				evt = (evt) ? evt : window.event;
				var charCode = (evt.which) ? evt.which : evt.keyCode;
				if(charCode==46)
				{
					return true;
				}
				else if(charCode==32)
					{
						return true;
					}
						
				else if (charCode > 31 && (charCode < 65 || charCode > 90) && (charCode < 97 || charCode > 122) || charCode==13)
					{
						return false;
					}
			}
	</script>
	<script>
	   $( function() 
	   {
		   
		var d = new Date();
		d.setFullYear(d.getFullYear());
	   
		 var date = $('.datepicker').datepicker({dateFormat: 'dd-mm-yy',changeMonth: true,
		changeYear: true,yearRange: '1968:' + d.getFullYear(),maxDate:0}).val();
				
	   } );
	  
	</script>
		<div id="my_pop1" class="modal">
			<div class="modal-content">
				<span class="close" onclick="close_my_pop();">&times;</span>
							<div class="contact-form" id="contact" style="width:100%;padding: 2px 13px;">
                                <h3 class="block-head" style="margin-bottom: 10px;padding: 0 0 4px;">Warning</h3>
                                <form class="" method="post" action="sendmail.php"  autocomplete="on">
									<p style="line-height: 1.9;font-size: 15px;">Your Minimum Qualification is not satisfied !</p>
                                    <div class="form-input" style="margin: 0px 0 15px 0;">
                                        
                                       <input type="button" onclick="close_my_pop();" name="submit_pop"  id="submit" style="font-size: 15px;line-height: 25px;background: #3d1349;color: white;" class="btn btn-large main-bg" value="Ok">
										
                                    </div>
                                </form>
								
                            </div>
			</div>
		</div>
		<div class="remodal" data-remodal-id="thankyou" style="border: 3px solid #f5be2a;">
							
						<a data-remodal-action="close" class="remodal-close"></a>
					<br>	
				<img src="<?php echo base_url();?>../assets/logo.png" alt="logo">
				  <p style="line-height:1.8;font-size:20px;">Thankyou for Registering in NIRM Online Job Application......!</br>
				  Your Password has been sent to your mail box....!</p>
				  
		</div>
		<div class="remodal" data-remodal-id="terms_condition" style="border: 3px solid #395bb1;overflow-y: scroll;height: 600px;">
							
						<a data-remodal-action="close" class="remodal-close"></a>
					<br>	
				<h4 style="text-align:left;font-size: 16px;color:#000;" ,=""><b>Terms &amp; Conditions of Appointment :</b></h4>
				 <p style="text-align:justify">1)	Contractual appointments are not against any sanctioned post of the Institute and therefore are Purely Temporary in nature. All such appointments will be against specific project(s) and will be co- terminus with the period of the specific project.   for rendering service to the client.  Under normal conditions, no extension of the tenure of appointment shall be permitted and therefore the contract stands terminated ipso facto on completion of the tenure of appointment.</p>
				 <p style="text-align:justify">2)	The tenure of appointment shall be for a period of one year or less (as per requirement in the project).  This can be extended in steps upto a maximum of three years duration. The selected candidate will be required to enter into a Contract Agreement with specified Terms &amp; Conditions that shall be signed jointly by the appointee and the Authorised Signatory from NIRM.</p>
				 <p style="text-align:justify">3)	The appointee shall have no claim for regularising the service at the Institute at a later date nor the Institute at any point of time will entertain any claim by the candidate for extension of term or re-appointment or regularisation of job.  Such Short Period Contractual Appointments are offered by the NIRM towards National Skill Development Mission.</p>
				 <p style="text-align:justify">4)	Cut-off age for all category of applicants for such short-term contractual appointment is 45 years.  For everything else remaining same, preference in recruitment will be given to candidates below 30-35 years of age.  This is in keeping with our mission of supporting Skill Development through short-term employment so that these candidates hone their skill at NIRM in specialised areas and apply the same in a regular job elsewhere.</p>
				 <p style="text-align:justify">5)	Further, in order to make use of the experience of skilled persons served in the same line of work, applications of retirees including voluntarily retired and those who have crossed the re-employable age (i.e 45 years and above) with a minimum of 10 years of experience in relevant field may be considered for appointment against the appropriate position/ post relevant to their field of exposure.</p>
				 <p style="text-align:justify">6)	All posts carry reservation for deserving category as per operative reservation roster for the number of posts for that category.  Hence candidates should submit their application with categorically mentioning their category (SC/ST/ OBC (Non-creamy)/ GEN).</p>
				 <p style="text-align:justify"> 7)	SC/ST /OBC applicants should enclose specified/prescribed copy of the caste certificate to avail the benefit of reservation and concessions failing which their applications will be categorised under unreserved class. For all the above posts, age relaxation will be provided for reserved category candidates as per the prevailing norms of Government of India.</p>
				 <p style="text-align:justify">8)	Those who are employed in the Government /public sector/autonomous Organisations should route their application through proper channel through their concerned employer. They may submit an advance copy of their application directly to NIRM by making a mention thereof. Their formal application  routed through proper channel should reach NIRM in time failing which they should produce a No Objection Certificate  (issued in this regard/for applying to this post.) at the time of interview. </p>
				 <p style="text-align:justify">9)	Head, Project Management Cell, will be appointing authority for all contractual employees.  The performance of the candidate in project will be monitored by the Project Leader and HoD from time to time. The Appointing Authority reserves the right to terminate the contract agreement at any point of time without assigning any reason whatsoever. </p>
				<p style="text-align:justify">10)	Since the recruitment is done to meet the obligations of NIRM Projects, the Project Staff are liable to be deputed  to project sites in any part of the country for satisfactorily carrying out/ accomplishment of the  project work. 
				In special case, the appointee may be asked to directly report to the project site. No transfer grant is admissible for joining the duty or upon his termination from contract service. 
				In case the appointee reports to office and is required to travel to project sites or elsewhere as per the requirements of the Institute, he/she shall be paid the applicable TA/DA as per the rules of the Institute applicable for contractual staff. </p>
				<p style="text-align:justify">11)	All contractual employees will be paid only consolidated emoluments for payment as agreed in the contract document. Therefore no other monetary liability or commitment will be entertained by NIRM. The Project Staff on contract are not entitled for any incentives/honorarium.  
				If the tenure of appointment is extended beyond one year, an annual increment in the emoluments limited to 3% of current monthly emoluments.</p>
				<p style="text-align:justify">12)	 Contract appointees will be entitled for 2½  days of Earned Leave for each completed month of service. The staff may avail maximum of 2 days Casual Leave in any one calendar month.  However, the maximum casual leave permissible in six months will be limited to 4 days only. All leave will lapse at the end of the year, there will be no carry forward of any type of leave.  No leave encashment will be admissible during the service or at the conclusion of the contract period. No study leave/deputation or lien would be permissible</p>
				<p style="text-align:justify">13)	 The appointee shall be entitled for OPD medical  treatment (reimbursement facility) for self only at par with the applicable rule for the regular employees of the Institute subject to a maximum of Rs.25,000/- per year.</p>
				<p style="text-align:justify">14)	The project staff will not be provided any accommodation by the Institute. Hence the permissible HRA has been included in the consolidated emoluments  itself</p>
								  
		</div>
</body>

</html>