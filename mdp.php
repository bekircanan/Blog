<?php
require_once 'header.php';
use PHPMailer\PHPMailer\PHPMailer;
require '.\vendor\autoload.php';

function smtp($email, $subject, $body){
    $mail = new PHPMailer();
    $mail->IsSMTP(); 
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = "tls";
    $mail->Host = "smtp.gmail.com";
    $mail->Port = 587;
    $mail->isHTML(true);
    $mail->CharSet = 'UTF-8';
    $mail->Username = "bolg.mdp@gmail.com";
    $mail->Password = "igmbkulkriqskwey";
    $mail->AddAddress($email);
    $mail->SetFrom("bolg.mdp@gmail.com");
    $mail->Subject = $subject;
    $mail->Body = $body;
    $mail->SMTPOptions=array('ssl'=>array(
        'verify_peer'=>false,
        'verify_peer_name'=>false,
        'allow_self_signed'=>false
    ));
    if(!$mail->Send()){
        return 'Erreur: '.$mail->ErrorInfo;
    }else{
        return 'Mail envoyé';
    }
}

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $stmt = $conn->prepare("SELECT idUser, pseudo FROM user WHERE email = :email");
    $stmt->bindParam(':email', $_POST['email']);
    $stmt->execute();
    $user = $stmt->fetch();
    if($user){
        $token = bin2hex(random_bytes(32));
        echo smtp($_POST['email'], 'Réinitialisation de mot de passe', 'Cliquez sur le lien suivant pour réinitialiser votre mot de passe: http://localhost/reset.php?token='.$token);
    } else {
        echo 'Aucun compte n\'est associé à cet email.';
    }
}
?>

<form method="Post">
    <label for="email">Email:</label>
    <input type="email" name="email" required>
    <br>
    <button type="submit">Envoyer un mail de réinitialisation</button>
</form>

<?php
require_once 'footer.php';
?>