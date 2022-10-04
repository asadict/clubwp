jQuery(document).ready(function($){
  
      var custom_uploader1;
    $('#wsrcfile_button').click(function(e) {

        e.preventDefault();
     
        if (custom_uploader1) {
            custom_uploader1.open();
            return;
        }

        //Extend the wp.media object
        custom_uploader1 = wp.media.frames.file_frame = wp.media({
            title: 'Choose Image',
            button: {
                text: 'Choose Image'
            },
            multiple: false,
            displaySettings: true,
            displayUserSettings: false
        });

        //When a file is selected, grab the URL and set it as the text field's value
        custom_uploader1.on('select', function() {
            attachment = custom_uploader1.state().get('selection').first().toJSON().url;
            $('#publicationsdocumenttype').val( attachment);
                    
        });

        //Open the uploader dialog
        custom_uploader1.open();
    });
    
    var custom_uploader2;
    $('#casestudybanner_button').click(function(e) {
        e.preventDefault();
        //If the uploader object has already been created, reopen the dialog
        if (custom_uploader2) {


            custom_uploader2.open();
            return;
        }

        //Extend the wp.media object
        custom_uploader2 = wp.media.frames.file_frame = wp.media({
            title: 'Choose Image',
            button: {
                text: 'Choose Image'
            },
            multiple: false,
            displaySettings: true,
            displayUserSettings: false
        });

        //When a file is selected, grab the URL and set it as the text field's value
        custom_uploader2.on('select', function() {
            attachment = custom_uploader2.state().get('selection').first().toJSON();

            var $imgurl = attachment.url;

            $('#casestudybanner').val($imgurl);
                    
        });

        //Open the uploader dialog
        custom_uploader2.open();
    }); 


    // Field fo pdf's in general settings
    var pdfUploader1;
    $('#pdfUploadSettings').click(function(e) {

        e.preventDefault();
        //If the uploader object has already been created, reopen the dialog
        if (pdfUploader1) {
            pdfUploader1.open();
            return;
        }
        
        //Extend the wp.media object
        pdfUploader1 = wp.media.frames.file_frame = wp.media({
            title: 'Choose Image',
            button: {
                text: 'Choose Image'
            },
            multiple: false,
            displaySettings: true,
            displayUserSettings: false
        });

        //When a file is selected, grab the URL and set it as the text field's value
        pdfUploader1.on('select', function() {
            attachment = pdfUploader1.state().get('selection').first().toJSON().url;
        

            $('#document_type').val( attachment);
                    
        });

        //Open the uploader dialog
        pdfUploader1.open();
    });    
    
    
});