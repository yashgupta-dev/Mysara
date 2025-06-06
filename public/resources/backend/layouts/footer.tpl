<!-- Core JS -->
{* filemanager *}
{include file="backend/common/filemanager.tpl"}
{* end filemanager *}
<!-- build:js assets/vendor/js/core.js -->

<script src="{asset path='public/resources/backend/assets/vendor/libs/jquery/jquery.js'}"></script>
<script src="{asset path='public/resources/backend/assets/vendor/libs/popper/popper.js'}"></script>
<script src="{asset path='public/resources/backend/assets/vendor/js/bootstrap.js'}"></script>
<script src="{asset path='public/resources/backend/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js'}">
</script>
<script src="{asset path='public/resources/backend/assets/vendor/js/menu.js'}"></script>

<!-- endbuild -->

<!-- Vendors JS -->
<script src="{asset path='public/resources/backend/assets/vendor/libs/apex-charts/apexcharts.js'}"></script>

<!-- Main JS -->
<script src="{asset path='public/resources/backend/assets/js/main.js'}"></script>
<script src="{asset path='public/assets/vendor/toaster/toastr.min.js'}"></script>
<script src="{asset path="public/assets/js/jquery/ajax.js"}"></script>
<script src="{asset path="public/assets/js/filemanager.js"}"></script>
<script>
    {if !empty($notifications)}
        {foreach from=$notifications item=item key=key}

            {if $item.type === 'E'}
                toastr.error('{$item.title}','{$item.message}');
            {elseif $item.type === 'I'}
                toastr.info('{$item.title}','{$item.message}');
            {elseif $item.type === 'O'}
                toastr.success('{$item.title}','{$item.message}');
            {elseif $item.type === 'W'}
                toastr.warning('{$item.title}','{$item.message}');
            {/if}
        {/foreach}
    {/if}
</script>
<!-- Page JS -->
<script src="{asset path='public/resources/backend/assets/js/dashboards-analytics.js'}"></script>
<script>
    ClassicEditor
        .create(document.querySelector('textarea[editor="ck-editor"]'),{
            // Set height of the editor
            height: 400,
            toolbar: ['heading', '|', 'bold', 'italic', '|', 'link', 'imageUpload', '|', 'undo', 'redo'],
            // FileManager plugin for image upload (you can integrate any file manager for this purpose)
            // simpleUpload: {
            //     uploadUrl: 'common.filemanager.list', // Define the URL for the file manager API or endpoint
            //     // headers: {
            //     //     'X-CSRF-TOKEN': 'your-csrf-token-here', // If required, include CSRF tokens for security
            //     // }
            // },
        })
        .catch(error => {
            console.error(error);
        });
</script>
</body>

</html>