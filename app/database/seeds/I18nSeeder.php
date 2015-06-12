<?php

class I18nSeeder extends Seeder {

    public function run()
    {
        //Button Constant text
            I18n::add(array('fr'=>'Boutons','en'=>'Buttons'), 'key', 'button');
            I18n::add(array('fr'=>'Sauvegarder','en'=>'save'), 'key', 'button.save');
            I18n::add(array('fr'=>'Éditer','en'=>'edit'), 'key', 'button.edit');
            I18n::add(array('fr'=>'Mettre à jour','en'=>'update'), 'key', 'button.update');
            I18n::add(array('fr'=>'Supprimer','en'=>'delete'), 'key', 'button.delete');
            I18n::add(array('fr'=>'Nouveau','en'=>'new'), 'key', 'button.new');
            I18n::add(array('fr'=>'Créer','en'=>'create'), 'key', 'button.create');
            I18n::add(array('fr'=>'Ajouter','en'=>'add'), 'key', 'button.add');
            I18n::add(array('fr'=>'Fermer','en'=>'Close'), 'key', 'button.close');

        //Reminder
            I18n::add(array('fr'=>"Remémoration",'en' => 'Reminder'), 'key', "reminder");
            I18n::add(array('fr'=>"Le mot de passe doit être de six caractères et correspondre à la confirmation.",'en' => ''), 'key', "reminder.password");
            I18n::add(array('fr'=>"Nous ne trouvons pas d'utilisateur avec cette adresse e-mail.",'en' => ''), 'key', "reminder.user");
            I18n::add(array('fr'=>"Ce reset token est invalide.",'en' => ''), 'key', "reminder.token");

        //Auth Constant text
            //General (User)
            I18n::add(array('fr' => 'Authentification', 'en'=>'Authentification'), 'key', 'auth');
            I18n::add(array('fr' => 'Connexion', 'en'=>''), 'key', 'auth.connexion');
            I18n::add(array('fr' => "Authorisation refusé !", 'en'=>''), 'key', 'auth.you_are_not_authorized');
            
            //Login
            I18n::add(array('fr' => 'Se déconnecter', 'en'=>''), 'key', 'auth.logout');
            I18n::add(array('fr' => 'Se connecter', 'en'=>''), 'key', 'auth.login');
            I18n::add(array('fr' => 'Mot de passe', 'en'=>''), 'key', 'auth.password');

            //User
            I18n::add(array('fr' => 'Email', 'en'=>''), 'key', 'auth.email');
            I18n::add(array('fr' => 'Profil', 'en'=>''), 'key', 'auth.profile');
            I18n::add(array('fr' => 'Mon profil', 'en'=>''), 'key', 'auth.show_profil');
            I18n::add(array('fr' => 'Modifiez son profil', 'en'=>''), 'key', 'auth.edit_account');
            I18n::add(array('fr' => 'Création de compte', 'en'=>''), 'key', 'auth.create_account');
            I18n::add(array('fr' => 'Compte mis à jour', 'en'=>''), 'key', 'auth.account_updated');
            I18n::add(array('fr' => 'Il y a eu un problème lors de l\'inscription... Veuillez, s\'il vous plaît, recommencer.', 'en'=>''), 'key', 'auth.error_saving');
            I18n::add(array('fr' => 'Votre compte a bien été créé.', 'en'=>''), 'key', 'auth.account_created');
            I18n::add(array('fr' => 'Cette utilisateur n\'existe pas !.', 'en'=>'User not exist !'), 'key', 'auth.user_unexisted');
            I18n::add(array('fr' => 'Vous devez être connecté !', 'en'=>''), 'key', 'auth.you_must_be_logged');
            I18n::add(array('fr' => 'Rôle utilisateur', 'en'=>''), 'key', 'auth.role');

            //Password
            I18n::add(array('fr' => 'Demander un nouveau mot de passe', 'en'=>''), 'key', 'auth.ask_new_password');
            I18n::add(array('fr' => 'Mot de passe oublié', 'en'=>''), 'key', 'auth.forgot_password');
            I18n::add(array('fr' => 'Ancien Mot de passe', 'en'=>''), 'key', 'auth.oldpassword');
            I18n::add(array('fr' => 'Votre ancien mot de passe est invalide !', 'en'=>''), 'key', 'auth.icorrect_old_password');
            I18n::add(array('fr' => 'Merci, nous venons de vous envoyer un email avec votre nouveau mot de passe !', 'en'=>''), 'key', 'auth.email_forgot_send');
            I18n::add(array('fr' => 'Veuillez saisir votre adresse email, nous pourrons ensuite vous envoyer par mail votre nouveau mot de passe !', 'en'=>''), 'key', 'auth.forgot_password_message');
            I18n::add(array('fr' => 'Votre nouveau mot de passe a été enregistré avec succès !', 'en'=>''), 'key', 'auth.your_password_succes_save');

        //Comment Constant text
            I18n::add(array('fr'=>'Module commentraire', 'en'=>'Comment Module'), 'key', 'comment');
            I18n::add(array('fr'=>'commentaire', 'en'=>''), 'key', 'comment.comment');
            I18n::add(array('fr'=>'commentaires', 'en'=>''), 'key', 'comment.comments');
            I18n::add(array('fr'=>'Laissez un message', 'en'=>''), 'key', 'comment.placeHolder');
            I18n::add(array('fr'=>'Répondre', 'en'=>''), 'key', 'comment.reply');
            I18n::add(array('fr'=>'Modifier', 'en'=>''), 'key', 'comment.edit');
            I18n::add(array('fr'=>'Poster votre message', 'en'=>''), 'key', 'comment.submit');
            I18n::add(array('fr'=>'Commentaire introuvable !', 'en'=>''), 'key', 'comment.not_find');
            I18n::add(array('fr'=>'Soyez le premier à laisser votre avis !', 'en'=>''), 'key', 'comment.be_the_first');
            I18n::add(array('fr'=>'Merci pour votre  message ! :)', 'en'=>''), 'key', 'comment.store_success');
            I18n::add(array('fr'=>'Message supprimé !', 'en'=>''), 'key', 'comment.destroy_success');
            I18n::add(array('fr'=>'Le message n\'a pas pu être supprimé... Veuillez réessayer !', 'en'=>''), 'key', 'comment.destroy_fail');
            I18n::add(array('fr'=>'Vous ne pouvez pas supprimer ce message !', 'en'=>''), 'key', 'comment.destroy_denied');
            I18n::add(array('fr'=>'La suppression des votes du message n\'ont pas pu être supprimés... Veuillez réessayer !', 'en'=>''), 'key', 'comment.destroy_comment_vote_fail');
            I18n::add(array('fr'=>'La suppression des réponses du message n\'ont pas pu être supprimées... Veuillez réessayer !', 'en'=>''), 'key', 'comment.destroy_child_fail');
            I18n::add(array('fr'=>'La suppression des votes des réponses n\'ont pas pu être supprimés... Veuillez réessayer !', 'en'=>''), 'key', 'comment.destroy_child_vote_fail');
            I18n::add(array('fr'=>'Commentaire modifié avec succès !', 'en'=>''), 'key', 'comment.edit_success');
            I18n::add(array('fr'=>'Le commentaire n\'a pas pu être modifié... Veuillez réessayer !', 'en'=>''), 'key', 'comment.edit_fail');
            I18n::add(array('fr'=>'Méthode de requête non autorisée', 'en'=>''), 'key', 'comment.update_405');
            I18n::add(array('fr'=>'Impossible de signaler votre commentaire', 'en'=>''), 'key', 'comment.signal_fail');
            I18n::add(array('fr'=>'Signaler comme commentaire indésirable', 'en'=>''), 'key', 'comment.report_long');
            I18n::add(array('fr'=>'Signaler un commentaire', 'en'=>''), 'key', 'comment.report_short');
            I18n::add(array('fr'=>'Pourquoi signaler ce commentaire ?', 'en'=>''), 'key', 'comment.report_why');
            I18n::add(array('fr'=>'Signaler', 'en'=>'Report'), 'key', 'comment.report');
            I18n::add(array('fr'=>'Vous avez déjà signaler ce commentaire', 'en'=>'Report'), 'key', 'comment.already_report');




            //vote
            I18n::add(array('fr'=>'+1', 'en'=>''), 'key', 'comment.vote_up');
            I18n::add(array('fr'=>'-1', 'en'=>''), 'key', 'comment.vote_down');
            I18n::add(array('fr'=>'Vote annulé !', 'en'=>''), 'key', 'comment.vote_canceled_success');
            I18n::add(array('fr'=>'Vote inversé !', 'en'=>''), 'key', 'comment.vote_reverse_success');
            I18n::add(array('fr'=>'Vote enregistré avec succès !', 'en'=>''), 'key', 'comment.vote_success');
            I18n::add(array('fr'=>'Ce vote n\'a pass pu être enregistré... Veuillez réessayer !', 'en'=>''), 'key', 'comment.vote_fail');


        //see action in public and controller...
        //lang.comment 
        //lang.button
        //lang.auth
        //lang.general

    }

}