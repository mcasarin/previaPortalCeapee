Este projeto foi desenvolvido para atender a necessidade do cliente em cadastro e administração de eventos e cursos. Será proposto cadastro com autenticação por e-mail, upload de documentos para o perfil do usuário e ambiente para administração das inscrições.
Todas as fontes e recursos estão comentados nos arquivos adaptados e aqui.

Fonte: https://github.com/ldtalent/stephenilori-php-pdo (Adaptado)
abr2022
        ### Simple Login And Signup System Using PHP PDO
        The Db.php file in the Model directory is where we get to set our environment credentials.
        But before we get to that, you should probably try creating the database or you upload the *portalceapee.sql* (adaptado) file.
        Inside of the Db.php file, the following line is where you can change the database name, database host, database user, and the database password.
        ```php
            /** Database Name */
            protected $dbName = 'learning_dollars_db'; 
            /** Database Host */
            protected $dbHost = 'localhost'; 
            /** Database Root */
            protected $dbUser = 'root';
            /** Databse Password */
            protected $dbPass = '';
        ```
        After this, you can view the application in your broswer.

 Autenticação para validação por e-mail 
Fonte: https://www.webslesson.info/2017/12/php-registration-script-with-email-confirmation.html (Adaptado)
Utilizando biblioteca: https://github.com/PHPMailer/PHPMailer (Biblioteca)
abr22
