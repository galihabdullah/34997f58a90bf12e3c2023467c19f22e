<?php


namespace App;

use App\Models\Emails;
use Pheanstalk\Pheanstalk;
use PHPMailer\PHPMailer\PHPMailer;

class Consumer
{

    private $queue;
    /**
     * @var Pheanstalk
     */
    private $client;
    /**
     * @var \string[][]
     */
    private $config;

    public function __construct(array $args)
    {
        $this->config = ['queue' => ['host' => 'beanstalkd']]; // Don't mind this. I typically have a config file, but I moved it here for purposes of this tutorial. Use IP or Domain for the host.

        $this->queue = $args['queue'];
        $this->client = Pheanstalk::create('beanstalkd');
    }

    public function listen()
    {
        $this->client->watch($this->queue); // Pass the name of the queue again.

        while ($job = $this->client->reserve()) { // Do this forever... so it's always listening.
            $message = json_decode($job->getData(), true); // Decode the message
            $this->process($message);
            $this->client->delete($job);

        }
    }

    public function process($msg)
    {
        $emails = json_decode($msg, true);
        $content = $emails['message'];
        $sendMail = $this->sendEmail($emails);
        $sendMail->msgHTML($content);
        $status = $sendMail->send();
        if(!$status){
            $emails['status'] = 'failed';
            Emails::create($emails);
            echo "Error while sending Email.";
            return false;
        }
        $emails['status'] = 'sent';
        Emails::create($emails);
        return true;
    }

    public function setSMtp()
    {
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->Mailer = "smtp";
        $mail->SMTPDebug  = 1;
        $mail->SMTPAuth   = TRUE;
        $mail->SMTPSecure = "tls";
        $mail->Port       = 587;
        $mail->Host       = "smtp.gmail.com";
        $mail->Username   = "galihabdullahtestapp@gmail.com";
        $mail->Password   = "ismetyonardi123";
        return $mail;
    }

    public function sendEmail($attributes)
    {
        $mail = $this->setSMtp();
        $mail->AddAddress($attributes['to_email']);
        $mail->SetFrom("galihabdullahtestapp@gmail.com");
        $mail->Subject = $attributes['title'];
        return $mail;
    }
}