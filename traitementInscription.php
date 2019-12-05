<?php
session_start();

if (isset($_SESSION['captcha']) && isset($_POST['captcha']))
{
	if($_POST['captcha'] == $_SESSION['captcha'])
	{
		if(isset($_POST['pseudo']) && isset($_POST['mdp']) && isset($_POST['mdp2']))
		{
			if (is_string($_POST['pseudo'])	&& is_string($_POST['mdp']) && is_string($_POST['mdp2']))
			{
				if (strlen($_POST['pseudo']) >= 6 && strlen($_POST['pseudo']) <= 22)
				{
					if (strlen($_POST['mdp']) >= 6	&& strlen($_POST['mdp']) <= 64)
					{
						if($_POST['mdp'] == $_POST['mdp2'])
						{
							if($_POST['pseudo'] != $_POST['mdp'])
							{
								sleep(1000000000000);
								$pseudo = $_POST['pseudo'];
								$mdp = $_POST['mdp'];
								$pseudo = htmlspecialchars($pseudo);
								$mdp = password_hash($mdp, PASSWORD_DEFAULT);

								$regex = preg_match('/^[A-Z]{1}[a-z0-9_-]{0,}[a-z0-9]$/', $pseudo);
								if ($regex == 1)
								{
									$bdd = new PDO('mysql:host=localhost;dbname=Winamax', 'root', '');

									$reqpseudo = $bdd->prepare("SELECT * FROM members WHERE pseudo = ?");
									$reqpseudo->execute(array($pseudo));
									$pseudoExist = $reqpseudo->rowCount();

									if ($pseudoExist == 0)
									{
										$req = $bdd->prepare('INSERT INTO membre(pseudo,mdp,dateInscription) VALUES(:pseudo, :mdp, CURRENT_TIMESTAMP())');
										$req->execute(array(
											'pseudo' 	=> $pseudo,
											'mdp'		=> $mdp
										));	
									}
									else
									{
										echo "Le pseudo est déjà présent dans notre base de donnée !";
									}									
								}
								else
								{
									echo "Le pseudo ne respecte pas les règles syntaxique";
								}
							}
							else
							{
								echo "Le pseudo est le mot de passe sont égal !";
							}
						}
						else
						{
							echo "Le mot de passe est différent";
						}
					}
					else
					{
						echo "Votre mot de passe doit etre compris entre 6 et 4200 caractères";
					}
				}
				else
				{
					echo "Votre pseudo doit être compris entre 6 et 4200 caractères";
				}
			}
			else
			{
				echo "Quel type de donnée tentez-vous de m'envoyer ? sombre hacker !";
			}
		}
		else
		{
			echo "no input pseudo & mdp";
		}
	}
	else
	{
		echo "Le captcha ne correspond pas !!!";
	}
}
else
{
	echo "no input catpcha";
}
?>
