document.addEventListener("DOMContentLoaded", function () {
    const openFileManagerBtn = document.getElementById("open-file-manager");
    const uploadInput = document.getElementById("upload");
    const filePreview = document.getElementById("file-preview");
    const uploadForm = document.getElementById("upload-form");
    const fileGrid = document.getElementById("file-grid");
    const searchInput = document.getElementById("search-input");
    const paginationContainer = document.getElementById("pagination-container");
    const folderNavigation = document.getElementById("folder-navigation");
    var openfile =  null;
    
    let currentPage = 1;
    let currentFolder = 'public/storage/uploads/'; // Track current folder
    const itemsPerPage = 10;
    
    const fileManagerModal = new bootstrap.Modal(document.getElementById('file-manager-modal'));

    openFileManagerBtn.addEventListener("click", function () {
        openfile = this;
        fileManagerModal.show();
        loadFiles(); // Load files on modal open
    });

    uploadInput.addEventListener("change", function (e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (event) {
                filePreview.src = event.target.result;
                filePreview.style.display = "block";
            };
            reader.readAsDataURL(file);
        }
    });

    uploadForm.addEventListener("submit", function (e) {
        e.preventDefault();
        const formData = new FormData(this);

        fetch("/admin.php?dispatch=common.filemanager.upload", {
            method: "POST",
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            
            if (data.success) {
                loadFiles(); // Reload files after upload
                filePreview.style.display = "none";
                uploadInput.value = "";
                toastr.success('Success', data.message);
            }

            if(data.error) {
                toastr.error('Error', data.message);   
            }
        })
        .catch(error => toastr.error('Error', error));
    });

    // Load files from server with pagination and folder navigation
    function loadFiles(page = 1) {
        fetch(`/admin.php?dispatch=common.filemanager.list&page=${page}&folder=${encodeURIComponent(currentFolder)}`)
        .then(response => response.json())
        .then(data => {
            fileGrid.innerHTML = '';
            paginationContainer.innerHTML = '';
            folderNavigation.innerHTML = '';

            // Handle folders
            if (data.folders) {
                data.folders.forEach(folder => {
                    const folderGridItem = document.createElement('div');
                    folderGridItem.className = 'file-grid-item';
                    folderGridItem.innerHTML = `
                        <div>
                            <img src="/public/assets/filemanager/folder.png" alt="Folder" />
                            <div>${folder.name}</div>
                        </div>
                    `;
                    folderGridItem.addEventListener('click', function () {
                        currentFolder = folder.path; // Update current folder
                        loadFiles(); // Load files in the selected folder
                    });
                    fileGrid.appendChild(folderGridItem);
                });
            }

            // Handle files
            if (data.files) {
                data.files.forEach(file => {
                    const fileGridItem = document.createElement('div');
                    fileGridItem.className = 'file-grid-item';

                    let thumbnailHtml = '';

                    if (file.type.startsWith('image/')) {
                        thumbnailHtml = `<img src="${file.thumbnail}" alt="${file.name}">`;
                        url = file.url;
                    } else if (file.type.startsWith('video/')) {
                        // thumbnailHtml = `<img src="${file.thumbnail}" alt="${file.name}">`;
                        thumbnailHtml = `<video src="${file.url}" controls style="width: 100%;"></video>`;
                        url = file.thumbnail;
                    }

                    fileGridItem.innerHTML = `
                        ${thumbnailHtml}
                        <div>
                            <a class="" href="${file.url}" target="_blank">View</a>
                            
                            <button class="choose-btn btn btn-dark btn-sm" data-url="${url}" data-name="${file.name}">Choose</button>
                        </div>
                    `;

                    fileGrid.appendChild(fileGridItem);
                });
            }

            // Pagination controls
            if (data.totalPages > 1) {
                for (let i = 1; i <= data.totalPages; i++) {
                    const pageBtn = document.createElement('button');
                    pageBtn.textContent = i;
                    pageBtn.className = 'pagination-btn';
                    if (i === page) pageBtn.classList.add('active');
                    pageBtn.addEventListener('click', () => loadFiles(i));
                    paginationContainer.appendChild(pageBtn);
                }
            }

            // Add event listeners for choose buttons
            document.querySelectorAll('.choose-btn').forEach(button => {
                button.addEventListener('click', function () {
                    const fileUrl = this.dataset.url;
                    if(openfile) {
                        openfile.setAttribute('src', fileUrl);
                        // Get the parent element of openfile
                        var parentElement = openfile.parentElement;

                        // Find the input element with the name 'f_image' within the parent element
                        var inputElement = parentElement.querySelector('input[name="f_image"]');
                        inputElement.value = fileUrl;

                        fileManagerModal.hide();

                    } else {
                        toastr.error('Error','Unable to select file');
                    }
                });
            });
        })
        .catch(error => toastr.error('Error', error));
    }

    // Handle search input
    searchInput.addEventListener('input', function () {
        const query = this.value.toLowerCase();
        document.querySelectorAll('.file-grid-item').forEach(item => {
            const fileName = item.querySelector('img') ? item.querySelector('img').alt.toLowerCase() : '';
            item.style.display = fileName.includes(query) ? '' : 'none';
        });
    });

    // Initial file load
    loadFiles(currentPage);
});
