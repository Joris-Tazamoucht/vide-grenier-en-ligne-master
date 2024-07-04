<?php

namespace App\Controllers;

use App\Models\Articles;
use App\Helpers\Upload;
use App\Helpers\Mailer;
use \Core\View;

/**
 * Product controller
 */
class Product extends \Core\Controller
{

    /**
     * Affiche la page d'ajout
     * @return void
     */
    public function indexAction()
    {

        if(isset($_POST['submit'])) {

            try {
                $f = $_POST;

                // TODO: Validation

                $f['user_id'] = $_SESSION['user']['id'];
                $id = Articles::save($f);

                $pictureName = Upload::uploadFile($_FILES['picture'], $id);

                Articles::attachPicture($id, $pictureName);

                header('Location: /product/' . $id);
            } catch (\Exception $e){
                    var_dump($e);
            }
        }

        View::renderTemplate('Product/Add.html');
    }

    /**
     * Affiche la page d'un produit
     * @return void
     */
    public function showAction()
    {
        
        $id = $this->route_params['id'];

        try {
            Articles::addOneView($id);
            $suggestions = Articles::getSuggest();
            $article = Articles::getOne($id);
        } catch(\Exception $e){
            var_dump($e);
        }

        if(isset($_POST['submit'])) {
            $f = $_POST;
            $this->sendMail($f,  $article[0]['user_id']);
        }

        View::renderTemplate('Product/Show.html', [
            'article' => $article[0],
            'suggestions' => $suggestions
        ]);
    }

    /**
     * Envoie un mail à partir du formulaire de contact
     */
    private function sendMail($data, $user_id) {
        try {
            $emailTo = \App\Models\User::getOne($user_id)[0]['email'];
            $senderName = $data["name"];
            $senderEmail = $data["email"];
            $subject = $data["subject"];
            $message = $data["content"];

            Mailer::sendMail($emailTo, $senderName, $senderEmail, $subject, $message);
        } catch (\Exception $e) {
            var_dump($e);
        }
    }
}
