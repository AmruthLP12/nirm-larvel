		function candidate_login()
		{
			base_url=$("#base_url").val();
			uname=$("#u_email").val();
			password=$("#pass").val();
			
			jQuery.ajax({
					type:"POST",
					url:base_url+ "home/candidate_login",
					datatype:"text",
					data:{uname:uname,password:password},
					success:function(response)
					{
						if(response=="success")
						{
							location.href=base_url;
						}
						else
						{
							alert("Invalid Email or Password..!");
							$("#u_email").val("");
							$("#pass").val("");
							$("#u_email").focus();
						}
					},
					error:function (xhr, ajaxOptions, thrownError){}
					});
		}
		function check_user_email_availability()
		{
			base_url=$("#base_url").val();
			email=$("#candidate_email").val();
			jQuery.ajax({
					type:"POST",
					url:base_url+ "/home/check_user_email_availability",
					datatype:"text",
					data:{email:email},
					success:function(response)
					{
						if(response>="1")
						{
							alert("Email already exists..!");
							$("#candidate_email").val("");
							$("#candidate_email").focus();
						}
					},
					error:function (xhr, ajaxOptions, thrownError){}
					});
		}
		function check_user_phone_availability()
		{
			base_url=$("#base_url").val();
			phone=$("#candidate_phone").val();
			jQuery.ajax({
					type:"POST",
					url:base_url+ "/home/check_user_phone_availability",
					datatype:"text",
					data:{phone:phone},
					success:function(response)
					{
						if(response>="1")
						{
							alert("Phone no already exists..!");
							$("#candidate_phone").val("");
							$("#candidate_phone").focus();
						}
					},
					error:function (xhr, ajaxOptions, thrownError){}
					});
		}