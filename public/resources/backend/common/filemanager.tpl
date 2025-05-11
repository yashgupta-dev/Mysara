<!-- File Manager Modal -->
<div class="modal fade" id="file-manager-modal" tabindex="-1" aria-labelledby="fileManagerModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                {* <h5 class="modal-title" id="fileManagerModalLabel">{$lang.text_filemanager}</h5> *}
                <div class="container">
                    <div class="row">
                        <div class="col-lg-4">
                            <input type="text" id="search-input" class="form-control" placeholder="Search files...">
                        </div>
                        <div class="col-lg-2">
                            <a class="btn btn-danger text-white btn-md"><i class="tf-icons bx bx-trash"></i></a>
                        </div>
                        <div class="col-lg-3">
                        </div>

                        <div class="col-lg-3">
                            <form id="upload-form" enctype="multipart/form-data">
                                <input type="file" class="d-none" name="file"  id="upload" accept="image/*,video/*">
                                <button type="submit" class="btn btn-primary d-none">{$lang.text_filemanager_upload}</button>
                                <a href="javascript:;" type="upload" onclick="document.getElementById('upload').click(); return false;" class="btn btn-dark">{$lang.text_filemanager_upload}</a>
                            </form>
                        </div>
                    </div>
                </div>
                
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="pagination-container" class="mt-3"></div>
                <div id="file-grid" class="row mt-3"></div>
            </div>
        </div>
    </div>
</div>