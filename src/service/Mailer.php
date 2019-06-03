<?php


namespace App\service;


use Twig\Environment;

class Mailer
{

    private $mailer;

    private $environment;

    public function __construct(\Swift_Mailer $mailer, Environment $environment)
    {
        $this->mailer = $mailer;
        $this->environment = $environment;
    }

    public function sendArticle(string $articleTitle, int $articleId): void
    {
        $message = (new \Swift_Message('Hello'))
                ->setFrom($_ENV['mail_from'])
                ->setTo('julien.letouzic1@gmail.com')
                ->setBody(
                    $this->environment->render(
                        'article/email/notification.html.twig',
                        [
                            'articleTitle' => $articleTitle,
                            'articleId' => $articleId
                        ]),
                    'text/html'
                    );

        $this->mailer->send($message);
    }
}