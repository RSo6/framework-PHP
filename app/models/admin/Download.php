<?php


namespace app\models\admin;


use app\models\AppModel;
use RedBeanPHP\R;

class Download extends AppModel
{

    public function getDownloads($lang, $start, $per_page): array
    {
        return R::getAll("
                    SELECT d.*, dd.* 
                    FROM download d 
                        JOIN download_description dd on d.id = dd.download_id 
                    WHERE dd.language_id = ? 
                    LIMIT $start, $per_page",
            [$lang['id']]);
    }

    public function downloadValidate(): bool
    {
        $errors = '';
        foreach ($_POST['download_description'] as $lang_id => $item) {
            $item['name'] = trim($item['name']);
            if (empty($item['name'])) {
                $errors .= "Не заповнений рядок {$lang_id}<br>";
            }
        }
        if (empty($_FILES) || $_FILES['file']['error']) {
            $errors .= "Помилка завантаження файлу<br>";
        } else {
            $extensions = ['jpg', 'jpeg', 'png', 'zip', 'pdf', 'txt',];
            $parts = explode('.', $_FILES['file']['name']);
            $ext = end($parts);
            if (!in_array($ext, $extensions)) {
                $errors .= "Допустимые для загрузки только расширения: jpg, jpeg, png, zip, pdf, txt<br>";
            }
        }

        if ($errors) {
            $_SESSION['errors'] = $errors;
            return false;
        }
        return true;
    }

    public function uploadFile(): array|false
    {
        $file_name = $_FILES['file']['name'] . '.' . uniqid();
        $path = WWW . '/downloads/' . $file_name;
        if (move_uploaded_file($_FILES['file']['tmp_name'], $path)) {
            return [
                'original_name' => $_FILES['file']['name'],
                'filename' => $file_name,
            ];
        }
        return false;
    }

    public function saveDownload($data): bool
    {
        R::begin();
        try {
            $download = R::dispense('download');
            $download->filename = $data['filename'];
            $download->original_name = $data['original_name'];
            $download_id = R::store($download);
            foreach ($_POST['download_description'] as $lang_id => $item) {
                R::exec("
                INSERT INTO download_description (download_id, language_id, name) VALUES (?,?,?)",
                [
                    $download_id,
                    $lang_id,
                    $item['name'],
                ]);
            }

            R::commit();
            return true;
        } catch (\Exception $e) {
            R::rollback();
            debug($e, 1);
            return false;
        }
    }

    public function downloadDelete($id): bool
    {
        $file_name = R::getCell("
        SELECT filename 
        FROM download
        WHERE id = ?,
        [$id]");
        $file_path = WWW . "/downloads/{$file_name}";
        if(file_exists($file_path)) {
            R::begin();
            try {
                R::exec("DELETE FROM download_description WHERE download_id = ?", [$id]);
                R::exec("DELETE FROM download WHERE id = ?", [$id]);
                    R::commit();
              @unlink($file_path);
                    return true;
            }catch(\Exception $e){
                    R::rollback();
                    return false;
            }
        }
        return false;
    }
}