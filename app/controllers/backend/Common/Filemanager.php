<?php

namespace app\controllers\backend\Common;

use app\core\Json;
use app\core\Response;
use app\core\Notification;
use app\controllers\BaseController;

class Filemanager extends BaseController
{
    protected $uploadDir;

    private $allowedMimeTypes = [
        'image/png',
        'image/jpeg',
        'image/jpg',
        'image/webp',
        'video/mp4',
        'audio/mpeg',
        'image/svg+xml'
    ];

    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->executeMiddleware($this->requestParam, ['AuthMiddleware', 'PermissionMiddleware', 'NotificationMiddleware']);
        $this->uploadDir = RESOURCES . '../storage/uploads/';
    }

    public function upload()
    {
        if ($this->requestMethod == 'POST') {
            if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
                $fileTmpPath = $_FILES['file']['tmp_name'];
                
                $fileName = basename($_FILES['file']['name']);

                $fileName = preg_replace('/[^a-zA-Z0-9_\.-]/', '', $fileName); // Sanitize the file name
                $filePath = $this->uploadDir . $fileName;

                if (move_uploaded_file($fileTmpPath, $filePath)) {
                    $fileMimeType = mime_content_type($filePath);

                    if (in_array($fileMimeType, $this->allowedMimeTypes)) {
                        if (strpos($fileMimeType, 'image/') === 0) {
                            $this->createImageThumbnail($filePath, $fileMimeType);
                        }
                        Notification::set('O', 'Success', $this->language['text_success']);
                        $response = ['success' => true, 'message' => $this->language['text_success']];
                    } else {
                        unlink($filePath); // Remove the file if type is not allowed
                        Notification::set('E', 'Error', sprintf($this->language['text_failed'], 'upload'));
                        $response = ['errors' => sprintf($this->language['text_failed'], 'upload')];
                    }
                } else {
                    Notification::set('E', 'Error', sprintf($this->language['text_failed'], 'upload'));
                    $response = ['errors' => sprintf($this->language['text_failed'], 'upload')];
                }
            } else {
                Notification::set('E', 'Error', sprintf($this->language['text_failed'], 'upload'));
                $response = ['errors' => sprintf($this->language['text_failed'], 'upload')];
            }
        } else {
            Notification::set('E', 'Error', sprintf($this->language['text_failed'], 'upload'));
            $response = ['errors' => sprintf($this->language['text_failed'], 'upload')];
            // echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
        }

        Response::json(Json::encode($response));
    }

    public function list()
    {
        $folder = isset($this->requestParam['folder']) ? rtrim($this->requestParam['folder'], '/') . '/' : $this->uploadDir;
        $page = isset($this->requestParam['page']) ? (int)$this->requestParam['page'] : 1;
        $itemsPerPage = 20; // Number of items per page
        $offset = ($page - 1) * $itemsPerPage;

        if (!is_dir($folder)) {
            $response = ['errors' => 'Directory not found'];
            Response::json(Json::encode($response));
        }

        $items = $this->getItems($folder);
        $totalFiles = count($items['files']);
        $totalPages = ceil($totalFiles / $itemsPerPage);
        $pagedFiles = array_slice($items['files'], $offset, $itemsPerPage);

        $response = [
            'folders'   => $items['folders'],
            'files'     => $pagedFiles,
            'totalPages' => $totalPages
        ];

        Response::json(Json::encode($response));
    }

    private function getItems($dir)
    {
        $items = ['files' => [], 'folders' => []];
        $itemsInDir = glob($dir . '*'); // Get all files and directories in the directory

        foreach ($itemsInDir as $item) {
            if (is_dir($item)) {
                $items['folders'][] = [
                    'name' => basename($item),
                    'path' => $item
                ];
            } else {
                if (!file_exists($item)) {
                    continue; // Skip non-existent files
                }

                $fileMimeType = @mime_content_type($item);
                if ($fileMimeType === false) {
                    $fileMimeType = 'unknown'; // Handle mime content type error
                }

                $items['files'][] = [
                    'name'      => basename($item),
                    'size'      => filesize($item),
                    'url'       => 'public/storage/uploads/' . basename($item),
                    'type'      => $fileMimeType,
                    'thumbnail' => $this->generateThumbnailUrl($item, $fileMimeType)
                ];
            }
        }
        return $items;
    }

    private function createImageThumbnail($file, $fileMimeType)
    {
        $thumbnailPath = $this->uploadDir . '../../assets/filemanager/cache/thumb_' . basename($file);
        switch ($fileMimeType) {
            case 'image/jpeg':
                $image = imagecreatefromjpeg($file);
                break;
            case 'image/png':
                $image = imagecreatefrompng($file);
                break;
            case 'image/gif':
                $image = imagecreatefromgif($file);
                break;
            default:
                return; // Unsupported image type
        }

        $width = imagesx($image);
        $height = imagesy($image);
        $newWidth = 150; // Example thumbnail width
        $newHeight = (int)($height * ($newWidth / $width));

        $thumbnail = imagecreatetruecolor($newWidth, $newHeight);

        // Handle PNG transparency
        if ($fileMimeType === 'image/png') {
            imagealphablending($thumbnail, false);
            imagesavealpha($thumbnail, true);
            $transparent = imagecolorallocatealpha($thumbnail, 0, 0, 0, 127);
            imagefill($thumbnail, 0, 0, $transparent);
        }

        imagecopyresampled($thumbnail, $image, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
        imagejpeg($thumbnail, $thumbnailPath); // Save as JPEG

        imagedestroy($image);
        imagedestroy($thumbnail);
    }

    private function generateThumbnailUrl($file, $fileMimeType)
    {
        $fileName = basename($file);
        $thumbnailPath = 'public/assets/filemanager/cache/thumb_' . $fileName;

        if (file_exists($thumbnailPath)) {
            return 'public/assets/filemanager/cache/' . 'thumb_' . $fileName;
        }

        if (strpos($fileMimeType, 'image/') === 0) {
            $this->createImageThumbnail($file, $fileMimeType);
        } elseif (strpos($fileMimeType, 'video/') === 0) {
            return 'public/assets/filemanager/default-video-thumbnail.png'; // Default video thumbnail
        }

        return 'public/storage/uploads/' . $fileName;
    }
}
