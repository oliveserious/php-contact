<?php

if(isset($_POST['submit'])) {

    $message=
    'Full Name:	'.$_POST['fullname'].'<br />
    Subject:	'.$_POST['subject'].'<br />
    Phone:      '.$_POST['phone'].'<br />
    Email:      '.$_POST['emailid'].'<br />
    Comments:	'.$_POST['comments'].'
    ';

    $fullname = $_POST['fullname'];
    $today = date("Y-m-d H:i:s");
    $subject = $_POST['subject'];
    $phone = $_POST['phone'];
    $emailid = $_POST['emailid'];
    $comments = $_POST['comments'];

    require "PHPMailer-master/class.phpmailer.php"; // include phpmailer class
      
    // Instantiate Class  
    $mail = new PHPMailer();  
      
    // Set up SMTP  
    $mail->IsSMTP();
    
    /* lignes permettant de tester la connexion lors de l'envoi d'un formulaire : indique toutes les étapes au format html dans le navigateur*/
    # $mail->SMTPDebug = 2; // attention, pour tester, retirer le # en début de ligne
    # $mail->Debugoutput = 'html';
    /****************************************************************************/
    
    // Messagerie
    $mail->SMTPSecure = "ssl";     
    $mail->Host = "smtp.gmail.com"; //Gmail SMTP server address or other
    $mail->Port = 465;  
    $mail->SMTPAuth = true; // Connection with the SMTP does require authorization  

    // Authentication  
    $mail->Username   = "ton adresse mail";
    $mail->Password   = "ton mot de passe";

      
    // Compose
    $mail->SetFrom($_POST['emailid'], $_POST['fullname']);
    $mail->AddReplyTo($_POST['emailid'], $_POST['fullname']);
    $mail->Subject = "Formulaire du site";      // Subject (which isn't required)  
    $mail->MsgHTML($message);
    
 
    // Send To  
    $mail->AddAddress("ton adresse mail", "ton nom"); // le nom n'est pas obligatoire, je crois !
    $result = $mail->Send();		 
    $message = $result ? 
        '<div class="alert alert-success" role="alert"><strong>Success!</strong>Message Sent Successfully!</div>'
        : '<div class="alert alert-danger" role="alert"><strong>Error!</strong>There was a problem delivering the message.</div>';  

    unset($mail);
}

?>

<!DOCTYPE html>
<html lang="en">
    
    <head>
        <meta charset="utf-8">
        <meta name="viewport"    content="width=device-width, initial-scale=1.0">
        <meta name="description" content="chemin site perso">
        <meta name="author"      content="olivier tessier 'loliveserious'">        
        <title>Titre vraiment con</title>            
        <link href="bootstrap.min.css" rel="stylesheet" type="text/css">
    </head>
    
    <body>
        <!-- Contact Section -->
        <section id="contact">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <h2 class="turquoise">Contact</h2>
                        <hr class="star-primary">
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <form name="form1" id="form1" action="" method="post">
                            <fieldset>
                                <input type="text" class="form-control" name="fullname" placeholder="Full Name" />
                                <br />
                                <input type="text" class="form-control" name="subject" placeholder="Subject" />
                                <br />
                                <input type="text" class="form-control" name="phone" placeholder="Phone" />
                                <br />
                                <input type="email" class="form-control" name="emailid" placeholder="Email" />
                                <br />
                                <textarea rows="4" class="form-control" cols="20" name="comments" placeholder="Comments"></textarea>
                                <br />
                                <input type="submit" class="btn btn-success"name="submit" value="Send Message" />
                            </fieldset>
                        </form>
                        <p><?php if(!empty($message)) echo $message; ?></p>
                    </div>
                </div>
            </div>
        </section>      
    </body>
</html>

