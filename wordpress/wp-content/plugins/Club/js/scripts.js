// Wait for the DOM to be ready
 jQuery(document).ready(function($){
    jQuery( '#frontend-triner-type' ).select2( {
    tags: true,
    tokenSeparators: [ ',' ]
  } );

/* Previous date disable */
var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0');
        var yyyy = today.getFullYear();

        today = yyyy + '-' + mm + '-' + dd;
        $('#course_starting_date').attr('min',today);
        $('#course_ending_date').attr('min',today);


$('#searchsubmit').click(function() {
    window.location.href = '/sports-offer';
    return true;
});

  jQuery.validator.addMethod("exactlength", function(value, element, param) {
      return this.optional(element) || value.length == param;
      },
      $.validator.format("Please enter exactly {0} characters."));
  jQuery.validator.addMethod("lettersonly", function(value, element) {
      return this.optional(element) || /^[a-z]+$/i.test(value);
  }, "Letters only please."); 
  $.validator.addMethod("regex",function(value, element, regexp)  {
        if (regexp && regexp.constructor != RegExp) {
          regexp = new RegExp(regexp);
        }
        else if (regexp.global) regexp.lastIndex = 0;
          return this.optional(element) || regexp.test(value);
  });

  $("form[name='course_add_form']").validate({
      // Specify validation rules
      rules: {
        course_name: "required",
      },
      // Specify validation error messages
      messages: {
        course_name: "Please enter course name.",
      },
      // Make sure the form is submitted to the destination defined
      // in the "action" attribute of the form when valid
      submitHandler: function(form) {
        form.submit();
      }
    });
  $("form[name='trainer_add_form']").validate({
    // Specify validation rules
    rules: {
      trainer_name: "required",
    },
    // Specify validation error messages
    messages: {
      trainer_name: "Please enter trainer name.",
    },
    // Make sure the form is submitted to the destination defined
    // in the "action" attribute of the form when valid
    submitHandler: function(form) {
      form.submit();
    }
  });


  $("form[name='manage_data']").validate({
    // Specify validation rules
    rules: {
      custom_profile_name: "required",
      // profile_email: "required",
      profile_email: {
          required: true,
          email: true,
          regex: /^\b[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b$/i
      },
      phone: {
          required: true,
          regex: /^(?=.*[0-9])[/ +()0-9]+$/
          //exactlength: 13,
      },
      mobile: {
          regex: /^(?=.*[0-9])[/ +()0-9]+$/,
      },
      fax: {
          regex: /^(?=.*[0-9])[/ +()0-9]+$/,
      },
      address:"required",
      zip: {
          required: true,
          exactlength: 5
      },
      place: {
          required: true,
          //lettersonly: true
      },
      contact_person: {
        required: true
      },
    },
    // Specify validation error messages
    messages: {
      custom_profile_name: "Please enter your profile name.",
      profile_email: {
                required: "Please enter email address.",
                email: "Please enter valid email address."
            },
      address: "Please provide your address.",
      zip: {
                required: "Please enter your zip code.",
                exactlength: "Please enter 5 digits.",
            },
      place: {
        required: "Please enter your place.",
        //lettersonly: "Please enter characters only."
      },
      contact_person: {
        required: "Please enter contact person."
      },
      phone: {
                required: "Please enter your phone number.",
                regex: "Please enter valid phone number.",
                exactlength: "Please enter valid phone number."
            },
      mobile: {
                regex: "Please enter valid mobile number.",
      },
      fax: {
                regex: "Please enter valid fax number.",
      },
    },
    // Make sure the form is submitted to the destination defined
    // in the "action" attribute of the form when valid
    submitHandler: function(form) {
      form.submit();
    }
  });
    $("form[name='job_add_form']").validate({
    // Specify validation rules
    rules: {
      jobs_title:"required",
      jobs_type:"required",
      jobs_sport_facility:"required",
      jobs_contact_person:"required",
      jobs_time_to: {
                    required: function () {
                        return $('#jobs_time_from').val() != ''
                    }
                },
      jobs_mail: {
        required: true,
        email: true,
        regex: /^\b[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{1,7}\b$/i
      },
      jobs_starting_day:"required"
          },
    // Specify validation error messages
    messages: {
      jobs_title:"Please enter your job title.",
      jobs_type:"Please select your job type.",
      jobs_sport_facility:"Please select sport facility."+'<br/>',
      jobs_contact_person:"Please enter contact person.",
      jobs_mail: {
                required: "Please enter email address.",
                email: "Please enter valid email address.",
                regex: "Please enter valid email address."
            },
      jobs_starting_day: {
                required: "Please choose starting day.",
                min: "Please enter valid date.",            },
    },
    errorPlacement: function(error, element) {
      if (element.attr("name") == "jobs_time_to" )
      {
          error.insertAfter("#time_from");
      }
      else
      {
          error.insertAfter(element);
      }
    },
    submitHandler: function(form) {
      form.submit();
    }
  });
  $("form[name='job_edit_form']").validate({
    // Specify validation rules
    rules: {
      jobs_title:"required",
      jobs_type:"required",
      jobs_sport_facility:"required",
      jobs_contact_person:"required",
      jobs_time_to: {
                    required: function () {
                        return $('#jobs_time_from').val() != ''
                    }
                },
      jobs_mail: {
        required: true,
        email: true
      },
      jobs_starting_day:"required"
          },
    // Specify validation error messages
    messages: {
      jobs_title:"Please enter your job title.",
      jobs_type:"Please select your job type.",
      jobs_sport_facility:"Please select sport facility."+'<br/>',
      jobs_contact_person:"Please enter contact person.",
      jobs_mail: {
                required: "Please enter email address.",
                email: "Please enter valid email address."
            },
      jobs_starting_day:"Please choose starting day."
    },
    errorPlacement: function(error, element) {
      if (element.attr("name") == "jobs_time_to" )
      {
          error.insertAfter("#time_from");
      }
      else
      {
          error.insertAfter(element);
      }
    },
    submitHandler: function(form) {
      form.submit();
    }
  });
  $("form[name='gym_add_form']").validate({
    // Specify validation rules
    rules: {
      gym_name:"required",
      gym_address:"required",
      gym_postcode: {
          required: true,
          exactlength: 5
      },
      gym_phone: {
          regex: /^(?=.*[0-9])[/ +()0-9]+$/,
      },
      gym_fax: {
          regex: /^(?=.*[0-9])[/ +()0-9]+$/,
      },
      gym_city:"required",
      gym_monday_to: {
                    required: function () {
                        return $('#gym_monday_from').val() != ''
                    }
                },  
      gym_tuesday_to: {
                    required: function () {
                        return $('#gym_tuesday_from').val() != ''
                    }
                },
      gym_wednesday_to: {
                    required: function () {
                        return $('#gym_wednesday_from').val() != ''
                    }
                },
      gym_thursday_to: {
                    required: function () {
                        return $('#gym_thursday_from').val() != ''
                    }
                },
      gym_friday_to: {
                    required: function () {
                        return $('#gym_friday_from').val() != ''
                    }
                },
      gym_saturday_to: {
                    required: function () {
                        return $('#gym_saturday_from').val() != ''
                    }
                },
      gym_sunday_to: {
                    required: function () {
                        return $('#gym_sunday_from').val() != ''
                    }
                },
      gym_mail: {
          regex: /^\b[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{1,7}\b$/i
      },
          },
    // Specify validation error messages
    messages: {
      gym_name:"Please enter your gym name.",
      gym_address:"Please enter your gym address.",
      gym_postcode: {
                required: "Please enter your postcode.",
                exactlength: "Please enter 5 digits.",
            },
      gym_phone: {
                regex: "Please enter valid phone number.",
      },
      gym_fax: {
                regex: "Please enter valid fax number.",
      },
      gym_city:"Please enter your city.",
      gym_mail: {
                regex: "Please enter valid email address."
            },
    },
    errorPlacement: function(error, element) {
      if (element.attr("name") == "gym_monday_to" )
      {
          error.insertAfter("#monday_error");
      }
      else if (element.attr("name") == "gym_tuesday_to" )
      {
          error.insertAfter("#tuesday_error");
      }
      else if (element.attr("name") == "gym_wednesday_to" )
      {
          error.insertAfter("#wednesday_error");
      }
      else if (element.attr("name") == "gym_thursday_to" )
      {
          error.insertAfter("#thursday_error");
      }
      else if (element.attr("name") == "gym_friday_to" )
      {
          error.insertAfter("#friday_error");
      }
      else if (element.attr("name") == "gym_saturday_to" )
      {
          error.insertAfter("#saturday_error");
      }
      else if (element.attr("name") == "gym_sunday_to" )
      {
          error.insertAfter("#sunday_error");
      }
      else
      {
          error.insertAfter(element);
      }
    },
    submitHandler: function(form) {
      form.submit();
    }
  });
  $("form[name='gym_edit_form']").validate({
    // Specify validation rules
    rules: {
      gym_name:"required",
      gym_address:"required",
      gym_postcode: {
          required: true,
          exactlength: 5
      },
      gym_phone: {
          regex: /^(?=.*[0-9])[/ +()0-9]+$/,
      },
      gym_fax: {
          regex: /^(?=.*[0-9])[/ +()0-9]+$/,
      },
      gym_city:"required",
      gym_monday_to: {
                    required: function () {
                        return $('#gym_monday_from').val() != ''
                    }
                },  
      gym_tuesday_to: {
                    required: function () {
                        return $('#gym_tuesday_from').val() != ''
                    }
                },
      gym_wednesday_to: {
                    required: function () {
                        return $('#gym_wednesday_from').val() != ''
                    }
                },
      gym_thursday_to: {
                    required: function () {
                        return $('#gym_thursday_from').val() != ''
                    }
                },
      gym_friday_to: {
                    required: function () {
                        return $('#gym_friday_from').val() != ''
                    }
                },
      gym_saturday_to: {
                    required: function () {
                        return $('#gym_saturday_from').val() != ''
                    }
                },
      gym_sunday_to: {
                    required: function () {
                        return $('#gym_sunday_from').val() != ''
                    }
                },
      gym_mail: {
         regex: /^\b[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{1,7}\b$/i
      },
          },
    // Specify validation error messages
    messages: {
      gym_name:"Please enter your gym name.",
      gym_address:"Please enter your gym address.",
      gym_postcode: {
                required: "Please enter your postcode.",
                exactlength: "Please enter 5 digits.",
            },
      gym_phone: {
                regex: "Please enter valid phone number.",
      },
      gym_fax: {
                regex: "Please enter valid fax number.",
      },
      gym_city:"Please enter your city.",
      gym_mail: {
               regex: "Please enter valid email address."
            },
    },
    errorPlacement: function(error, element) {
      if (element.attr("name") == "gym_monday_to" )
      {
          error.insertAfter("#monday_error");
      }
      else if (element.attr("name") == "gym_tuesday_to" )
      {
          error.insertAfter("#tuesday_error");
      }
      else if (element.attr("name") == "gym_wednesday_to" )
      {
          error.insertAfter("#wednesday_error");
      }
      else if (element.attr("name") == "gym_thursday_to" )
      {
          error.insertAfter("#thursday_error");
      }
      else if (element.attr("name") == "gym_friday_to" )
      {
          error.insertAfter("#friday_error");
      }
      else if (element.attr("name") == "gym_saturday_to" )
      {
          error.insertAfter("#saturday_error");
      }
      else if (element.attr("name") == "gym_sunday_to" )
      {
          error.insertAfter("#sunday_error");
      }
      else
      {
          error.insertAfter(element);
      }
    },
    submitHandler: function(form) {
      form.submit();
    }
  });

   $("form[name='booking_gym']").validate({
    // Specify validation rules
    rules: {
      g_id:"required",
      g_startdate:"required",
      g_enddate:"required",
      gym_parts : "required",
      day_selection:"required",
      start_time: "required",
      end_time: {
        required : true,
        },
          },
    errorPlacement: function(error, element) {
      if (element.attr("name") == "start_time" )
      {
          error.insertAfter("#startDateError");
      }
      else if (element.attr("name") == "end_time" )
      {
          error.insertAfter("#endDateError");
      }
      else
      {
          error.insertAfter(element);
      }
    },
    
    submitHandler: function(form) {
      form.submit();
    }
  });

   $("form[name='contactForm']").validate({
    // Specify validation rules
    rules: {
      cf_provider_name: "required",
      cf_provider_email: {
          required: true,
          email: true,
          regex: /^\b[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b$/i
      },
      cf_provider_message:"required",
    },
    // Specify validation error messages
    messages: {
      cf_provider_name: "Please enter your name.",
      cf_provider_email: {
                required: "Please enter email address.",
                email: "Please enter valid email address.",
                regex: "Please enter valid email address."
            },
      cf_provider_message: "Please enter your message.",
    },
    // Make sure the form is submitted to the destination defined
    // in the "action" attribute of the form when valid
    submitHandler: function(form) {
      form.submit();
    }
  });

   $("form[name='jobs_provider']").validate({
    // Specify validation rules
    rules: {
      cf_provider_name: "required",
      cf_provider_email: {
          required: true,
          email: true,
          regex: /^\b[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b$/i
      },
      cf_provider_message:"required",
    },
    // Specify validation error messages
    messages: {
      cf_provider_name: "Please enter your name.",
      cf_provider_email: {
                required: "Please enter email address.",
                email: "Please enter valid email address.",
                regex: "Please enter valid email address."
            },
      cf_provider_message: "Please enter your message.",
    },
    // Make sure the form is submitted to the destination defined
    // in the "action" attribute of the form when valid
    submitHandler: function(form) {
      form.submit();
    }
  });
});

var startTimeSelected;
        var endTimeSelected;
        var selectedDay;
          var minimumTime = "7:00 AM"; // mentions the start time.
          var maximumTime = "10:30 PM"; // mentions the start time.
          var minimumTimepicker;
          //Time Picker
          jQuery(function () {
            var monday_from = jQuery("#gym_monday_from").val();
            var monday_to = jQuery("#gym_monday_to").val();
            var tuesday_from = jQuery("#gym_tuesday_from").val();
            var tuesday_to = jQuery("#gym_tuesday_to").val();
            var wednesday_from = jQuery("#gym_wednesday_from").val();
            var wednesday_to = jQuery("#gym_wednesday_to").val();
            var thursday_from = jQuery("#gym_thursday_from").val();
            var thursday_to = jQuery("#gym_thursday_to").val();
            var friday_from = jQuery("#gym_friday_from").val();
            var friday_to = jQuery("#gym_friday_to").val();
            var saturday_from = jQuery("#gym_saturday_from").val();
            var saturday_to = jQuery("#gym_saturday_to").val();
            var sunday_from = jQuery("#gym_sunday_from").val();
            var sunday_to = jQuery("#gym_sunday_to").val();
            if(monday_from == ""){
                   jQuery("#gym_monday_from").ejTimePicker({
                  minTime: minimumTime, // Start time as minimumTime.
                  maxTime: maximumTime, // End time as maximumTime.
                  interval: 5,
                  value : '',
                  select: function (args) {
                    var to_time= 'gym_monday_to';
                    if($(this).get(0)._id == 'gym_monday_from'){
                      to_time= 'gym_monday_to';
                    }
                        var selDate = args.value;
                        gym_to = $("#"+to_time).data("ejTimePicker");
                        gym_to.setModel({ "minTime": selDate });
                  },
              });
            }else{ 
          }
          if(tuesday_from == ""){
                   jQuery("#gym_tuesday_from").ejTimePicker({
                  minTime: minimumTime, // Start time as minimumTime.
                  maxTime: maximumTime, // End time as maximumTime.
                  interval: 5,
                  value : '',
                  select: function (args) {
                    var to_time= 'gym_tuesday_to';
                    if($(this).get(0)._id == 'gym_tuesday_from'){
                      to_time= 'gym_tuesday_to';
                    }
                        var selDate = args.value;
                        gym_to = $("#"+to_time).data("ejTimePicker");
                        gym_to.setModel({ "minTime": selDate });
                  },
              });
            }else{  
          }
          if(wednesday_from == ""){
                   jQuery("#gym_wednesday_from").ejTimePicker({
                  minTime: minimumTime, // Start time as minimumTime.
                  maxTime: maximumTime, // End time as maximumTime.
                  interval: 5,
                  value : '',
                  select: function (args) {
                    var to_time= 'gym_wednesday_to';
                    if($(this).get(0)._id == 'gym_wednesday_from'){
                      to_time= 'gym_wednesday_to';
                    }
                        var selDate = args.value;
                        gym_to = $("#"+to_time).data("ejTimePicker");
                        gym_to.setModel({ "minTime": selDate });
                  },
              });
            }else{ 
          }
          if(thursday_from == ""){
                   jQuery("#gym_thursday_from").ejTimePicker({
                  minTime: minimumTime, // Start time as minimumTime.
                  maxTime: maximumTime, // End time as maximumTime.
                  interval: 5,
                  value : '',
                  select: function (args) {
                    var to_time= 'gym_thursday_to';
                    if($(this).get(0)._id == 'gym_thursday_from'){
                      to_time= 'gym_thursday_to';
                    }
                        var selDate = args.value;
                        gym_to = $("#"+to_time).data("ejTimePicker");
                        gym_to.setModel({ "minTime": selDate });
                  },
              });
            }else{
          }
          if(friday_from == ""){
                   jQuery("#gym_friday_from").ejTimePicker({
                  minTime: minimumTime, // Start time as minimumTime.
                  maxTime: maximumTime, // End time as maximumTime.
                  interval: 5,
                  value : '',
                  select: function (args) {
                    var to_time= 'gym_friday_to';
                    if($(this).get(0)._id == 'gym_friday_from'){
                      to_time= 'gym_friday_to';
                    }
                        var selDate = args.value;
                        gym_to = $("#"+to_time).data("ejTimePicker");
                        gym_to.setModel({ "minTime": selDate });
                  },
              });
            }else{
          }
          if(saturday_from == ""){
                   jQuery("#gym_saturday_from").ejTimePicker({
                  minTime: minimumTime, // Start time as minimumTime.
                  maxTime: maximumTime, // End time as maximumTime.
                  interval: 5,
                  value : '',
                  select: function (args) {
                    var to_time= 'gym_saturday_to';
                    if($(this).get(0)._id == 'gym_saturday_from'){
                      to_time= 'gym_saturday_to';
                    }
                        var selDate = args.value;
                        gym_to = $("#"+to_time).data("ejTimePicker");
                        gym_to.setModel({ "minTime": selDate });
                  },
              });
            }else{  
          }
          if(sunday_from == ""){
                   jQuery("#gym_sunday_from").ejTimePicker({
                  minTime: minimumTime, // Start time as minimumTime.
                  maxTime: maximumTime, // End time as maximumTime.
                  interval: 5,
                  value : '',
                  select: function (args) {
                    var to_time= 'gym_sunday_to';
                    if($(this).get(0)._id == 'gym_sunday_from'){
                      to_time= 'gym_sunday_to';
                    }
                        var selDate = args.value;
                        gym_to = $("#"+to_time).data("ejTimePicker");
                        gym_to.setModel({ "minTime": selDate });
                  },
              });
            }else{  
          }
              jQuery("#gym_monday_from, #gym_tuesday_from, #gym_wednesday_from, #gym_thursday_from, #gym_friday_from, #gym_saturday_from, #gym_sunday_from").ejTimePicker({
                  minTime: minimumTime, // Start time as minimumTime.
                  maxTime: maximumTime, // End time as maximumTime.
                  interval: 5,
                  //value : '',
                  select: function (args) {
                    var to_time= 'gym_monday_to';
                    if($(this).get(0)._id == 'gym_monday_from'){
                      to_time= 'gym_monday_to';
                    }else if($(this).get(0)._id == 'gym_tuesday_from'){
                      to_time= 'gym_tuesday_to';
                    }
                    else if($(this).get(0)._id == 'gym_wednesday_from'){
                      to_time= 'gym_wednesday_to';
                    }
                    else if($(this).get(0)._id == 'gym_thursday_from'){
                      to_time= 'gym_thursday_to';
                    }
                    else if($(this).get(0)._id == 'gym_friday_from'){
                      to_time= 'gym_friday_to';
                    }
                    else if($(this).get(0)._id == 'gym_saturday_from'){
                      to_time= 'gym_saturday_to';
                    }
                    else if($(this).get(0)._id == 'gym_sunday_from'){
                      to_time= 'gym_sunday_to';
                    }
                        var selDate = args.value;
                        gym_to = $("#"+to_time).data("ejTimePicker");
                        gym_to.setModel({ "minTime": selDate });
                  },
              });
              
              if(monday_to == ""){
                   jQuery("#gym_monday_to").ejTimePicker({
                    minTime: minimumTime, // Start time as minimumTime.
                    maxTime: maximumTime, // End time as maximumTime.
                    interval: 5,
                    value : '',
                  });
              }else{  
            }
            if(tuesday_to == ""){
                   jQuery("#gym_tuesday_to").ejTimePicker({
                    minTime: minimumTime, // Start time as minimumTime.
                    maxTime: maximumTime, // End time as maximumTime.
                    interval: 5,
                    value : '',
                  });
              }else{ 
            }
            if(wednesday_to == ""){
                   jQuery("#gym_wednesday_to").ejTimePicker({
                    minTime: minimumTime, // Start time as minimumTime.
                    maxTime: maximumTime, // End time as maximumTime.
                    interval: 5,
                    value : '',
                  });
              }else{  
            }
            if(thursday_to == ""){
                   jQuery("#gym_thursday_to").ejTimePicker({
                    minTime: minimumTime, // Start time as minimumTime.
                    maxTime: maximumTime, // End time as maximumTime.
                    interval: 5,
                    value : '',
                  });
              }else{
            }
            if(friday_to == ""){
                   jQuery("#gym_friday_to").ejTimePicker({
                    minTime: minimumTime, // Start time as minimumTime.
                    maxTime: maximumTime, // End time as maximumTime.
                    interval: 5,
                    value : '',
                  });
              }else{ 
            }
            if(saturday_to == ""){
                   jQuery("#gym_saturday_to").ejTimePicker({
                    minTime: minimumTime, // Start time as minimumTime.
                    maxTime: maximumTime, // End time as maximumTime.
                    interval: 5,
                    value : '',
                  });
              }else{ 
            }
            if(sunday_to == ""){
                   jQuery("#gym_sunday_to").ejTimePicker({
                    minTime: minimumTime, // Start time as minimumTime.
                    maxTime: maximumTime, // End time as maximumTime.
                    interval: 5,
                    value : '',
                  });
              }else{  
            }

              jQuery('#gym_monday_to, #gym_tuesday_to, #gym_wednesday_to, #gym_thursday_to, #gym_friday_to, #gym_saturday_to, #gym_sunday_to').ejTimePicker({
                  minTime: minimumTime,
                  maxTime: maximumTime,
                  interval: 5,
                  //value : '',
              });
          });

/*Course time start*/

var startTimeSelected;
        var endTimeSelected;
        var selectedDay;
          var minimumTime = "7:00 AM"; // mentions the start time.
          var maximumTime = "10:30 PM"; // mentions the start time.
          var minimumTimepicker;
          //Time Picker
          jQuery(function () {
            var monday_from = jQuery("#course_monday_from").val();
            var monday_to = jQuery("#course_monday_to").val();
            var tuesday_from = jQuery("#course_tuesday_from").val();
            var tuesday_to = jQuery("#course_tuesday_to").val();
            var wednesday_from = jQuery("#course_wednesday_from").val();
            var wednesday_to = jQuery("#course_wednesday_to").val();
            var thursday_from = jQuery("#course_thursday_from").val();
            var thursday_to = jQuery("#course_thursday_to").val();
            var friday_from = jQuery("#course_friday_from").val();
            var friday_to = jQuery("#course_friday_to").val();
            var saturday_from = jQuery("#course_saturday_from").val();
            var saturday_to = jQuery("#course_saturday_to").val();
            var sunday_from = jQuery("#course_sunday_from").val();
            var sunday_to = jQuery("#course_sunday_to").val();
            if(monday_from == ""){
                   jQuery("#course_monday_from").ejTimePicker({
                  minTime: minimumTime, // Start time as minimumTime.
                  maxTime: maximumTime, // End time as maximumTime.
                  interval: 5,
                  value : '',
                  select: function (args) {
                    var to_time= 'course_monday_to';
                    if($(this).get(0)._id == 'course_monday_from'){
                      to_time= 'course_monday_to';
                    }
                        var selDate = args.value;
                        course_to = $("#"+to_time).data("ejTimePicker");
                        course_to.setModel({ "minTime": selDate });
                  },
              });
            }else{ 
          }
          if(tuesday_from == ""){
                   jQuery("#course_tuesday_from").ejTimePicker({
                  minTime: minimumTime, // Start time as minimumTime.
                  maxTime: maximumTime, // End time as maximumTime.
                  interval: 5,
                  value : '',
                  select: function (args) {
                    var to_time= 'course_tuesday_to';
                    if($(this).get(0)._id == 'course_tuesday_from'){
                      to_time= 'course_tuesday_to';
                    }
                        var selDate = args.value;
                        course_to = $("#"+to_time).data("ejTimePicker");
                        course_to.setModel({ "minTime": selDate });
                  },
              });
            }else{  
          }
          if(wednesday_from == ""){
                   jQuery("#course_wednesday_from").ejTimePicker({
                  minTime: minimumTime, // Start time as minimumTime.
                  maxTime: maximumTime, // End time as maximumTime.
                  interval: 5,
                  value : '',
                  select: function (args) {
                    var to_time= 'course_wednesday_to';
                    if($(this).get(0)._id == 'course_wednesday_from'){
                      to_time= 'course_wednesday_to';
                    }
                        var selDate = args.value;
                        course_to = $("#"+to_time).data("ejTimePicker");
                        course_to.setModel({ "minTime": selDate });
                  },
              });
            }else{ 
          }
          if(thursday_from == ""){
                   jQuery("#course_thursday_from").ejTimePicker({
                  minTime: minimumTime, // Start time as minimumTime.
                  maxTime: maximumTime, // End time as maximumTime.
                  interval: 5,
                  value : '',
                  select: function (args) {
                    var to_time= 'course_thursday_to';
                    if($(this).get(0)._id == 'course_thursday_from'){
                      to_time= 'course_thursday_to';
                    }
                        var selDate = args.value;
                        course_to = $("#"+to_time).data("ejTimePicker");
                        course_to.setModel({ "minTime": selDate });
                  },
              });
            }else{
          }
          if(friday_from == ""){
                   jQuery("#course_friday_from").ejTimePicker({
                  minTime: minimumTime, // Start time as minimumTime.
                  maxTime: maximumTime, // End time as maximumTime.
                  interval: 5,
                  value : '',
                  select: function (args) {
                    var to_time= 'course_friday_to';
                    if($(this).get(0)._id == 'course_friday_from'){
                      to_time= 'course_friday_to';
                    }
                        var selDate = args.value;
                        course_to = $("#"+to_time).data("ejTimePicker");
                        course_to.setModel({ "minTime": selDate });
                  },
              });
            }else{
          }
          if(saturday_from == ""){
                   jQuery("#course_saturday_from").ejTimePicker({
                  minTime: minimumTime, // Start time as minimumTime.
                  maxTime: maximumTime, // End time as maximumTime.
                  interval: 5,
                  value : '',
                  select: function (args) {
                    var to_time= 'course_saturday_to';
                    if($(this).get(0)._id == 'course_saturday_from'){
                      to_time= 'course_saturday_to';
                    }
                        var selDate = args.value;
                        course_to = $("#"+to_time).data("ejTimePicker");
                        course_to.setModel({ "minTime": selDate });
                  },
              });
            }else{  
          }
          if(sunday_from == ""){
                   jQuery("#course_sunday_from").ejTimePicker({
                  minTime: minimumTime, // Start time as minimumTime.
                  maxTime: maximumTime, // End time as maximumTime.
                  interval: 5,
                  value : '',
                  select: function (args) {
                    var to_time= 'course_sunday_to';
                    if($(this).get(0)._id == 'course_sunday_from'){
                      to_time= 'course_sunday_to';
                    }
                        var selDate = args.value;
                        course_to = $("#"+to_time).data("ejTimePicker");
                        course_to.setModel({ "minTime": selDate });
                  },
              });
            }else{  
          }
              jQuery("#course_monday_from, #course_tuesday_from, #course_wednesday_from, #course_thursday_from, #course_friday_from, #course_saturday_from, #course_sunday_from").ejTimePicker({
                  minTime: minimumTime, // Start time as minimumTime.
                  maxTime: maximumTime, // End time as maximumTime.
                  interval: 5,
                  //value : '',
                  select: function (args) {
                    var to_time= 'course_monday_to';
                    if($(this).get(0)._id == 'course_monday_from'){
                      to_time= 'course_monday_to';
                    }else if($(this).get(0)._id == 'course_tuesday_from'){
                      to_time= 'course_tuesday_to';
                    }
                    else if($(this).get(0)._id == 'course_wednesday_from'){
                      to_time= 'course_wednesday_to';
                    }
                    else if($(this).get(0)._id == 'course_thursday_from'){
                      to_time= 'course_thursday_to';
                    }
                    else if($(this).get(0)._id == 'course_friday_from'){
                      to_time= 'course_friday_to';
                    }
                    else if($(this).get(0)._id == 'course_saturday_from'){
                      to_time= 'course_saturday_to';
                    }
                    else if($(this).get(0)._id == 'course_sunday_from'){
                      to_time= 'course_sunday_to';
                    }
                        var selDate = args.value;
                        course_to = $("#"+to_time).data("ejTimePicker");
                        course_to.setModel({ "minTime": selDate });
                  },
              });
              
              if(monday_to == ""){
                   jQuery("#course_monday_to").ejTimePicker({
                    minTime: minimumTime, // Start time as minimumTime.
                    maxTime: maximumTime, // End time as maximumTime.
                    interval: 5,
                    value : '',
                  });
              }else{  
            }
            if(tuesday_to == ""){
                   jQuery("#course_tuesday_to").ejTimePicker({
                    minTime: minimumTime, // Start time as minimumTime.
                    maxTime: maximumTime, // End time as maximumTime.
                    interval: 5,
                    value : '',
                  });
              }else{ 
            }
            if(wednesday_to == ""){
                   jQuery("#course_wednesday_to").ejTimePicker({
                    minTime: minimumTime, // Start time as minimumTime.
                    maxTime: maximumTime, // End time as maximumTime.
                    interval: 5,
                    value : '',
                  });
              }else{  
            }
            if(thursday_to == ""){
                   jQuery("#course_thursday_to").ejTimePicker({
                    minTime: minimumTime, // Start time as minimumTime.
                    maxTime: maximumTime, // End time as maximumTime.
                    interval: 5,
                    value : '',
                  });
              }else{
            }
            if(friday_to == ""){
                   jQuery("#course_friday_to").ejTimePicker({
                    minTime: minimumTime, // Start time as minimumTime.
                    maxTime: maximumTime, // End time as maximumTime.
                    interval: 5,
                    value : '',
                  });
              }else{ 
            }
            if(saturday_to == ""){
                   jQuery("#course_saturday_to").ejTimePicker({
                    minTime: minimumTime, // Start time as minimumTime.
                    maxTime: maximumTime, // End time as maximumTime.
                    interval: 5,
                    value : '',
                  });
              }else{ 
            }
            if(sunday_to == ""){
                   jQuery("#course_sunday_to").ejTimePicker({
                    minTime: minimumTime, // Start time as minimumTime.
                    maxTime: maximumTime, // End time as maximumTime.
                    interval: 5,
                    value : '',
                  });
              }else{  
            }

              jQuery('#course_monday_to, #course_tuesday_to, #course_wednesday_to, #course_thursday_to, #course_friday_to, #course_saturday_to, #course_sunday_to').ejTimePicker({
                  minTime: minimumTime,
                  maxTime: maximumTime,
                  interval: 5,
                  //value : '',
              });
          });
         
/*Course time end*/

/*Course searching start*/

var startTimeSelected;
        var endTimeSelected;
        var selectedDay;
          var minimumTime = "7:00 AM"; // mentions the start time.
          var maximumTime = "10:30 PM"; // mentions the start time.
          var minimumTimepicker;
          //Time Picker
          jQuery(function () {
            var offer_from = jQuery("#offer_from").val();
            var offer_to = jQuery("#offer_to").val();
           
            if(offer_from == ""){
                   jQuery("#offer_from").ejTimePicker({
                  minTime: minimumTime, // Start time as minimumTime.
                  maxTime: maximumTime, // End time as maximumTime.
                  interval: 5,
                  value : '',
                  select: function (args) {
                    var to_time= 'offer_to';
                    if($(this).get(0)._id == 'offer_from'){
                      to_time= 'offer_to';
                    }
                        var selDate = args.value;
                        course_to = $("#"+to_time).data("ejTimePicker");
                        course_to.setModel({ "minTime": selDate });
                  },
              });
            }
              jQuery("#offer_from").ejTimePicker({
                  minTime: minimumTime, // Start time as minimumTime.
                  maxTime: maximumTime, // End time as maximumTime.
                  interval: 5,
                  //value : '',
                  select: function (args) {
                    var to_time= 'offer_to';
                    if($(this).get(0)._id == 'offer_from'){
                      to_time= 'offer_to';
                    }
                        var selDate = args.value;
                        course_to = $("#"+to_time).data("ejTimePicker");
                        course_to.setModel({ "minTime": selDate });
                  },
              });
              
              if(offer_to == ""){
                   jQuery("#offer_to").ejTimePicker({
                    minTime: minimumTime, // Start time as minimumTime.
                    maxTime: maximumTime, // End time as maximumTime.
                    interval: 5,
                    value : '',
                  });
              }else{  
            }
              jQuery('#offer_to').ejTimePicker({
                  minTime: minimumTime,
                  maxTime: maximumTime,
                  interval: 5,
                  //value : '',
              });
          });

/*Course searching end*/

          jQuery(function () {
            var jobs_times_from = jQuery('#jobs_time_from').val();
            var jobs_times_to = jQuery('#jobs_time_to').val();
            if(jobs_times_from == ""){
                  jQuery("#jobs_time_from").ejTimePicker({
                  minTime: minimumTime, // Start time as minimumTime.
                  maxTime: maximumTime, // End time as maximumTime.
                  interval: 5,
                  value : '',
                  select: function (args) {
                    var to_time= 'jobs_time_to';
                    if($(this).get(0)._id == 'jobs_time_from'){
                      to_time= 'jobs_time_to';
                    }
                        var selDate = args.value;
                        gym_to = $("#"+to_time).data("ejTimePicker");
                        gym_to.setModel({ "minTime": selDate });
                  },
              });
            }
              jQuery("#jobs_time_from").ejTimePicker({
                  minTime: minimumTime, // Start time as minimumTime.
                  maxTime: maximumTime, // End time as maximumTime.
                  interval: 5,
                  //value:'',
                  select: function (args) {
                    var to_time= 'jobs_time_to';
                    if($(this).get(0)._id == 'jobs_time_from'){
                      to_time= 'jobs_time_to';
                    }
                        var selDate = args.value;
                        gym_to = $("#"+to_time).data("ejTimePicker");
                        gym_to.setModel({ "minTime": selDate });
                  },
              });
              if(jobs_times_to == ""){
                   jQuery("#jobs_time_to").ejTimePicker({
                    minTime: minimumTime, // Start time as minimumTime.
                    maxTime: maximumTime, // End time as maximumTime.
                    interval: 5,
                    value : '',
                  });
              }
              jQuery('#jobs_time_to').ejTimePicker({
                  minTime: minimumTime,
                  maxTime: maximumTime,
                  interval: 5,
                  //value: '',
              });
          });

function myMap() {
  var mapCanvas = document.getElementById("map");
  var mapOptions = {
    center: new google.maps.LatLng(51.5, -0.2), zoom: 10
  };
  var map = new google.maps.Map(mapCanvas, mapOptions);
}

if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}


     
            
