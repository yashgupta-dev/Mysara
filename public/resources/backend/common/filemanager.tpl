<!-- File Manager Modal -->
<div class="modal fade" id="file-manager-modal" tabindex="-1" aria-labelledby="fileManagerModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="fileManagerModalLabel">File Manager</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="upload-form" enctype="multipart/form-data">
                    <input type="file" id="upload" name="file" accept="image/*,video/*">
                    
                        <img id="file-preview" src="" class="d-none" alt="File preview">
                    

                    <button type="submit" class="btn btn-primary mt-2">Upload</button>
                </form>
                <input type="text" id="search-input" class="form-control mt-3" placeholder="Search files...">
                <div id="folder-navigation" class="mt-3"></div>
                <div id="file-grid" class="row mt-3"></div>
                <div id="pagination-container" class="mt-3"></div>
            </div>
        </div>
    </div>
</div>