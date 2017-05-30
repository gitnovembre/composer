<div id="plupload_import">
	<input type="file" <?php echo $input->attributes; ?> style="display:none;" />
    <div id="plupload_drop">
        <a id="plupload_browse" href="javascript:;">Parcourir vos fichiers</a>
    </div>
    <ul id="plupload_filelist"></ul>
</div>

<script>
jQuery().ready(function($)
{
	GLOBALS.PLUPLOAD = new plupload.Uploader(
    {
        browse_button: 'plupload_browse',
        url: "<?php echo admin_url('admin-post.php'); ?>",
        filters : {
            max_file_size : '10mb',
            mime_types: [
                {title : "Image files", extensions : "jpg,gif,png"}
            ]
        },
        drop_element: 'plupload_drop',
        multi_selection: <?php echo ($input->isMultiple) ? 'true' : 'false'; ?>,
        multipart: true
    });
    GLOBALS.PLUPLOAD.init();
    GLOBALS.PLUPLOAD.bind('FilesAdded', function(up, files)
    {
        var html = '';
        plupload.each(files, function(file)
        {
            html += '<li><span id="' + file.id + '"></span>' + file.name + ' (' + plupload.formatSize(file.size) + ') <b></b></li>';
        });
        document.getElementById('plupload_filelist').innerHTML += html;
    });
    GLOBALS.PLUPLOAD.bind('UploadProgress', function(up, file)
    {
        document.getElementById(file.id).style.width = file.percent + "%";
    });
    GLOBALS.PLUPLOAD.bind('FileUploaded', function(up, file, res)
    {
    });
    GLOBALS.PLUPLOAD.bind('StateChanged', function(uploader, files)
    {
    	uploader.settings.multipart_params = {
            action : "plupload",
            files : files,
            plupload : $('#myForm').serialize(),
    	};
	});
});
</script>
