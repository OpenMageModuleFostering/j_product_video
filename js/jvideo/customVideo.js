
	/** 
	 * Javascript file for handling the Ajax and Client request in the Product Video extension
	 */

	jQuery(document).ready(function()
	{
		var id	= jQuery('#currentproductId').val();
		jQuery.ajax(
			{
				url		: baseUrl+'productvideo/jproductvideo/getProductVideo/id/'+id,
				type	: 'POST',async:false,
				dataType: 'JSON',
				success	: handleVideoDetails
			}
		);
	});

	function handleVideoDetails(videoData)
	{
		if(videoData != '' && videoData != null)
		{
			videoPlayList(videoData);
		}
	}

	function videoPlayList(data)
	{
		jQuery('#videoCaption').text(data[0].title) // Assign Caption for the Product Video
		
		jQuery("#jquery_jplayer_1").jPlayer({
			ready: function () {
				jQuery(this).jPlayer("setMedia", {
					m4v: data[0].fileName,
					ogv: data[0].fileName,
					webmv: data[0].fileName,
					flv: data[0].fileName,
					poster: data[1].fileName
				});
			},
			swfPath: jsUrl+"jvideo",
			solution: "flash, html",
			supplied: "flv, webmv, ogv, m4v",
			size: {
				width: "640px",
				height: "360px",
				cssClass: "jp-video-360p"
			}		
		});
	}
