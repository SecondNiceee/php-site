<?php


namespace app\models\admin;


use app\models\AppModel;
use RedBeanPHP\R;
use shop\App;

class Page extends AppModel
{

    public function get_pages(): array
    {
        return R::getAll("SELECT p.*, pd.title FROM page p JOIN page_description pd on p.id = pd.page_id");
    }

    public function deletePage($id): bool
    {
        R::begin();
        try {
            $page = R::load('page', $id);
            if (!$page) {
                return false;
            }
            R::trash($page);
            R::exec("DELETE FROM page_description WHERE page_id = ?", [$id]);

            R::commit();
            return true;
        } catch (\Exception $e) {
            R::rollback();
            return false;
        }
    }

    public function page_validate(): bool
    {
        $errors = '';

        
        $_POST['title'] = trim($_POST['title']);
        $_POST['content'] = trim($_POST['content']);
        if (empty($_POST['title'])) {
            $errors .= "Не заполнено Наименование<br>";
        }
        if (empty($_POST['content'])) {
            $errors .= "Не заполнен Контент<br>";
        }
        

        if ($errors) {
            $_SESSION['errors'] = $errors;
            $_SESSION['form_data'] = $_POST;
            return false;
        }
        return true;
    }

    public function save_page(): bool
    {
        R::begin();
        try {
            // page
            $page = R::dispense('page');
            $page_id = R::store($page);
            $page->menu = post('menu');
            $page->slug = AppModel::create_slug('page', 'slug', $_POST['title'], $page_id);
            R::store($page);

            // page_description
            
            R::exec("INSERT INTO page_description (page_id, title, content, keywords, description) VALUES (?,?,?,?,?)", [
                $page_id,
                $_POST['title'],
                $_POST['content'],
                $_POST['keywords'],
                $_POST['description'],
            ]);
            

            R::commit();
            return true;
        } catch (\Exception $e) {
            R::rollback();
            debug($e, 1);
            $_SESSION['form_data'] = $_POST;
            return false;
        }
    }

    public function update_page($id): bool
    {
        R::begin();
        try {
            // page
            $page = R::load('page', $id);
            if (!$page) {
                return false;
            }

            // page_description
           
                R::exec("UPDATE page_description SET title = ?, content = ?, keywords = ?, description = ? WHERE page_id = ?", [
                    $_POST['title'],
                    $_POST['content'],
                    $_POST['keywords'],
                    $_POST['description'],
                    $id,
                ]);
            

            R::commit();
            return true;
        } catch (\Exception $e) {
            R::rollback();
            return false;
        }
    }

    public function get_page($id): array
    {
        return R::getRow("SELECT pd.*, p.* FROM page_description pd JOIN page p on p.id = pd.page_id WHERE pd.page_id = ?", [$id]);
    }

}