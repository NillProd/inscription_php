<?php
session_start();

?>
	<div id="form">
		<form method="POST" id="subscribe" action="subscribe.php">
			<div>
				<label for="pseudo">Votre pseudo :</label><br>
				<input type="text" name="pseudo" id="pseudo" placeholder="Renseignez votre pseudo"/><br>
			</div>

			<div>
                <label for="mdp">Votre mot de passe :</label><br>
                <input type="password" name="mdp" id="mdp" palceholder="Renseignez votre mot de passe"/><br>
            </div>

			<div>
                <label for="mdp2">Confirmez le mot de passe :</label><br>
                <input type="password" name="mdp2" id="mdp2"/><br>
            </div>

            <div>
                <label for="captcha">Entrez les 4 chiffres suivant :</label>
                <img src="captcha/captcha.php" /><br>
                <input type="text" name="captcha" id="captcha"/>
            </div>

			<div>
                <label for="code">Entrez le <strong><a href="#">code de parrainage</a></strong></label><br>
				<input type="text" name="parrainage" placeholder="Code parrainage" id="parrain" />
            </div>

    		<input type="submit" name="validation">
			<p id ="erreur"></p>

			</form>
	</div>

</div>
</body>
</html>
