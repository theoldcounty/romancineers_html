
	var validateForm = {
		invoke: function(el){
			var that = this;

			var options = {
				rules: {},
				messages: {}
			}

			el.find('input[type=text], input[type=password], input[type=email], input[type=checkbox], textarea').each(function( index ) {
				options["rules"][$(this).attr("name")] = {};
				options["messages"][$(this).attr("name")] = {};
				
				if($(this).data("required")){
					options["rules"][$(this).attr("name")]["required"] = $(this).data("required");
					options["messages"][$(this).attr("name")]["required"] = $(this).data("message-required");
				}

				if($(this).data("minlength")){
					options["rules"][$(this).attr("name")]["minlength"] = $(this).data("minlength");
					options["messages"][$(this).attr("name")]["minlength"] = $(this).data("message-minlength");
				}

				if($(this).data("email")){
					options["rules"][$(this).attr("name")]["email"] = $(this).data("email");
					options["messages"][$(this).attr("name")]["email"] = $(this).data("message-email");
				}
				
				if($(this).data("equal-to")){
					options["rules"][$(this).attr("name")]["equalTo"] = $(this).data("equal-to");
					options["messages"][$(this).attr("name")]["equalTo"] = $(this).data("message-equal-to");
				}
				
			});
			
			options["submitHandler"] = function() { 
				that.submithandler(); 
			}
			
			console.log("options", options);
			
			el.validate(options);
		},
		submithandler: function(){
			alert("submitted 2 1!")
		}
	}
	