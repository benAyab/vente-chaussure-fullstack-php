<?php 
    session_start();
    include_once('../views/header.php');
?>
<body>

    <div id="loginModal" class="modal is-active">
        <div class="modal-background"></div>
        <div class="modal-card">
            <header class="modal-card-head">
            <p class="modal-card-title">Connexion</p>
            </header>
            <section class="modal-card-body">
            
                <div class="field">
                    <label class="label is-medium">Email</label>
                    <div class="control has-icons-left has-icons-right">
                        <input id="email" class="input" type="email" placeholder="Votre Email" value="">

                        <span class="icon is-medium is-left">
                            <i class="feather-mail"></i>
                        </span>
                        <span id="validEmailIcon" class="icon is-medium is-success is-right is-hidden">
                            <i class="feather feather-check"></i>
                        </span>
                        <span id="invalidEmailIcon" class="icon is-danger is-right is-hidden">
                            <i class="feather-alert-triangle"></i>
                        </span>
                    </div>

                    <p id="validEmailMsg" class="help is-success is-hidden">Email valide</p>
                    <p id="invalidEmailMsg" class="help is-danger is-hidden">Email invalide</p>
                </div>

                <div class="field">
                    <label class="label is-medium">Mot de passe</label>
                    <div class="control has-icons-left has-icons-right">
                        <input id="pwd" class="input" type="password"  placeholder="Votre mot de passe..." value="">
                    
                        <span  class="icon is-medium  is-left">
                            <i class="feather feather-lock"></i>
                        </span>
                        <span id="validPwdIcon" class="icon is-medium is-success is-right is-hidden">
                            <i class="feather feather-check"></i>
                        </span>
                        <span id="invalidPwdIcon" class="icon is-danger is-right is-hidden">
                            <i class="feather-alert-triangle"></i>
                        </span>

                    </div>
                    <p id="validPwdMsg" class="help is-success is-hidden">
                        Mot de passe valide
                    </p>
                    <p id="invalidPwdMsg" class="help is-danger is-hidden">
                        Invalide, le mot de passe doit avoir au moins six (6) caractères
                    </p>
                </div>
            </section>
            <footer class="modal-card-foot">
                <div class="control">
                    <button id="submit" class="button is-success is-rounded">Connexion</button>
                </div>
                <p style="margin-left: 10px;">
                    Vous n'avez pas de compte ? <a href="/public/inscription.php"> Créer un compte</a> 
                </p>
            </footer>
        </div>
    </div>
    <script src="/public/js/login.script.js"></script>
</body>
</html>
