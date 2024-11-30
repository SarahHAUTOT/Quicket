<?php

use CodeIgniter\Email\Email;
use CodeIgniter\I18n\Time;

const __EMAIL0 = new Email([
	'protocol'=>'smtp',
	'SMTPHost'=>'smtp.googlemail.com',
	'SMTPUser'=>'quicket.noreply@gmail.com',
	'SMTPPass'=>'tnss xpbc ambf ecer',
	'SMTPPort'=>587,
	'SMTPTimeout'=>15,
	'mailType'=>'html',
	'newLine'=>"\r\n",
	'charset'=>'utf-8',
	'SMTPCrypto'=>'tls',
]);

__EMAIL0->setFrom('quicket.noreply@gmail.com', 'Quicket');

/**
 * Méthode générique pour envoyer des mails depuis le serveur en passant
 * par le serveur SMTP de Google et le compte associé à l'application.
 *
 * PS : Si vous voulez conserver votre sanité, je vous recommande de ne PAS lire
 * le code qui se trouve juste au-dessus du HTML.
 *
 * @param string $mail L'adresse mail du destinataire.
 * @param string $sujet Le sujet du mail.
 * @param string $corps Le corps du mail
 * @param string $titre Le titre, juste avant le corps.
 * @param string $lien_btn Le lien lié au bouton.
 * @param string $sous_titre Le sous-titre, optionnel.
 * @param string $msg_bouton Le message affiché sur le bouton, "Afficher" par défaut.
 * @param string $corps2 Corps du mail secondaire, sous le bouton, optionnel.
 * @return bool Retourne <i>true</i> si le mail a été envoyé avec succès, sinon <i>false</i>.
 */
function envoyer_mail(string $mail, string $sujet, string $corps, string $titre, string $lien_btn, string $sous_titre = "", string $msg_bouton = "Afficher", string $corps2 = ""): bool {
	__EMAIL0->setTo($mail);
	__EMAIL0->setSubject($sujet);
	$paragraphes = array_map(fn($e) => "<p style='text-align: left; line-height: 24px; font-size: 16px; color: black; width: 100%; margin: 0;'>$e</p>",	preg_split("#".PHP_EOL.PHP_EOL."#", $corps) ?: [$corps]);
	$paragraphes = join('<table class="s-3 w-full" role="presentation" border="0" cellpadding="0" cellspacing="0" style="width: 100%;" width="100%">
	<tbody>
	  <tr>
		<td style="line-height: 12px; font-size: 12px; width: 100%; height: 12px; margin: 0;" align="left" width="100%" height="12">
		  &nbsp;
		</td>
	  </tr>
	</tbody>
  </table>', $paragraphes);
	$paragraphes2 = "";
	if (!empty($corps2)) {
		$paragraphes2 = array_map(fn($e) => "<p style='text-align: center; line-height: 24px; font-size: 16px; color: black; width: 100%; margin: 0;'>$e</p>", preg_split
		("#".PHP_EOL.PHP_EOL."#", $corps2) ?: [$corps2]);
		$paragraphes2 = '<table class="s-3 w-full" role="presentation" border="0" cellpadding="0" cellspacing="0" style="width: 100%;" width="100%">
	<tbody>
	  <tr>
		<td style="line-height: 12px; font-size: 12px; width: 100%; height: 12px; margin: 0;" align="left" width="100%" height="12">
		  &nbsp;
		</td>
	  </tr>
	</tbody>
  </table>'.join('<table class="s-3 w-full" role="presentation" border="0" cellpadding="0" cellspacing="0" style="width: 100%;" width="100%">
	<tbody>
	  <tr>
		<td style="line-height: 12px; font-size: 12px; width: 100%; height: 12px; margin: 0;" align="left" width="100%" height="12">
		  &nbsp;
		</td>
	  </tr>
	</tbody>
  </table>', $paragraphes2);
	}
	
	__EMAIL0->setMessage('<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
	<head>
    <!-- Compiled with Bootstrap Email version: 1.5.1 --><meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="x-apple-disable-message-reformatting">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="format-detection" content="telephone=no, date=no, address=no, email=no">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <style type="text/css">
      body,table,td{font-family:Helvetica,Arial,sans-serif !important}.ExternalClass{width:100%}.ExternalClass,.ExternalClass p,.ExternalClass span,.ExternalClass font,.ExternalClass td,.ExternalClass div{line-height:150%}a{text-decoration:none}*{color:inherit}a[x-apple-data-detectors],u+#body a,#MessageViewBody a{color:inherit;text-decoration:none;font-size:inherit;font-family:inherit;font-weight:inherit;line-height:inherit}img{-ms-interpolation-mode:bicubic}table:not([class^=s-]){font-family:Helvetica,Arial,sans-serif;mso-table-lspace:0pt;mso-table-rspace:0pt;border-spacing:0px;border-collapse:collapse}table:not([class^=s-]) td{border-spacing:0px;border-collapse:collapse}@media screen and (max-width: 600px){.w-full,.w-full>tbody>tr>td{width:100% !important}*[class*=s-lg-]>tbody>tr>td{font-size:0 !important;line-height:0 !important;height:0 !important}.s-2>tbody>tr>td{font-size:8px !important;line-height:8px !important;height:8px !important}.s-3>tbody>tr>td{font-size:12px !important;line-height:12px !important;height:12px !important}.s-5>tbody>tr>td{font-size:20px !important;line-height:20px !important;height:20px !important}.s-10>tbody>tr>td{font-size:40px !important;line-height:40px !important;height:40px !important}}.space-y-3{margin: 0 calc(50% / 2);background-color: #E2E2E2E0;padding: 8px 10px;}
    </style>
  </head>
  <body class="bg-light" style="outline: 0; width: 100%; min-width: 100%; height: 100%; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; font-family: Helvetica, Arial, sans-serif; line-height: 24px; font-weight: normal; font-size: 16px; -moz-box-sizing: border-box; -webkit-box-sizing: border-box; box-sizing: border-box; color: #000000; margin: 0; padding: 0; border-width: 0;" bgcolor="#f7fafc">
    <table class="bg-light body" valign="top" role="presentation" border="0" cellpadding="0" cellspacing="0" style="outline: 0; width: 100%; min-width: 100%; height: 100%; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; font-family: Helvetica, Arial, sans-serif; line-height: 24px; font-weight: normal; font-size: 16px; -moz-box-sizing: border-box; -webkit-box-sizing: border-box; box-sizing: border-box; color: #000000; margin: 0; padding: 0; border-width: 0;" bgcolor="#f7fafc">
      <tbody>
        <tr>
          <td valign="top" style="line-height: 24px; font-size: 16px; margin: 0;" align="left" bgcolor="#f7fafc">
            <table class="container" role="presentation" border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
              <tbody>
                <tr>
                  <td align="center" style="line-height: 24px; font-size: 16px; margin: 0; padding: 0 16px;">
                    <!--[if (gte mso 9)|(IE)]>
                      <table align="center" role="presentation">
                        <tbody>
                          <tr>
                            <td width="600">
                    <![endif]-->
                    <table align="center" role="presentation" border="0" cellpadding="0" cellspacing="0" style="width: 100%; max-width: 80%; margin: 0 auto;">
                      <tbody>
                        <tr>
                          <td style="line-height: 24px; font-size: 16px; margin: 0;" align="left">
                            <table class="s-10 w-full" role="presentation" border="0" cellpadding="0" cellspacing="0" style="width: 100%;" width="100%">
                              <tbody>
                                <tr>
                                  <td style="line-height: 40px; font-size: 40px; width: 100%; height: 40px; margin: 0;" align="left" width="100%" height="40">
                                    &nbsp;
                                  </td>
                                </tr>
                              </tbody>
                            </table>
                            <table class="card" role="presentation" border="0" cellpadding="0" cellspacing="0" style="border-radius: 6px;border-collapse: separate !important;width: 100%;overflow: hidden;border: 2px solid #e60026;" bgcolor="#ffffff">
                              <tbody>
                                <tr>
                                  <td style="line-height: 24px; font-size: 16px; width: 100%; margin: 0;" align="left" bgcolor="#ffffff">
                                    <table class="card-body" role="presentation" border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
                                      <tbody>
                                        <tr>
                                          <td style="line-height: 24px;font-size: 16px;width: 100%;margin: 0;padding: 20px;background-image: url(https://i.ibb.co/wJMkbRP/bg.png);background-repeat: no-repeat;background-position: bottom;background-size: contain;" align="left">
                                            <a href="'.base_url().'" target="_blank" style="color: #0d6efd;">
                                              <img src="https://i.ibb.co/hdV7vnR/Logo-Nom-Horizontal.png" style="height: 50px; line-height: 100%; outline: none; text-decoration: none; display: block; border-style: none; border-width: 0;">
                                            </a>
                                            <h1 class="h3  text-center" style="padding-top: 0; padding-bottom: 0; font-weight: 500; vertical-align: baseline; font-size: 28px; line-height: 33.6px; margin: 0;" align="center">'.$titre.'</h1>
                                            <table class="s-2 w-full" role="presentation" border="0" cellpadding="0" cellspacing="0" style="width: 100%;" width="100%">
                                              <tbody>
                                                <tr>
                                                  <td style="line-height: 8px; font-size: 8px; width: 100%; height: 8px; margin: 0;" align="left" width="100%" height="8">
                                                    &nbsp;
                                                  </td>
                                                </tr>
                                              </tbody>
                                            </table>
                                            <h5 class="text-teal-700 text-center" style="color: #13795b; padding-top: 0; padding-bottom: 0; font-weight: 500; vertical-align: baseline; font-size: 20px; line-height: 24px; margin: 0;" align="center">'.$sous_titre.'</h5>
                                            <table class="s-5 w-full" role="presentation" border="0" cellpadding="0" cellspacing="0" style="width: 100%;" width="100%">
                                              <tbody>
                                                <tr>
                                                  <td style="line-height: 20px; font-size: 20px; width: 100%; height: 20px; margin: 0;" align="left" width="100%" height="20">
                                                    &nbsp;
                                                  </td>
                                                </tr>
                                              </tbody>
                                            </table>
                                            <table class="hr" role="presentation" border="0" cellpadding="0" cellspacing="0" style="width: 100%;height: 2.5px;">
                                              <tbody>
                                                <tr>
                                                  <td style="line-height: 24px;font-size: 16px;border-top-width: 1px;border-top-color: #e2e8f0;border-top-style: solid;height: 2.5px;width: 100%;margin: 0;" align="left">
                                                  </td>
                                                </tr>
                                              </tbody>
                                            </table>
                                            <table class="s-5 w-full" role="presentation" border="0" cellpadding="0" cellspacing="0" style="width: 100%;" width="100%">
                                              <tbody>
                                                <tr>
                                                  <td style="line-height: 20px; font-size: 20px; width: 100%; height: 20px; margin: 0;" align="left" width="100%" height="20">
                                                    &nbsp;
                                                  </td>
                                                </tr>
                                              </tbody>
                                            </table>
                                            <div class="space-y-3" style="border-radius: 2.5px 2.5px 0 0;">
                                              '.$paragraphes.'
                                              <table class="s-5 w-full" role="presentation" border="0" cellpadding="0" cellspacing="0" style="width: 100%;" width="100%">
                                              <tbody>
                                                <tr>
                                                  <td style="line-height: 5px; font-size: 5px; width: 100%; height: 5px; margin: 0;" align="left" width="100%" height="20">
                                                    &nbsp;
                                                  </td>
                                                </tr>
                                              </tbody>
                                            </table>
                                            </div>
                                            
                                            <table class="btn btn-primary center-block" role="presentation" border="0" cellpadding="0" cellspacing="0" style="border-radius: 6px;border-collapse: separate !important;margin: 0 calc(50% / 2);width: 50%;">
                                              <tbody>
                                                <tr>
                                                  <td style="line-height: 24px; font-size: 16px;margin: 0;width: 50%;background-color: #E2E2E2E0;" align="center">
                                                    <a href="'.$lien_btn.'" target="_blank" style="color: #ffffff;font-size: 16px;font-family: Helvetica, Arial, sans-serif;text-decoration: none;border-radius: 6px;line-height: 20px;display: block;font-weight: normal;white-space: nowrap;background-color: #e60026;padding: 8px 12px;border: 1px solid #e60026;width: 50%;">'.$msg_bouton.'</a>
                                                  </td>
                                                </tr>
                                              </tbody>
                                            </table>
                                            <div class="space-y-3" style="border-radius: 0 0 2.5px 2.5px;">
												'.$paragraphes2.'
											</div>
                                          </td>
                                        </tr>
                                      </tbody>
                                    </table>
                                  </td>
                                </tr>
                              </tbody>
                            </table>
                            <table class="s-10 w-full" role="presentation" border="0" cellpadding="0" cellspacing="0" style="width: 100%;" width="100%">
                              <tbody>
                                <tr>
                                  <td style="line-height: 40px; font-size: 40px; width: 100%; height: 40px; margin: 0;" align="left" width="100%" height="40">
                                    &nbsp;
                                  </td>
                                </tr>
                              </tbody>
                            </table>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                    <!--[if (gte mso 9)|(IE)]>
                    </td>
                  </tr>
                </tbody>
              </table>
                    <![endif]-->
                  </td>
                </tr>
              </tbody>
            </table>
          </td>
        </tr>
      </tbody>
    </table>
</body></html>');
	if (__EMAIL0->send())
		return true;
	log_message("error", __EMAIL0->printDebugger());
	return false;
}

/**
 * Envoi un mail de vérification à un utilisateur qui vient de créer son compte.
 *
 * @param string $mail L'adresse mail de l'utilisateur.
 * @param string $jeton Le jeton pour activer le compte de l'utilisateur.
 * @param string $pseudo Le pseudo de l'utilisateur.
 * @return bool <i>True</i> si le mail a été envoyé, sinon <i>false</i>.
 */
function mail_certif_compte(string $mail, string $jeton, string $pseudo): bool {
	$lien = site_url("connexion/activation/$jeton");
	return envoyer_mail($mail, "Vérification de votre compte Quicket", "Bonjour $pseudo,

Merci de vous être inscrit sur ".APP_NAME." !

Nous sommes ravis de vous accueillir dans notre communauté.

Pour activer votre compte et commencer à utiliser toutes les fonctionnalités de notre application, veuillez cliquer sur le lien ci-dessous :", "Activez votre compte afin d'accéder à tout nos services !",	$lien, msg_bouton: "Activer mon compte", corps2: "Si le lien ci-dessus ne fonctionne pas, vous pouvez le copier et le coller dans votre navigateur :<br>$lien");
}

/**
 * Envoi un mail pour modifier le mot de passe d'un utilisateur.
 *
 * @param string $mail L'adresse mail de l'utilisateur.
 * @param string $jeton Le jeton pour "autoriser" la modification.
 * @param string $pseudo Le pseudo de l'utilisateur.
 * @return bool <i>True</i> si le mail a été envoyé, sinon <i>false</i>.
 * @throws Exception Dans le cas où {@link Time::now()} échouerait à récupérer la date.
 */
function mail_modifier_mdp(string $mail, string $jeton, string $pseudo): bool {
    $lien = site_url("connexion/mdp/$jeton");
    return envoyer_mail($mail, "Réinitialisation de votre mot de passe ".APP_NAME, "Bonjour $pseudo,

Vous avez demandé la réinitialisation de votre mot de passe le ".date('d/m/Y à H:i', time() + 3600).".

Si vous n'êtes pas à l'origine de cette demande, ignorez ce message.

Pour réinitialiser votre mot de passe, cliquez sur le lien ci-dessous :", "Réinitialisation de votre mot de passe ".APP_NAME, $lien, msg_bouton: "Réinitialiser", corps2: "Ce lien sera valide pendant 1 heure.");
}
